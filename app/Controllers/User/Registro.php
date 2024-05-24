<?php

namespace App\Controllers\User;


use App\Controllers\BaseController;

use \App\Models\UserModel;


class Registro extends BaseController
{
    public function index()
    {
        return view('user/registro');
    }
    public function do_register()
{
    $userModel = new UserModel();

    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    
    // Verificar si el correo electrónico ya está registrado
    if ($userModel->isEmailTaken($email)) {
        $this->session->setFlashdata('error', 'El correo electrónico ya está registrado.');
        return;
    }
    
    $password = password_hash($password, PASSWORD_BCRYPT);

    // Codigo unico de recuperacion
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $cod_recup = '';
    $max = strlen($caracteres) - 1;
    $codigoUnico = false;
    
    while (!$codigoUnico) {
        $cod_recup = '';
        for ($i = 0; $i < 8; $i++) {
            $cod_recup .= $caracteres[mt_rand(0, $max)];
        }

        if (!$userModel->isCodTaken($cod_recup)) {
            $codigoUnico = true;
        }
    }
    
    $data = ['name' => $name, 'email' => $email, 'password' => $password,'cod_recup' => $cod_recup];
    $ra=($data);
    if ($ra)
{   
    $userModel->register($ra);
    $this->session->setFlashdata('success', 'Usuario registrado exitosamente!');

}
else
{
    $this->session->setFlashdata('error', 'Error durante el registro');
}

    return redirect()->to('login');
}

}
