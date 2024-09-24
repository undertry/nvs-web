<?php

namespace App\Controllers\secondary\profile;

use App\Controllers\main\BaseController;

use App\Models\secondary\form\ScanModel;

class History extends BaseController
{
    public function history()
    {
        $user = session('user');

        if (!$user || $user->id_user < 1) {
            // Si no hay id_user en sesión, redirigir a la página de inicio de sesión
            return redirect()->to('/login');
        } else {
            $id_user = $user->id_user;
            $scanModel = new ScanModel();
            $data['scanDetails'] = $scanModel->getScanDetailsByUser($id_user);

            return view('secondary/user-functions/history', $data);
        }
    }
    public function animation()
    {
        return view('animations/history/animation');
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
}