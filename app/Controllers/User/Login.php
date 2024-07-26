<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use \App\Models\UserModel;
use \App\Models\CodigoModel;

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
                
    
                // si la contraseña es correcta redirigir basado en el estado de verificación
                if ($result->verification == 0) {
                    // Establecer la sesión del usuario
                    $this->session->set("user", $result);
                    return redirect()->to('dashboard'); // Redirige al dashboard si verification es 0
                } else {
                    $result->id_user=0;
                    $this->session->set("user", $result);
                    return redirect()->to('verificationcode'); // Redirige a la verificación de dos pasos si verification es 1
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


    public function sendemailverification()
    {
        $Codigo = new CodigoModel();
        $UserModel = new UserModel();

        $emailU = session('user')->email;

        // Generar código único de recuperación
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
        $cod_recup = '';
        $max = strlen($caracteres) - 1;

        // Buscar un código único que no esté en uso
        do {
            $cod_recup = '';
            for ($i = 0; $i < 8; $i++) {
                $cod_recup .= $caracteres[mt_rand(0, $max)];
            }
        } while ($Codigo->isCodTaken($cod_recup));

        // Obtener el usuario por correo electrónico
        $user = $UserModel->GetIdByemail($emailU);
        $id_user = $user->id_user;

        // Verificar si ya existe un código para el usuario
        $existingCode = $Codigo->getCodeByUserId($id_user);

        if ($existingCode) {
            // Actualizar el código existente
            $Codigo->updatecode($cod_recup, $existingCode->id_codigo_recuperacion);
        } else {
            // Insertar un nuevo código
            $data = [
                'cod_recup' => $cod_recup,
                'id_user' => $id_user
            ];
            $Codigo->insertcod($data);
        }

        // Configuracion y envio del email
        $email = \Config\Services::email();
        $email->setFrom('cibersafe.verify@gmail.com');
        $email->setTo($emailU);
        $email->setSubject('Verification Code');
        $email->setMessage('Your code: ' . $cod_recup);

        if ($email->send()) {
            return redirect()->to('2stepverify');
        } else {
            session()->setFlashdata('error', 'verifique que la informacion de login sea correcta.');
            return redirect()->to('login');
        }
    }
        public function verify()
        {
            return view('user/form/2stepverify');
        }

        public function verificationconfirm()
        {
            $userModel = new UserModel();
            $codigoModel = new CodigoModel();


            $codigo = $this->request->getPost('code');
            $userse= session('user'); 
            $emailU= $userse->email;
            $user = $userModel->GetIdByemail($emailU);   
            $id_user = $user->id_user;

            // REALIZAR VERIFICACION QUE EL CODIGO PERTENESCA AL USUARIO EN SESION
            // Obtener el id_user asociado al código de recuperación
            $userco = $codigoModel->getUserByCodigo($codigo);   
            $id_userco= $userco->id_user;
            if ($id_userco !== $id_user) {  
                $this->session->setFlashdata('error', 'Código de verificación inválido.');
                return redirect()->to('2stepverify');
            }else{
            // Limpiar el código de recuperación después de cambiar la contraseña
            $codigoModel->deleteByCodigo($codigo);
            session('user')->id_user = $id_user;
            $this->session->setFlashdata('success', 'Verificación exitosa.');
            return redirect()->to('dashboard');
             }
        }
}
