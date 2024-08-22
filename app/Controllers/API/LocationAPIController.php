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
}
