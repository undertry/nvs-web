<?php

namespace App\Models\secondary\form;

use CodeIgniter\Model;

class ScanModel extends Model
{
    protected $table = 'scan';
    protected $primaryKey = 'id_scan';
    protected $allowedFields = ['id_user', 'id_network'];

    public function getScanDetailsByUser($id_user)
    {
        return $this//->db->table('scan')
    ->select('scan.*,
        users.name AS user_name, network.signal, network.essid,
        network.bssid, security_type.type AS security_type, devices.ip_address,
        devices.operating_system, devices.mac_address, ports.port_name, 
        ports.service,port_status.status, solution.vulnerability_code, 
        solution.vuln_description, network.channel')
    ->join('users', 'users.id_user = scan.id_user')
    ->join('network', 'network.id_network = scan.id_network')
    ->join('scan_details', 'scan_details.id_scan = scan.id_scan')
    ->join('devices', 'devices.id_devices = scan_details.id_devices')
    ->join('port_analysis', 'port_analysis.id_devices = devices.id_devices')
    ->join('ports', 'ports.id_port = port_analysis.id_port')
    ->join('port_status', 'port_status.id_port_status = ports.id_port_status')
    ->join('port_details', 'port_details.id_analysis = port_analysis.id_analysis')  // RELACIÓN CORRECTA
    ->join('solution', 'solution.id_solution = port_details.id_solution')  // JOIN CON solution DESPUÉS DE port_details
    ->join('security_type', 'security_type.id_security_type = network.id_security_type')
    ->where('scan.id_user', $id_user)
    ->get()
    ->getResultArray();

    }

    public function deleteScanDetails($id_scan)
    {
           // Eliminar los detalles del escaneo de la tabla 'scan_details' para evitar problemas de bloqueo o dependencia.
        return $this->db->table('scan_details')->where('id_scan', $id_scan)->delete();
    }
    
    public function deleteScanWithDetails($id_scan)
{
    // Iniciar una transacción para asegurar que todas las eliminaciones se completen correctamente
    $this->db->transStart();

    // Obtener los registros de 'scan_details' asociados al escaneo a eliminar
    $scanDetails = $this->db->table('scan_details')->where('id_scan', $id_scan)->get()->getResultArray();

    if ($scanDetails) {
        foreach ($scanDetails as $detail) {
            // Verificar si el dispositivo relacionado existe antes de intentar eliminar puertos
            if (isset($detail['id_devices'])) {
                // Obtener los registros de análisis de puertos ('port_analysis') asociados al dispositivo
                $portAnalysisRecords = $this->db->table('port_analysis')->where('id_devices', $detail['id_devices'])->get()->getResultArray();
                
                foreach ($portAnalysisRecords as $portAnalysis) {
                    if (isset($portAnalysis['id_port'])) {
                        // Obtener los detalles del puerto asociados al análisis desde la tabla 'port_details'
                        $portDetailsRecords = $this->db->table('port_details')->where('id_analysis', $portAnalysis['id_analysis'])->get()->getResultArray();

                        foreach ($portDetailsRecords as $portDetail) {
                            if (isset($portDetail['id_solution'])) {
                            // Verificar y eliminar soluciones relacionadas en la tabla 'solution'
                                $this->db->table('solution')->where('id_solution', $portDetail['id_solution'])->delete();
                            }
                        }
                        
                        // Eliminar los detalles del puerto desde 'port_details' una vez eliminadas las soluciones
                        $this->db->table('port_details')->where('id_analysis', $portAnalysis['id_analysis'])->delete();
                        
                        // Eliminar el puerto en sí desde la tabla 'ports'                        
                        $this->db->table('ports')->where('id_port', $portAnalysis['id_port'])->delete();
                    }

                        // Verificar y eliminar el estado del puerto desde 'port_status'
                    if (isset($portAnalysis['id_port_status'])) {
                        $this->db->table('port_status')->where('id_port_status', $portAnalysis['id_port_status'])->delete();
                    }
                }

                // Eliminar los registros de análisis de puertos relacionados con el dispositivo desde 'port_analysis'                
                $this->db->table('port_analysis')->where('id_devices', $detail['id_devices'])->delete();
            }

            // Eliminar el dispositivo desde la tabla 'devices'
            $this->db->table('devices')->where('id_devices', $detail['id_devices'])->delete();
        }
    }


    // Eliminar los detalles del escaneo llamando a la función deleteScanDetails
    $this->deleteScanDetails($id_scan);


    $scan = $this->db->table('scan')->where('id_scan', $id_scan)->get()->getRowArray();
    
    if ($scan && isset($scan['id_network'])) {
        $this->db->table('network')->where('id_network', $scan['id_network'])->delete();
    }

    // Eliminar el escaneo
    $this->db->table('scan')->where('id_scan', $id_scan)->delete();

    // Confirmar la transacción para aplicar todos los cambios de forma segura
    $this->db->transComplete();

    // Retornar el estado de la transacción
    return $this->db->transStatus(); // Devuelve true si la transacción fue exitosa
}


    
public function insertScan($scandat){

    $this->insert($scandat);
    return $this->insertID(); // Devuelve la ID del registro insertado
}
}