<?php

namespace App\Models\Location;

use CodeIgniter\Model;

class CountryModel extends Model
{
    protected $table            = 'countries';
    protected $primaryKey       = 'country_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Location\CountryEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['country_code', 'country_name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // protected array $casts = [
    //     'country_id' => 'integer',
    //     'country_code' => 'string',
    //     'country_name' => 'string',
    // ];

    // Validation
    protected $validationRules      = [
        'country_code' => 'required|regex_match[/^[+](\d{1,4})$/]',
        'country_name' => 'required|string|max_length[255]',
    ];
    protected $validationMessages   = [
        'country_code' => [
            'required' => 'Country code is required.',
            'regex_match' => "Country code should follow this format: +961",
        ],
        'country_name' => [
            'required' => 'Country name is required.',
            'string' => 'Country name must be a string.',
            'max_length' => 'Country name cannot exceed 255 characters.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
