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
    $routes->get('h-animation', 'User\History::animation');
    $routes->get('history', 'User\History::history');
    $routes->post('history/deleteScan/(:num)', 'User\History::deleteScan/$1');
    $routes->post('history/deleteallScans/(:num)', 'User\History::deleteAllScans/$1');

});

$routes->group('scan', function ($routes) {
    $routes->get('network', 'Scan\Network::index');
    $routes->post('save-results', 'Scan\Network::saveResults');
    $routes->post('select-network', 'Scan\Network::selectNetwork');
    $routes->post('setScanMode', 'Scan\Network::setScanMode'); 
    $routes->post('startWifiScan', 'Scan\Network::startWifiScan');
    $routes->post('startDeviceScan', 'Scan\Network::startDeviceScan');
    $routes->post('startNmapScan', 'Scan\Network::startNmapScan');
    $routes->post('mac', 'Scan\Network::mac');
    $routes->get('nmap-results', 'Scan\Network::nmapResults');
    $routes->post('ipset', 'Scan\Network::ipset');
});



