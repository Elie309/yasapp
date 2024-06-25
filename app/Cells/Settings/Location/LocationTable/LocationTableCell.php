<?php

namespace App\Cells\Settings\Location\LocationTable;

use CodeIgniter\View\Cells\Cell;
use App\Models\Location\CountryModel;

class LocationTableCell extends Cell
{
    public $countries = [];

    public function __construct()
    {
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

        $this->countries = $countries;
    }
}
