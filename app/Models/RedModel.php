<?php

namespace App\Models;

use CodeIgniter\Model;

class RedModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_red';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'encryption', 'channel'];

    public function red($networks)
    {
        // Iterar sobre cada red en el array y luego insertar en la base de datos
        foreach ($networks as $network) {
            $this->insert($network);
        }
    }
}
