<?php

namespace App\Controllers;

// use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
{
    return view ('main/form/login');
}
    
}   