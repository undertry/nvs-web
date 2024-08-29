<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class NetworkModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_network';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'channel', 'encryption'];

    public function network($networks)
    {
        if (isset($networks[0]) && is_array($networks[0])) {
            // Si es un array de arrays (múltiples redes)
            foreach ($networks as $network) {
                $this->insertIfNotExists($network);
            }
        } else {
            // Si es un solo array asociativo (una red)
            $this->insertIfNotExists($networks);
        }
    }

    private function insertIfNotExists($network)
    {
        // Verificar si la red ya existe en la base de datos por su BSSID
        $exists = $this->where('bssid', $network['bssid'])->first();

        if (!$exists) {
            // Si no existe, insertar la red
            $this->insert($network);
        }
    }
}