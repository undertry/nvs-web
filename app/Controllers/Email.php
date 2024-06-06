<?php

namespace App\Controllers;

class Email extends BaseController
{
//Modificar la logica de funcionamiento del
  public function index()
    {      
        return view('user/change_password');     
    }
    public function sendcode() 
    {
        $email = \Config\Services::email();
        //$Emailu= session('user')->email;
        $email->setFrom('cibersafe.verify@gmail.com', 'Testing email code');
        $email->setTo('cristianmonteverde@alumnos.itr3.edu.ar');  
       // $email->setTo($Emailu);
        $email->setSubject('Verification Code');
        $email->setMessage('Testing the email class.'); 

      if ($email->send()) {
        echo "enviado"; 
      }else {   
        echo "error";
            }
                   
    }
}   