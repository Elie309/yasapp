<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('dashboard', 'HomeController::index');

//AUTHENTICATION

$routes->post('login/acceptdata' ,'AuthController::acceptData');

$routes->get('login', 'AuthController::login');

$routes->get('logout', 'AuthController::logout');


//SETTINGS
$routes->get('settings', 'SettingsController::index');
$routes->get('settings/location', 'SettingsController::location');

