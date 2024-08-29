<?php

namespace App\Controllers\secondary\form;

use CodeIgniter\HTTP\CURLRequest;

use App\Controllers\main\BaseController; // Asegúrate de importar la clase correcta , hay que importar el BseController de main
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
                $network = json_decode($response->getBody(), true);
                log_message('info', 'Datos recibidos: ' . print_r($network, true));

                log_message('info', 'Datos procesados: ' . print_r($network, true));

                $NetworkModel->network($network);

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
public function animation()
    {
        return view('animations/network/animation');
    }
}