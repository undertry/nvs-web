<?php

namespace App\Controllers\secondary\form;


use App\Controllers\main\BaseController;

use \App\Models\secondary\form\UserModel;

class Signup extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene un ID de usuario válido
        $user = session('user');

        if (!$user || $user->id_user < 1) {
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return view('secondary/form/signup');
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
            $this->session->setFlashdata('error', 'The email address is already registered.');
            return redirect()->back()->withInput();
        }

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            $this->session->setFlashdata('error', 'The passwords do not match.');
            return redirect()->back()->withInput();
        }

        // Verificar si la contraseña cumple con los requisitos
        if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $password)) {
            $this->session->setFlashdata('error', 'The password must have at least 8 characters, 1 uppercase letter, and 1 special character.');
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

            // Configuracion y envio del email
            $emailc = \Config\Services::email();
            $emailc->setFrom('cibersafe.verify@gmail.com');
            $emailc->setTo($email);
            $emailc->setSubject('Registration Successful');
            $emailc->setMessage("Thank you, $name, for registering with Network Vulnerability Scan.");
            $emailc->send();

            $userModel->register($data);
            $this->session->setFlashdata('success', 'User registered successfully! Redirecting to login...');
            return redirect()->to('login-animation');
        } else {
            $this->session->setFlashdata('error', 'Error during registration');
            return redirect()->back()->withInput();
        }
    }

    public function animation()
    {
        return view('animations/user/signup-animation');
    }
}
