<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class RedModel extends Model
{
    protected $table = 'red';
    protected $primaryKey = 'id_red';
    protected $allowedFields = ['signal', 'essid', 'bssid','channel','encryption'];



    public function red($networks)
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