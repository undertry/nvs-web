<?php

namespace App\Models\secondary\form;

use CodeIgniter\Model;

class Scan_detailsModel extends Model
{
    protected $table = 'scan_details';
    protected $primaryKey = 'id_scan_details';
    protected $allowedFields = ['id_scan', 'id_devices'];

    
 public function insertDetails($detailsdat){

    $this->insert($detailsdat);
    return $this->insertID(); // Devuelve la ID del registro insertado
    
}
}