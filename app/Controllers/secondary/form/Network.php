<?php

namespace App\Controllers\secondary\form;

use CodeIgniter\HTTP\CURLRequest;
use App\Controllers\main\BaseController;

class Network extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get('http://192.168.0.162:5000/scan');
            log_message('info', 'Solicitud realizada a la API.');

            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                log_message('info', 'Datos recibidos: ' . print_r($network, true));
                echo "<pre>";
                print_r($network);  // Para ver la estructura del array
                echo "</pre>";
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

    // Nueva función para manejar la selección de red
    public function selectNetwork()
    {
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
}