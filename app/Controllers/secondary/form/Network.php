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
        $client = \Config\Services::curlrequest();

        try {
            // Solicitar los resultados del escaneo de redes WiFi a la API
            $response = $client->get('http://10.81.11.135:5000/scan');
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

    // Función para manejar la selección de red WiFi
    public function selectNetwork()
    {
        $networkmodel = new NetworkModel();
        $securitymodel = new SecurityModel();

        $selectedNetwork = [
            'essid' => $this->request->getPost('essid'),
            'bssid' => $this->request->getPost('bssid'),
            'signal' => $this->request->getPost('signal'),
            'channel' => $this->request->getPost('channel'),
            'encryption' => $this->request->getPost('encryption'),
        ];

        // Enviar la red seleccionada a la Raspberry Pi
        $client = \Config\Services::curlrequest();
        try {
            $response = $client->post('http://10.81.11.135:5000/save-network', [
                'json' => $selectedNetwork
            ]);

            if ($response->getStatusCode() == 200) {
                $encryption = $selectedNetwork['encryption'];
                $id_security_type = $securitymodel->IdSecurityType($encryption);
                $selnet = [
                    'essid' => $this->request->getPost('essid'),
                    'bssid' => $this->request->getPost('bssid'),
                    'signal' => $this->request->getPost('signal'),
                    'channel' => $this->request->getPost('channel'),
                    'id_security_type' => $id_security_type
                ];
                $id_network = $networkmodel->networkinsert($selnet);
                $this->session->set("id_network", $id_network);
            } else {
                log_message('error', 'Error al enviar la red seleccionada a la Raspberry Pi.');
                return redirect()->back()->with('error', 'Error al seleccionar la red.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar enviar la red a la Raspberry Pi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Excepción al seleccionar la red.');
        }
    }

    // Nueva función para manejar los resultados de Nmap
    public function nmapResults()
    {
        $client = \Config\Services::curlrequest();
    
        // Obtener los datos de puertos, IP, MAC, servicios, OS
        try {
            $response = $client->get('http://192.168.0.162:5000/nmap/ports-services');
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
            $response = $client->get('http://192.168.0.162:5000/nmap/vulnerabilities');
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
        'ip_address' => $ip,
        'mac_address' => $mac,
        'operating_system' => $os_info,
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
                'port_name' => $port_name,
                'service' => $service_name,
                'protocol' => 'tcp', // o extraer del servicio si está disponible
                'id_port_status' => $port_status['id_port_status'] ?? null,
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
                        'solution' => $description,
                        'vulnerability_code' => $cve,
                        'vuln_description' => $description,
                    ]);

                    // Asociar la vulnerabilidad con el análisis de puerto
                    $portDetailsModel->insert([
                        'id_analysis' => $port_analysis_id,
                        'id_solution' => $solution_id,
                    ]);
                }
            }
        }
    }
    
        // Pasar los datos a la vista (opcional)
        return view('tertiary/network/nmap_results', [
            'nmap_ports_services' => $nmap_ports_services,
            'nmap_vulnerabilities' => $nmap_vulnerabilities
        ]);
    }
    

    public function animation()
    {
        return view('animations/network/animation');
    }
}