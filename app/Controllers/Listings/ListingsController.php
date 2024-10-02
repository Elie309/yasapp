<?php

namespace App\Controllers\Listings;

use App\Controllers\BaseController;
use App\Models\Listings\ApartmentDetailsModel;
use App\Models\Listings\Attributes\ApartmentGenderModel;
use App\Models\Listings\Attributes\PropertyStatusModel;
use App\Models\Listings\Attributes\PropertyTypeModel;
use App\Models\Listings\LandDetailsModel;
use App\Models\Listings\PropertyModel;
use App\Models\Settings\EmployeeModel;

class ListingsController extends BaseController
{
    public function index()
    {

        $apartmentGender = new ApartmentGenderModel();
        $apartmentGender = $apartmentGender->findAll();

        $propertyStatus = new PropertyStatusModel();
        $propertyStatus = $propertyStatus->findAll();

        $propertyType = new PropertyTypeModel();
        $propertyType = $propertyType->findAll();

        $agent = new EmployeeModel();
        $agents = $agent->select('employee_name')->findAll();


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
                'agents' => $agents,
                'properties' => $property,
                'pager' => $pager
            ]) .
            view('template/footer');
    }

    public function add()
    {
        $apartmentGender = new ApartmentGenderModel();
        $apartmentGender = $apartmentGender->findAll();

        $propertyStatus = new PropertyStatusModel();
        $propertyStatus = $propertyStatus->findAll();

        $propertyType = new PropertyTypeModel();
        $propertyType = $propertyType->findAll();

        return view('template/header') .
            view('listings/saveListing', [
                'method' => 'NEW_REQUEST',
                'apartmentGender' => $apartmentGender,
                'propertyStatus' => $propertyStatus,
                'propertyType' => $propertyType
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
        $property = $propertyModel->find($property_id);

        if (!$property) {
            return redirect()->to('listings')->with('errors', 'Page not found');
        }

        // Get land details
        $landDetails = $landDetailModel->where('property_id', $property_id);

        $apartmentDetails = null;

        if ($landDetails) {

            $landDetails = $landDetails->first();
        } else {
            $landDetails = null;
        }

        if ($landDetails == null) {
            $apartmentDetails = $apartmentDetailModel->select('apartment_details.*, apartment_partitions.*, apartment_specifications.*')
                ->join('apartment_partitions', 'apartment_partitions.apartment_id = apartment_details.apartment_id')
                ->join('apartment_specifications', 'apartment_specifications.apartment_id = apartment_details.apartment_id')
                ->where('property_id', $property_id)->first();
        }




        // Pass data to the view
        return view('template/header') . view('listings/viewListing', [
            'property' => $property,
            'landDetails' => $landDetails,
            'apartmentDetails' => $apartmentDetails,
        ]) . view('template/footer');
    }


    public function export() {}

    public function delete($id)
    {

        return redirect()->to('listings')->with('success', 'Property deleted successfully');
    }

    public function _applyFilters($propertyModel, $employee_id)
    {
        $property = $propertyModel->select('`properties`.*, 
                CONCAT(`clients`.`client_firstname`, " ", `clients`.`client_lastname`) as `client_name`,
                `employees`.`employee_name` as `employee_name`,
                `cities`.`city_name` as `city_name`,

                CONCAT(FORMAT(`properties`.`property_price`, 0), " ", `currencies`.`currency_symbol`) as `property_budget`,
                `property_type`.`property_type_name` as `property_type_name`,
                `property_status`.`property_status_name` as `property_status_name`,
                CONCAT(FORMAT(`properties`.`property_size`, 0), " m²") as `property_dimension`,
                CASE 
                    WHEN `properties`.`property_rent_or_sale` = "rent" THEN "Rent"
                    WHEN `properties`.`property_rent_or_sale` = "sale" THEN "Sale"
                    WHEN `properties`.`property_rent_or_sale` = "rent_sale" THEN "Rent & Sale"
                    ELSE `properties`.`property_rent_or_sale`
                END as property_rent_or_sale
                ')
            ->join('clients', 'clients.client_id = properties.client_id', 'left')
            ->join('employees', 'employees.employee_id = properties.employee_id', 'left')
            ->join('currencies', 'currencies.currency_id = properties.currency_id', 'left')
            ->join('cities', 'cities.city_id = properties.city_id', 'left')
            ->join('property_type', 'property_type.property_type_id = properties.property_type_id', 'left')
            ->join('property_status', 'property_status.property_status_id = properties.property_status_id', 'left')
            ->where('properties.employee_id', $employee_id);

        if (!empty($this->request->getVar('propertyStatus'))) {
            $property = $property->where('property_status_name', $this->request->getVar('propertyStatus'));
        }

        if (!empty($this->request->getVar('propertyType'))) {
            $property = $property->where('property_type_name', $this->request->getVar('propertyType'));
        }

        if (!empty($this->request->getVar('createdAt'))) {
            $property = $property->where('created_at >=', $this->request->getVar('createdAt'));
        }

        if (!empty($this->request->getVar('updatedAt >='))) {
            $property = $property->where('updated_at', $this->request->getVar('updatedAt'));
        }

        $property = $property->orderBy('properties.created_at', 'DESC');

        return $property;
    }
}
