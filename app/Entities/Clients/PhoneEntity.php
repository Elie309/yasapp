<?php

namespace App\Entities\Clients;

use CodeIgniter\Entity\Entity;

class PhoneEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'phone_id' => 'int',
        'client_id' => 'int',
        'country_id' => 'int',
        'phone_number' => 'string',
    ];
}
