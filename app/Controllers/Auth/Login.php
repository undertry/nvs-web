<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\secondary\form\UserModel;
use App\Models\secondary\form\CodeModel;

class Login extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene un ID de usuario válido
        $user = session("user");

        if (!$user || $user->id_user < 1) {
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return view("modules/auth/views/log-in/index.html");
        } else {
            return redirect()->to("dashboard");
        }
    }

    public function do_login()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        // Obtener el usuario por correo electrónico
        $result = $userModel->getUserByEmail($email);

        if ($result !== null && $result->id_user > 0) {
            // Verificar si la contraseña es correcta
            if (password_verify($password, $result->password)) {
                // Eliminar la propiedad 'password' antes de guardar en la sesión
                unset($result->password);

                // si la contraseña es correcta redirigir basado en el estado de verificación
                if ($result->verification == 0) {
                    // Establecer la sesión del usuario
                    $this->session->set("user", $result);
                    return redirect()->to("dashboard-animation"); // Redirige al dashboard si verification es 0
                } else {
                    $result->id_user = 0;
                    $this->session->set("user", $result);
                    return redirect()->to("verificationcode"); // Redirige a la verificación de dos pasos si verification es 1
                }
            } else {
                // Contraseña incorrecta
                $this->session->setFlashdata(
                    "error",
                    "Invalid password or email address"
                );
            }
        } else {
            // Usuario no encontrado
            $this->session->setFlashdata(
                "error",
                "Invalid password or email address"
            );
        }

        // Redirigir de nuevo a la página de inicio de sesión
        return redirect()->to("auth/login");
    }

    public function sendemailverification()
    {
        $code = new CodeModel();
        $UserModel = new UserModel();

        $emailU = session("user")->email;

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
        } while ($code->isCodTaken($recovery_code));

        // Obtener el usuario por correo electrónico
        $user = $UserModel->GetIdByemail($emailU);
        $id_user = $user->id_user;

        // Verificar si ya existe un código para el usuario
        $existingCode = $code->getCodeByUserId($id_user);

        if ($existingCode) {
            // Actualizar el código existente
            $code->updatecode($recovery_code, $existingCode->id_recovery_code);
        } else {
            // Insertar un nuevo código
            $data = [
                "recovery_code" => $recovery_code,
                "id_user" => $id_user,
            ];
            $code->insertcod($data);
        }

        // Configuracion y envio del email
        $email = \Config\Services::email();
        $email->setFrom("cibersafe.verify@gmail.com");
        $email->setTo($emailU);
        $email->setSubject("Verification Code");
        $email->setMessage("Your code: " . $recovery_code);

        if ($email->send()) {
            return redirect()->to("auth/2fa");
        } else {
            session()->setFlashdata(
                "error",
                "Please check that the login information is correct."
            );
            return redirect()->to("auth/login");
        }
    }

    public function verificationconfirm()
    {
        $userModel = new UserModel();
        $codeModel = new CodeModel();

        $code = $this->request->getPost("code");
        $userse = session("user");
        $emailU = $userse->email;
        $user = $userModel->GetIdByemail($emailU);
        $id_user = $user->id_user;

        // REALIZAR VERIFICACION QUE EL CODIGO PERTENEZCA AL USUARIO EN SESION
        // Obtener el id_user asociado al código de recuperación
        $userco = $codeModel->getUserByCode($code);
        if (!$userco) {
            //cuando el codigo no se encuentra
            $this->session->setFlashdata("error", "Invalid verification code.");
            return redirect()->to("auth/2fa");
        }
        $id_userco = $userco->id_user;
        if ($id_userco !== $id_user) {
            //si no coincide el codigo con el usuario
            $this->session->setFlashdata("error", "Invalid verification code.");
            return redirect()->to("auth/2fa");
        } else {
            // Limpiar el código de recuperación después de cambiar la contraseña
            $codeModel->deleteByCode($code);
            session("user")->id_user = $id_user;
            $this->session->setFlashdata("success", "Verification successful.");
            return redirect()->to("dashboard");
        }
    }

    public function verify()
    {
        return view("secondary/user-functions/2stepverify");
    }

    public function logout()
    {
        // Destruir la sesión
        session()->destroy();

        // Redirigir a la página de inicio de sesión
        return redirect()->to("home/animation");
    }

    public function animation()
    {
        return view("modules/auth/animations/l-animation.html");
    }
}
