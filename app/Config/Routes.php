<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'Home::index');

//AUTHENTICATION

$routes->post('login/acceptdata' ,'AuthController::acceptData');

$routes->get('login', 'AuthController::login');

$routes->get('logout', 'AuthController::logout');

