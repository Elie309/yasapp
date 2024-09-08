<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class LandDetailsEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'land_zone_first' => 'float',
        'land_zone_second' => 'float',
    ];
}
