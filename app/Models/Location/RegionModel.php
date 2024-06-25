<?php

namespace App\Models\Location;

use CodeIgniter\Model;

class RegionModel extends Model
{
    protected $table            = 'regions';
    protected $primaryKey       = 'region_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Location\RegionEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'country_id','region_name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Validation
    protected $validationRules      = [
        'country_id' => 'required|integer',
        'region_name' => 'required|string|max_length[255]|is_unique[regions.region_name]',
    ];
    protected $validationMessages   = [
        'country_id' => [
            'required' => 'country ID is required.',
            'integer' => 'country ID must be an integer.',
        ],
        'region_name' => [
            'required' => 'region name is required.',
            'string' => 'region name must be a string.',
            'max_length' => 'region name cannot exceed 255 characters.',
            'is_unique' => 'region name should be unique'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
