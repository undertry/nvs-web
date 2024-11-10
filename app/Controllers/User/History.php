<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\secondary\form\ScanModel;

class History extends BaseController
{
    public function history()
    {
        $user = session('user');

        if (!$user || $user->id_user < 1) {
            // Si no hay id_user en sesión, redirigir a la página de inicio de sesión
            return redirect()->to('auth/login');
        } else {
            $id_user = $user->id_user;
            $scanModel = new ScanModel();
            $data['scanDetails'] = $scanModel->getScanDetailsByUser($id_user);

            return view('modules/user/views/history/index.html', $data);
        }
    }
  
    public function deleteScan($id_scan)
    {
        $scanModel = new ScanModel();

        if ($scanModel->deleteScanWithDetails($id_scan)) {
            return redirect()->back()->with('success', 'Escaneo eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el escaneo.');
        }
    }

    public function deleteAllScans($id_user)
{
    $scanModel = new ScanModel();
       
    if ($scanModel->deleteAllScansByUser($id_user)) {
        return redirect()->back()->with('success', 'All scans have been successfully deleted.');
    } else {
        return redirect()->back()->with('error', 'Error deleting the scans.');
    }
}
}
