<?php

namespace App\Models\Listings\Attributes;

use CodeIgniter\Model;

class ApartmentGenderModel extends Model
{
    protected $table            = 'apartment_gender';
    protected $primaryKey       = 'apartment_gender_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\Attributes\ApartmentGenderEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'apartment_gender_id',
        'apartment_gender_name'

    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'apartment_gender_id' => 'integer',
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
        'apartment_gender_id'   => 'required|integer',
        'apartment_gender_name' => 'required|string|max_length[255]'
    ];
    protected $validationMessages   = [
        'apartment_gender_id' => [
            'required' => 'Apartment gender ID is required',
            'integer'  => 'Apartment gender ID must be an integer'
        ],
        'apartment_gender_name' => [
            'required' => 'Apartment gender name is required',
            'string'   => 'Apartment gender name must be a string',
            'max_length' => 'Apartment gender name must not exceed 255 characters'
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
