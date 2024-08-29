<?php

namespace App\Models\secondary\form;

use CodeIgniter\Model;

class ScanModel extends Model
{
    protected $table = 'scan';
    protected $primaryKey = 'id_scan';
    protected $allowedFields = ['id_user', 'id_network', 'scan_date'];

    public function getScanDetailsByUser($id_user)
    {
        return $this->db->table('scan')
            ->select('scan.*, users.name AS user_name, network.signal, network.essid,
            network.bssid, network.encryption AS security_type, devices.ip_address,
            devices.operating_system, devices.mac_address, ports.port_name, ports.service,
            ports.protocol, port_status.open, port_status.close, port_status.filtered,
            solution.solution, solution.vulnerability_code, solution.vuln_description, network.channel')
            ->join('users', 'users.id_user = scan.id_user')
            ->join('network', 'network.id_network = scan.id_network')
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