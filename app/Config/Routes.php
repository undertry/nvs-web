<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Seccion controlador Home/index
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::home');
$routes->get('home-animation', 'Home::animation');
// Seccion controlador User/Login

$routes->get('login-animation', 'User\Login::animation');
$routes->get('login', 'User\Login::index');
$routes->POST('login', 'User\Login::do_login');
$routes->get('logout', 'User\Login::logout');
$routes->get('2stepverify', 'User\Login::verify');
//envio de codigo mediante email para la verificaicon
$routes->get('verificationcode', 'User\Login::sendemailverification');
//confirmacion de codigo de verificaicon
$routes->POST('confirmcode', 'User\Login::verificationconfirm');

// Seccion controlador User/Register
$routes->get('signup-animation', 'User\Register::animation');
$routes->get('register', 'User\Register::index');
$routes->POST('register', 'User\Register::do_register');

// get para la vista de cambio de contraseña y post para pasar los datos al controlador
//solo para usuarios en sesion
$routes->get('change_password', 'User\Dashboard::change_password');
$routes->POST('password_change', 'User\Dashboard::password_change');
//Cambia el estado de verificacion enable o disable
$routes->get('verification', 'User\Dashboard::verification');

//gets para las vistas de se olvido la contraseña y post para el envio de datos al controlador
$routes->get('forgot_password', 'User\Change_Password::forgot_password');
$routes->get('change_forgot', 'User\Change_Password::change_forgot');
$routes->POST('password_change_forgot', 'User\Change_Password::password_change_forgot');
//envio de codigo mediante email
$routes->post('sendemail', 'User\Change_Password::sendemail');

// Seccion controlador User/Dashboard
$routes->get('dashboard', 'User\Dashboard::index');

// vista para el historial de escaneos del usuario
$routes->get('/history', 'User\History::history');

$routes->get('red', 'Red::index');