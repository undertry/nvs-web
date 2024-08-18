<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Inicio de La Aplicacion Web
    public function index()
    {
        return view('home/intro');
    }

    public function home()
    {
        return view('home/home');
    }
}