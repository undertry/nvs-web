<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class DeviceModel extends Model
{
    protected $table = 'devices';
    protected $primaryKey = 'id_devices';
    protected $allowedFields = ['ip _address', 'operating_system', 'mac_address'];

    
}