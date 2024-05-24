<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use \App\Models\UserModel;


// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Change_Password extends BaseController
{
    public function index()
    {
        return view('user/change_password');
    }

    public function change_password()
    {
        // Realizar codigo para poder cambiar la contraseña verificando que coincida el codigo de recuperacion 
    }
}
