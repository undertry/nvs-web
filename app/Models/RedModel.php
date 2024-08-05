<?php

namespace App\Models;

use CodeIgniter\Model;

class RedModel extends Model
{
    protected $table = 'red';
    protected $primaryKey = 'id_red';
    protected $allowedFields = ['signal', 'essid', 'bssid','id_security_type','channel'];



    public function red($networks)
    {
        $this->insert($networks);
    }
}