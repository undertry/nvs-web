<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;

// use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        return view("user/register");
    }

    public function do_register()
    {
        $userModel = new UserModel();

        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $confirm_password = $this->request->getPost("confirm_password");

        // Verificar si el correo electrónico ya está registrado
        if ($userModel->isEmailTaken($email)) {
            $this->session->setFlashdata(
                "error",
                "El correo electrónico ya está registrado."
            );
            return redirect()
                ->to("register")
                ->withInput();
        }

        // Verificar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            $this->session->setFlashdata(
                "error",
                "Las contraseñas no coinciden."
            );
            return redirect()
                ->to("register")
                ->withInput();
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword,
        ];

        // Depuración: Verificar los datos antes de registrar
        error_log("Register data: " . var_export($data, true));

        // Registrar el usuario
        if ($userModel->insert($data)) {
            $this->session->setFlashdata(
                "success",
                "Usuario registrado exitosamente! Redirigiendo a login..."
            );
            return redirect()->to("login");
        } else {
            $this->session->setFlashdata("error", "Error durante el registro");
            return redirect()
                ->to("register")
                ->withInput();
        }
    }
}
