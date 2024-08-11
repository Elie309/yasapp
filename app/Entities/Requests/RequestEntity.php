<?php

namespace App\Entities\Requests;

use CodeIgniter\Entity\Entity;

class RequestEntity extends Entity
{
    protected $datamap = [
        'id' => 'request_id',
        'clientId' => 'client_id',
        'locationId' => 'location_id',
        'paymentPlanId' => 'payment_plan_id',
        'currencyId' => 'currency_id',
        'employeeId' => 'employee_id',
        'budget' => 'request_budget',
        'state' => 'request_state',
        'priority' => 'request_priority',
        'type' => 'request_type',
        'comments' => 'comments'
    ];
    
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'id' => 'integer',
        'clientId' => 'integer',
        'locationId' => 'integer',
        'paymentPlanId' => 'integer',
        'currencyId' => 'integer',
        'employeeId' => 'integer',
        'budget' => 'float',
        'state' => 'string',
        'priority' => 'string',
        'type' => 'string',
        'comments' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
