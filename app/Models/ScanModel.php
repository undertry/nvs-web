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
            ->select('scan.*, usuarios.name AS user_name, red.signal, red.essid, 
            red.bssid, security_type.tipo AS security_type, devices.ip_address, 
            devices.operating_system, devices.dir_mac, ports.port_name, ports.service, 
            ports.protocol, port_status.open, port_status.close, port:status.filtered, 
            solution.solution, solution.vulnerability_code, solution.vuln_description')
            ->join('users', 'users.id_user = scan.id_user')
            ->join('red', 'red.id_red = scan.id_red')
            ->join('security_type', 'security_type.id_security_type = red.id_security_type')
            ->join('scan_details', 'scan_details.id_scan = scan.id_scan')
            ->join('devices', 'devices.id_devices = scan_details.id_devices')
            ->join('port_analysis', 'port_analysis.id_devices = devices.id_devices')
            ->join('ports', 'ports.id_port = port_analysis.id_port')
            ->join('port_status', 'port_status.id_port_status = ports.id_port_status')
            ->join('solution', 'solution.id_solution = scan_details.id_solution')
            ->where('scan.id_user', $id_user)
            ->get()
            ->getResultArray();
    }
}
