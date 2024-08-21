<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

use App\Models\NetworkModel;

use App\Models\SecurityModel;

class Network extends BaseController
{
    public function index()
    {
        $NetworkModel = new NetworkModel();
        $SecurityModel = new SecurityModel();

        $client = \Config\Services::curlrequest();
        $response = $client->get('http://192.168.0.164:5000/scan');

        if ($response->getStatusCode() == 200) {
            $network = json_decode($response->getBody(), true);

            // Obtener el ID del tipo de seguridad
            $securityType = $SecurityModel->IdSecurityType($network['encryption']);
            if ($securityType) {
                $network['id_security_type'] = $securityType['id_security_type'];
            } else {
                $network['id_security_type'] = null; // Manejar caso donde no se encuentre el tipo de seguridad
            }
            // Remover el campo de 'security' para evitar duplicados (opcional)
            unset($network['encryption']);

            // Guardar en la base de datos usando NetworkModel
            $NetworkModel->network($network);
        } else {
            $network = [];
        }

        return view('network', ['network' => $network]);
    }
}