<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class PortsModel extends Model
{
    protected $table = 'ports';
    protected $primaryKey = 'id_port';
    protected $allowedFields = ['port_name', 'service', 'protocol','id_port_status'];

}