<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\SubregionModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\CountryModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class LocationController extends BaseController
{

    private $link_back = '/settings/locations';

    public function index()
    {

        // Load model
        $countryModel = new CountryModel();

        // Fetch all countries and all children regions and subregions and cities

        $countries = $countryModel->select('countries.country_id, countries.country_name, countries.country_code, regions.region_name, subregions.subregion_name, GROUP_CONCAT(cities.city_name SEPARATOR ", ") as city_names')
            ->join('regions', 'regions.country_id = countries.country_id', 'left')
            ->join('subregions', 'subregions.region_id = regions.region_id', 'left')
            ->join('cities', 'cities.subregion_id = subregions.subregion_id', 'left')
            ->groupBy(['countries.country_id', 'regions.region_id', 'subregions.subregion_id'])
            ->findAll();


        return view("template/header") .
            view('settings/location', ['data_location' => $countries]) .
            view("template/footer");
    }

    public function addLocation()
    {
        return view("template/header") .
            view('settings/edit-location') .
            view("template/footer");
    }

    public function addCity()
    {

        $cityModel = new CityModel();

        $subregionId = $this->request->getPost('subregion_id');
        $subregionModel = new SubregionModel();
        $subregion = $subregionModel->find($subregionId);

        if ($subregion === null) {
            return redirect()->back()->withInput()->with('errors', ['Subregion not found']);
        }

        $data = [
            'subregion_id' => $subregionId,
            'city_name' => esc($this->request->getPost('city_name'))
        ];

        if ($cityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $cityModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'City added successfully');
    }

    public function addSubregion()
    {

        $subregionModel = new SubregionModel();

        $regionId = $this->request->getPost('region_id');
        $regionModel = new RegionModel();
        $region = $regionModel->find($regionId);
        if ($region === null) {
            return redirect()->back()->withInput()->with('errors', ['Region not found']);
        }

        $data = [
            'region_id' => $regionId,
            'subregion_name' => esc($this->request->getPost('subregion_name'))
        ];


        if ($subregionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'Subregion added successfully');
    }

    public function addRegion()
    {

        $regionModel = new RegionModel();

        $countryId = $this->request->getPost('country_id');
        $countryModel = new CountryModel();
        $country = $countryModel->find($countryId);
        if ($country === null) {
            return redirect()->back()->withInput()->with('errors', ['Country not found']);
        }
        $regionName = esc($this->request->getPost('region_name'));

        $data = [
            'country_id' => $countryId,
            'region_name' => $regionName
        ];


        if ($regionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $regionModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'Region added successfully');
    }

    public function addCountry()
    {
        $countryModel = new CountryModel();

        $countryName = esc($this->request->getPost('country_name'));
        $countryCode = esc($this->request->getPost('country_code'));

        $data = [
            'country_name' => $countryName,
            'country_code' => $countryCode
        ];
                

        if ($countryModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $countryModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'Country added successfully');
    }


    public function updateCity()
    {
        $cityModel = new CityModel();

        $data = [
            'city_id' => $this->request->getPost('city_id'),
            'city_name' => $this->request->getPost('city_name')
        ];

        if($cityModel->find($this->request->getPost('city_id')) === null) {
            return redirect()->back()->withInput()->with('errors', ['City not found']);
        }

        if ($cityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $cityModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'City updated successfully');
    }

    public function updateSubregion()
    {
        $subregionModel = new SubregionModel();

        $data = [
            'subregion_id' => $this->request->getPost('subregion_id'),
            'subregion_name' => $this->request->getPost('subregion_name')
        ];

        if($subregionModel->find($this->request->getPost('subregion_id')) === null) {
            return redirect()->back()->withInput()->with('errors', ['Subregion not found']);
        }

        if ($subregionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'Subregion updated successfully');
    }


    public function updateRegion()
    {
        $regionModel = new RegionModel();

        $data = [
            'region_id' => $this->request->getPost('region_id'),
            'region_name' => $this->request->getPost('region_name')
        ];

        if($regionModel->find($this->request->getPost('region_id')) === null) {
            return redirect()->back()->withInput()->with('errors', ['Region not found']);
        }

        if ($regionModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $regionModel->errors());
        }

        return redirect()->to($this->link_back)->with('success', 'Region updated successfully');
    }


    public function updateCountry()
    {
        $countryModel = new CountryModel();

        $countryID = esc($this->request->getPost('country_id'));

        // Retrieve the current country data
        $currentCountry = $countryModel->find($countryID);

        if ($currentCountry === null) {
            return redirect()->back()->withInput()->with('errors', ['Country not found']);
        }

        $data = [];
        if ($this->request->getPost('country_name') !== $currentCountry->country_name) {
            $data['country_name'] = $this->request->getPost('country_name');
        }
        if ($this->request->getPost('country_code') !== $currentCountry->country_code) {
            $data['country_code'] = $this->request->getPost('country_code');
        }

       

        // Proceed with update only if there's something to update
        if (!empty($data)) {
            if ($countryModel->update($countryID, $data) === false) {
                return redirect()->back()->withInput()->with('errors', $countryModel->errors());
            }

            return redirect()->to($this->link_back)->with('success', 'Country updated successfully');
        } else {
            return redirect()->back()->with('success', 'No changes detected.');
        }
    }





    public function deleteCity()
    {
        try {

            $cityModel = new CityModel();

            $cityId = $this->request->getPost('city_id');

            if($cityModel->find($cityId) === null) {
                return redirect()->back()->withInput()->with('errors', ['City not found']);
            }

            if ($cityModel->delete($cityId) === false) {
                return redirect()->back()->withInput()->with('errors', $cityModel->errors());
            }

            return redirect()->to($this->link_back)->with('success', 'City deleted successfully');
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['City cannot be deleted']);
        }
    }


    public function deleteSubregion()
    {
        try {

            $subregionModel = new SubregionModel();

            $subregionId = $this->request->getPost('subregion_id');

            if($subregionModel->find($subregionId) === null) {
                return redirect()->back()->withInput()->with('errors', ['Subregion not found']);
            }

            if ($subregionModel->delete($subregionId) === false) {
                return redirect()->back()->withInput()->with('errors', $subregionModel->errors());
            }

            return redirect()->to($this->link_back)->with('success', 'Subregion deleted successfully');
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Subregion cannot be deleted']);
        }
    }
    public function deleteRegion()
    {
        try {

            $regionModel = new RegionModel();

            $regionId = $this->request->getPost('region_id');

            if($regionModel->find($regionId) === null) {
                return redirect()->back()->withInput()->with('errors', ['Region not found']);
            }

            if ($regionModel->delete($regionId) === false) {
                return redirect()->back()->withInput()->with('errors', $regionModel->errors());
            }

            return redirect()->to($this->link_back)->with('success', 'Region deleted successfully');
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Region cannot be deleted']);
        }
    }

    public function deleteCountry()
    {
        try {

            $countryModel = new CountryModel();

            $countryId = $this->request->getPost('country_id');

            if($countryModel->find($countryId) === null) {
                return redirect()->back()->withInput()->with('errors', ['Country not found']);
            }

            if ($countryModel->delete($countryId) === false) {
                return redirect()->back()->withInput()->with('errors', $countryModel->errors());
            }

            return redirect()->to($this->link_back)->with('success', 'Country deleted successfully');
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Country cannot be deleted']);
        }
    }
}
