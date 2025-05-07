<?php

namespace App\Models\Listings;

use CodeIgniter\Model;

class LandDetailsModel extends Model
{
    protected $table            = 'land_details';
    protected $primaryKey       = 'land_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\LandDetailsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_id',
        'land_type',
        'land_zone_first',
        'land_zone_second',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'land_id' => 'integer',
        'property_id' => 'integer',
        'land_zone_first' => 'float',
        'land_zone_second' => 'float'
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
        'land_id' => 'permit_empty',
        'property_id' => 'required|integer',
        'land_type' => 'required|string|in_list[industrial, residential, commercial, agricultural, mixed, other]',
        'land_zone_first' => 'decimal',
        'land_zone_second' => 'decimal',
    ];
    protected $validationMessages   = [
        'land_id' => [],
        'property_id' => [
            'required' => 'Property ID is required',
            'integer'  => 'Property ID must be an integer'
        ],
        'land_type' => [
            'required' => 'Land Type is required',
            'string'   => 'Land Type must be a string',
            'in_list'  => 'Land Type must be one of: industrial, residential, commercial, agricultural, mixed, other'
        ],
        'land_zone_first' => [
            'decimal' => 'Land Zone First must be a number'
        ],
        'land_zone_second' => [
            'decimal' => 'Land Zone Second must be a number'
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
