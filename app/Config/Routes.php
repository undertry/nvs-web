<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('home', function ($routes) {
    $routes->get('/', 'Home::home');
    $routes->get('animation', 'Home::animation');
});


$routes->group('auth', function ($routes) {
    $routes->get('animation', 'Auth\Login::animation');
    $routes->get('login', 'Auth\Login::index');
    $routes->post('login', 'Auth\Login::do_login');
    $routes->get('logout', 'Auth\Login::logout');
    $routes->get('2fa', 'Auth\Login::verify');
    $routes->get('verificationcode', 'Auth\Login::sendemailverification');
    $routes->post('confirmcode', 'Auth\Login::verificationconfirm');
    $routes->get('s-animation', 'Auth\Signup::animation');
    $routes->get('signup', 'Auth\Signup::index');
    $routes->POST('signup', 'Auth\Signup::do_register');
    $routes->get('forgot_password', 'Auth\Change_Password::forgot_password');
    $routes->get('change_forgot', 'Auth\Change_Password::change_forgot');
    $routes->POST('password_change_forgot', 'Auth\Change_Password::password_change_forgot');
    $routes->post('sendemail', 'Auth\Change_Password::sendemail');
});

$routes->group('user', function ($routes) {
    $routes->get('animation', 'User\Dashboard::animation');
    $routes->get('dashboard', 'User\Dashboard::index');
    $routes->get('configuration', 'User\Dashboard::configuration');
    $routes->get('change_password', 'User\Dashboard::change_password');
    $routes->POST('password_change', 'User\Dashboard::password_change');
    $routes->get('verification', 'User\Dashboard::verification');
    $routes->get('fetchNetworks', 'User\Dashboard::fetchNetworks');
    $routes->get('fetchDevices', 'User\Dashboard::fetchDevices');
    $routes->post('setCredentials', 'User\Dashboard::setCredentials');
    $routes->post('startApi', 'User\Dashboard::startApi');
    $routes->post('stopApi', 'User\Dashboard::stopApi');
    $routes->post('enableMonitor', 'User\Dashboard::enableMonitor');
    $routes->post('desactiveMonitor', 'User\Dashboard::desactiveMonitor');
});











// vista para el historial de escaneos del usuario
$routes->get('/history', 'secondary\profile\History::history');
$routes->get('history-animation', 'secondary\profile\History::animation');
$routes->get('setScanMode', 'secondary\form\Network::showSetScanMode'); // Ruta para mostrar la vista
$routes->post('setScanMode', 'secondary\form\Network::setScanMode'); // ruta para mandar los datos
$routes->get('network', 'secondary\form\Network::index');
$routes->post('select-network', 'secondary\form\Network::selectNetwork');
$routes->post('startDeviceScan', 'secondary\form\Network::startDeviceScan');
$routes->post('startWifiScan', 'secondary\form\Network::startWifiScan');
$routes->post('startNmapScan', 'secondary\form\Network::startNmapScan');
$routes->post('csv', 'secondary\form\Network::csv');
$routes->post('mac', 'secondary\form\Network::mac');
$routes->get('vulnerabilities', 'secondary\form\Network::showVulnerabilities');
$routes->get('vulnerabilities/details/(:segment)', 'secondary\form\Network::getVulnerabilityDetails/$1');
$routes->get('nmap-results', 'secondary\form\Network::nmapResults');
$routes->get('nmap-animation', 'secondary\form\Network::nmap_animation');
$routes->get('network-animation', 'secondary\form\Network::animation');

$routes->post('history/deleteScan/(:num)', 'secondary\profile\History::deleteScan/$1');


$routes->get('prueba', 'secondary\form\Network::index');

//TESTING
$routes->get('ip', 'secondary\form\Network::ipview');
$routes->POST('ipset', 'secondary\form\Network::ipset');
