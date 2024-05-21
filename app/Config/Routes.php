<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Seccion controlador User/Inicio_Sesion
$routes->get('login', 'User\Inicio_Sesion::index');
$routes->POST('login', 'User\Inicio_Sesion::do_login');

// Seccion controlador User/Registro
$routes->get('register', 'User\Registro::index');
$routes->POST('register', 'User\Registro::do_register');
