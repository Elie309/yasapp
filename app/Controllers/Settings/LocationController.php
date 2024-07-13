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

          // Load model
          $countryModel = new CountryModel();

          // Fetch data
          $countries = $countryModel->findAll();
  
          // Format data
          foreach ($countries as $country) {
              $regions = $country->getRegions();
  
              foreach ($regions as $region) {
                  $subregions = $region->getSubregions();
  
                  foreach ($subregions as $subregion) {
                      $cities = $subregion->getCities();
                      $subregion->cities = $cities;
                  }
  
                  $region->subregions = $subregions;
              }
  
              $country->regions = $regions;
          }
  
        
        return view("template/header", ['role' => $session->get('role')]) . 
                view('settings/location', ['data_location' => $countries]) . 
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

        if ($cityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $cityModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'City added successfully');
    }

    public function addSubregion()
    {

        $subregionModel = new SubregionModel();

        $data = [
            'region_id' => $this->request->getPost('region_id'),
            'subregion_name' => $this->request->getPost('subregion_name')
        ];


        if ($subregionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Subregion added successfully');
    }

    public function addRegion()
    {

        $regionModel = new RegionModel();

        $data = [
            'country_id' => $this->request->getPost('country_id'),
            'region_name' => $this->request->getPost('region_name')
        ];


        if ($regionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $regionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Region added successfully');
    }

    public function addCountry()
    {
        $countryModel = new CountryModel();

        $data = [
            'country_name' => $this->request->getPost('country_name'),
            'country_code' => $this->request->getPost('country_code')
        ];

        if ($countryModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $countryModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Country added successfully');
    }


    public function deleteCity(){
        $cityModel = new CityModel();

        $cityId = $this->request->getPost('city_id');

        if ($cityModel->delete($cityId) === false) {
            return redirect()->back()->withInput()->with('errors', $cityModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Subregion delete successfully');
        
    }


    public function deleteSubregion(){

        $subregionModel = new SubregionModel();

        $subregionId = $this->request->getPost('subregion_id');

        if ($subregionModel->delete($subregionId) === false) {
            return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Subregion delete successfully');

    }
    public function deleteRegion(){
        $regionModel = new RegionModel();

        $regionId = $this->request->getPost('region_id');

        if ($regionModel->delete($regionId) === false) {
            return redirect()->back()->withInput()->with('errors', $regionModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Region delete successfully');

    }

    public function deleteCountry(){
        $countryModel = new CountryModel();

        $countryId = $this->request->getPost('country_id');

        if ($countryModel->delete($countryId) === false) {
            return redirect()->back()->withInput()->with('errors', $countryModel->errors());
        }

        return redirect()->to('/settings/location')->with('success', 'Country delete successfully');
    }
}
