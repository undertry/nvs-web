<?php

namespace App\Models;

use CodeIgniter\Model;

class ScanModel extends Model
{
    protected $table = 'red';
    protected $primaryKey = 'id_red';
    protected $allowedFields = ['signal', 'essid', 'bssid','id_tipo_seguridad','channel','encryption'];



    public function red($networks)
    {
        $this->insert($networks);
    }
}