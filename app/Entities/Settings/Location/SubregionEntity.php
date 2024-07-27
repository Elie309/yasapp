<?php

namespace App\Entities\Settings\Location;

use CodeIgniter\Entity\Entity;

class SubregionEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'subregion_id' => 'integer',
        'region_id' => 'integer',
        'subregion_name' => 'string',
    ];
}
