<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Change_Password extends BaseController
{
    public function index()
    {
        return view('user/change_password');
    }




        /* // Codigo unico de recuperacion
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $cod_recup = '';
    $max = strlen($caracteres) - 1;
    $codigoUnico = false;
    
    while (!$codigoUnico) {
        $cod_recup = '';
        for ($i = 0; $i < 8; $i++) {
            $cod_recup .= $caracteres[mt_rand(0, $max)];
        }

        if (!$userModel->isCodTaken($cod_recup)) {
            $codigoUnico = true;
        }
    }
    */
   

    public function change_password()
    {
       
    }
}
