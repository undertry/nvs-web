<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class NetworkModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_network';
    protected $allowedFields = ['signal', 'essid', 'bssid','channel','id_security_type'];



    public function network($networks)
    {
        if (isset($networks[0]) && is_array($networks[0])) {
            // Si es un array de arrays (múltiples redes)
            foreach ($networks as $network) {
                $this->insert($network);
            }
        } else {
            // Si es un solo array asociativo (una red)
            $this->insert($networks);
        }
    }

}