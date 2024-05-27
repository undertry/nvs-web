<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Register extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Cargar la biblioteca de sesiones
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('user/register.php');
    }

    public function do_register()
    {
        $userModel = new UserModel();

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verificar que los campos no sean null
        if (is_null($name) || is_null($email) || is_null($password)) {
            $this->session->setFlashdata('error', 'Todos los campos son obligatorios.');
            return redirect()->to('register');
        }

        // Verificar que $password sea una cadena de texto
        if (!is_string($password)) {
            $this->session->setFlashdata('error', 'La contraseña debe ser una cadena de texto.');
            return redirect()->to('register');
        }

        // Verificar si el correo electrónico ya está registrado
        if ($userModel->isEmailTaken($email)) {
            $this->session->setFlashdata('error', 'El correo electrónico ya está registrado.');
            return redirect()->to('register'); // Asegurar redirección
        }

        // Hashear la contraseña
        $password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name'     => $name,
            'email'    => $email,
            'password' => $password
        ];

        // Depuración: Verificar los datos antes de registrar
        error_log("Register data: " . var_export($data, true));

        if ($userModel->register($data)) {
            $this->session->setFlashdata('success', 'Usuario registrado exitosamente!');
        } else {
            $this->session->setFlashdata('error', 'Error durante el registro');
        }

        return redirect()->to('login');
    }
}
