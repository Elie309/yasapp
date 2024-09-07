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
$routes->get('settings/locations/add', 'Settings\LocationController::addLocation');
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

//SETTINGS PROFILE
$routes->get('settings/profile', 'Settings\ProfileController::index');
$routes->post('settings/profile', 'Settings\ProfileController::updateProfile');

//Settings Listings

$routes->get('settings/listings-attributes', 'Settings\ListingsAttributesController::index');
$routes->get('settings/listings-attributes/property-types', 'Settings\ListingsAttributesController::propertyTypes');
$routes->get('settings/listings-attributes/property-status', 'Settings\ListingsAttributesController::propertyStatus');
$routes->get('settings/listings-attributes/apartment-gender', 'Settings\ListingsAttributesController::apartmentGender');


$routes->post('settings/listings-attributes/add-property-types', 'Settings\ListingsAttributes\PropertyTypesController::save');
$routes->post('settings/listings-attributes/edit-property-types', 'Settings\ListingsAttributes\PropertyTypesController::update/$1');
$routes->post('settings/listings-attributes/delete-property-types', 'Settings\ListingsAttributes\PropertyTypesController::delete/$1');

$routes->post('settings/listings-attributes/add-property-status', 'Settings\ListingsAttributes\PropertyStatusController::save');
$routes->post('settings/listings-attributes/edit-property-status', 'Settings\ListingsAttributes\PropertyStatusController::update/$1');
$routes->post('settings/listings-attributes/delete-property-status', 'Settings\ListingsAttributes\PropertyStatusController::delete/$1');

$routes->post('settings/listings-attributes/add-apartment-gender', 'Settings\ListingsAttributes\ApartmentGenderController::save');
$routes->post('settings/listings-attributes/edit-apartment-gender', 'Settings\ListingsAttributes\ApartmentGenderController::update/$1');
$routes->post('settings/listings-attributes/delete-apartment-gender', 'Settings\ListingsAttributes\ApartmentGenderController::delete/$1');


//CLIENTS
$routes->get('clients', 'Clients\ClientsController::index');
$routes->get('clients/(:num)', 'Clients\ClientsController::view/$1');
$routes->get('clients/add', 'Clients\ClientsController::add');
$routes->post('clients/add', 'Clients\ClientsController::addClient');
$routes->get('clients/edit/(:num)', 'Clients\ClientsController::edit/$1');
$routes->post('clients/edit/(:num)', 'Clients\ClientsController::updateClient/$1');
$routes->get('clients/delete/(:num)', 'Clients\ClientsController::delete/$1');
$routes->get('clients/export', 'Clients\ClientsController::export');

//REQUESTS
$routes->get('requests', 'Requests\RequestController::index');
$routes->get('requests/(:num)', 'Requests\RequestController::view/$1');
$routes->get('requests/add', 'Requests\RequestController::add');
$routes->post('requests/add', 'Requests\RequestController::addRequest');
$routes->get('requests/edit/(:num)', 'Requests\RequestController::edit/$1');
$routes->post('requests/edit/(:num)', 'Requests\RequestController::updateRequest/$1');
$routes->get('requests/delete/(:num)', 'Requests\RequestController::delete/$1');
$routes->get('requests/export', 'Requests\RequestController::export');


//Listings
$routes->get('listings', 'Listings\ListingsController::index');



//API

$routes->get('/api/clients/search', 'API\ClientAPIController::search');
$routes->get('/api/locations/search', 'API\LocationAPIController::search');
$routes->get('/api/locations/get-cities', 'API\LocationAPIController::getCities');
$routes->get('/api/locations/get-subregions', 'API\LocationAPIController::getSubregions');
$routes->get('/api/locations/get-regions', 'API\LocationAPIController::getRegions');
$routes->get('/api/locations/get-countries', 'API\LocationAPIController::getCountries');