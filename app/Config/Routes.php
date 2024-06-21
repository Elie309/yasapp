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
$routes->get('settings/location', 'Settings\LocationController::index');

//SETTINGS POST

$routes->post('settings/location/add-city', 'Settings\LocationController::addCity');
$routes->post('settings/location/add-subregion', 'Settings\LocationController::addSubregion');
$routes->post('settings/location/add-region', 'Settings\LocationController::addRegion');
$routes->post('settings/location/add-country', 'Settings\LocationController::addCountry');







