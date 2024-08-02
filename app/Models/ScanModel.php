<?php

namespace App\Models;

use CodeIgniter\Model;

class ScanModel extends Model
{
    protected $table = 'scan';
    protected $primaryKey = 'id_scan';
    protected $allowedFields = ['id_user', 'id_red', 'fecha_scan'];

    public function getScanDetailsByUser($id_user)
    {
        return $this->db->table('scan')
            ->select('scan.*, usuarios.name AS user_name, red.direccion_red, red.potencia, red.essid, red.bssid, tipo_seguridad.tipo AS tipo_seguridad, dispositivos.direccion_ip, dispositivos.sistema_operativo, dispositivos.dir_mac, puertos.puerto_nombre, puertos.servicio, puertos.protocolo, estado_puerto.abierto, estado_puerto.cerrado, estado_puerto.filtrado, solucion.solucion, solucion.codigo_vulnerabilidad, solucion.descripcion_vuln')
            ->join('usuarios', 'usuarios.id_user = scan.id_user')
            ->join('red', 'red.id_red = scan.id_red')
            ->join('tipo_seguridad', 'tipo_seguridad.id_tipo_seguridad = red.id_tipo_seguridad')
            ->join('detalle_scan', 'detalle_scan.id_scan = scan.id_scan')
            ->join('dispositivos', 'dispositivos.id_dispositivos = detalle_scan.id_dispositivos')
            ->join('analisis_puertos', 'analisis_puertos.id_dispositivos = dispositivos.id_dispositivos')
            ->join('puertos', 'puertos.id_puerto = analisis_puertos.id_puerto')
            ->join('estado_puerto', 'estado_puerto.id_estado_puerto = puertos.id_estado_puerto')
            ->join('solucion', 'solucion.id_solucion = detalle_scan.id_solucion')
            ->where('scan.id_user', $id_user)
            ->get()
            ->getResultArray();
    }
}
