<?php

namespace App\Models\secondary\form;

use CodeIgniter\Model;

class Scan_detailsModel extends Model
{
    protected $table = 'scan_details';
    protected $primaryKey = 'id_scan_details';
    protected $allowedFields = ['id_scan', 'id_devices'];

    
}