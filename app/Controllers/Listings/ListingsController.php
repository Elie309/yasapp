<?php

namespace App\Controllers\Listings;

use App\Controllers\BaseController;
use App\Entities\Listings\Attributes\ApartmentGenderEntity;
use App\Entities\Listings\Attributes\PropertyStatusEntity;
use App\Entities\Listings\Attributes\PropertyTypeEntity;
use App\Entities\Settings\PaymentPlansEntity;
use App\Models\Listings\ApartmentDetailsModel;
use App\Models\Listings\Attributes\ApartmentGenderModel;
use App\Models\Listings\Attributes\PropertyStatusModel;
use App\Models\Listings\Attributes\PropertyTypeModel;
use App\Models\Listings\LandDetailsModel;
use App\Models\Listings\PropertyModel;
use App\Models\Settings\CurrenciesModel;
use App\Models\Settings\EmployeeModel;
use App\Models\Settings\Location\CountryModel;

class ListingsController extends BaseController
{
    private $landTypes = [
        'residential',
        'industrial',
        'commercial',
        'agricultural',
        'mixed',
        'other'
    ];

    public function index()
    {

        $apartmentGender = new ApartmentGenderModel();
        $apartmentGender = $apartmentGender->findAll();

        $propertyStatus = new PropertyStatusModel();
        $propertyStatus = $propertyStatus->findAll();

        $propertyType = new PropertyTypeModel();
        $propertyType = $propertyType->findAll();

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
                'propertyType' => $propertyType,
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

        $propertyType = new PropertyTypeEntity();
        $propertyType = $propertyType->getPropertyTypes();

        $countryModel = new CountryModel();
        $countries = $countryModel->findAll();

        $paymentPlans = new PaymentPlansEntity();
        $paymentPlans = $paymentPlans->getPaymentPlans();

        $currencyModel = new CurrenciesModel();
        $currencies = $currencyModel->findAll();

        return view('template/header') .
            view('listings/saveListing', [
                'method' => 'NEW_REQUEST',
                'countries' => $countries,
                'landTypes' => $this->landTypes,
                'currencies' => $currencies,
                'apartmentGender' => $apartmentGender,
                'propertyStatus' => $propertyStatus,
                'propertyType' => $propertyType,
                'paymentPlans' => $paymentPlans
            ]) .
            view('template/footer');
    }

    public function edit($id)
    {

        $apartmentGender = new ApartmentGenderModel();
        $apartmentGender = $apartmentGender->findAll();

        $propertyStatus = new PropertyStatusModel();
        $propertyStatus = $propertyStatus->findAll();

        $propertyType = new PropertyTypeModel();
        $propertyType = $propertyType->findAll();


        return view('template/header') .
            view('listings/saveListing', [
                'method' => 'EDIT_REQUEST',
                'apartmentGender' => $apartmentGender,
                'propertyStatus' => $propertyStatus,
                'propertyType' => $propertyType
            ]) .
            view('template/footer');
    }

    public function view($property_id)
    {
        // Load models
        $propertyModel = new PropertyModel();
        $landDetailModel = new LandDetailsModel();
        $apartmentDetailModel = new ApartmentDetailsModel();

        // Get property data
        $property = $propertyModel->select('properties.*, clients.*,
        CONCAT(clients.client_firstname, " ", clients.client_lastname) as client_name,
        GROUP_CONCAT(CONCAT(countries.country_code, " ", phones.phone_number) SEPARATOR ", ") as client_phone,
        CONCAT(FORMAT(properties.property_price, 0), " ", currencies.currency_symbol) as property_budget,
        employees.employee_name as employee_name,
        CONCAT(countries_loc.country_name, ", ", regions.region_name, ", ", subregions.subregion_name, ", ", cities.city_name, ", ", properties.property_location) as property_detailed_location,
        payment_plans.payment_plan_name as payment_plan_name,
        property_type.property_type_name as property_type_name,
        property_status.property_status_name as property_status_name,
        properties.created_at as property_created_at,
        properties.updated_at as property_updated_at,
        ')
            ->join('clients', 'clients.client_id = properties.client_id', 'left')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
            ->join('cities', 'cities.city_id = properties.city_id', 'left')
            ->join('payment_plans', 'payment_plans.payment_plan_id = properties.payment_plan_id', 'left')
            ->join('currencies', 'currencies.currency_id = properties.currency_id', 'left')
            ->join('subregions', 'subregions.subregion_id = cities.subregion_id', 'left')
            ->join('regions', 'regions.region_id = subregions.region_id', 'left')
            ->join('countries as countries_loc', 'countries_loc.country_id = regions.country_id', 'left')
            ->join('property_type', 'property_type.property_type_id = properties.property_type_id', 'left')
            ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left')

            ->where('property_id', $property_id)
            ->groupBy('properties.property_id')
            ->first();


        if (!$property) {
            return redirect()->to('listings')->with('errors', 'Page not found');
        }

        if ($property->employee_id !== $this->session->get('id') && $this->session->get('role') !== 'admin') {
            return redirect()->to('listings')->with('errors', 'You are not authorized to view this page');
        }

        $landDetails = null;
        $apartmentDetails = null;

        if (!empty($property->land_id)) {
            $landDetails = $landDetailModel->where('property_id', $property_id)->first();
        } else if (!empty($property->apartment_id)) {
            $apartmentDetails = $apartmentDetailModel->select('apartment_details.*, apartment_partitions.*, 
            apartment_specifications.*, apartment_gender.apartment_gender_name as apartment_gender')
                ->join('apartment_partitions', 'apartment_partitions.apartment_id = apartment_details.apartment_id')
                ->join('apartment_specifications', 'apartment_specifications.apartment_id = apartment_details.apartment_id')
                ->join('apartment_gender', 'apartment_gender.apartment_gender_id = apartment_details.ad_gender_id')
                ->where('property_id', $property_id)->first();
        } else {
            return redirect()->to('listings')->with('errors', 'Page not found');
        }




        // Pass data to the view
        return view('template/header') . view('listings/viewListing', [
            'property' => $property,
            'landDetails' => $landDetails,
            'apartmentDetails' => $apartmentDetails,
        ]) . view('template/footer');
    }


    public function export() {
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
            'property_type_name' => 'Type',
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

        return redirect()->to('listings')->with('success', 'Property deleted successfully');
    }

    public function _applyFilters($propertyModel, $employee_id)
    {

        $role = $this->session->get('role');
        $property = $propertyModel->select('`properties`.*,
                CONCAT(`clients`.`client_firstname`, " ", `clients`.`client_lastname`) as `client_name`,
                `employees`.`employee_name` as `employee_name`,
                `cities`.`city_name` as `city_name`,
                CONCAT(FORMAT(`properties`.`property_price`, 0), " ", `currencies`.`currency_symbol`) as `property_budget`,
                `property_type`.`property_type_name` as `property_type_name`,
                `property_status`.`property_status_name` as `property_status_name`,
                CONCAT(FORMAT(`properties`.`property_size`, 0), " m²") as `property_dimension`,
                properties.land_id as property_land_or_apartment,
                properties.created_at as property_created_at,
                properties.updated_at as property_updated_at
                ')
            ->join('clients', 'clients.client_id = properties.client_id', 'left')
            ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
            ->join('currencies', 'currencies.currency_id = properties.currency_id', 'left')
            ->join('cities', 'cities.city_id = properties.city_id', 'left')
            ->join('property_type', 'property_type.property_type_id = properties.property_type_id', 'left')
            ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left');



        if ($role !== 'admin') {
            $property->where('properties.employee_id', $employee_id);
        }

        if ($role === 'admin' && !empty($this->request->getVar('agent'))) {
            $property->where('employee_name', $this->request->getVar('agent'));
        }


        if (!empty($this->request->getVar('landOrApartment'))) {
            if ($this->request->getVar('landOrApartment') === 'land') {
                $property->where('properties.land_id IS NOT NULL');
            } else if ($this->request->getVar('landOrApartment') === 'apartment') {
                $property->where('properties.apartment_id IS NOT NULL');
            }
        }

        if (!empty($this->request->getVar('propertyStatus'))) {
            $property->where('property_status_name', $this->request->getVar('propertyStatus'));
        }

        if (!empty($this->request->getVar('propertyType'))) {
            $property->where('property_type_name', $this->request->getVar('propertyType'));
        }

        if (!empty($this->request->getVar('createdAt'))) {
            $property->where('properties.created_at >=', $this->request->getVar('createdAt'));
        }

        if (!empty($this->request->getVar('updatedAt'))) {
            $property->where('properties.updated_at >=', $this->request->getVar('updatedAt'));
        }

        $property->orderBy('properties.created_at', 'DESC');

        return $property;
    }
}
