<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class PortsModel extends Model
{
    protected $table = 'ports';
    protected $primaryKey = 'id_port';
    protected $allowedFields = ['port_name', 'service','id_port_status'];


public function insertPort($portdat){

    $this->insert($portdat);
    return $this->insertID(); // Devuelve la ID del registro insertado
    
    }
}