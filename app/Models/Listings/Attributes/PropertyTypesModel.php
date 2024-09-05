<?php

namespace App\Models\Listings\Attributes;

use CodeIgniter\Model;

class PropertyTypesModel extends Model
{
    protected $table            = 'property_types';
    protected $primaryKey       = 'property_type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\Attributes\PropertyTypesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_type_id',
        'property_type_name'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'property_type_id' => 'integer',
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
        'property_type_id'   => 'required|integer',
        'property_type_name' => 'required|string|max_length[255]'
    ];
    protected $validationMessages   = [
        'property_type_id' => [
            'required' => 'Property Type ID is required',
            'integer'  => 'Property Type ID must be an integer'
        ],
        'property_type_name' => [
            'required'    => 'Property Type Name is required',
            'string'      => 'Property Type Name must be a string',
            'max_length'  => 'Property Type Name must not exceed 255 characters'
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
