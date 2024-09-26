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
            network.bssid, network.id_security_type AS security_type, devices.ip_address,
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
            ->join('solution', 'solution.id_solution = port_analysis.id_solution')
            ->where('scan.id_user', $id_user)
            ->get()
            ->getResultArray();
    }

    public function deleteScanDetails($id_scan)
    {
        return $this->db->table('scan_details')->where('id_scan', $id_scan)->delete();
    }
    public function deleteScanWithDetails($id_scan)
    {
        // Iniciar la transacción
        $this->db->transStart();
    
        // Obtener los detalles de escaneo para eliminar datos relacionados
        $scanDetails = $this->db->table('scan_details')->where('id_scan', $id_scan)->get()->getResultArray();
    
        if ($scanDetails) {
            foreach ($scanDetails as $detail) {
                // Eliminar puertos relacionados
                $this->db->table('port_analysis')->where('id_devices', $detail['id_devices'])->delete();
    
                // Eliminar dispositivos relacionados
                $this->db->table('devices')->where('id_devices', $detail['id_devices'])->delete();
    
                // Verificar si existen y eliminar de 'ports' y 'port_status'
                if (isset($detail['id_port'])) {
                    $this->db->table('ports')->where('id_port', $detail['id_port'])->delete();
                }
    
                if (isset($detail['id_port_status'])) {
                    $this->db->table('port_status')->where('id_port_status', $detail['id_port_status'])->delete();
                }
            }
            
            // Eliminar también la red asociada si existe
            // Comprobar que haya al menos un detalle y que contenga id_network
            if (isset($scanDetails[0]['id_network'])) {
                $this->db->table('network')->where('id_network', $scanDetails[0]['id_network'])->delete();
            }
        }
    
        // Eliminar los detalles del escaneo
        $this->deleteScanDetails($id_scan);
    
        // Eliminar el escaneo
        $this->delete($id_scan);
    
        // Completar la transacción
        $this->db->transComplete();
    
        // Retornar el estado de la transacción
        return $this->db->transStatus(); // Devuelve true si la transacción fue exitosa
    }
    
    
    
    

}