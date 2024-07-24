<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('dashboard', 'HomeController::index');

//AUTHENTICATION

$routes->post('login/acceptdata' ,'Auth\AuthController::acceptData');

$routes->get('login', 'Auth\AuthController::login');

$routes->get('logout', 'Auth\AuthController::logout');


//SETTINGS
$routes->get('settings', 'Settings\SettingsController::index');
$routes->get('settings/locations', 'Settings\LocationController::index');
$routes->get('settings/payment-plans', 'Settings\PaymentPlansController::index');
$routes->get('settings/currencies', 'Settings\CurrenciesController::index');
$routes->get('settings/employees', 'Settings\EmployeesController::index');

//SETTINGS POST LOCATION

$routes->post('settings/locations/add-city', 'Settings\LocationController::addCity');
$routes->post('settings/locations/add-subregion', 'Settings\LocationController::addSubregion');
$routes->post('settings/locations/add-region', 'Settings\LocationController::addRegion');
$routes->post('settings/locations/add-country', 'Settings\LocationController::addCountry');

$routes->post('settings/locations/edit-city', 'Settings\LocationController::updateCity');
$routes->post('settings/locations/edit-subregion', 'Settings\LocationController::updateSubregion');
$routes->post('settings/locations/edit-region', 'Settings\LocationController::updateRegion');
$routes->post('settings/locations/edit-country', 'Settings\LocationController::updateCountry');

$routes->post('settings/locations/delete-city', 'Settings\LocationController::deleteCity');
$routes->post('settings/locations/delete-subregion', 'Settings\LocationController::deleteSubregion');
$routes->post('settings/locations/delete-region', 'Settings\LocationController::deleteRegion');
$routes->post('settings/locations/delete-country', 'Settings\LocationController::deleteCountry');

// SETTINGS POST PAYMENT PLANS

$routes->post('settings/payment-plans/add-payment-plan', 'Settings\PaymentPlansController::addPaymentPlan');
$routes->post('settings/payment-plans/edit-payment-plan', 'Settings\PaymentPlansController::updatePaymentPlan');
$routes->post('settings/payment-plans/delete-payment-plan', 'Settings\PaymentPlansController::deletePaymentPlan');

// SETTINGS POST CURRENCIES

$routes->post('settings/currencies/add-currency', 'Settings\CurrenciesController::addCurrency');
$routes->post('settings/currencies/edit-currency', 'Settings\CurrenciesController::updateCurrency');
$routes->post('settings/currencies/delete-currency', 'Settings\CurrenciesController::deleteCurrency');

$routes->post('settings/employees', 'Settings\EmployeesController::handleEmployeeForm');


//PROFILE
$routes->get('profile', 'Profile\ProfileController::index');
$routes->post('profile', 'Profile\ProfileController::updateProfile');