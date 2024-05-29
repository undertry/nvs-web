<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Seccion controlador Home/index
$routes->get('/', 'Home::index');

// Seccion controlador User/Login
$routes->get('login', 'User\Login::index');
$routes->POST('login', 'User\Login::do_login');
$routes->get('logout', 'User\Login::logout');

// Seccion controlador User/Register
$routes->get('register', 'User\Register::index');
$routes->POST('register', 'User\Register::do_register');

// Seccion controlador User/Change_Password
$routes->get('change_password', 'User\Change_Password::index');


// Seccion controlador User/Change_Password
$routes->get('user_page', 'User\User_page::index');

