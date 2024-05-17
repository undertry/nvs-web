<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Seccion controlador User/Inicio_Sesion
$routes->get('/inicio-sesion', 'User\Inicio_Sesion::index');
$routes->POST('/inicio-sesion', 'User\Inicio_Sesion::index');

// Seccion controlador User/Registro
$routes->get('/registro', 'User\Registro::index');
$routes->POST('/registro', 'User\Registro::index');
