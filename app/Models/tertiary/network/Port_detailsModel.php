<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class Port_detailsModel extends Model
{
    protected $table = 'port_details';
    protected $primaryKey = 'id_port_details';
    protected $allowedFields = ['id_port_analysis', 'id_solution'];

    
}