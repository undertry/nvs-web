<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class SolutionModel extends Model
{
    protected $table = 'solution';
    protected $primaryKey = 'id_solution';
    protected $allowedFields = ['vulnerability_code', 'vuln_description'];

    public function insertSolution($solutiondat){

        $this->insert($solutiondat);
        return $this->insertID(); // Devuelve la ID del registro insertado
            
        }
        public function insertNosolut($nosolut){

            $this->insert($nosolut);
            return $this->insertID(); // Devuelve la ID del registro insertado
                
            }
}
