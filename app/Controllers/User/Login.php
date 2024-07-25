<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use \App\Models\UserModel;

// use App\Models\UserModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Login extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene un ID de usuario válido
        $user = session('user');

        if (!$user || $user->id_user < 1) {
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return view('user/form/login');
        } else {
            return redirect()->back();
        }
    }
    public function do_login()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Obtener el usuario por correo electrónico
        $result = $userModel->getUserByEmail($email);
    
        if ($result !== null && $result->id_user > 0) {
            // Verificar si la contraseña es correcta
            if (password_verify($password, $result->password)) {
                // Eliminar la propiedad 'password' antes de guardar en la sesión
                unset($result->password);
                // Establecer la sesión del usuario
                $this->session->set("user", $result);
    
                // si la contraseña es correcta redirigir basado en el estado de verificación
                if ($result->verification == 0) {
                    return redirect()->to('dashboard'); // Redirige al dashboard si verification es 0
                } else {
                    unset($result->id_user);
                    return redirect()->to('2stepverify'); // Redirige a la verificación de dos pasos si verification es 1
                }
            } else {
                // Contraseña incorrecta
                $this->session->setFlashdata('error', 'Contraseña u correo electrónico no válido');
            }
        } else {
            // Usuario no encontrado
            $this->session->setFlashdata('error', 'Contraseña u correo electrónico no válido');
        }
    
        // Redirigir de nuevo a la página de inicio de sesión
        return redirect()->to('login');
    }
    public function logout()
    {
        // Destruir la sesión
        session()->destroy();

        // Redirigir a la página de inicio de sesión
        return redirect()->to('/');
    }
    public function verify()
    {
        return view('user/form/2stepverify');
    }

}
