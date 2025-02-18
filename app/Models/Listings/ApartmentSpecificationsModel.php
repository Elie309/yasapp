<?php

namespace App\Models\Listings;

use CodeIgniter\Model;

class ApartmentSpecificationsModel extends Model
{
    protected $table            = 'apartment_specifications';
    protected $primaryKey       = 'spec_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\ApartmentSpecificationsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'apartment_id',
        'spec_heating_system',
        'spec_heating_system_provision',
        'spec_ac_system',
        'spec_ac_system_provision',
        'spec_double_wall',
        'spec_double_glazing',
        'spec_shutters_electrical',
        'spec_tiles',
        'spec_oak_doors',
        'spec_chimney',
        'spec_indirect_light',
        'spec_wood_panel_decoration',
        'spec_stone_panel_decoration',
        'spec_security_door',
        'spec_alarm_system',
        'spec_solar_heater',
        'spec_intercom',
        'spec_garage',
        'specs_jacuzzi',
        'spec_swimming_pool' ,
        'spec_gym' ,
        'spec_kitchenette' ,
        'spec_driver_room',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'spec_id' => 'integer',
        'apartment_id' => 'integer',

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
        'spec_id' => 'permit_empty',
        'apartment_id' => 'required|integer',
        'spec_heating_system' => 'permit_empty|boolean',
        'spec_heating_system_provision' => 'permit_empty|boolean',
        'spec_ac_system' => 'permit_empty|boolean',
        'spec_ac_system_provision' => 'permit_empty|boolean',
        'spec_double_wall' => 'permit_empty|boolean',
        'spec_double_glazing' => 'permit_empty|boolean',
        'spec_shutters_electrical' => 'permit_empty|boolean',
        'spec_tiles' => 'permit_empty|string|max_length[255]',
        'spec_oak_doors' => 'permit_empty|boolean',
        'spec_chimney' => 'permit_empty|boolean',
        'spec_indirect_light' => 'permit_empty|boolean',
        'spec_wood_panel_decoration' => 'permit_empty|boolean',
        'spec_stone_panel_decoration' => 'permit_empty|boolean',
        'spec_security_door' => 'permit_empty|boolean',
        'spec_alarm_system' => 'permit_empty|boolean',
        'spec_solar_heater' => 'permit_empty|boolean',
        'spec_intercom' => 'permit_empty|boolean',
        'spec_garage' => 'permit_empty|boolean',
        'specs_jacuzzi' => 'permit_empty|boolean',
        'spec_swimming_pool' => 'permit_empty|boolean',
        'spec_gym' => 'permit_empty|boolean',
        'spec_kitchenette' => 'permit_empty|boolean',
        'spec_driver_room' => 'permit_empty|boolean',
    ];
    protected $validationMessages   = [
        'spec_id' => [],
        'apartment_id' => [
            'required' => 'Apartment ID is required',
            'integer' => 'Apartment ID must be an integer'
        ],
        'spec_heating_system' => [
            'boolean' => 'Heating system must be a boolean value'
        ],
        'spec_heating_system_provision' => [
            'boolean' => 'Heating system on provisions must be a boolean value'
        ],
        'spec_ac_system' => [
            'boolean' => 'AC system must be a boolean value'
        ],
        'spec_ac_system_provision' => [
            'boolean' => 'AC system on provisions must be a boolean value'
        ],
        'spec_double_wall' => [
            'boolean' => 'Double wall must be a boolean value'
        ],
        'spec_double_glazing' => [
            'boolean' => 'Double glazing must be a boolean value'
        ],
        'spec_shutters_electrical' => [
            'boolean' => 'Shutters electrical must be a boolean value'
        ],
        'spec_tiles' => [
            'string' => 'Tiles must be a string',
            'max_length' => 'Tiles must not exceed 255 characters'
        ],
        'spec_oak_doors' => [
            'boolean' => 'Oak doors must be a boolean value'
        ],
        'spec_chimney' => [
            'boolean' => 'Chimney must be a boolean value'
        ],
        'spec_indirect_light' => [
            'boolean' => 'Indirect light must be a boolean value'
        ],
        'spec_wood_panel_decoration' => [
            'boolean' => 'Wood panel decoration must be a boolean value'
        ],
        'spec_stone_panel_decoration' => [
            'boolean' => 'Stone panel decoration must be a boolean value'
        ],
        'spec_security_door' => [
            'boolean' => 'Security door must be a boolean value'
        ],
        'spec_alarm_system' => [
            'boolean' => 'Alarm system must be a boolean value'
        ],
        'spec_solar_heater' => [
            'boolean' => 'Solar heater must be a boolean value'
        ],
        'spec_intercom' => [
            'boolean' => 'Intercom must be a boolean value'
        ],
        'spec_garage' => [
            'boolean' => 'Garage must be a boolean value'
        ],
        'specs_jacuzzi' => [
            'boolean' => 'Jacuzzi must be a boolean value'
        ],
        'spec_swimming_pool' => [
            'boolean' => 'Swimming pool must be a boolean value'
        ],
        'spec_gym' => [
            'boolean' => 'Gym must be a boolean value'
        ],
        'spec_kitchenette' => [
            'boolean' => 'Kitchenette must be a boolean value'
        ],
        'spec_driver_room' => [
            'boolean' => 'Driver room must be a boolean value'
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
