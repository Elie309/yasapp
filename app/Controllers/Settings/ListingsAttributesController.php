<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\ApartmentGenderModel;
use App\Models\Listings\Attributes\PropertyStatusModel;
use App\Models\Listings\Attributes\PropertyTypeModel;

class ListingsAttributesController extends BaseController
{

    public function index()
    {

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }
    
        return redirect()->to('settings/listings-attributes/property-status');
    }

    public function PropertyType()
    {
        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }

        $propertyTypeModel = new PropertyTypeModel();
        $propertyType = $propertyTypeModel->findAll();

        return view('template/header') . view('settings/listings-attributes', [
            'id' => 'propertyType',
            'propertyType' => $propertyType,
        ]) . view('template/footer');
    }

    public function propertyStatus()
    {
        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }

        $propertyStatusModel = new PropertyStatusModel();
        $propertyStatus = $propertyStatusModel->findAll();

        return view('template/header') . view('settings/listings-attributes', [
            'id' => 'propertyStatus',
            'propertyStatus' => $propertyStatus,
        ]) . view('template/footer');
    }

    public function apartmentGender()
    {
        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }

        $apartmentGenderModel = new ApartmentGenderModel();
        $apartmentGender = $apartmentGenderModel->findAll();

        return view('template/header') . view('settings/listings-attributes', [
            'id' => 'apartmentGender',
            'apartmentGender' => $apartmentGender,
        ]) . view('template/footer');
    }
}
