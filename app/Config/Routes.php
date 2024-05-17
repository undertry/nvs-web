<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Seccion controlador Login
$routes->get('/login', 'Login::index');
$routes->POST('/login', 'Login::index');

// Seccion controlador Register
$routes->get('/register', 'Register::index');
$routes->POST('/register', 'Register::index');

