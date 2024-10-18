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
use \App\Models\tertiary\network\SecurityModel;
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
                $id_network= $networkmodel->networkinsert($selnet);
                $this->session->set("id_network",$id_network);

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
       $portStatusModel = new Port_statusModel();  // Agrega este modelo si no está definido
   
       // Insertar un nuevo escaneo
       $scan_id = $scanModel->insert([
           'id_user' => $id_user,
           'id_network' => $id_network,
       ]);
   
       // Datos del dispositivo
       if (!empty($nmap_ports_services)) {
           foreach ($nmap_ports_services as $device_data) {
               // Insertar dispositivo
               $device_id = $deviceModel->insert([
                   'ip_address' => $device_data['ip'],
                   'mac_address' => $device_data['mac'],
                   'operating_system' => $device_data['os_info']
               ]);
   
               // Insertar detalles del escaneo (asociación entre escaneo y dispositivo)
               $scanDetailsModel->insert([
                   'id_scan' => $scan_id,
                   'id_devices' => $device_id
               ]);
   
               // Insertar puertos asociados a los dispositivos
               foreach ($device_data['ports'] as $port) {
                   // Obtener el estado del puerto desde la tabla port_status según el estado recibido ('open', 'closed', etc.)
                   $port_status = $portStatusModel->where('status', $port['state'])->first();
                   
                   // Insertar puerto en la tabla `ports`
                   $port_id = $portsModel->insert([
                       'port_name' => $port['port'],  
                       'service' => $port['service'],  
                       'protocol' => $port['protocol'],  
                       'id_port_status' => $port_status['id_port_status']  // ID de port_status
                   ]);
   
                   // Insertar análisis de puertos en la tabla `port_analysis`
                   $port_analysis_id = $portAnalysisModel->insert([
                       'id_port' => $port_id,
                       'id_devices' => $device_id  // Asociar puerto al dispositivo
                   ]);
   
                   // Insertar detalles de las vulnerabilidades para ese puerto
                   if (!empty($port['vulnerabilities'])) {
                       foreach ($port['vulnerabilities'] as $vulnerability) {
                           // Insertar solución (vulnerabilidad)
                           $solution_id = $solutionModel->insert([
                               'solution' => $vulnerability['description'],  // Descripción de la solución
                               'vulnerability_code' => $vulnerability['cve'],  // Código CVE
                               'vuln_description' => $vulnerability['details'] // Detalles adicionales de la vulnerabilidad
                           ]);
   
                           // Insertar detalles del puerto asociado a la solución
                           $portDetailsModel->insert([
                               'id_analysis' => $port_analysis_id,  // Relación con port_analysis
                               'id_solution' => $solution_id  // Relación con la vulnerabilidad
                           ]);
                       }
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
}