<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class SolutionModel extends Model
{
    protected $table = 'Solution';
    protected $primaryKey = 'id_solution';
    protected $allowedFields = ['Solution', 'vulnerability_code', 'vuln_description'];

    
}