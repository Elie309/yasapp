<?php

namespace App\Models\Requests;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table            = 'requests';
    protected $primaryKey       = 'request_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Requests\RequestEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields = [
        'client_id',
        'city_id',
        'currency_id',
        'employee_id',
        'agent_id',
        'request_payment_plan',
        'request_location',
        'request_budget',
        'request_state',
        'request_priority',
        'comments'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'request_id' => 'integer',
        'client_id' => 'integer',
        'city_id' => 'integer',
        'currency_id' => 'integer',
        'employee_id' => 'integer',
        'agent_id' => 'integer',
        'request_budget' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'client_id' => 'required|integer',
        'city_id' => 'integer',
        'currency_id' => 'required|integer',
        'employee_id' => 'required|integer',
        'agent_id' => 'permit_empty|integer',
        'request_payment_plan' => 'permit_empty|string',
        'request_location' => 'permit_empty|string',
        'request_budget' => 'required|integer',
        'request_state' => 'required|in_list[pending,finishing,rejected,cancelled,on-hold,on-track]',
        'request_priority' => 'required|in_list[low,medium,high]',
        'comments' => 'permit_empty|string',
        'created_at' => 'permit_empty|valid_date',
        'updated_at' => 'permit_empty|valid_date',
        'deleted_at' => 'permit_empty|valid_date'
    ];
    protected $validationMessages   = [
        'client_id' => [
            'required' => 'Client is required',
            'integer' => 'Client is invalid'
        ],
        'city_id' => [
            'integer' => 'City is invalid'
        ],
        'currency_id' => [
            'required' => 'Currency is required',
            'integer' => 'Currency is invalid'
        ],
        'employee_id' => [
            'required' => 'Employee is required',
            'integer' => 'Employee is invalid'
        ],
        'agent_id' => [
            'integer' => 'Agent is invalid'
        ],
        'request_payment_plan' => [
            'string' => 'Request Payment Plan must be a string'
        ],
        'request_location' => [
            'string' => 'Request Location must be a string'
        ],
        'request_budget' => [
            'required' => 'Request Budget is required',
            'integer' => 'Request Budget must be a integer'
        ],
        'request_state' => [
            'required' => 'Request State is required',
            'in_list' => 'Request State must be one of: pending, on-hold, on-track, finishing, rejected and cancelled'
        ],
        'request_priority' => [
            'required' => 'Request Priority is required',
            'in_list' => 'Request Priority must be one of: low, medium, high'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
