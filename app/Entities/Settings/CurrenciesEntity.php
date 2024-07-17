<?php

namespace App\Entities\Settings;

use CodeIgniter\Entity\Entity;

class CurrenciesEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'currency_id' => 'integer',
        'currency_code' => 'string',
        'currency_name' => 'string',
        'currency_symbol' => 'string',
    ];
}
