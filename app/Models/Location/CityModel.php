<?php

namespace App\Models\Location;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table            = 'cities';
    protected $primaryKey       = 'city_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['city_id','subregion_id', 'city_name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation
    protected $validationRules      = [
        'subregion_id' => 'required|integer',
        'city_name' => 'required|string|max_length[255]',
    ];
    protected $validationMessages   = [
        'subregion_id' => [
            'required' => 'Subregion ID is required.',
            'integer' => 'Subregion ID must be an integer.',
        ],
        'city_name' => [
            'required' => 'City name is required.',
            'string' => 'City name must be a string.',
            'max_length' => 'City name cannot exceed 255 characters.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
