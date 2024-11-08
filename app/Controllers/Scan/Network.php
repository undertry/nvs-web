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
        $ip = session("ip");
        $client = \Config\Services::curlrequest();

        try {
            // Solicitar los resultados del escaneo de redes WiFi a la API
            $response = $client->get("http://" . $ip . ":5000/scan");
            log_message("info", "Solicitud realizada a la API.");

            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                log_message(
                    "info",
                    "Datos recibidos: " . print_r($network, true)
                );
            } else {
                log_message(
                    "error",
                    "Error en la respuesta de la API: " .
                        $response->getStatusCode()
                );
                $network = [];
            }
        } catch (\Exception $e) {
            log_message(
                "error",
                "Excepción capturada al intentar conectarse a la API: " .
                    $e->getMessage()
            );
            $network = [];
        }

        return view("tertiary/network/network", ["network" => $network]);
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

            // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
            $output = $ssh->exec("cd ~/nvs_project && python3 nmap_scanner.py");

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

    // Nueva función para manejar los resultados de Nmap
    public function nmapResults()
    {
        $client = \Config\Services::curlrequest();
        $ip = session("ip");
        // Obtener los datos de puertos, IP, MAC, servicios, OS
        try {
            $response = $client->get(
                "http://" . $ip . ":5000/nmap/ports-services"
            );

            log_message(
                "info",
                "Solicitud realizada a la API para puertos y servicios."
            );

            if ($response->getStatusCode() == 200) {
                $nmap_ports_services = json_decode($response->getBody(), true);
                log_message(
                    "info",
                    "Datos de puertos y servicios recibidos: " .
                        print_r($nmap_ports_services, true)
                );
            } else {
                log_message(
                    "error",
                    "Error en la respuesta de la API: " .
                        $response->getStatusCode()
                );
                $nmap_ports_services = [];
            }
        } catch (\Exception $e) {
            log_message(
                "error",
                "Excepción capturada al intentar conectarse a la API: " .
                    $e->getMessage()
            );
            $nmap_ports_services = [];
        }

        // Obtener las vulnerabilidades
        try {
            $response = $client->get(
                "http://" . $ip . ":5000/nmap/vulnerabilities"
            );
            log_message(
                "info",
                "Solicitud realizada a la API para vulnerabilidades."
            );

            if ($response->getStatusCode() == 200) {
                $nmap_vulnerabilities = json_decode($response->getBody(), true);
                log_message(
                    "info",
                    "Datos de vulnerabilidades recibidos: " .
                        print_r($nmap_vulnerabilities, true)
                );
            } else {
                log_message(
                    "error",
                    "Error en la respuesta de la API: " .
                        $response->getStatusCode()
                );
                $nmap_vulnerabilities = [];
            }
        } catch (\Exception $e) {
            log_message(
                "error",
                "Excepción capturada al intentar conectarse a la API: " .
                    $e->getMessage()
            );
            $nmap_vulnerabilities = [];
        }

        // Obtener el id_user y id_network desde la sesión
        $id_user = session("user")->id_user;
        $id_network = session("id_network"); // Verifica que esté correctamente almacenado en la sesión

        // Datos a guardar en la sesión
        $scanData = [
            "ip" => $nmap_ports_services["ip"] ?? "N/A",
            "mac" => $nmap_ports_services["mac"] ?? "N/A",
            "os_info" => $nmap_ports_services["os_info"] ?? "N/A",
        ];

        // Guardar los datos en la sesión
        session()->set("last_scan_data", $scanData);

        // Modelos
        $scanModel = new ScanModel();
        $deviceModel = new DeviceModel();
        $scanDetailsModel = new Scan_detailsModel();
        $portsModel = new PortsModel();
        $portAnalysisModel = new Port_analysisModel();
        $portDetailsModel = new Port_detailsModel();
        $solutionModel = new SolutionModel();
        $portStatusModel = new Port_statusModel(); // Asegúrate de que este modelo esté definido

        $scandat = [
            "id_user" => $id_user,
            "id_network" => $id_network,
        ];
        // Insertar un nuevo escaneo
        $scan_id = $scanModel->insertScan($scandat);
        // Verificar si los datos están disponibles
        $ip = $nmap_ports_services["ip"] ?? "N/A";
        $mac = $nmap_ports_services["mac"] ?? "N/A";
        $os_info = $nmap_ports_services["os_info"] ?? "N/A";

        $devicedat= [
            "ip_address" => $ip,
            "mac_address" => $mac,
            "operating_system" => $os_info,
        ];
        // Insertar dispositivo en la base de datos
        $device_id = $deviceModel->insertDevice($devicedat);

        $detailsdat= [
            "id_scan" => $scan_id,
            "id_devices" => $device_id,
        ];
        // Insertar detalles del escaneo
        $scanDetailsModel->insertDetails($detailsdat);

        // Procesar puertos y servicios asociados al dispositivo
        $ports_services = $nmap_ports_services["ports_services"] ?? [];
        if (!empty($ports_services)) {
            foreach ($ports_services as $service) {
                // Verificar los datos de cada puerto
                $port_name = $service["port"] ?? "Unknown Port";
                $state = $service["state"] ?? "Unknown State";
                $service_name = $service["service"] ?? "Unknown Service";

                // Obtener el estado del puerto desde la tabla port_status
                $port_status = $portStatusModel->getStatus($state);
                  
                $portdat= [
                    "port_name" => $port_name ?? "N/A",
                    "service" => $service_name ?? "N/A",
                    "id_port_status" => $port_status["id_port_status"] ?? "unknown",
                ];
                // Insertar información del puerto en la base de datos
                $port_id = $portsModel->insertPort($portdat);

                $analysisdat = [
                    "id_port" => $port_id,
                    "id_devices" => $device_id,
                ];
                // Insertar en port_analysis para asociar el puerto al dispositivo
                $port_analysis_id = $portAnalysisModel->insertAnalysis($analysisdat);

                // Procesar vulnerabilidades asociadas al puerto
                $vulnerabilities = $service["vulnerabilities"] ?? [];
                if (!empty($vulnerabilities)) {
                    foreach ($vulnerabilities as $vuln) {
                        // Obtener detalles de la vulnerabilidad
                        $cve = $vuln["cve"] ?? "N/A";
                        $description = $vuln["description"] ?? "No description available";

                        $solutiondat= [
                            "vulnerability_code" => $cve,
                            "vuln_description" => $description,
                        ];
                        // Insertar la solución (vulnerabilidad) en la base de datos
                        $solution_id = $solutionModel->insertSolution($solutiondat);

                        $portdetdat= [
                            "id_analysis" => $port_analysis_id,
                            "id_solution" => $solution_id,
                        ];
                        // Asociar la vulnerabilidad con el análisis de puerto
                        $portDetailsModel->insertPortdet($portdetdat);
                    }
                } else {
                    // Insertar sin solución
                    $nosolut =[
                        "vulnerability_code" => "N/A",
                        "vuln_description" => "N/A",
                    ];
                    $solution_id = $solutionModel->insertNosolut($nosolut);
                        
                    //port detail no solution
                    $portdetns=[
                        "id_analysis" => $port_analysis_id,
                        "id_solution" => $solution_id,
                    ];
                    // Asociar la vulnerabilidad con el análisis de puerto
                    $portDetailsModel->insertPortdetns($portdetns);
                }
            }
        }

        // Pasar los datos a la vista (opcional)
        return view("modules/scan/views/index.html", [
            "nmap_ports_services" => $nmap_ports_services,
            "nmap_vulnerabilities" => $nmap_vulnerabilities,
        ]);
    }

    public function ipset()
    {
        $ip = $this->request->getPost("ip");
        $this->session->set("ip", $ip);
        return redirect()->back()->with("success", "Ip asignadas correctamentes");;
    }

}
