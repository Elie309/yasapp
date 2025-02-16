<?php

namespace App\Cells\Utils\LocationFormHandler;

use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\CountryModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\SubregionModel;
use CodeIgniter\View\Cells\Cell;

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

    public function setDefaultData(){

        if(!isset($this->isFetchPossible) && !$this->isFetchPossible){
            return;
        }

        $this->defaultData = [];

        if($this->defaultCountryId){
            $regionModel = new RegionModel();
            $defaultData['regions'] = $regionModel->where('country_id', $this->defaultCountryId)->findAll();
        }else{
            throw new \Exception('Default Country Id is required');
        }

        if($this->defaultRegionId){
            $subregionModel = new SubregionModel();
            $defaultData['subregions'] = $subregionModel->where('region_id', $this->defaultRegionId)->findAll();
        }else {
            throw new \Exception('Default Region Id is required');
        }

        if($this->defaultSubregionId){
            $cityModel = new CityModel();
            $defaultData['cities'] = $cityModel->where('subregion_id', $this->defaultSubregionId)->findAll();
        }else{
            throw new \Exception('Default Subregion Id is required');
        }

        $this->defaultData = $defaultData;



    }

}
