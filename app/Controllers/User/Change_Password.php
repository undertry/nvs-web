<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;

use App\Models\CodigoModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Change_Password extends BaseController
{
    public function forgot_password()   
    {
        $user = session('user');
        if (!$user ) {           
            return view('user/forgot_password');
        } else {
            return view("user/dashboard");
        }
    }
    public function change_forgot()
{
        $user = session('user');
        if (!$user ) {           
            return view('user/forgot_change');
        } else {
            return view("user/dashboard");
        }
    }

    public function sendemail()
    {
        $Codigo = new CodigoModel();
        $UserModel = new UserModel();

        $emailU = $this->request->getPost('email');

        if (!$UserModel->isEmailTaken($emailU)) {
            $this->session->setFlashdata('error', 'Verifique su correo');
            return redirect()->to('forgot_password');
        }

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
        if (!$user) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('forgot_password');
        }

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
            return redirect()->to('change_forgot');
        } else {    
            session()->setFlashdata('error', 'Error al enviar el email.');
            return redirect()->to('forgot_password');
        }
    }


    //Parte de se olvido la contraseña
public function password_change_forgot()
{
    $userModel = new UserModel();
    $codigoModel = new CodigoModel();

    $password = $this->request->getPost('password');
    $confirm_password = $this->request->getPost('confirm_password');
    $codigo = $this->request->getPost('codigo');

    if ($password !== $confirm_password) {
        $this->session->setFlashdata('error', 'Las contraseñas no coinciden.');
        return redirect()->to('change_forgot');
    }

    // Obtener el id_user asociado al código de recuperación
    $user = $codigoModel->getUserByCodigo($codigo);
    if (!$user) {
        $this->session->setFlashdata('error', 'Código de recuperación inválido.');
        return redirect()->to('change_forgot');
    }
    $id_user = $user->id_user;

    // Cambiar la contraseña del usuario
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $data["password"] = $hashedPassword;
    $userModel->password_change($id_user, $data);

    // Limpiar el código de recuperación después de cambiar la contraseña
    $codigoModel->deleteByCodigo($codigo);

    $this->session->setFlashdata('success', 'Contraseña cambiada exitosamente.');
    return redirect()->to('login');
}

}