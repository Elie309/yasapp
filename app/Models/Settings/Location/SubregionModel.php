<?php

namespace App\Models\Settings\Location;

use CodeIgniter\Model;

class SubregionModel extends Model
{
    protected $table            = 'subregions';
    protected $primaryKey       = 'subregion_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Settings\Location\SubregionEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['region_id', 'subregion_name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    
    protected array $castHandlers = [];

    // Validation
    protected $validationRules      = [
        'region_id' => 'required|integer',
        'subregion_name' => 'required|string|max_length[255]|is_unique[subregions.subregion_name]',
    ];
    protected $validationMessages   = [
        'region_id' => [
            'required' => 'Region ID is required.',
            'integer' => 'Region ID must be an integer.',
        ],
        'subregion_name' => [
            'required' => 'Subregion name is required.',
            'string' => 'Subregion name must be a string.',
            'max_length' => 'Subregion name cannot exceed 255 characters.',
            'is_unique' => 'Subregion name should be unique'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
