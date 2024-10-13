<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class Port_statusModel extends Model
{
    protected $table = 'port_status';
    protected $primaryKey = 'id_port_status';
    protected $allowedFields = ['status'];

    
}