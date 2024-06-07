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
$routes->get('forgot_password', 'User\Change_Password::forgot_password');
$routes->get('change_forgot', 'User\Change_Password::change_forgot');

//Cambio de contraseña del usuario en sesion
$routes->POST('password_change', 'User\Dashboard::password_change');

//Cambio de contraseña olvidada
$routes->POST('password_change_forgot', 'User\Dashboard::password_change_forgot');


// Seccion controlador User/Dashboard
$routes->get('dashboard', 'User\Dashboard::index');


//Testing email
$routes->post('sendemail', 'User\Change_Password::sendemail');



//Cambio de contraseña de un usuario
$routes->POST('password_change', 'User\Dashboard::password_change');


