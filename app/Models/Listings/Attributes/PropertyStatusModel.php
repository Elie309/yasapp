<?php

namespace App\Models\Listings\Attributes;

use CodeIgniter\Model;

class PropertyStatusModel extends Model
{
    protected $table            = 'property_status';
    protected $primaryKey       = 'property_status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\Attributes\PropertyStatusEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_status_id',
        'property_status_name'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'property_status_id' => 'integer',
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'property_status_id'   => 'integer|permit_empty',
        'property_status_name' => 'required|string|max_length[255]|is_unique[property_status.property_status_name]'
    ];
    protected $validationMessages   = [
        'property_status_id' => [
            'integer'  => 'Property status ID must be an integer'
        ],
        'property_status_name' => [
            'required' => 'Property status name is required',
            'string'   => 'Property status name must be a string',
            'max_length' => 'Property status name must not exceed 255 characters',
            'is_unique' => 'Property status name already exists'
        ]
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
