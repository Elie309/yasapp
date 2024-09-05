<?php

namespace App\Models\Listings;

use CodeIgniter\Model;

/*
CREATE TABLE apartment_specifications (
    spec_id INT AUTO_INCREMENT PRIMARY KEY,

    apartment_id INT UNSIGNED NOT NULL UNIQUE,

    spec_heating_system BOOLEAN DEFAULT FALSE,
    spec_heating_system_on_provisions BOOLEAN DEFAULT FALSE,
    spec_ac_system BOOLEAN DEFAULT FALSE,
    spec_ac_system_on_provisions BOOLEAN DEFAULT FALSE,
    spec_double_wall BOOLEAN DEFAULT FALSE,
    spec_double_glazing BOOLEAN DEFAULT FALSE,
    spec_shutters_electrical BOOLEAN DEFAULT FALSE,
    spec_tiles ENUM('european', 'marble', 'granite', 'other') DEFAULT 'other',
    spec_oak_doors BOOLEAN DEFAULT FALSE,
    spec_chimney BOOLEAN DEFAULT FALSE,
    spec_indirect_light BOOLEAN DEFAULT FALSE,
    spec_wood_panel_decoration BOOLEAN DEFAULT FALSE,
    spec_stone_panel_decoration BOOLEAN DEFAULT FALSE,
    spec_security_door BOOLEAN DEFAULT FALSE,
    spec_alarm_system BOOLEAN DEFAULT FALSE,
    spec_solar_heater BOOLEAN DEFAULT FALSE,
    spec_intercom BOOLEAN DEFAULT FALSE,
    spec_garage BOOLEAN DEFAULT FALSE,
    spec_extra_features TEXT,
    

    FOREIGN KEY (apartment_id) REFERENCES apartment_details(apartment_id)
);

*/

class ApartmentSpecificationsModel extends Model
{
    protected $table            = 'apartment_specifications';
    protected $primaryKey       = 'spec_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\ApartmentSpecificationsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'spec_id',
        'apartment_id',
        'spec_heating_system',
        'spec_heating_system_on_provisions',
        'spec_ac_system',
        'spec_ac_system_on_provisions',
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
        'spec_extra_features'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'spec_id' => 'integer',
        'apartment_id' => 'integer',
        'spec_heating_system' => 'boolean',
        'spec_heating_system_on_provisions' => 'boolean',
        'spec_ac_system' => 'boolean',
        'spec_ac_system_on_provisions' => 'boolean',
        'spec_double_wall' => 'boolean',
        'spec_double_glazing' => 'boolean',
        'spec_shutters_electrical' => 'boolean',
        'spec_oak_doors' => 'boolean',
        'spec_chimney' => 'boolean',
        'spec_indirect_light' => 'boolean',
        'spec_wood_panel_decoration' => 'boolean',
        'spec_stone_panel_decoration' => 'boolean',
        'spec_security_door' => 'boolean',
        'spec_alarm_system' => 'boolean',
        'spec_solar_heater' => 'boolean',
        'spec_intercom' => 'boolean',
        'spec_garage' => 'boolean'

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
        'spec_id' => 'required|integer',
        'apartment_id' => 'required|integer',
        'spec_heating_system' => 'boolean',
        'spec_heating_system_on_provisions' => 'boolean',
        'spec_ac_system' => 'boolean',
        'spec_ac_system_on_provisions' => 'boolean',
        'spec_double_wall' => 'boolean',
        'spec_double_glazing' => 'boolean',
        'spec_shutters_electrical' => 'boolean',
        'spec_tiles' => 'in_list[european,marble,granite,other]',
        'spec_oak_doors' => 'boolean',
        'spec_chimney' => 'boolean',
        'spec_indirect_light' => 'boolean',
        'spec_wood_panel_decoration' => 'boolean',
        'spec_stone_panel_decoration' => 'boolean',
        'spec_security_door' => 'boolean',
        'spec_alarm_system' => 'boolean',
        'spec_solar_heater' => 'boolean',
        'spec_intercom' => 'boolean',
        'spec_garage' => 'boolean',
        'spec_extra_features' => 'string'
    ];
    protected $validationMessages   = [
        'spec_id' => [
            'required' => 'Specification ID is required',
            'integer' => 'Specification ID must be an integer'
        ],
        'apartment_id' => [
            'required' => 'Apartment ID is required',
            'integer' => 'Apartment ID must be an integer'
        ],
        'spec_heating_system' => [
            'boolean' => 'Heating system must be a boolean value'
        ],
        'spec_heating_system_on_provisions' => [
            'boolean' => 'Heating system on provisions must be a boolean value'
        ],
        'spec_ac_system' => [
            'boolean' => 'AC system must be a boolean value'
        ],
        'spec_ac_system_on_provisions' => [
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
            'in_list' => 'Tiles must be one of: european, marble, granite, other'
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
        'spec_extra_features' => [
            'string' => 'Extra features must be a string'
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
