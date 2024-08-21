<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\ScanModel;

class History extends BaseController
{
    public function history()
    {
        $user = session('user');
        $id_user = session('user')->id_user;

        if (!$id_user) {
            // Si no hay id_user en sesión, redirigir a la página de inicio de sesión
            return redirect()->to('/login');
        } else {

            $scanModel = new ScanModel();
            $data['scanDetails'] = $scanModel->getScanDetailsByUser($id_user);

            echo view('user/user-functions/history', $data);
        }
    }
    public function animation()
    {
        echo view('common/history/animation');
    }
}