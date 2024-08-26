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
        'payment_plan_id',
        'currency_id',
        'employee_id',
        'request_budget',
        'request_state',
        'request_priority',
        'request_type',
        'comments'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'request_id' => 'integer',
        'client_id' => 'integer',
        'city_id' => 'integer',
        'payment_plan_id' => 'integer',
        'currency_id' => 'integer',
        'employee_id' => 'integer',
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
        'payment_plan_id' => 'required|integer',
        'currency_id' => 'required|integer',
        'employee_id' => 'required|integer',
        'request_budget' => 'required|decimal',
        'request_state' => 'required|in_list[pending,fulfilled,rejected,cancelled]',
        'request_priority' => 'required|in_list[low,medium,high]',
        'request_type' => 'required|in_list[normal,urgent]',
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
        'payment_plan_id' => [
            'required' => 'Payment Plan is required',
            'integer' => 'Payment Plan is invalid'
        ],
        'currency_id' => [
            'required' => 'Currency is required',
            'integer' => 'Currency is invalid'
        ],
        'employee_id' => [
            'required' => 'Employee is required',
            'integer' => 'Employee is invalid'
        ],
        'request_budget' => [
            'required' => 'Request Budget is required',
            'decimal' => 'Request Budget must be a decimal'
        ],
        'request_state' => [
            'required' => 'Request State is required',
            'in_list' => 'Request State must be one of: pending, fulfilled, rejected, cancelled'
        ],
        'request_priority' => [
            'required' => 'Request Priority is required',
            'in_list' => 'Request Priority must be one of: low, medium, high'
        ],
        'request_type' => [
            'required' => 'Request Type is required',
            'in_list' => 'Request Type must be one of: normal, urgent'
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
