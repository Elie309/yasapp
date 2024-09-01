<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Settings\Location\CityModel;

class LocationAPIController extends BaseController
{
    public function search()
    {
        $search = $this->request->getGet('search');
        $search = esc($search);
        $search = str_replace('+', ' ', $search);
        $search = trim($search);

        $cityModel = new CityModel();

        $city = $cityModel->select('cities.city_id, cities.city_name, subregions.subregion_name, regions.region_name, countries.country_name')
            ->join('subregions', 'cities.subregion_id = subregions.subregion_id', 'left')
            ->join('regions', 'subregions.region_id = regions.region_id', 'left')
            ->join('countries', 'regions.country_id = countries.country_id', 'left')
            ->groupStart()
            ->like('cities.city_name', $search)
            ->groupEnd()
            ->findAll();


        return $this->response->setJSON($city);
    }

    public function getCities()
    {
        $search = esc($this->request->getGet('search'));

        $cityModel = new CityModel();

        $cities = $cityModel->select('cities.city_id as id, cities.city_name as name')
            ->like('cities.city_name', $search)
            ->findAll();

        return $this->response->setJSON($cities);
    }

    public function getSubregions()
    {
        $search = esc($this->request->getGet('search'));

        $subregion = new \App\Models\Settings\Location\SubregionModel();

        $subregions = $subregion->select('subregions.subregion_id as id, subregions.subregion_name as name')
            ->like('subregions.subregion_name', $search)
            ->findAll();

        return $this->response->setJSON($subregions);
    }

    public function getRegions()
    {
        $search = esc($this->request->getGet('search'));
        
        $region = new \App\Models\Settings\Location\RegionModel();

        $regions = $region->select('regions.region_id as id, regions.region_name as name')
            ->like('regions.region_name', $search)
            ->findAll();
        

        return $this->response->setJSON($regions);
    }

    public function getCountries()
    {
        $search = esc($this->request->getGet('search'));
        $country = new \App\Models\Settings\Location\CountryModel();

        $countries = $country->select('countries.country_id as id, countries.country_name as name')
            ->like('countries.country_name', $search)
            ->findAll();

        return $this->response->setJSON($countries);
    }


}
