<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class Port_statusModel extends Model
{
    protected $table = 'port_status';
    protected $primaryKey = 'id_port_status';
    protected $allowedFields = ['status'];

    public function getStatus($state)
    {
        return $this->where('status', $state)->first();
    }
}