<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class NetworkModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_network';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'channel', 'id_security_type'];

    public function networkinsert($selnet)
    {
        $this->insert($selnet);
        return $this->insertID(); // Retorna la id de la inserción

    }
    public function getLastNetwork($id_user)
    {
        return $this//->db->table('network')
            ->select('network.*')
            ->join('scan', 'scan.id_network = network.id_network')
            ->where('scan.id_user', $id_user)
            ->orderBy('scan.id_scan', 'DESC')
            ->limit(1)
            ->get()
            ->getResultArray();
    }
}
