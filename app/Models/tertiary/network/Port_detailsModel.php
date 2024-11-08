<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class Port_detailsModel extends Model
{
    protected $table = 'port_details';
    protected $primaryKey = 'id_port_details';
    protected $allowedFields = ['id_analysis', 'id_solution'];

public function insertPortdet($portdetdat){

        $this->insert($portdetdat);
        return $this->insertID(); // Devuelve la ID del registro insertado
            
        }

        //No solution
public function insertPortdetns($portdetns){

        $this->insert($portdetns);
        return $this->insertID(); // Devuelve la ID del registro insertado
                
        }
}