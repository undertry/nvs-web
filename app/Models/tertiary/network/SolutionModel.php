<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class SolutionModel extends Model
{
    protected $table = 'solution';
    protected $primaryKey = 'id_solution';
    protected $allowedFields = ['vulnerability_code', 'vuln_description'];
}
