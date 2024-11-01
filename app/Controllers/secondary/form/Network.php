<?php

namespace App\Controllers\secondary\form;

use CodeIgniter\HTTP\CURLRequest;
use App\Controllers\main\BaseController;
use \App\Models\tertiary\network\NetworkModel;
use \App\Models\tertiary\network\SecurityModel;
use \App\Models\tertiary\network\DeviceModel;
use \App\Models\tertiary\network\Port_analysisModel;
use \App\Models\tertiary\network\Port_detailsModel;
use \App\Models\tertiary\network\PortsModel;
use \App\Models\tertiary\network\SolutionModel;
use \App\Models\tertiary\network\Port_statusModel;
use \App\Models\secondary\form\scanModel;
use \App\Models\secondary\form\Scan_detailsModel;

class Network extends BaseController
{
    // Función para mostrar las redes WiFi escaneadas
    public function index()
    {
        $ip = session('ip');
        $client = \Config\Services::curlrequest();

        try {
            // Solicitar los resultados del escaneo de redes WiFi a la API
            $response = $client->get('http://' . $ip . ':5000/scan');
            log_message('info', 'Solicitud realizada a la API.');

            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                log_message('info', 'Datos recibidos: ' . print_r($network, true));
            } else {
                log_message('error', 'Error en la respuesta de la API: ' . $response->getStatusCode());
                $network = [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar conectarse a la API: ' . $e->getMessage());
            $network = [];
        }

        return view('tertiary/network/network', ['network' => $network]);
    }
    // Función para manejar la selección del modo de escaneo
    public function setScanMode()
    {
        $ip = session('ip');
        $client = \Config\Services::curlrequest();
        $mode = $this->request->getPost('mode'); // Obtener el modo seleccionado desde la vista
        $this->session->set("mode", $mode);
        // Validar que el modo sea uno de los aceptados y asignar el tiempo en segundos
        $scanDurations = [
            'rapido' => 10,
            'intermedio' => 120,
            'profundo' => 320
        ];

        if (!isset($scanDurations[$mode])) {
            return redirect()->back()->with('error', 'Modo de escaneo inválido.');
        }

        // Enviar el modo seleccionado y la duración a la API de la Raspberry Pi
        try {
            $response = $client->post('http://' . $ip . ':5000/set-scan-mode', [
                'json' => [
                    'mode' => $mode,
                    'duration' => $scanDurations[$mode]
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->back()->with('success', 'Modo de escaneo establecido correctamente.');
            } else {
                log_message('error', 'Error al establecer el modo de escaneo en la Raspberry Pi.');
                return redirect()->back()->with('error', 'Error al establecer el modo de escaneo.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar establecer el modo de escaneo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Excepción al establecer el modo de escaneo.');
        }
    }


    public function showSetScanMode()
    {
        return view('tertiary/network/scan'); // Cargar la vista del formulario
    }



    // Función para manejar la selección de red WiFi
    public function selectNetwork()
    {
        $networkModel = new NetworkModel();
        $securityModel = new SecurityModel();

        // Usa getJSON() para obtener los datos del JSON enviado en la solicitud POST
        $selectedNetwork = $this->request->getJSON(true);

        // Verifica si los datos se recibieron correctamente
        if (!$selectedNetwork) {
            return $this->response->setJSON(['success' => false, 'message' => 'Datos de red no recibidos correctamente.']);
        }

        $ip = session('ip');
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('http://' . $ip . ':5000/save-network', [
                'json' => $selectedNetwork
            ]);

            if ($response->getStatusCode() == 200) {
                $encryption = $selectedNetwork['encryption'];
                $id_security_type = $securityModel->IdSecurityType($encryption);
                //insercion para bd
                $selnet = [
                    'essid' => $selectedNetwork['essid'],
                    'bssid' => $selectedNetwork['bssid'],
                    'signal' => $selectedNetwork['signal'],
                    'channel' => $selectedNetwork['channel'],
                    'id_security_type' => $id_security_type
                ];
                $id_network = $networkModel->networkinsert($selnet);
                //para la session
                $network = [
                    'essid' => $selectedNetwork['essid'],
                    'bssid' => $selectedNetwork['bssid'],
                    'signal' => $selectedNetwork['signal'],
                    'channel' => $selectedNetwork['channel'],
                    'security' => $selectedNetwork['encryption']
                ];
                $this->session->set("current_network", $network);
                $this->session->set("id_network", $id_network);

                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Error al enviar la red seleccionada a la Raspberry Pi.');
                return $this->response->setJSON(['success' => false, 'message' => 'Error al seleccionar la red.']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar enviar la red a la Raspberry Pi: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Excepción al seleccionar la red.']);
        }
    }




    public function startWifiScan()
    {
        $ip = session('ip');
        $client = \Config\Services::curlrequest([
            'timeout' => 340  // Tiempo en segundos
        ]);

        try {
            $response = $client->post("http://" . $ip . ":5000/start-wifi-scan");
            $body = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200) {
                $message = $body['message'] ?? 'El escaneo se completó correctamente.';
                return redirect()->back()->with('scan_message', $message);
            } else {
                $message = $body['message'] ?? 'Error al iniciar el escaneo.';
                return redirect()->back()->with('scan_message', $message);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error al conectar con el API server: ' . $e->getMessage());
            return redirect()->back()->with('scan_message', 'Error: No se pudo conectar con el API server.');
        }
    }

    public function startDeviceScan()
    {
        $ip = session('ip');
        $client = \Config\Services::curlrequest([
            'timeout' => 340  // Tiempo en segundos
        ]);

        try {
            $response = $client->post("http://$ip:5000/start-device-scan");
            $body = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200) {
                $message = $body['message'] ?? 'El escaneo se inició correctamente.';
                return redirect()->back()->with('scan_message', $message);
            } else {
                $message = $body['message'] ?? 'Error al iniciar el escaneo.';
                return redirect()->back()->with('scan_message', $message);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error al conectar con el API server: ' . $e->getMessage());
            return redirect()->back()->with('scan_message', 'Error: No se pudo conectar con el API server.');
        }
    }



    // Nueva función para manejar los resultados de Nmap
    public function nmapResults()
    {
        $client = \Config\Services::curlrequest();
        $ip = session('ip');
        // Obtener los datos de puertos, IP, MAC, servicios, OS
        try {

            $response = $client->get('http://' . $ip . ':5000/nmap/ports-services');

            log_message('info', 'Solicitud realizada a la API para puertos y servicios.');

            if ($response->getStatusCode() == 200) {
                $nmap_ports_services = json_decode($response->getBody(), true);
                log_message('info', 'Datos de puertos y servicios recibidos: ' . print_r($nmap_ports_services, true));
            } else {
                log_message('error', 'Error en la respuesta de la API: ' . $response->getStatusCode());
                $nmap_ports_services = [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar conectarse a la API: ' . $e->getMessage());
            $nmap_ports_services = [];
        }

        // Obtener las vulnerabilidades
        try {
            $response = $client->get('http://' . $ip . ':5000/nmap/vulnerabilities');
            log_message('info', 'Solicitud realizada a la API para vulnerabilidades.');

            if ($response->getStatusCode() == 200) {
                $nmap_vulnerabilities = json_decode($response->getBody(), true);
                log_message('info', 'Datos de vulnerabilidades recibidos: ' . print_r($nmap_vulnerabilities, true));
            } else {
                log_message('error', 'Error en la respuesta de la API: ' . $response->getStatusCode());
                $nmap_vulnerabilities = [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar conectarse a la API: ' . $e->getMessage());
            $nmap_vulnerabilities = [];
        }

        // Obtener el id_user y id_network desde la sesión
        $id_user = session('user')->id_user;
        $id_network = session('id_network');  // Verifica que esté correctamente almacenado en la sesión

        // Datos a guardar en la sesión
        $scanData = [
            'ip' => $nmap_ports_services['ip'] ?? 'N/A',
            'mac' => $nmap_ports_services['mac'] ?? 'N/A',
            'os_info' => $nmap_ports_services['os_info'] ?? 'N/A',
        ];

        // Guardar los datos en la sesión
        session()->set('last_scan_data', $scanData);

        // Modelos
        $scanModel = new ScanModel();
        $deviceModel = new DeviceModel();
        $scanDetailsModel = new Scan_detailsModel();
        $portsModel = new PortsModel();
        $portAnalysisModel = new Port_analysisModel();
        $portDetailsModel = new Port_detailsModel();
        $solutionModel = new SolutionModel();
        $portStatusModel = new Port_statusModel();  // Asegúrate de que este modelo esté definido

        // Insertar un nuevo escaneo
        $scan_id = $scanModel->insert([
            'id_user' => $id_user,
            'id_network' => $id_network,
        ]);
        // Verificar si los datos están disponibles
        $ip = $nmap_ports_services['ip'] ?? 'N/A';
        $mac = $nmap_ports_services['mac'] ?? 'N/A';
        $os_info = $nmap_ports_services['os_info'] ?? 'N/A';

        // Insertar dispositivo en la base de datos
        $device_id = $deviceModel->insert([
            'ip_address' => $ip ?? 'N/A',
            'mac_address' => $mac ?? 'N/A',
            'operating_system' => $os_info ?? 'N/A',
        ]);

        // Insertar detalles del escaneo
        $scanDetailsModel->insert([
            'id_scan' => $scan_id,
            'id_devices' => $device_id
        ]);

        // Procesar puertos y servicios asociados al dispositivo
        $ports_services = $nmap_ports_services['ports_services'] ?? [];
        if (!empty($ports_services)) {
            foreach ($ports_services as $service) {
                // Verificar los datos de cada puerto
                $port_name = $service['port'] ?? 'Unknown Port';
                $state = $service['state'] ?? 'Unknown State';
                $service_name = $service['service'] ?? 'Unknown Service';

                // Obtener el estado del puerto desde la tabla port_status
                $port_status = $portStatusModel->where('status', $state)->first();

                // Insertar información del puerto en la base de datos
                $port_id = $portsModel->insert([
                    'port_name' => $port_name ?? 'N/A',
                    'service' => $service_name ?? 'N/A',
                    'protocol' => 'tcp', // o extraer del servicio si está disponible
                    'id_port_status' => $port_status['id_port_status'] ?? '1',
                ]);

                // Insertar en port_analysis para asociar el puerto al dispositivo
                $port_analysis_id = $portAnalysisModel->insert([
                    'id_port' => $port_id,
                    'id_devices' => $device_id,
                ]);

                // Procesar vulnerabilidades asociadas al puerto
                $vulnerabilities = $service['vulnerabilities'] ?? [];
                if (!empty($vulnerabilities)) {
                    foreach ($vulnerabilities as $vuln) {
                        // Obtener detalles de la vulnerabilidad
                        $cve = $vuln['cve'] ?? 'N/A';
                        $description = $vuln['description'] ?? 'No description available';

                        // Insertar la solución (vulnerabilidad) en la base de datos
                        $solution_id = $solutionModel->insert([
                            'vulnerability_code' => $cve ?? 'N/A',
                            'vuln_description' => $description ?? 'N/A',
                        ]);

                        // Asociar la vulnerabilidad con el análisis de puerto
                        $portDetailsModel->insert([
                            'id_analysis' => $port_analysis_id,
                            'id_solution' => $solution_id,
                        ]);
                    }
                } else {


                    // Insertar la solución (vulnerabilidad) en la base de datos
                    $solution_id = $solutionModel->insert([
                        'vulnerability_code' => 'N/A',
                        'vuln_description' => 'N/A',
                    ]);

                    // Asociar la vulnerabilidad con el análisis de puerto
                    $portDetailsModel->insert([
                        'id_analysis' => $port_analysis_id,
                        'id_solution' => $solution_id,
                    ]);
                }
            }
        }

        // Pasar los datos a la vista (opcional)
        return view('tertiary/network/nmap_results', [
            'nmap_ports_services' => $nmap_ports_services,
            'nmap_vulnerabilities' => $nmap_vulnerabilities
        ]);
    }

    public function ipview()
    {
        return view('secondary/profile/dashboard.php');
    }
    public function ipset()
    {
        $ip = $this->request->getPost('ip');
        $this->session->set("ip", $ip);
        return redirect()->to('dashboard');
    }

    public function animation()
    {
        return view('animations/network/animation');
    }

    public function nmap_animation()
    {
        return view('animations/network/nmap-animation');
    }
}
