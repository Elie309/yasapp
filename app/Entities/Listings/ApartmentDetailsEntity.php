<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentDetailsEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'apartment_id' => 'int',
        'property_id' => 'int',
        'ad_gender_id' => 'int',
        'ad_status_age' => 'string',
        'ad_apartments_per_floor' => 'int',
        'ad_terrace_area' => 'int',
        'ad_roof_area' => 'int',
        'ad_floor_level' => 'int',
    ];


    public function setAdTerrace(string $value = 'off')
    {
        $this->attributes['ad_terrace'] = $value == 'on' ? true : false;
    }

    public function setAdRoof(string $value = 'off')
    {
        $this->attributes['ad_roof'] = $value == 'on' ? true : false;
    }

    public function setAdFurnished(string $value = 'off')
    {
        $this->attributes['ad_furnished'] = $value == 'on' ? true : false;
    }

    public function setAdFurnishedOnProvisions(string $value = 'off')
    {
        $this->attributes['ad_furnished_on_provisions'] = $value == 'on' ? true : false;
    }

    public function setAdElevator(string $value = 'off')
    {
        $this->attributes['ad_elevator'] = $value == 'on' ? true : false;
    }

    //Getters for boolean values TRUE or FALSE
    public function getAdTerrace()
    {
        return $this->attributes['ad_terrace'] ? true : false;
    }

    public function getAdRoof()
    {
        return $this->attributes['ad_roof'] ? true : false;
    }

    public function getAdFurnished()
    {
        return $this->attributes['ad_furnished'] ? true : false;
    }

    public function getAdFurnishedOnProvisions()
    {
        return $this->attributes['ad_furnished_on_provisions'] ? true : false;
    }

    public function getAdElevator()
    {
        return $this->attributes['ad_elevator'] ? true : false;
    }

    
}
