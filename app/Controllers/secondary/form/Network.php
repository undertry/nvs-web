<?php

namespace App\Controllers\secondary\form;

use CodeIgniter\HTTP\CURLRequest;

use App\Controllers\main\BaseController; // Asegúrate de importar la clase correcta , hay que importar el BseController de main
use App\Models\tertiary\network\NetworkModel;

use App\Models\tertiary\network\SecurityModel;


class Network extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();

        $NetworkModel = new NetworkModel();
        $SecurityModel = new SecurityModel();

        try {
            $response = $client->get('http://192.168.0.164:5000/scan');
            log_message('info', 'Solicitud realizada a la API.');

            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                log_message('info', 'Datos recibidos: ' . print_r($network, true));

                // Obtener el valor de 'encryption' y buscar la id correspondiente
                $encryption = $network['encryption'] ?? null;

                if ($encryption) {
                    $securityData = $SecurityModel->IdSecurityType($encryption);

                    if ($securityData) {
                        // Cambiar 'encryption' por 'id_security_type'
                        $network['id_security_type'] = $securityData['id_security_type'];
                        unset($network['encryption']);
                    } else {
                        log_message('error', 'Tipo de cifrado no encontrado en la base de datos: ' . $encryption);
                    }
                }

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