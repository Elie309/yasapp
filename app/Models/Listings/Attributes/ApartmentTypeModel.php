<?php

namespace App\Models\Listings\Attributes;

use CodeIgniter\Model;

class ApartmentTypeModel extends Model
{
    protected $table            = 'apartment_type';
    protected $primaryKey       = 'apartment_type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\Attributes\ApartmentTypeEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'apartment_type_id',
        'apartment_type_name'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'apartment_type_id' => 'integer',
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
        'apartment_type_id'   => 'integer|permit_empty',
        'apartment_type_name' => 'required|string|max_length[255]|is_unique[apartment_type.apartment_type_name]'
    ];
    protected $validationMessages   = [
        'apartment_type_id' => [
            'integer'  => 'Apartment Type ID must be an integer'
        ],
        'apartment_type_name' => [
            'required'    => 'Apartment Type Name is required',
            'string'      => 'Apartment Type Name must be a string',
            'max_length'  => 'Apartment Type Name must not exceed 255 characters',
            'is_unique'   => 'Apartment Type Name already exists'
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
