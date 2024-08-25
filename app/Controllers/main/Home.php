<?php

namespace App\Controllers\main;

class Home extends BaseController
{
    // Inicio de La Aplicacion Web
    public function index()
    {
        return view('animations/main/intro');
    }

    public function home()
    {
        return view('main/home');
    }

    public function animation()
    {
        return view('animations/home/animation');
    }
}