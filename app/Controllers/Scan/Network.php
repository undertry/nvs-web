<?php

namespace App\Controllers\Scan;
require_once __DIR__ . "/../../../vendor/autoload.php";
use phpseclib3\Net\SSH2;
use CodeIgniter\HTTP\CURLRequest;
use App\Controllers\BaseController;
use App\Models\tertiary\network\NetworkModel;
use App\Models\tertiary\network\SecurityModel;
use App\Models\tertiary\network\DeviceModel;
use App\Models\tertiary\network\Port_analysisModel;
use App\Models\tertiary\network\Port_detailsModel;
use App\Models\tertiary\network\PortsModel;
use App\Models\tertiary\network\SolutionModel;
use App\Models\tertiary\network\Port_statusModel;
use App\Models\secondary\form\scanModel;
use App\Models\secondary\form\Scan_detailsModel;

class Network extends BaseController
{
    // Función para mostrar las redes WiFi escaneadas
    public function index()
    {
      
        $client = \Config\Services::curlrequest();
        $ip = session("ip");
        
        // Obtener los datos de puertos, IP, MAC, servicios, OS
        $nmap_ports_services = $this->getNmapPortsServices($client, $ip);
        
        // Obtener las vulnerabilidades
        $nmap_vulnerabilities = $this->getNmapVulnerabilities($client, $ip);

        // Guardar los datos en la sesión para usarlos más tarde
        session()->set('nmap_ports_services', $nmap_ports_services);
        session()->set('nmap_vulnerabilities', $nmap_vulnerabilities);

        // Pasar los datos a la vista
        return view("modules/scan/views/index.html", [
            "nmap_ports_services" => $nmap_ports_services,
            "nmap_vulnerabilities" => $nmap_vulnerabilities,
        ]);
    }

    
    // Función para manejar la selección del modo de escaneo
    public function setScanMode()
    {
        $ip = session("ip");
        $client = \Config\Services::curlrequest();
        $mode = $this->request->getPost("mode"); // Obtener el modo seleccionado desde la vista
        $this->session->set("mode", $mode);
        // Validar que el modo sea uno de los aceptados y asignar el tiempo en segundos
        $scanDurations = [
            "quick" => 10,
            "intermediate" => 120,
            "deep" => 320,
        ];

        if (!isset($scanDurations[$mode])) {
            return redirect()
                ->back()
                ->with("error", "Modo de escaneo inválido.");
        }

        // Enviar el modo seleccionado y la duración a la API de la Raspberry Pi
        try {
            $response = $client->post("http://" . $ip . ":5000/set-scan-mode", [
                "json" => [
                    "mode" => $mode,
                    "duration" => $scanDurations[$mode],
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()
                    ->back()
                    ->with(
                        "success",
                        "Modo de escaneo establecido correctamente."
                    );
            } else {
                log_message(
                    "error",
                    "Error al establecer el modo de escaneo en la Raspberry Pi."
                );
                return redirect()
                    ->back()
                    ->with("error", "Error al establecer el modo de escaneo.");
            }
        } catch (\Exception $e) {
            log_message(
                "error",
                "Excepción capturada al intentar establecer el modo de escaneo: " .
                    $e->getMessage()
            );
            return redirect()
                ->back()
                ->with("error", "Excepción al establecer el modo de escaneo.");
        }
    }

    public function selectNetwork()
    {
        $networkModel = new NetworkModel();
        $securityModel = new SecurityModel();

        // Usa getJSON() para obtener los datos del JSON enviado en la solicitud POST
        $selectedNetwork = $this->request->getJSON(true);

        // Verifica si los datos se recibieron correctamente
        if (!$selectedNetwork) {
            return $this->response->setJSON([
                "success" => false,
                "message" => "Datos de red no recibidos correctamente.",
            ]);
        }

        $ip = session("ip");
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post("http://" . $ip . ":5000/save-network", [
                "json" => $selectedNetwork,
            ]);

            if ($response->getStatusCode() == 200) {
                $encryption = $selectedNetwork["encryption"];
                $id_security_type = $securityModel->IdSecurityType($encryption);
                //insercion para bd
                $selnet = [
                    "essid" => $selectedNetwork["essid"],
                    "bssid" => $selectedNetwork["bssid"],
                    "signal" => $selectedNetwork["signal"],
                    "channel" => $selectedNetwork["channel"],
                    "id_security_type" => $id_security_type,
                ];
                $id_network = $networkModel->networkinsert($selnet);
                //para la session
                $network = [
                    "essid" => $selectedNetwork["essid"],
                    "bssid" => $selectedNetwork["bssid"],
                    "signal" => $selectedNetwork["signal"],
                    "channel" => $selectedNetwork["channel"],
                    "security" => $selectedNetwork["encryption"],
                ];
                $this->session->set("current_network", $network);
                $this->session->set("id_network", $id_network);

                return $this->response->setJSON(["success" => true]);
            } else {
                log_message(
                    "error",
                    "Error al enviar la red seleccionada a la Raspberry Pi."
                );
                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Error al seleccionar la red.",
                ]);
            }
        } catch (\Exception $e) {
            log_message(
                "error",
                "Excepción capturada al intentar enviar la red a la Raspberry Pi: " .
                    $e->getMessage()
            );
            return $this->response->setJSON([
                "success" => false,
                "message" => "Excepción al seleccionar la red.",
            ]);
        }
    }

    public function startWifiScan()
    {
        $ip = session("ip");
        $user = session("raspberry_user");
        $password = session("raspberry_password");

        if (!$ip || !$user || !$password) {
            return redirect()
                ->back()
                ->with(
                    "wifi_message",
                    "Error: IP o credenciales no asignadas."
                );
        }

        try {
            // Crear instancia de SSH
            $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
            if (!$ssh->login($user, $password)) {
                throw new \Exception(
                    "Error: No se pudo establecer conexión SSH."
                );
            }

            // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
            $output = $ssh->exec("cd ~/nvs_project && python3 wifi_scan.py");

            $ssh->disconnect();

            // Evaluar el resultado para confirmar el éxito o el error
            if (strpos($output, "Error") === false) {
                return redirect()
                    ->back()
                    ->with(
                        "wifi_message",
                        "El escaneo de WiFi se inició correctamente."
                    );
            } else {
                throw new \Exception(
                    "Error durante la ejecución del escaneo de WiFi."
                );
            }
        } catch (\Exception $e) {
            if (isset($ssh)) {
                $ssh->disconnect();
            }
            return redirect()
                ->back()
                ->with("wifi_message", $e->getMessage());
        }
    }

    public function startDeviceScan()
    {
        $ip = session("ip");
        $user = session("raspberry_user");
        $password = session("raspberry_password");

        if (!$ip || !$user || !$password) {
            return redirect()
                ->back()
                ->with(
                    "device_message",
                    "Error: IP o credenciales no asignadas."
                );
        }

        try {
            // Crear instancia de SSH
            $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
            if (!$ssh->login($user, $password)) {
                throw new \Exception(
                    "Error: No se pudo establecer conexión SSH."
                );
            }

            // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
            $output = $ssh->exec("cd ~/nvs_project && python3 device_scan.py");

            $ssh->disconnect();

            // Evaluar el resultado para confirmar el éxito o el error
            if (strpos($output, "Error") === false) {
                return redirect()
                    ->back()
                    ->with(
                        "device_message",
                        "El escaneo de Dispositivo se realizo correctamente."
                    );
            } else {
                throw new \Exception(
                    "Error durante la ejecución del escaneo de Dispositivos."
                );
            }
        } catch (\Exception $e) {
            if (isset($ssh)) {
                $ssh->disconnect();
            }
            return redirect()
                ->back()
                ->with("device_message", $e->getMessage());
        }
    }

    public function startNmapScan()
    {
        $ip = session("ip");
        $user = session("raspberry_user");
        $password = session("raspberry_password");

        if (!$ip || !$user || !$password) {
            return redirect()
                ->back()
                ->with(
                    "nmap_message",
                    "Error: IP o credenciales no asignadas."
                );
        }

        try {
            // Crear instancia de SSH
            $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
            if (!$ssh->login($user, $password)) {
                throw new \Exception(
                    "Error: No se pudo establecer conexión SSH."
                );
            }
            $smode = session("mode");
            if ($smode && $smode == "deep") {
            // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
            $output = $ssh->exec("cd ~/nvs_project && nohup python3 nmap_scanner.py &");
            }else{
                $output = $ssh->exec("cd ~/nvs_project && python3 nmap_scanner.py ");
            }

            $ssh->disconnect();

            // Evaluar el resultado para confirmar el éxito o el error
            if (strpos($output, "Error") === false) {
                return redirect()
                    ->back()
                    ->with(
                        "nmap_message",
                        "El escaneo de Nmap se inició correctamente."
                    );
            } else {
                throw new \Exception(
                    "Error durante la ejecución del escaneo de Nmap."
                );
            }
        } catch (\Exception $e) {
            if (isset($ssh)) {
                $ssh->disconnect();
            }
            return redirect()
                ->back()
                ->with("nmap_message", $e->getMessage());
        }
    }

    public function mac()
    {
        $ip = session("ip");
        $user = session("raspberry_user");
        $password = session("raspberry_password");

        if (!$ip || !$user || !$password) {
            return redirect()
                ->back()
                ->with("mac_message", "Error: IP o credenciales no asignadas.");
        }

        try {
            // Crear instancia de SSH
            $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
            if (!$ssh->login($user, $password)) {
                throw new \Exception(
                    "Error: No se pudo establecer conexión SSH."
                );
            }

            // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
            $output = $ssh->exec(
                "cd ~/nvs_project && python3 mac_ip_matcher.py"
            );

            $ssh->disconnect();

            // Evaluar el resultado para confirmar el éxito o el error
            if (strpos($output, "Error") === false) {
                return redirect()
                    ->back()
                    ->with("mac_message", "Se encontraron dispositivos.");
            } else {
                throw new \Exception(
                    "Error durante la ejecución del escaneo de ips."
                );
            }
        } catch (\Exception $e) {
            if (isset($ssh)) {
                $ssh->disconnect();
            }
            return redirect()
                ->back()
                ->with("mac_message", $e->getMessage());
        }
    }

    public function saveResults()
    {
        // Recuperar los datos de la sesión
        $nmap_ports_services = session('nmap_ports_services');
        $nmap_vulnerabilities = session('nmap_vulnerabilities');

        // Obtener el id_user y id_network desde la sesión
        $id_user = session("user")->id_user;
        $id_network = session("id_network");

        // Modelos
        $scanModel = new ScanModel();
        $deviceModel = new DeviceModel();
        $scanDetailsModel = new Scan_detailsModel();
        $portsModel = new PortsModel();
        $portAnalysisModel = new Port_analysisModel();
        $portDetailsModel = new Port_detailsModel();
        $solutionModel = new SolutionModel();
        $portStatusModel = new Port_statusModel();

        // Insertar un nuevo escaneo
        $scan_id = $scanModel->insert([
            "id_user" => $id_user,
            "id_network" => $id_network,
        ]);

        // Insertar dispositivo en la base de datos
        $device_id = $deviceModel->insert([
            "ip_address" => $nmap_ports_services["ip"] ?? "N/A",
            "mac_address" => $nmap_ports_services["mac"] ?? "N/A",
            "operating_system" => $nmap_ports_services["os_info"] ?? "N/A",
        ]);

        // Insertar detalles del escaneo
        $scanDetailsModel->insert([
            "id_scan" => $scan_id,
            "id_devices" => $device_id,
        ]);

        // Procesar puertos y servicios asociados al dispositivo
        $this->processPortsAndServices($nmap_ports_services, $device_id, $portsModel, $portAnalysisModel, $portDetailsModel, $solutionModel, $portStatusModel);

        // Devolver una respuesta JSON
        return $this->response->setJSON(['success' => true, 'message' => 'Resultados guardados con éxito']);
    }

    private function getNmapPortsServices($client, $ip)
    {
        try {
            $response = $client->get("http://" . $ip . ":5000/nmap/ports-services");
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
        } catch (\Exception $e) {
            log_message("error", "Error al obtener puertos y servicios: " . $e->getMessage());
        }
        return [];
    }

    private function getNmapVulnerabilities($client, $ip)
    {
        try {
            $response = $client->get("http://" . $ip . ":5000/nmap/vulnerabilities");
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
        } catch (\Exception $e) {
            log_message("error", "Error al obtener vulnerabilidades: " . $e->getMessage());
        }
        return [];
    }

    private function processPortsAndServices($nmap_ports_services, $device_id, $portsModel, $portAnalysisModel, $portDetailsModel, $solutionModel, $portStatusModel)
    {
        $ports_services = $nmap_ports_services["ports_services"] ?? [];
        foreach ($ports_services as $service) {
            $port_name = $service["port"] ?? "Unknown Port";
            $state = $service["state"] ?? "Unknown State";
            $service_name = $service["service"] ?? "Unknown Service";

            $port_status = $portStatusModel->where('status', $state)->first();
            
            $port_id = $portsModel->insert([
                "port_name" => $port_name,
                "service" => $service_name,
                "id_port_status" => $port_status ? $port_status['id_port_status'] : null,
            ]);

            $port_analysis_id = $portAnalysisModel->insert([
                "id_port" => $port_id,
                "id_devices" => $device_id,
            ]);

            $vulnerabilities = $service["vulnerabilities"] ?? [];
            if (!empty($vulnerabilities)) {
                foreach ($vulnerabilities as $vuln) {
                    $solution_id = $solutionModel->insert([
                        "vulnerability_code" => $vuln["cve"] ?? "N/A",
                        "vuln_description" => $vuln["description"] ?? "No description available",
                    ]);

                    $portDetailsModel->insert([
                        "id_analysis" => $port_analysis_id,
                        "id_solution" => $solution_id,
                    ]);
                }
            } else {
                $solution_id = $solutionModel->insert([
                    "vulnerability_code" => "N/A",
                    "vuln_description" => "N/A",
                ]);

                $portDetailsModel->insert([
                    "id_analysis" => $port_analysis_id,
                    "id_solution" => $solution_id,
                ]);
            }
        }
    }

    public function ipset()
    {
        $ip = $this->request->getPost("ip");
        $this->session->set("ip", $ip);
        return redirect()->back()->with("success", "Ip asignadas correctamentes");;
    }

}
