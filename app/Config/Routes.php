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
$routes->get('settings/payment-plans', 'Settings\PaymentPlansController::index');
$routes->get('settings/currencies', 'Settings\CurrenciesController::index');

//SETTINGS POST LOCATION

$routes->post('settings/location/add-city', 'Settings\LocationController::addCity');
$routes->post('settings/location/add-subregion', 'Settings\LocationController::addSubregion');
$routes->post('settings/location/add-region', 'Settings\LocationController::addRegion');
$routes->post('settings/location/add-country', 'Settings\LocationController::addCountry');

$routes->post('settings/location/edit-city', 'Settings\LocationController::updateCity');
$routes->post('settings/location/edit-subregion', 'Settings\LocationController::updateSubregion');
$routes->post('settings/location/edit-region', 'Settings\LocationController::updateRegion');
$routes->post('settings/location/edit-country', 'Settings\LocationController::updateCountry');

$routes->post('settings/location/delete-city', 'Settings\LocationController::deleteCity');
$routes->post('settings/location/delete-subregion', 'Settings\LocationController::deleteSubregion');
$routes->post('settings/location/delete-region', 'Settings\LocationController::deleteRegion');
$routes->post('settings/location/delete-country', 'Settings\LocationController::deleteCountry');

// SETTINGS POST PAYMENT PLANS

$routes->post('settings/payment-plans/add-payment-plan', 'Settings\PaymentPlansController::addPaymentPlan');
$routes->post('settings/payment-plans/edit-payment-plan', 'Settings\PaymentPlansController::updatePaymentPlan');
$routes->post('settings/payment-plans/delete-payment-plan', 'Settings\PaymentPlansController::deletePaymentPlan');

// SETTINGS POST CURRENCIES

$routes->post('settings/currencies/add-currency', 'Settings\CurrenciesController::addCurrency');
$routes->post('settings/currencies/edit-currency', 'Settings\CurrenciesController::updateCurrency');
$routes->post('settings/currencies/delete-currency', 'Settings\CurrenciesController::deleteCurrency');






