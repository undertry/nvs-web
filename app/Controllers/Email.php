<?php

namespace App\Controllers;

class Email extends BaseController
{
    // Inicio de La Aplicacion Web
    public function index()
    {
        $email = \Config\Services::email();
        
        $email->setFrom('keytechempresa@gmail.com', 'Testing email code');
        $email->setTo('tadeo270148@gmail.com');
       // $email->cc('another@another-example.com');
        //$email->bcc('them@their-example.com');

        $email->setSubject('Email Test');
        $email->setMessage('Testing the email class.'); 

      if ($email->send()) {
        echo "enviado"; 
      }else {   
        echo "error";
            }
                   
    }
}   