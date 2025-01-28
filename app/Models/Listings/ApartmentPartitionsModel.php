<?php

namespace App\Models\Listings;

use CodeIgniter\Model;


class ApartmentPartitionsModel extends Model
{
    protected $table            = 'apartment_partitions';
    protected $primaryKey       = 'partition_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\ApartmentPartitionsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'apartment_id',
        'partition_salon',
        'partition_dining',
        'partition_kitchen',
        'partition_master_bedroom',
        'partition_bedroom',
        'partition_bathroom',
        'partition_maid_room',
        'partition_reception_balcony',
        'partition_sitting_corner',
        'partition_balconies',
        'partition_parking',
        'partition_storage_room',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'partition_id' => 'integer',
        'apartment_id' => 'integer'
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
        'partition_id' => 'permit_empty',
        'apartment_id' => 'required|integer',
        'partition_salon' => 'permit_empty|string|max_length[255]',
        'partition_dining' => 'permit_empty|string|max_length[255]',
        'partition_kitchen' => 'permit_empty|string|max_length[255]',
        'partition_master_bedroom' => 'permit_empty|string|max_length[255]',
        'partition_bedroom' => 'permit_empty|string|max_length[255]',
        'partition_bathroom' => 'permit_empty|string|max_length[255]',
        'partition_maid_room' => 'permit_empty|string|max_length[255]',
        'partition_reception_balcony' => 'permit_empty|string|max_length[255]',
        'partition_sitting_corner' => 'permit_empty|string|max_length[255]',
        'partition_balconies' => 'permit_empty|string|max_length[255]',
        'partition_parking' => 'permit_empty|string|max_length[255]',
        'partition_storage_room' => 'permit_empty|string|max_length[255]',
    ];
    protected $validationMessages   = [
        'partition_id' => [],
        'apartment_id' => [
            'required' => 'Apartment ID is required',
            'integer' => 'Apartment ID must be an integer'
        ],
        'partition_salon' => [
            'string' => 'Salon must be a string',
            'max_length' => 'Salon must not exceed 255 characters'
        ],
        'partition_dining' => [
            'string' => 'Dining must be a string',
            'max_length' => 'Dining must not exceed 255 characters'
        ],
        'partition_kitchen' => [
            'string' => 'Kitchen must be a string',
            'max_length' => 'Kitchen must not exceed 255 characters'
            
        ],
        'partition_master_bedroom' => [
            'string' => 'Master Bedroom must be a string',
            'max_length' => 'Master Bedroom must not exceed 255 characters'
        ],
        'partition_bedroom' => [
            'string' => 'Bedroom must be a string',
            'max_length' => 'Bedroom must not exceed 255 characters'
        ],
        'partition_bathroom' => [
            'string' => 'Bathroom must be a string',
            'max_length' => 'Bathroom must not exceed 255 characters'
        ],
        'partition_maid_room' => [
            'string' => 'Maid Room must be a string',
            'max_length' => 'Maid Room must not exceed 255 characters'
        ],
        'partition_reception_balcony' => [
            'string' => 'Reception Balcony must be a string',
            'max_length' => 'Reception Balcony must not exceed 255 characters'
        ],
        'partition_sitting_corner' => [
            'string' => 'Sitting Corner must be a string',
            'max_length' => 'Sitting Corner must not exceed 255 characters'
        ],
        'partition_balconies' => [
            'string' => 'Balconies must be a string',
            'max_length' => 'Balconies must not exceed 255 characters'
        ],
        'partition_parking' => [
            'string' => 'Parking must be a string',
            'max_length' => 'Parking must not exceed 255 characters'
        ],
        'partition_storage_room' => [
            'string' => 'Storage Room must be a string',
            'max_length' => 'Storage Room must not exceed 255 characters'
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
