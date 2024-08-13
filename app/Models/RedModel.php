<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

use App\Models\RedModel;

class RedModel extends Model
{
    protected $table = 'network';
    protected $primaryKey = 'id_red';
    protected $allowedFields = ['signal', 'essid', 'bssid', 'encryption', 'channel'];

    public function red($networks)
    {
        // Filtrar redes duplicadas dentro del mismo array
        $networks = array_unique($networks, SORT_REGULAR);

        foreach ($networks as $network) {
            // Verificar si ya existe una red con los mismos valores de bssid, channel, encryption, y essid
            $existingNetwork = $this->where('bssid', $network['bssid'])
                                    ->where('channel', $network['channel'])
                                    ->where('encryption', $network['encryption'])
                                    ->where('essid', $network['essid'])
                                    ->first();

            // Si no existe, insertar la nueva red
            if (!$existingNetwork) {
                $this->insert($network);
            }
        }
    }
}
