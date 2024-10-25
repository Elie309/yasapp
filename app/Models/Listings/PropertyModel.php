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
        'payment_plan_id',
        'city_id',
        'currency_id',

        'land_id',
        'apartment_id',

        'property_location',
        'property_referral_name',
        'property_referral_phone',
        'property_type',
        'property_catch_phrase',
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
        'payment_plan_id' => 'integer',
        'city_id' => 'integer',
        'land_id' => '?integer',
        'apartment_id' => '?integer',
        'property_type_id' => 'integer',
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
        'payment_plan_id' => 'required|integer',
        'city_id' => 'required|integer',
        'property_type_id' => 'required|integer',
        'property_status_id' => 'required|integer',
        'currency_id' => 'required|integer',
        'land_id' => 'integer|permit_empty',
        'apartment_id' => 'integer|permit_empty',
        'property_location' => 'string|max_length[255]',
        'property_referral_name' => 'string|max_length[255]',
        'property_referral_phone' => 'string|max_length[20]',
        'property_catch_phrase' => 'string',
        'property_size' => 'integer',
        'property_price' => 'integer',
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
        'payment_plan_id' => [
            'required' => 'Payment Plan ID is required',
            'integer' => 'Payment Plan ID must be an integer'
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
        'property_type_id' => [
            'required' => 'Property Type ID is required',
            'integer' => 'Property Type ID must be an integer'
        ],
        'property_status_id' => [
            'required' => 'Property Status ID is required',
            'integer' => 'Property Status ID must be an integer'
        ],
        'currency_id' => [
            'required' => 'Currency ID is required',
            'integer' => 'Currency ID must be an integer'
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
        'property_size' => [
            'integer' => 'Property Size must be a integer'
        ],
        'property_price' => [
            'integer' => 'Property Price must be a integer'
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
