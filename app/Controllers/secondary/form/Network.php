<?php

namespace App\Controllers\secondary\network;

use CodeIgniter\HTTP\CURLRequest;

use App\Models\tertiary\network\NetworkModel;

class Network extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();

        $NetworkModel = new NetworkModel();


        try {
            $response = $client->get('http://192.168.0.164:5000/scan');
            log_message('info', 'Solicitud realizada a la API.');

            if ($response->getStatusCode() == 200) {
                $networks = json_decode($response->getBody(), true);
                log_message('info', 'Datos recibidos: ' . print_r($networks, true));

                // Descomenta la siguiente línea para desactivar la inserción en la base de datos temporalmente
                // $NetworkModel->network($networks);

            } else {
                log_message('error', 'Error en la respuesta de la API: ' . $response->getStatusCode());
                $networks = [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción capturada al intentar conectarse a la API: ' . $e->getMessage());
            $networks = [];
        }

        return view('tertiary/network/network', ['networks' => $networks]);
    }

public function animation()
    {
        return view('animations/home/animation');
    }
}