<?php

namespace App\Models\Listings;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table            = 'properties';
    protected $primaryKey       = 'property_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\PropertyEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    =[
        'client_id',
        'employee_id',
        'city_id',
        'currency_id',

        'land_id',
        'apartment_id',

        'property_rent',
        'property_sale',
        'property_location',
        'property_referral_name',
        'property_referral_phone',
        'property_catch_phrase',
        'property_payment_plan',
        'property_size',
        'property_price',
        'property_status_id',

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'property_id' => 'integer',
        'client_id' => 'integer',
        'employee_id' => 'integer',
        'city_id' => 'integer',
        'land_id' => '?integer',
        'apartment_id' => '?integer',
        'currency_id' => 'integer',
        'property_size' => 'float',
        'property_price' => 'float',
        'property_status_id' => 'integer',
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

        'property_id' => 'permit_empty',
        'client_id' => 'required|integer',
        'employee_id' => 'required|integer',
        'city_id' => 'required|integer',
        'property_status_id' => 'required|integer',
        'currency_id' => 'required|integer',
        'land_id' => 'integer|permit_empty',
        'apartment_id' => 'integer|permit_empty',
        'property_rent' => 'permit_empty|boolean',
        'property_sale' => 'permit_empty|boolean',
        'property_location' => 'string|max_length[255]',
        'property_referral_name' => 'string|max_length[255]',
        'property_referral_phone' => 'string|max_length[20]',
        'property_catch_phrase' => 'permit_empty|string',
        'property_payment_plan' => 'permit_empty|string',
        'property_size' => 'decimal',
        'property_price' => 'decimal',
    ];
    protected $validationMessages   = [
        'property_id' => [],
        'client_id' => [
            'required' => 'Client ID is required',
            'integer' => 'Client ID must be an integer'
        ],
        'employee_id' => [
            'required' => 'Employee ID is required',
            'integer' => 'Employee ID must be an integer'
        ],
        'city_id' => [
            'required' => 'City ID is required',
            'integer' => 'City ID must be an integer'
        ],
        'land_id' => [
            'integer' => 'Land ID must be an integer'
        ],
        'apartment_id' => [
            'integer' => 'Apartment ID must be an integer'
        ],
        'property_status_id' => [
            'required' => 'Property Status ID is required',
            'integer' => 'Property Status ID must be an integer'
        ],
        'currency_id' => [
            'required' => 'Currency ID is required',
            'integer' => 'Currency ID must be an integer'
        ],
        'property_rent' => [
            'boolean' => 'Property Rent must be a boolean'
        ],
        'property_sale' => [
            'boolean' => 'Property Sale must be a boolean'
        ],
        'property_location' => [
            'string' => 'Property Location must be a string',
            'max_length' => 'Property Location must not exceed 255 characters'
        ],
        'property_referral_name' => [
            'string' => 'Property Referral Name must be a string',
            'max_length' => 'Property Referral Name must not exceed 255 characters'
        ],
        'property_referral_phone' => [
            'string' => 'Property Referral Phone must be a string',
            'max_length' => 'Property Referral Phone must not exceed 20 characters'
        ],
        'property_catch_phrase' => [
            'string' => 'Property Catch Phrase must be a string'
        ],
        'property_payment_plan' => [
            'string' => 'Property Payment Plan must be a string'
        ],
        'property_size' => [
            'decimal' => 'Property Size must be a decimal or float',
        ],
        'property_price' => [
            'decimal' => 'Property Price must be a decimal or float',
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
