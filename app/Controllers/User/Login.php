<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Cargar la biblioteca de sesiones
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('user/login.php');
    }

    public function do_login()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $result = $userModel->getUserByEmail($email);

        // Depuración: Verificar el valor y tipo de $result->password
        error_log("Password type: " . gettype($result->password));
        error_log("Password value: " . var_export($result->password, true));

        // Verificar que $result no es null y que contiene una contraseña válida
        if ($result !== null && isset($result->id_user) && $result->id_user > 0 && is_string($result->password) && !empty($result->password)) {
            // Verificar si la contraseña es correcta
            if (password_verify($password, $result->password)) {
                unset($result->password);
                $this->session->set("user", $result);
                return redirect()->to('----'); // Reemplaza '----' con la ruta correcta
            } else {
                $this->session->setFlashdata('error', 'Contraseña incorrecta');
            }
        } else {
            // Depuración adicional
            if ($result === null) {
                error_log("Result is null");
            } elseif (!isset($result->id_user) || $result->id_user <= 0) {
                error_log("Invalid user ID");
            } elseif (!is_string($result->password)) {
                error_log("Password is not a string");
            } elseif (empty($result->password)) {
                error_log("Password is empty");
            }
            $this->session->setFlashdata('error', 'Correo electrónico no válido');
        }

        return redirect()->to('login');
    }
}
