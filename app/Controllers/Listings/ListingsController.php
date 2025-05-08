<?php

namespace App\Controllers\Listings;

use App\Controllers\BaseController;
use App\Entities\Clients\ClientEntity;
use App\Entities\Listings\ApartmentDetailsEntity;
use App\Entities\Listings\ApartmentPartitionsEntity;
use App\Entities\Listings\ApartmentSpecificationsEntity;
use App\Entities\Listings\Attributes\ApartmentGenderEntity;
use App\Entities\Listings\Attributes\PropertyStatusEntity;
use App\Entities\Listings\Attributes\ApartmentTypeEntity;
use App\Entities\Listings\LandDetailsEntity;
use App\Entities\Listings\PropertyEntity;
use App\Entities\Listings\PropertyPriceEntity;
use App\Models\Clients\ClientModel;
use App\Models\Clients\PhoneModel;
use App\Models\Listings\ApartmentDetailsModel;
use App\Models\Listings\ApartmentPartitionsModel;
use App\Models\Listings\ApartmentSpecificationsModel;
use App\Models\Listings\LandDetailsModel;
use App\Models\Listings\PropertyModel;
use App\Models\Listings\PropertyPriceModel;
use App\Models\Settings\CurrenciesModel;
use App\Models\Settings\EmployeeModel;
use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\CountryModel;
use App\Services\ClientServices;
use App\Services\Listings\ApartmentServices;
use App\Services\Listings\LandServices;
use App\Services\Listings\ListingsServices;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ListingsController extends BaseController
{
    private $landTypes = [];

    private $tilesOptions = [];

    protected ClientServices $clientServices;
    protected LandServices $landServices;
    protected ApartmentServices $apartmentServices;

    public function __construct()
    {
        $listingsServices = new ListingsServices();

        $this->clientServices = new ClientServices();
        $this->landServices = new LandServices();
        $this->apartmentServices = new ApartmentServices();

        $this->landTypes = $listingsServices->getLandTypes();
        $this->tilesOptions = $listingsServices->getTiles();
    }

    public function index()
    {

        $apartmentGender = new ApartmentGenderEntity();
        $apartmentGender = $apartmentGender->getApartmentGenders();

        $propertyStatus = new PropertyStatusEntity();
        $propertyStatus = $propertyStatus->getPropertyStatuses();

        $apartmentTypes = new ApartmentTypeEntity();
        $apartmentTypes = $apartmentTypes->getApartmentTypes();


        if ($this->session->get('role') === 'admin') {
            $agent = new EmployeeModel();
            $agents = $agent->select('employee_name')->findAll();
        }


        $employee_id = $this->session->get('id');

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $propertyModel = new PropertyModel();

        $property = $this->_applyFilters($propertyModel, $employee_id);

        $property = $property->paginate($rowsPerPage);

        $pager = $propertyModel->pager;


        return view('template/header') .
            view('listings/listings', [
                'apartmentGender' => $apartmentGender,
                'propertyStatus' => $propertyStatus,
                'apartmentTypes' => $apartmentTypes,
                'agents' => $agents ?? null,
                'properties' => $property,
                'pager' => $pager
            ]) .
            view('template/footer');
    }

    public function add()
    {
        $apartmentGender = new ApartmentGenderEntity();
        $apartmentGender = $apartmentGender->getApartmentGenders();

        $propertyStatus = new PropertyStatusEntity();
        $propertyStatus = $propertyStatus->getPropertyStatuses();

        $apartmentTypes = new ApartmentTypeEntity();
        $apartmentTypes = $apartmentTypes->getApartmentTypes();

        $countryModel = new CountryModel();
        $countries = $countryModel->findAll();


        $currencyModel = new CurrenciesModel();
        $currencies = $currencyModel->findAll();

        return view('template/header') .
            view('listings/saveListing', [
                'method' => 'NEW_REQUEST',
                'countries' => $countries,
                'landTypes' => $this->landTypes,
                'tilesOptions' => $this->tilesOptions,
                'currencies' => $currencies,
                'apartmentGender' => $apartmentGender,
                'propertyStatus' => $propertyStatus,
                'apartmentTypes' => $apartmentTypes,
                'employee_id' => $this->session->get('id'),
                'role' => $this->session->get('role')
            ]) .
            view('template/footer');
    }

    public function addListing()
    {
        $this->db->transException(true)->transStart();

        try {
            $employee_id = $this->session->get('id');

            // Entities and models
            $clientModel = new ClientModel();
            $clientEntity = new ClientEntity();
            $phoneModel = new PhoneModel();
            $propertyModel = new PropertyModel();
            $propertyEntity = new PropertyEntity();

            $post = $this->request->getPost();
            $phones = $post['phone_number'] ?? [];
            $countries = $post['country_id'] ?? [];

            // Client save or retrieve
            $client = $clientModel->find($post['client_id']);
            $client_id = null;

            if (!$client) {
                $clientEntity->fill($post);
                $clientEntity->employee_id = $employee_id;

                if (!$clientModel->save($clientEntity)) {
                    throw new \Exception(json_encode($clientModel->errors()));
                }

                $client_id = $clientModel->getInsertID();

                if (count($phones) === count($countries) && count($phones) > 0) {
                    foreach ($phones as $i => $phone) {
                        $phoneData = [
                            'client_id' => $client_id,
                            'country_id' => $countries[$i],
                            'phone_number' => $phone
                        ];

                        if (!$phoneModel->save($phoneData)) {
                            throw new \Exception(json_encode($phoneModel->errors()));
                        }
                    }
                }
            } else {
                $client_id = $client->client_id;
            }

            // Save base property
            $property = $propertyEntity->fill($post);
            $property->employee_id = $employee_id;
            $property->client_id = $client_id;

            if (!$propertyModel->save($property)) {
                throw new \Exception(json_encode($propertyModel->errors()));
            }

            $property_id = $propertyModel->getInsertID();
            $type = esc($post['property_land_or_apartment']);

            if ($type === 'land') {
                $this->saveLand($post, $property_id, $propertyModel);
            } elseif ($type === 'apartment') {
                $this->saveApartment($post, $property_id, $propertyModel);
            } else {
                throw new \Exception('Invalid property land or apartment type');
            }

            $savePriced = $this->savePrices($property_id, $post['prices']);
            log_message('error', json_encode($savePriced));

            if (!$savePriced) {
                $this->db->transRollback();
                throw new \Exception('Error saving property prices');
            }

            $this->db->transCommit();
            return redirect()->to('listings')->with('success', 'Property added successfully');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('errors', $e->getMessage());
        }
    }


    public function edit($property_id)
    {

        $role = $this->session->get('role');
        $employee_id = $this->session->get('id');

        try {

            $property_id = esc($property_id);
            $property_id = (int) $property_id;

            $propertyModel = new PropertyModel();
            $property = $propertyModel->find($property_id);

            if (!$property) {
                return redirect()->to('listings')->with('errors', 'Page not found');
            }

            if ($property->employee_id !== $employee_id) {
                return redirect()->to('listings')->with('errors', 'You are not authorized to view this page');
            }


            $apartmentGender = new ApartmentGenderEntity();
            $apartmentGender = $apartmentGender->getApartmentGenders();

            $propertyStatus = new PropertyStatusEntity();
            $propertyStatus = $propertyStatus->getPropertyStatuses();

            $apartmentTypes = new ApartmentTypeEntity();
            $apartmentTypes = $apartmentTypes->getApartmentTypes();

            $countryModel = new CountryModel();
            $countries = $countryModel->findAll();


            $currencyModel = new CurrenciesModel();
            $currencies = $currencyModel->findAll();

            $landDetails = null;
            $apartmentDetails = null;

            $property = $propertyModel->select('properties.*, clients.*,
        CONCAT(clients.client_firstname, " ", clients.client_lastname) as client_name,
        GROUP_CONCAT(CONCAT(countries.country_code, " ", phones.phone_number) SEPARATOR ", ") as client_phone,
        employees.employee_name as employee_name,
        property_status.property_status_name as property_status_name,
        properties.created_at as property_created_at,
        properties.updated_at as property_updated_at,
        ')
                ->join('clients', 'clients.client_id = properties.client_id', 'left')
                ->join('phones', 'phones.client_id = clients.client_id', 'left')
                ->join('countries', 'countries.country_id = phones.country_id', 'left')
                ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
                ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left')

                ->where('property_id', $property_id)
                ->groupBy('properties.property_id')
                ->first();

            if (!$property) {
                return redirect()->to('listings')->with('errors', 'Page not found');
            }

            $phonesModel = new PhoneModel();
            $phones = $phonesModel->select('phones.*')
                ->where('client_id', $property->client_id)
                ->findAll();




            if ($property->land_id !== null) {
                $landDetailsModel = new LandDetailsModel();
                $landDetails = $landDetailsModel->where('property_id', $property_id)->first();
            }

            if ($property->apartment_id !== null) {

                $apartmentDetailModel = new ApartmentDetailsModel();
                $apartmentPartitionsModel = new ApartmentPartitionsModel();
                $apartmentSpecsModel = new ApartmentSpecificationsModel();
                $apartment = $apartmentDetailModel->select('apartment_details.*, apartment_gender.*, apartment_type.apartment_type_name as ad_type_name')
                    ->join('apartment_gender', 'apartment_gender.apartment_gender_id = apartment_details.ad_gender_id', 'left')
                    ->join('apartment_type', 'apartment_type.apartment_type_id = apartment_details.ad_type_id', 'left')
                    ->where('property_id', $property_id)->first();
                $apartmentPartitions = $apartmentPartitionsModel->where('apartment_id', $property->apartment_id)->first();
                $apartmentSpecs = $apartmentSpecsModel->where('apartment_id', $property->apartment_id)->first();
                unset($apartment->property_id);
                unset($apartment->apartment_id);
                unset($apartmentPartitions->apartment_id);
                unset($apartmentSpecs->apartment_id);

                if ($apartment)
                    $apartmentDetails = array_merge($apartment->toArray(), $apartmentPartitions->toArray(), $apartmentSpecs->toArray());
            }


            $property->property_land_or_apartment = $property->land_id !==  0 ? 'land' : 'apartment';

            $cityModel = new CityModel();

            $location = $cityModel->select('cities.*, subregions.*, regions.*, countries.country_id, countries.country_name')
                ->join('subregions', 'cities.subregion_id = subregions.subregion_id')
                ->join('regions', 'subregions.region_id = regions.region_id')
                ->join('countries', 'regions.country_id = countries.country_id')
                ->where('cities.city_id', $property->city_id)
                ->first();



            return view('template/header') .
                view('listings/saveListing', [
                    'method' => 'UPDATE_REQUEST',
                    'countries' => $countries,
                    'landTypes' => $this->landTypes,
                    'tilesOptions' => $this->tilesOptions,
                    'currencies' => $currencies,
                    'apartmentGender' => $apartmentGender,
                    'propertyStatus' => $propertyStatus,
                    'apartmentTypes' => $apartmentTypes,
                    'property' => $property,
                    'location' => $location,
                    'landDetails' => $landDetails,
                    'apartmentDetails' => $apartmentDetails,
                    'phones' => $phones,
                    'employee_id' => $employee_id,
                    'role' => $role

                ]) .
                view('template/footer');
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->to('listings')->with('errors', 'An error occurred while accessing the property');
        }
    }

    public function updateListing($property_id)
    {
        try {
            $employee_id = $this->session->get('id');
            $clientEntity = new ClientEntity();
            $clientEntity->fill($this->request->getPost());

            $phones = esc($this->request->getPost('phone_number'));
            $countries = esc($this->request->getPost('country_id'));
            $phone_ids = esc($this->request->getPost('phone_id'));

            $phones_details = [];
            foreach ($phones as $key => $phone) {
                $phones_details[] = [
                    'phone_id' => $phone_ids[$key],
                    'phone_number' => $phone,
                    'country_id' => $countries[$key]
                ];
            }

            $propertyModel = new PropertyModel();
            $propertyEntity = new PropertyEntity();
            $propertyEntity->fill($this->request->getPost());
            $propertyEntity->employee_id = $employee_id;

            unset($propertyEntity->land_id, $propertyEntity->apartment_id, $propertyEntity->client_id);

            $this->db->transException(true)->transStart();

            if (!$property_id) {
                return redirect()->back()->withInput()->with('errors', 'Invalid property id');
            }

            $oldProperty = $propertyModel->find($property_id);
            if (!$oldProperty) {
                return redirect()->back()->withInput()->with('errors', 'Property not found');
            }

            if ($oldProperty->employee_id !== $employee_id) {
                return redirect()->to('listings')->with('errors', 'You are not authorized to edit this page');
            }

            // Update client
            $client_id = $this->clientServices->updateClient($clientEntity, $phones_details);
            $propertyEntity->client_id = $client_id;

            // Update main property
            if (!$propertyModel->update($property_id, $propertyEntity)) {
                $this->db->transRollback();
                return redirect()->back()->withInput()->with('errors', $propertyModel->errors());
            }

            // Update land or apartment based on type
            $land_apartment = esc($this->request->getPost('property_land_or_apartment'));
            $property = $propertyModel->find($property_id); // fresh fetch

            if ($land_apartment === 'land') {
                $result = $this->landServices->updateLandDetails($property->land_id, $this->request->getPost());
                if ($result !== true) {
                    $this->db->transRollback();
                    return redirect()->back()->withInput()->with('errors', $result);
                }
            } elseif ($land_apartment === 'apartment') {
                $result = $this->apartmentServices->updateApartmentWithDetails($property->apartment_id, $this->request->getPost());
                if ($result !== true) {
                    $this->db->transRollback();
                    return redirect()->back()->withInput()->with('errors', $result);
                }
            } else {
                $this->db->transRollback();
                return redirect()->back()->withInput()->with('errors', 'Invalid property land or apartment type');
            }

            $this->db->transCommit();
            return redirect()->to('listings')->with('success', 'Property updated successfully');
        } catch (DatabaseException $e) {
            if ($e->getCode() === 1452) {
                $this->db->transRollback();
                return redirect()->back()->withInput()->with('errors', 'Invalid data provided, please check the data and try again');
            }
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('errors', $e->getMessage());
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('errors', $e->getMessage());
        }
    }



    public function view($property_id)
    {
        // Load models
        $propertyModel = new PropertyModel();
        $landDetailModel = new LandDetailsModel();
        $apartmentDetailModel = new ApartmentDetailsModel();

        // Add PropertyPriceModel
        $propertyPriceModel = new \App\Models\Listings\PropertyPriceModel();
        $currencyModel = new CurrenciesModel();

        $employee_id = $this->session->get('id');

        // Get property data
        $property = $propertyModel->select('properties.*,
        properties.employee_id as employee_id,
        clients.client_email,
        CONCAT(clients.client_firstname, " ", clients.client_lastname) as client_name,
        GROUP_CONCAT(CONCAT(countries.country_code, " ", phones.phone_number) SEPARATOR ", ") as client_phone,
        employees.employee_name as employee_name,
        CONCAT(countries_loc.country_name, ", ", regions.region_name, ", ", subregions.subregion_name, ", ", cities.city_name, ", ", properties.property_location) as property_detailed_location,
        property_status.property_status_name as property_status_name,
        properties.created_at as property_created_at,
        properties.updated_at as property_updated_at,
        ')
            ->join('clients', 'clients.client_id = properties.client_id', 'left')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
            ->join('cities', 'cities.city_id = properties.city_id', 'left')
            ->join('subregions', 'subregions.subregion_id = cities.subregion_id', 'left')
            ->join('regions', 'regions.region_id = subregions.region_id', 'left')
            ->join('countries as countries_loc', 'countries_loc.country_id = regions.country_id', 'left')
            ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left')
            ->where('property_id', $property_id)
            ->groupBy('properties.property_id')
            ->first();


        if (!$property) {
            return redirect()->to('listings')->with('errors', 'Page not found');
        }

        if ($property->employee_id !== $employee_id && $this->session->get('role') !== 'admin') {
            return redirect()->to('listings')->with('errors', 'You are not authorized to view this page');
        }

        $landDetails = null;
        $apartmentDetails = null;

        // Fetch property prices
        $propertyPrices = $propertyPriceModel->getPricesByProperty($property_id);

        // Get currency symbols for display
        $currencies = $currencyModel->findAll();
        $currencySymbols = [];
        foreach ($currencies as $currency) {
            $currencySymbols[$currency->currency_id] = $currency->currency_symbol;
        }

        if (!empty($property->land_id)) {
            $landDetails = $landDetailModel->where('property_id', $property_id)->first();
        } else if (!empty($property->apartment_id)) {
            $apartmentDetails = $apartmentDetailModel->select('apartment_details.*, apartment_partitions.*, 
            apartment_specifications.*, apartment_gender.*, apartment_type.*')
                ->join('apartment_partitions', 'apartment_partitions.apartment_id = apartment_details.apartment_id')
                ->join('apartment_specifications', 'apartment_specifications.apartment_id = apartment_details.apartment_id')
                ->join('apartment_gender', 'apartment_gender.apartment_gender_id = apartment_details.ad_gender_id')
                ->join('apartment_type', 'apartment_type.apartment_type_id = apartment_details.ad_type_id')
                ->where('property_id', $property_id)->first();
        } else {
            return redirect()->to('listings')->with('errors', 'Page not found');
        }

        $propertyStatusModel = new PropertyStatusEntity();
        $propertyStatuses = $propertyStatusModel->getPropertyStatuses();


        // Pass data to the view
        return view('template/header') . view('listings/viewListing', [
            'property' => $property,
            'landDetails' => $landDetails,
            'apartmentDetails' => $apartmentDetails,
            'propertyStatuses' => $propertyStatuses,
            'employee_id' => $employee_id,
            'propertyPrices' => $propertyPrices, // Add property prices
            'currencySymbols' => $currencySymbols // Add currency symbols
        ]) . view('template/footer');
    }


    public function export()
    {
        helper('excel');

        $employee_id = $this->session->get('id');

        $propertyModel = new PropertyModel();
        $property = $this->_applyFilters($propertyModel, $employee_id);



        $properties = $property->findAll();

        //TODO: Change this to a less manual way
        for ($i = 0; $i < count($properties); $i++) {
            if ($properties[$i]->property_land_or_apartment !== null) {
                $properties[$i]->property_land_or_apartment = 'Land';
            } else {
                $properties[$i]->property_land_or_apartment = 'Apartment';
            }
        }

        $filename = 'listings_export_' . date('Ymd') . '.xlsx';
        $header = [
            'client_name' => 'Vendor',
            'employee_name' => 'Employee',
            'city_name' => 'City',
            'property_land_or_apartment' => 'Land/Apartment',
            'property_status_name' => 'Status',
            'property_budget' => 'Price',
            'property_dimension' => 'Size',
            'property_created_at' => 'Created At',
            'property_updated_at' => 'Updated At',

        ];

        export_to_excel($filename, $header, $properties);
    }

    public function delete($id)
    {
        $propertyModel = new PropertyModel();

        $property = $propertyModel->find($id);

        if (!$property) {
            return redirect()->to('listings')->with('errors', 'Property not found');
        }

        if ($property->employee_id !== $this->session->get('id') && $this->session->get('role') !== 'admin') {
            return redirect()->to('listings')->with('errors', 'You are not authorized to delete this property');
        }

        if (!$propertyModel->delete($id)) {
            return redirect()->to('listings')->with('errors', 'An error occurred while deleting the property');
        }

        return redirect()->to('listings')->with('success', 'Property deleted successfully');
    }

    public function _applyFilters($propertyModel, $employee_id)
    {
        $search = esc($this->request->getVar('search'));
        $searchParam = esc($this->request->getVar('searchParam'));

        $propertyStatus = esc($this->request->getVar('propertyStatus'));
        $apartmentTypes = esc($this->request->getVar('apartmentType'));
        $createdAt = esc($this->request->getVar('createdAt'));
        $updatedAt = esc($this->request->getVar('updatedAt'));

        $landOrApartment = esc($this->request->getVar('landOrApartment'));

        $param = [
            'client_name' => 'clients.client_firstname',
            'city_name' => 'cities.city_name',
            'subregion_name' => 'subregions.subregion_name',
        ];


        $role = $this->session->get('role');
        $property = $propertyModel->select('`properties`.*,
                CONCAT(`clients`.`client_firstname`, " ", `clients`.`client_lastname`) as `client_name`,
                GROUP_CONCAT(CONCAT(countries.country_code, " ", phones.phone_number) SEPARATOR ", ") as phone_number,
                `employees`.`employee_name` as `employee_name`,
                `subregions`.`subregion_name` as `subregion_name`,
                `cities`.`city_name` as `city_name`,
                `property_status`.`property_status_name` as `property_status_name`,
                CONCAT(FORMAT(`properties`.`property_size`, 0), " m²") as `property_dimension`,
                properties.land_id as property_land_or_apartment,
                properties.created_at as property_created_at,
                properties.updated_at as property_updated_at
                ')
            ->join('clients', 'clients.client_id = properties.client_id', 'left')
            ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->join('cities', 'cities.city_id = properties.city_id', 'left')
            ->join('subregions', 'subregions.subregion_id = cities.subregion_id', 'left')
            ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left')
            ->groupBy('properties.property_id');



        if ($role !== 'admin') {
            $property->where('properties.employee_id', $employee_id);
        }

        if ($role === 'admin' && !empty($this->request->getVar('agent'))) {
            $property->where('employee_name', $this->request->getVar('agent'));
        }


        if (!empty($landOrApartment)) {
            if ($landOrApartment === 'land') {
                $property->where('properties.land_id IS NOT NULL');
            } else if ($landOrApartment === 'apartment') {
                $property->where('properties.apartment_id IS NOT NULL');
            }
        }

        if (!empty($search) && !empty($searchParam) && isset($param[$searchParam])) {

            if ($searchParam === 'client_name') {
                $property = $property->like('clients.client_firstname', $search)
                    ->orLike('clients.client_lastname', $search)
                    ->orLike('CONCAT_WS(" ", clients.client_firstname, clients.client_lastname)', $search);
            } else {
                $property->like($param[$searchParam], $search);
            }
        }

        if (!empty($propertyStatus)) {
            $property->where('property_status_name', $propertyStatus);
        }

        if (!empty($apartmentTypes)) {
            $property->where('apartment_type_name', $apartmentTypes);
        }

        if (!empty($createdAt)) {
            $property->where('properties.created_at >=', $createdAt);
        }

        if (!empty($updatedAt)) {
            $property->where('properties.updated_at >=', $updatedAt);
        }

        $property->orderBy('properties.created_at', 'DESC');

        return $property;
    }


    // HELPERS

    /**
     * Save Prices for the property
     * @param int $propertyId
     * @param array $pricesPost
     * @return bool
     */
    private function savePrices($propertyId, $pricesPost)
    {


        $propertyPriceModel = new PropertyPriceModel();

        $prices = $pricesPost;
        log_message('error', json_encode($prices));

        foreach (['rent', 'sale'] as $type) {
            if (!isset($prices[$type]['is_enabled'])) {
                continue;
            }
            $priceEntity = new PropertyPriceEntity();


            $priceData = [
                'property_price_property_id' => $propertyId,
                'property_price_type' => $type,
                'property_price_currency_id' => $prices[$type]['currency_id'],
                'property_price_amount' => floatval($prices[$type]['price']),
                'property_price_is_negotiable' => isset($prices[$type]['is_negotiable']),
                'property_price_is_primary' => isset($prices[$type]['is_primary']),
            ];

            // Type-specific fields
            if ($type === 'rent') {
                $priceData['property_price_rent_period'] = $prices[$type]['period'] ?? null;
            } elseif ($type === 'sale') {
                $priceData['property_price_payment_terms'] = $prices[$type]['payment_terms'] ?? null;
            }

            // Fill the entity with data
            $priceEntity->fill($priceData);

            if (!$propertyPriceModel->save($priceEntity)) {
                throw new \Exception(json_encode($propertyPriceModel->errors()));
            }
        }

        return true;
    }

    private function saveLand(array $post, int $property_id, PropertyModel $propertyModel)
    {
        $landModel = new LandDetailsModel();
        $landEntity = new LandDetailsEntity();

        $land = $landEntity->fill($post);
        $land->property_id = $property_id;

        if (!$landModel->save($land)) {
            throw new \Exception(json_encode($landModel->errors()));
        }

        $land_id = $landModel->getInsertID();
        if (!$propertyModel->update($property_id, ['land_id' => $land_id])) {
            throw new \Exception('Failed to link land to property');
        }
    }

    private function saveApartment(array $post, int $property_id, PropertyModel $propertyModel)
    {
        $apartmentModel = new ApartmentDetailsModel();
        $apartmentEntity = new ApartmentDetailsEntity();
        $apartment = $apartmentEntity->fill($post);
        $apartment->property_id = $property_id;

        $partitionModel = new ApartmentPartitionsModel();
        $partitionEntity = new ApartmentPartitionsEntity();
        $partition = $partitionEntity->fill($post);

        $specModel = new ApartmentSpecificationsModel();
        $specEntity = new ApartmentSpecificationsEntity();
        $spec = $specEntity->fill($post);

        if (!$apartmentModel->save($apartment)) {
            throw new \Exception(json_encode($apartmentModel->errors()));
        }

        $apartment_id = $apartmentModel->getInsertID();
        $partition->apartment_id = $apartment_id;
        $spec->apartment_id = $apartment_id;

        if (!$partitionModel->save($partition)) {
            throw new \Exception(json_encode($partitionModel->errors()));
        }

        if (!$specModel->save($spec)) {
            throw new \Exception(json_encode($specModel->errors()));
        }

        if (!$propertyModel->update($property_id, ['apartment_id' => $apartment_id])) {
            throw new \Exception('Failed to link apartment to property');
        }
    }
}
