<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\CountryModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\SubregionModel;
use App\Services\LocationServices;

class LocationAPIController extends BaseController
{
    public function search()
    {
        try {
            $search = $this->request->getGet('search');
            $search = esc($search);
            $search = str_replace('+', ' ', $search);


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
        } catch (\Exception $e) {
            return $this->response->setJSON(['errors' => $e->getMessage()]);
        }
    }

    public function getCities()
    {
        try {
            $search = esc($this->request->getGet('search'));

            $subregion_id = intval(esc($this->request->getGet('subregion_id')));

            $cityModel = new CityModel();

            $cities = $cityModel->select('cities.city_id as id, cities.city_name as name');

            if ($subregion_id && $subregion_id > 0) {
                $cities->where('cities.subregion_id', $subregion_id);
            }

            if ($search) {
                $cities->like('cities.city_name', $search);
            }

            $cities = $cities->findAll();

            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'data' => $cities
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function getSubregions()
    {
        try {
            $search = esc($this->request->getGet('search'));
            $region_id = intval(esc($this->request->getGet('region_id')));
            $employee_id = intval($this->session->get('id'));
            $role = esc($this->session->get('role'));

            $subregions = [];

            if ($search) {
                $subregionModel = new SubregionModel();
                $subregions = $subregionModel->select('subregions.subregion_id as id, subregions.subregion_name as name')
                    ->like('subregions.subregion_name', $search)
                    ->findAll();
            } else {
                $locationServices = new LocationServices();
                $subregions = $locationServices->getSubregionsByEmployeeId($employee_id, $region_id, $role);
            }

            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'data' => $subregions
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function getRegions()
    {
        try {
            $search = esc($this->request->getGet('search'));
            $country_id = intval(esc($this->request->getGet('country_id')));

            if ($search) {
                $regionModel = new RegionModel();
                $regions = $regionModel->select('regions.region_id as id, regions.region_name as name')
                    ->like('regions.region_name', $search)
                    ->findAll();
            } else {
                $role = esc($this->session->get('role'));
                $employee_id = intval(esc($this->session->get('id')));
                $locationServices = new LocationServices();
                $regions = $locationServices->getRegionsByEmployeeId($employee_id, $country_id, $role);
            }

            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'data' => $regions
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function getCountries()
    {
        try {
            $search = esc($this->request->getGet('search'));
            $country = new CountryModel();


            $countries = $country->select('countries.country_id as id, countries.country_name as name')
                ->like('countries.country_name', $search)
                ->findAll();

            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'data' => $countries
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }
}
