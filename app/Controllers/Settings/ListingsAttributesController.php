<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Entities\Listings\Attributes\ApartmentGenderEntity;
use App\Entities\Listings\Attributes\ApartmentTypeEntity;
use App\Entities\Listings\Attributes\PropertyStatusEntity;

class ListingsAttributesController extends BaseController
{

    public function index()
    {

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }
    
        return redirect()->to('settings/listings-attributes/property-status');
    }

    public function apartmentType()
    {
        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }

        $apartmentType = new ApartmentTypeEntity();
        $apartmentType = $apartmentType->getApartmentTypes();

        return view('template/header') . view('settings/listings-attributes', [
            'id' => 'apartmentType',
            'apartmentType' => $apartmentType,
        ]) . view('template/footer');
    }

    public function propertyStatus()
    {
        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->to('settings')->with('errors', 'You are not authorized to view this page');
        }

        $propertyStatus = new PropertyStatusEntity();
        $propertyStatus = $propertyStatus->getPropertyStatuses();

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

        $apartmentGender = new ApartmentGenderEntity();
        $apartmentGender = $apartmentGender->getApartmentGenders();

        return view('template/header') . view('settings/listings-attributes', [
            'id' => 'apartmentGender',
            'apartmentGender' => $apartmentGender,
        ]) . view('template/footer');
    }
}
