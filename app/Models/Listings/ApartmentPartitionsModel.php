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
        'partition_id',
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
        'partition_storage_room'
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
        'partition_id' => 'required|integer',
        'apartment_id' => 'required|integer',
        'partition_salon' => 'string',
        'partition_dining' => 'string',
        'partition_kitchen' => 'string',
        'partition_master_bedroom' => 'string',
        'partition_bedroom' => 'string',
        'partition_bathroom' => 'string',
        'partition_maid_room' => 'string',
        'partition_reception_balcony' => 'string',
        'partition_sitting_corner' => 'string',
        'partition_balconies' => 'string',
        'partition_parking' => 'string',
        'partition_storage_room' => 'string'
    ];
    protected $validationMessages   = [
        'partition_id' => [
            'required' => 'Partition ID is required',
            'integer' => 'Partition ID must be an integer'
        ],
        'apartment_id' => [
            'required' => 'Apartment ID is required',
            'integer' => 'Apartment ID must be an integer'
        ],
        'partition_salon' => [
            'string' => 'Salon must be a string'
        ],
        'partition_dining' => [
            'string' => 'Dining must be a string'
        ],
        'partition_kitchen' => [
            'string' => 'Kitchen must be a string'
        ],
        'partition_master_bedroom' => [
            'string' => 'Master Bedroom must be a string'
        ],
        'partition_bedroom' => [
            'string' => 'Bedroom must be a string'
        ],
        'partition_bathroom' => [
            'string' => 'Bathroom must be a string'
        ],
        'partition_maid_room' => [
            'string' => 'Maid Room must be a string'
        ],
        'partition_reception_balcony' => [
            'string' => 'Reception Balcony must be a string'
        ],
        'partition_sitting_corner' => [
            'string' => 'Sitting Corner must be a string'
        ],
        'partition_balconies' => [
            'string' => 'Balconies must be a string'
        ],
        'partition_parking' => [
            'string' => 'Parking must be a string'
        ],
        'partition_storage_room' => [
            'string' => 'Storage Room must be a string'
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
