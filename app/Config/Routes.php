<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');

$routes->get('dashboard', 'DashboardController::index');

//AUTHENTICATION

$routes->post('login/acceptdata' ,'Auth\AuthController::acceptData');

$routes->get('login', 'Auth\AuthController::login');

$routes->get('logout', 'Auth\AuthController::logout');


//SETTINGS
$routes->get('settings', 'Settings\SettingsController::index');
$routes->get('settings/locations', 'Settings\LocationController::index');
$routes->get('settings/locations/add', 'Settings\LocationController::addLocation');
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
$routes->get('settings/listings-attributes/apartment-types', 'Settings\ListingsAttributesController::apartmentType');
$routes->get('settings/listings-attributes/property-status', 'Settings\ListingsAttributesController::propertyStatus');
$routes->get('settings/listings-attributes/apartment-gender', 'Settings\ListingsAttributesController::apartmentGender');


$routes->post('settings/listings-attributes/add-apartment-types', 'Settings\ListingsAttributes\ApartmentTypeController::save');
$routes->post('settings/listings-attributes/edit-apartment-types', 'Settings\ListingsAttributes\ApartmentTypeController::update/$1');
$routes->post('settings/listings-attributes/delete-apartment-types', 'Settings\ListingsAttributes\ApartmentTypeController::delete/$1');

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

//Request API Routes
$routes->get('api/requests/update-status/(:num)/(:segment)', 'API\RequestAPIController::updateRequestStatus/$1/$2');
$routes->get('api/requests/update-priority/(:num)/(:alpha)', 'API\RequestAPIController::updateRequestPriority/$1/$2');

//Listing API Routes
$routes->get('api/listings/update-status/(:num)/(:segment)', 'API\ListingStatusAPIController::updatePropertyStatus/$1/$2');


//Listings
$routes->get('listings', 'Listings\ListingsController::index');
$routes->get('listings/(:num)', 'Listings\ListingsController::view/$1');
$routes->get('listings/add', 'Listings\ListingsController::add');
$routes->post('listings/add', 'Listings\ListingsController::addListing');
$routes->get('listings/edit/(:num)', 'Listings\ListingsController::edit/$1');
$routes->post('listings/edit/(:num)', 'Listings\ListingsController::updateListing/$1');
$routes->get('listings/delete/(:num)', 'Listings\ListingsController::delete/$1');
$routes->get('listings/export', 'Listings\ListingsController::export');

$routes->get('listings/(:num)/upload', 'Files\UploadController::uploadPage/$1');
$routes->get('listings/(:num)/files', 'Files\UploadController::viewFiles/$1');
$routes->post('listings/uploads', 'Files\UploadController::uploads');
$routes->post('listings/download/(:num)', 'Files\DownloadController::download/$1');
$routes->post('listings/download-all/(:num)', 'Files\DownloadController::downloadAll/$1');
$routes->delete('listings/delete-upload/(:num)', 'Files\DeleteController::delete/$1');


//Notifications
$routes->get('notifications', 'Notifications\NotificationController::index');




//Employee Subregion Controller
$routes->get('settings/employee-subregions', 'Settings\EmployeeSubregionController::index');
$routes->post('settings/employee-subregions/add', 'Settings\EmployeeSubregionController::addEmployeeSubregion');
$routes->post('settings/employee-subregions/delete', 'Settings\EmployeeSubregionController::deleteEmployeeSubregion');


// Backup Routes
$routes->get('settings/backup', 'Settings\BackupController::index');
$routes->post('settings/backup/backup-database', 'Settings\BackupController::backupDatabase');
$routes->post('settings/backup/download', 'Settings\BackupController::downloadBackup/$1');
$routes->post('settings/backup/delete', 'Settings\BackupController::deleteBackup');

//API

$routes->get('/api/clients/search', 'API\ClientAPIController::search');
$routes->get('/api/locations/search', 'API\LocationAPIController::search');
$routes->get('/api/locations/get-cities', 'API\LocationAPIController::getCities');
$routes->get('/api/locations/get-subregions', 'API\LocationAPIController::getSubregions');
$routes->get('/api/locations/get-regions', 'API\LocationAPIController::getRegions');
$routes->get('/api/locations/get-countries', 'API\LocationAPIController::getCountries');

//API Notifications
$routes->get('/api/notifications', 'API\NotificationAPIController::unreadNotifications');
$routes->get('/api/notifications/mark-read/(:num)', 'API\NotificationAPIController::markRead/$1');
$routes->get('/api/notifications/mark-unread/(:num)', 'API\NotificationAPIController::markUnread/$1');
$routes->get('/api/notifications/mark-all-read', 'API\NotificationAPIController::markAllRead');
$routes->get('/api/notifications/mark-all-unread', 'API\NotificationAPIController::markAllUnread');
$routes->get('/api/notifications/delete/(:num)', 'API\NotificationAPIController::delete/$1');

// Chart Routes
$routes->group('charts', function($routes) {
    // Requests Charts
    $routes->get('requests/status', 'Charts\RequestsChartsController::requestsByStatus');
    $routes->get('requests/priority', 'Charts\RequestsChartsController::requestsByPriority');
    $routes->get('requests/city', 'Charts\RequestsChartsController::requestsByCity');
    $routes->get('requests/overtime', 'Charts\RequestsChartsController::requestsOverTime');
    $routes->get('requests/average-budget', 'Charts\RequestsChartsController::averageRequestBudgetByPriority');

    // Listings Charts
    $routes->get('listings/status', 'Charts\ListingsChartsController::propertyStatusDistribution');
    $routes->get('listings/city', 'Charts\ListingsChartsController::propertyListingsByCity');
    $routes->get('listings/type', 'Charts\ListingsChartsController::propertyTypeBreakdown');
    $routes->get('listings/sale-vs-rent', 'Charts\ListingsChartsController::saleVsRentProperties');
    $routes->get('listings/average-price', 'Charts\ListingsChartsController::averagePropertyPriceByCity');

    // Employees Charts
    $routes->get('employees/role-distribution', 'Charts\EmployeesChartsController::employeeRoleDistribution');
    $routes->get('employees/count-overtime', 'Charts\EmployeesChartsController::employeeCountOverTime');
});

