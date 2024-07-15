<?php

namespace App\Entities\Settings;

use CodeIgniter\Entity\Entity;

class PaymentPlansEntity extends Entity
{

    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'payment_plan_id' => 'integer',
        'payment_plan_name' => 'string',
    ];
}
