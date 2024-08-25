<?php

namespace App\Controllers\secondary\profile;

use App\Controllers\main\BaseController;

use App\Models\secondary\form\ScanModel;

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

            return view('secondary/user-functions/history', $data);
        }
    }
    public function animation()
    {
        return view('animations/history/animation');
    }
}