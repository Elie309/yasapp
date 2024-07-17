<?php

namespace App\Entities\Settings\Location;

use CodeIgniter\Entity\Entity;

class CityEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'city_id' => 'integer',
        'subregion_id' => 'integer',
        'city_name' => 'string',
    ];
}
