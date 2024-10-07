<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class PropertyEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'property_id' => 'integer',
        'client_id' => 'integer',
        'employee_id' => 'integer',
        'payment_plan_id' => 'integer',
        'city_id' => 'integer',
        'land_id' => 'integer',
        'apartment_id' => 'integer',
        'currency_id' => 'integer',
        'property_type_id' => 'integer',
        'property_size' => 'float',
        'property_price' => 'float',
    ];
}
