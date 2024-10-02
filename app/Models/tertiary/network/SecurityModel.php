<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class SecurityModel extends Model
{
    protected $table = 'security_type';
    protected $primaryKey = 'id_security_type ';
    protected $allowedFields = ['type'];

    public function IdSecurityType($encryption)
    {
        return $this->select("id_security_type")
                    ->where('type', $encryption)
                    ->first();
    }
}