<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class Port_analisysModel extends Model
{
    protected $table = 'port_analysis';
    protected $primaryKey = 'id_analysis';
    protected $allowedFields = ['id_port', 'id_devices','id_solution'];

    
}