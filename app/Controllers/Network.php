<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

use App\Models\NetworkModel;

class Network extends BaseController
{
    public function index()
    {
        $NetworkModel = new NetworkModel();

        $client = \Config\Services::curlrequest();
        $response = $client->get('http://192.168.0.164:5000/scan');

        if ($response->getStatusCode() == 200) {
            $networks = json_decode($response->getBody(), true);
            $NetworkModel->network($networks);
        } else {
            $networks = [];
        }

        return view('network', ['networks' => $networks]);
    }
}