<?php

namespace App\Controllers\User;


use App\Controllers\BaseController;

use \App\Models\UserModel;

// use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene un ID de usuario válido
        $user = session('user');

        if (!$user || $user->id_user < 1) {
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return view('user/form/register');
        } else {
            return redirect()->back();
        }
    }
    public function do_register()
    {
        $userModel = new UserModel();

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Verificar si el correo electrónico ya está registrado
        if ($userModel->isEmailTaken($email)) {
            $this->session->setFlashdata('error', 'El correo electrónico ya está registrado.');
            return redirect()->back()->withInput();
        }

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            $this->session->setFlashdata('error', 'Las contraseñas no coinciden.');
            return redirect()->back()->withInput();
        }

        // Verificar si la contraseña cumple con los requisitos
        if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $password)) {
            $this->session->setFlashdata('error', 'La contraseña debe tener al menos 8 caracteres, 1 mayúscula y 1 caracter especial.');
            return redirect()->back()->withInput();
        }

        // Si todas las verificaciones pasan, crear el hash de la contraseña y preparar los datos
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];

        // Registrar usuario
        if ($data !== null) {
            $userModel->register($data);
            $email = $data->email;
            $name = $data->name;
            // Configuracion y envio del email
             $emailc = \Config\Services::email();
             $emailc->setFrom('cibersafe.verify@gmail.com');
             $emailc->setTo($email);
             $emailc->setSubject('Registro Exitoso');
             $emailc->setMessage('Muchas Gracias Por Regristrarte en Network Vulnerability Scan'. $name);
            $this->session->setFlashdata('success', 'Usuario registrado exitosamente! Redirigiendo a login...');
            return redirect()->to('login');
        } else {
            $this->session->setFlashdata('error', 'Error durante el registro');
            return redirect()->back()->withInput();
        }
    }
}
