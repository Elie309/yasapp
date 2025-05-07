<?php

namespace App\Models\Listings;

use CodeIgniter\Model;


class ApartmentDetailsModel extends Model
{
    protected $table            = 'apartment_details';
    protected $primaryKey       = 'apartment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\ApartmentDetailsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_id',
        'ad_terrace',
        'ad_terrace_area',
        'ad_roof',
        'ad_roof_area',
        'ad_gender_id',
        'ad_type_id',
        'ad_furnished',
        'ad_elevator',
        'ad_status_age',
        'ad_floor_level',
        'ad_apartments_per_floor',
        'ad_view',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'apartment_id' => 'integer',
        'property_id' => 'integer',
        'ad_terrace_area' => 'integer',
        'ad_roof_area' => 'integer',
        'ad_gender_id' => 'integer',
        'ad_type_id' => 'integer',
        'ad_floor_level' => 'integer',
        'ad_apartments_per_floor' => 'integer'
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
        'apartment_id' => 'permit_empty',
        'property_id' => 'required|integer',
        'ad_terrace' => 'permit_empty|boolean',
        'ad_terrace_area' => 'permit_empty|integer',
        'ad_roof' => 'permit_empty|boolean',
        'ad_roof_area' => 'permit_empty|integer',
        'ad_gender_id' => 'required|integer',
        'ad_type_id' => 'required|integer',
        'ad_furnished' => 'permit_empty|boolean',
        'ad_elevator' => 'permit_empty|boolean',
        'ad_status_age' => 'string|max_length[255]',
        'ad_floor_level' => 'permit_empty|integer',
        'ad_apartments_per_floor' => 'permit_empty|integer',
        'ad_view' => 'string|max_length[255]',
    ];
    protected $validationMessages   = [
        'apartment_id' => [],
        'property_id' => [
            'required' => 'Property ID is required',
            'integer'  => 'Property ID must be an integer'
        ],
        'ad_terrace' => [
            'boolean' => 'Terrace must be a boolean'
        ],
        'ad_terrace_area' => [
            'integer' => 'Terrace Area must be an integer'
        ],
        'ad_roof' => [
            'boolean' => 'Roof must be a boolean'
        ],
        'ad_roof_area' => [
            'integer' => 'Roof Area must be an integer'
        ],
        'ad_gender_id' => [
            'required' => 'Apartment Gender ID is required',
            'integer'  => 'Apartment Gender ID must be an integer'
        ],
        'ad_type_id' => [
            'integer' => 'Apartment Type ID must be an integer',
            'required' => 'Apartment Type ID is required'
        ],
        'ad_furnished' => [
            'boolean' => 'Furnished must be a boolean'
        ],
        'ad_elevator' => [
            'boolean' => 'Elevator must be a boolean'
        ],
        'ad_status_age' => [
            'string' => 'Status Age must be a string',
            'max_length' => 'Status Age must not exceed 255 characters'
        ],
        'ad_floor_level' => [
            'integer' => 'Floor Level must be an integer'
        ],
        'ad_apartments_per_floor' => [
            'integer' => 'Apartments Per Floor must be an integer'
        ],
        'ad_view' => [
            'string' => 'View must be a string',
            'max_length' => 'View must not exceed 255 characters'
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
