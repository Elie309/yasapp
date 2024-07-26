<?php

namespace App\Models\Clients;

use CodeIgniter\Model;

class PhoneModel extends Model
{
    protected $table            = 'phones';
    protected $primaryKey       = 'phone_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Clients\PhoneEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['phone_id', 'client_id','country_id', 'phone_number'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'client_id' => 'required|integer',
        'country_id' => 'required|integer',
        'phone_number' => 'required|string|max_length[20]',
    ];
    protected $validationMessages   = [
        'client_id' => [
            'required' => 'Client ID is required',
            'integer' => 'Client ID must be an integer',
        ],
        'country_id' => [
            'required' => 'Country ID is required',
            'integer' => 'Country ID must be an integer',
        ],
        'phone_number' => [
            'required' => 'Phone number is required',
            'string' => 'Phone number must be a string',
            'max_length' => 'Phone number must not exceed 20 characters',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
