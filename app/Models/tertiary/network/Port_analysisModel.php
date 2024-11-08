<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class  Port_analysisModel extends Model
{
    protected $table = 'port_analysis';
    protected $primaryKey = 'id_analysis';
    protected $allowedFields = ['id_port', 'id_devices'];

public function insertAnalysis($analysisdat){

    $this->insert($analysisdat);
    return $this->insertID(); // Devuelve la ID del registro insertado
        
    }
}
