<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class NetworkModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_network';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'channel', 'id_security_type'];

    public function networkinsert($selnet)
    {
        $this->insert($selnet);
    }
}