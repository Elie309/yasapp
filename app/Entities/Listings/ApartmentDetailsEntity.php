<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentDetailsEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'ad_terrace_area' => 'int',
        'ad_roof_area' => 'int',
    ];
}
