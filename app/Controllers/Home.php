<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('modules/home/animations/index.html');
    }

    public function home()
    {
        return view('modules/home/views/index.html');
    }

    public function animation()
    {
        return view('modules/home/animations/animation.html');
    }
}
