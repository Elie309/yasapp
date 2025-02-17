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

    public function mount(): void
    {
        $this->setDefaultData();
    }

    public function setDefaultData()
    {
        if (!isset($this->isFetchPossible) && !$this->isFetchPossible) {
            return;
        }

        $this->defaultData = [];
        $role = esc($this->role);
        $locationServices = new LocationServices();

        if ($this->defaultRegionId && $this->defaultCountryId) {
            $this->defaultData['regions'] = $locationServices->getRegionsByEmployeeId($this->employee_id, $this->defaultCountryId, $role);
            $this->defaultData['subregions'] = $locationServices->getSubregionsByEmployeeId($this->employee_id, $this->defaultRegionId, $role);
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
    }
}
