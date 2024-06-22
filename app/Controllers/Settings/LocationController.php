<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Location\CityModel;
use App\Models\Location\SubregionModel;
use App\Models\Location\RegionModel;
use App\Models\Location\CountryModel;

class LocationController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $cityModel = new CityModel();
        $subregionModel = new SubregionModel();
        $regionModel = new RegionModel();
        $countryModel = new CountryModel();

        $countries = $countryModel->findAll();
        $regions = $regionModel->findAll();
        $subregions = $subregionModel->findAll();
        $cities = $cityModel->findAll();


        
        return view("template/header", ['role' => $session->get('role')]) . 
                view('settings/location', ['countries' => $countries, "regions" => $regions, 'subregions' => $subregions, 'cities' => $cities]) . 
                view("template/footer");
    }

    public function addCity()
    {
        $session = session();

        $cityModel = new CityModel();

        $data = [
            'subregion_id' => $this->request->getPost('subregion_id'),
            'city_name' => $this->request->getPost('city_name')
        ];

       $session->setFlashdata("title", 'city');


        if ($cityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $cityModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'City added successfully');
    }

    public function addSubregion()
    {
        $session = session();

        $subregionModel = new SubregionModel();

        $data = [
            'region_id' => $this->request->getPost('region_id'),
            'subregion_name' => $this->request->getPost('subregion_name')
        ];

       $session->setFlashdata("title", 'subregion');


        if ($subregionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Subregion added successfully');
    }

    public function addRegion()
    {
        $session = session();

        $regionModel = new RegionModel();

        $data = [
            'country_id' => $this->request->getPost('country_id'),
            'region_name' => $this->request->getPost('region_name')
        ];

       $session->setFlashdata("title", 'region');


        if ($regionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $regionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Region added successfully');
    }

    public function addCountry()
    {
        $session = session();
        $countryModel = new CountryModel();

        $data = [
            'country_name' => $this->request->getPost('country_name'),
            'country_code' => $this->request->getPost('country_code')
        ];

       $session->setFlashdata("title", 'country');

        if ($countryModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $countryModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Country added successfully');
    }
}
