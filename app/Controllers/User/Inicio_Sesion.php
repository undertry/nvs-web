<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

// use App\Models\UserModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Inicio_Sesion extends BaseController
{
    public function index()
    {
        return view('user/inicio_sesion.php');
    }
}
