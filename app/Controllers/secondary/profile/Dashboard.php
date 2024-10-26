<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\secondary\profile;

use App\Controllers\main\BaseController;
use App\Models\tertiary\network\NetworkModel;
use \App\Models\secondary\form\UserModel;
use \App\Models\tertiary\network\DeviceModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Dashboard extends BaseController
{
    public function index()
    {
        $user = session('user');
    
        $id_user = $user->id_user;

        // Crear instancia del modelo de la red
        $networkmodel = new NetworkModel();
        // Obtener la última red insertada para el usuario
        $last_network = $networkmodel->getLastNetwork($id_user);
        $last_ip = session('ip'); // Obtén la IP de la sesión

        // Preparar los datos para enviarlos a la vista
        $data = [
            'last_network' => $last_network,
            'last_ip' => $last_ip // Incluye la IP en los datos
        ];


        if (!$user || $user->id_user < 1) {
            //  Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return redirect()->to('login');
        } else {
            //      Cargar la vista del panel de control si el usuario está autenticado
            return view('secondary/profile/dashboard.php', $data);
        }
    }

    public function change_password()
    { {
            // Verificar si el usuario está autenticado y tiene un ID de usuario válido
            $user = session('user');
            if (!$user) {
                // Redirigir a la página de inicio de sesión si el usuario no está autenticado
                return view('secondary/form/login');
            } else {
                return view("secondary/user-functions/change_password");
            }
        }
    }



    //Cambio de contraseña del usuario en sesion
    public function password_change()
    {
        $userModel = new UserModel();

        $current_password = $this->request->getPost('current_password');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $id_user = session('user')->id_user;
        $email = session('user')->email;

        // Obtener el usuario por correo electrónico
        $result = $userModel->getUserByEmail($email);

        if ($result === null || $result->id_user <= 0) {
            return redirect()->to('change_password');
        } else {
            if (password_verify($current_password, $result->password)) {
                // Verificar si los campos están vacíos
                if (empty($password) || empty($confirm_password)) {
                    $this->session->setFlashdata('error', 'ou must fill out the form');
                    return redirect()->to('change_password');
                } elseif ($password !== $confirm_password) {
                    $this->session->setFlashdata('error', 'The passwords do not match');
                    return redirect()->to('change_password');
                }
                // Verificar si la contraseña cumple con los requisitos
                if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $password)) {
                    $this->session->setFlashdata('error', 'The password must have at least 8 characters, 1 uppercase letter, and 1 special character');
                    return redirect()->to('change_password');
                }
                // Cambiar la contraseña si todas las validaciones son correctas
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $data["password"] = $hashedPassword;
                $userModel->password_change($id_user, $data);

                $this->session->setFlashdata('success', 'Password changed successfully.');
                return redirect()->to('dashboard');
            } else {
                $this->session->setFlashdata('error', 'Invalid current password.');
                return redirect()->to('change_password');
            }
        }
        // Redirigir de nuevo a la página de inicio de sesión si el usuario no se encuentra
        return redirect()->to('login');
    }

    public function verification()
    {
        $session = session();
        $email = $session->get('user')->email;

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user) {
            $verificationstatus = $user->verification == 1 ? 0 : 1;  // Cambia de 1 a 0 o de 0 a 1
            $userModel->verification($email, $verificationstatus);
            $user->verification = $verificationstatus;
            unset($user->password);
            // Actualizar la sesión con el nuevo estado de verificacion
            $session->set('user', $user);
        }

        return redirect()->back();
    }

    public function animation()
    {
        return view('animations/dashboard/animation');
    }

    public function configuration()
    {
        return view('secondary/profile/configuration');
    }
}
