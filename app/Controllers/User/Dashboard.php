<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\User;

use App\Controllers\BaseController;

use \App\Models\UserModel;

use \App\Models\CodigoModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Dashboard extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene un ID de usuario válido
        $user = session('user');
    
        if (!$user || $user->id_user < 1) {
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            return redirect()->to('login');
        } else {
            // Cargar la vista del panel de control si el usuario está autenticado
            return view('user/dashboard.php');
        }
    }
    public function password_change()
    {
        $userModel = new UserModel();
    
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $id_user = session('user')->id_user;
    
        // Verificar si los campos están vacíos
        if (empty($password) || empty($confirm_password)) {
            $this->session->setFlashdata('error', 'Debe rellenar el formulario.');
            return redirect()->to('change_password');
        }elseif ($password !== $confirm_password){
                $this->session->setFlashdata('error', 'Las contraseñas no coinciden.');
            return redirect()->to('change_password');
        }
    
        // Cambiar la contraseña si todas las validaciones son correctas
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data["password"] = $hashedPassword;
        $userModel->password_change($id_user, $data);
        $this->session->setFlashdata('success', 'Contraseña cambiada exitosamente.');
    
        return redirect()->to('dashboard');
}
public function password_change_forgot()
{
    $userModel = new UserModel();
    $codigoModel = new CodigoModel();

    $password = $this->request->getPost('password');
    $confirm_password = $this->request->getPost('confirm_password');
    $codigo = $this->request->getPost('codigo');

    // Verificar si los campos están vacíos
    if (empty($password) || empty($confirm_password) || empty($codigo)) {
        $this->session->setFlashdata('error', 'Debe rellenar el formulario.');
        return redirect()->to('change_password');
    } elseif ($password !== $confirm_password) {
        $this->session->setFlashdata('error', 'Las contraseñas no coinciden.');
        return redirect()->to('change_password');
    }

    // Obtener el id_user asociado al código de recuperación
    $user = $codigoModel->getUserByCodigo($codigo);
    if (!$user) {
        $this->session->setFlashdata('error', 'Código de recuperación inválido.');
        return view('change_forgot');
    }
    $id_user = $user->id_user;

    // Cambiar la contraseña del usuario
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $data["password"] = $hashedPassword;
    $userModel->password_change($id_user, $data);

    // Limpiar el código de recuperación después de cambiar la contraseña
    $codigoModel->deleteByCodigo($codigo);

    $this->session->setFlashdata('success', 'Contraseña cambiada exitosamente.');
    return redirect()->to('dashboard');
}
}  
