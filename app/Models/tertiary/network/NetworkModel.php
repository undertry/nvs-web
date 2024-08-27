<?php

namespace App\Models\tertiary\network;

use CodeIgniter\Model;

class NetworkModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_network';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'channel', 'encryption'];

    public function network($networks)
    {
        // Filtrar redes duplicadas dentro del mismo array
            $networks = array_unique($networks, SORT_REGULAR);

            // Verificar si ya existe una red con los mismos valores de bssid, channel, encryption, y essid
            $existingNetwork = $this->where('bssid', $networks['bssid'])
                                    ->where('channel', $networks['channel'])
                                    ->where('id_security_type', $networks['id_security_type'])
                                    ->where('essid', $networks['essid'])
                                    ->first();

            // Si no existe, insertar la nueva red
            if (!$existingNetwork) {
                $this->insert($networks);
            }
    }
}