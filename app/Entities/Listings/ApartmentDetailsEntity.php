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


    public function setAdTerrace(string $value)
    {
        $this->attributes['ad_terrace'] = $value == 'on' ? true : false;
    }

    public function setAdRoof(string $value)
    {
        $this->attributes['ad_roof'] = $value == 'on' ? true : false;
    }

    public function setAdFurnished(string $value)
    {
        $this->attributes['ad_furnished'] = $value == 'on' ? true : false;
    }

    public function setAdFurnishedOnProvisions(string $value)
    {
        $this->attributes['ad_furnished_on_provisions'] = $value == 'on' ? true : false;
    }

    public function setAdElevator(string $value)
    {
        $this->attributes['ad_elevator'] = $value == 'on' ? true : false;
    }





    
}
