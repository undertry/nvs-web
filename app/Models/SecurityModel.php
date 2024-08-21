<?php

namespace App\Models;

use CodeIgniter\Model;

class SecurityModel extends Model
{
    protected $table = 'security_type';
    protected $primaryKey = 'id_security_type ';
    protected $allowedFields = ['type'];

    public function IdSecurityType($encryption)
    {
        return $this->where('type', $encryption)->first();
    }
}

