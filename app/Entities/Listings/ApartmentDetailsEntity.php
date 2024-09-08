<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentDetailsEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'apartment_id' => 'int',
        'property_id' => 'int',
        'ad_terrace' => 'bool',
        'ad_roof' => 'bool',
        'ad_gender_id' => 'int',
        'ad_furnished' => 'bool',
        'ad_furnished_on_provisions' => 'bool',
        'ad_elevator' => 'bool',
        'ad_status_age' => 'int',
        'ad_apartments_per_floor' => 'int',
        'ad_terrace_area' => 'int',
        'ad_roof_area' => 'int',
        'ad_floor_level' => 'int',
    ];
}
