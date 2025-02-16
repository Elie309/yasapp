<?php

namespace App\Cells\Utils\LocationFormHandler;

use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\CountryModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\SubregionModel;
use CodeIgniter\View\Cells\Cell;
use App\Services\LocationServices;

class LocationInternalFormCell extends Cell
{
    public $searchCountryLink;
    public $searchRegionLink;
    public $searchSubregionLink;
    public $searchCityLink;
    public $countries;

    public $defaultCountryId;
    public $defaultRegionId;
    public $defaultSubregionId;
    public $defaultCityId;

    public $defaultData;
    public $isFetchPossible;

    public $employee_id;
    public $role;

    public function __construct()
    {
        $this->searchCountryLink = base_url('/api/locations/get-countries');
        $this->searchRegionLink = base_url('/api/locations/get-regions');
        $this->searchSubregionLink = base_url('/api/locations/get-subregions');
        $this->searchCityLink = base_url('/api/locations/get-cities');


        $this->getCountries();
    }

    public function getCountries()
    {

        $countryModel = new CountryModel();
        $this->countries = $countryModel->findAll();
    }

    public function mount(): void {
        $this->setDefaultData();
    }

    public function setDefaultData()
    {
        if (!isset($this->isFetchPossible) && !$this->isFetchPossible) {
            return;
        }

        $this->defaultData = [];
        $role = esc($this->employee_id);
        $locationServices = new LocationServices();

        if($this->defaultRegionId) {
            if ($role !== 'manager' && $role !== 'admin') {
                $this->defaultData['regions'] = $locationServices->getRegionsByEmployeeId($this->employee_id);
                $this->defaultData['subregions'] = $locationServices->getSubregionsByEmployeeId($this->employee_id);
            } else {
                $regionModel = new RegionModel();
                $this->defaultData['regions'] = $regionModel->select('region_id as id, region_name as name')
                                                           ->where('country_id', $this->defaultCountryId)
                                                           ->findAll();
                $subregionModel = new SubregionModel();
                $this->defaultData['subregions'] = $subregionModel->select('subregion_id as id, subregion_name as name')
                                                                 ->where('region_id', $this->defaultRegionId)
                                                                 ->findAll();
            }
        } else {
            throw new \Exception('Default Region/Subregion Id is required');
        }

        if ($this->defaultSubregionId) {
            $cityModel = new CityModel();
            $this->defaultData['cities'] = $cityModel->select('city_id as id, city_name as name')
                                                     ->where('subregion_id', $this->defaultSubregionId)
                                                     ->findAll();
        } else {
            throw new \Exception('Default Subregion Id is required');
        }

        log_message('info', 'Default Data: ' . json_encode($this->defaultData));
    }

}
