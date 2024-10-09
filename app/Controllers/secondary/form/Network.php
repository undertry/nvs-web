<?php

namespace App\Controllers\secondary\form;

use CodeIgniter\HTTP\CURLRequest;
use App\Controllers\main\BaseController;
use \App\Models\tertiary\network\NetworkModel;
use \App\Models\tertiary\network\SecurityModel;

class Network extends BaseController
{
   // Función para mostrar las redes WiFi escaneadas
   public function index()
   {
       $client = \Config\Services::curlrequest();

       try {
           // Solicitar los resultados del escaneo de redes WiFi a la API
           $response = $client->get('http://192.168.0.162:5000/scan');
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
           $response = $client->post('http://192.168.0.162:5000/save-network', [
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
               $networkmodel->networkinsert($selnet);

               log_message('info', 'Red seleccionada enviada a la Raspberry Pi.');
               return redirect()->back()->with('success', 'Red seleccionada correctamente.');
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
       var_dump($nmap_ports_services);
       echo "<br>";
       var_dump($nmap_vulnerabilities);
    //    // Pasar los datos a las vistas
    //    return view('tertiary/network/nmap_results', [
    //        'nmap_ports_services' => $nmap_ports_services,
    //        'nmap_vulnerabilities' => $nmap_vulnerabilities
    //    ]);
   }
}