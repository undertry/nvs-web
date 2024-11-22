<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\secondary\form\UserModel;

use App\Models\secondary\form\CodeModel;

class Change_Password extends BaseController
{
    public function forgot_password()
    {
        $user = session("user");

        if ($user && $user->id_user > 0) {
            return redirect()->to("user/dashboard");
        } else {
            return view("modules/auth/functionality/views/f-password/index.html");
        }
    }
    public function change_forgot()
    {
        $user = session("user");
        if (!$user) {
            return view("modules/auth/functionality/views/f-change/index.html");
        } else {
            return redirect()->to("user/dashboard");
        }
    }

    public function sendemail()
    {
        $Code = new CodeModel();
        $UserModel = new UserModel();

        $emailU = $this->request->getPost("email");

        if (!$UserModel->isEmailTaken($emailU)) {
            $this->session->setFlashdata("error", "Check your email");
            return redirect()->to("auth/forgot_password");
        }

        // Generar código único de recuperación
        $caracteres =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
        $recovery_code = "";
        $max = strlen($caracteres) - 1;

        // Buscar un código único que no esté en uso
        do {
            $recovery_code = "";
            for ($i = 0; $i < 8; $i++) {
                $recovery_code .= $caracteres[mt_rand(0, $max)];
            }
        } while ($Code->isCodTaken($recovery_code));

        // Obtener el usuario por correo electrónico
        $user = $UserModel->GetIdByemail($emailU);
        if (!$user) {
            session()->setFlashdata("error", "User not found.");
            return redirect()->to("auth/forgot_password");
        }

        $id_user = $user->id_user;

        // Verificar si ya existe un código para el usuario
        $existingCode = $Code->getCodeByUserId($id_user);

        if ($existingCode) {
            // Actualizar el código existente
            $Code->updatecode($recovery_code, $existingCode->id_recovery_code);
        } else {
            // Insertar un nuevo código
            $data = [
                "recovery_code" => $recovery_code,
                "id_user" => $id_user,
            ];
            $Code->insertcod($data);
        }

        // Configuracion y envio del email
        $email = \Config\Services::email();
        $email->setFrom("cibersafe.verify@gmail.com");
        $email->setTo($emailU);
        $email->setSubject("Verification Code");
        $email->setMessage("Your code: " . $recovery_code);

        if ($email->send()) {
            return redirect()->to("auth/change_forgot");
        } else {
            session()->setFlashdata("error", "Error al enviar el email.");
            return redirect()->to("auth/forgot_password");
        }
    }

    //Parte de se olvido la contraseña
    public function password_change_forgot()
    {
        $userModel = new UserModel();
        $codeModel = new CodeModel();

        $password = $this->request->getPost("password");
        $confirm_password = $this->request->getPost("confirm_password");
        $code = $this->request->getPost("code");

        if ($password !== $confirm_password) {
            $this->session->setFlashdata(
                "error",
                "The passwords do not match."
            );
            return redirect()->to("auth/change_forgot");
        }
        // Verificar si la contraseña cumple con los requisitos
        if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $password)) {
            $this->session->setFlashdata(
                "error",
                "The password must have at least 8 characters, 1 uppercase letter, and 1 special character"
            );
            return redirect()->to("auth/change_forgot");
        }
        // Obtener el id_user asociado al código de recuperación
        $user = $codeModel->getUserByCode($code);
        if (!$user) {
            $this->session->setFlashdata("error", "Invalid recovery code");
            return redirect()->to("auth/change_forgot");
        }
        $id_user = $user->id_user;

        // Cambiar la contraseña del usuario
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data["password"] = $hashedPassword;
        $userModel->password_change($id_user, $data);

        // Limpiar el código de recuperación después de cambiar la contraseña
        $codeModel->deleteByCode($code);

        $this->session->setFlashdata(
            "success",
            "Password changed successfully"
        );
        return redirect()->to("auth/login");
    }
}
