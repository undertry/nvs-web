<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

use App\Models\RedModel;

class Red extends BaseController
{
    public function index()
    {
        $redModel = new RedModel();

        $client = \Config\Services::curlrequest();
        $response = $client->get('http://192.168.0.164:5000/scan');

        if ($response->getStatusCode() == 200) {
            $networks = json_decode($response->getBody(), true);
            $redModel->red($networks);
        } else {
            $networks = [];
        }

        return view('red', ['networks' => $networks]);
    }
}
