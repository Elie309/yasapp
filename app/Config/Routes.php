<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'Home::index');

$routes->post('login/acceptdata' ,'Login::acceptData');

$routes->get('login', 'Login::index');

