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
    protected $allowedFields    = [ 'country_code', 'country_name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation
    protected $validationRules      = [
        'country_code' => 'required|regex_match[/^[+](\d{1,4})$/]|is_unique[countries.country_code]',
        'country_name' => 'required|string|max_length[255]|is_unique[countries.country_name]',
    ];

    protected $validationMessages   = [
        'country_code' => [
            'required' => 'Country code is required.',
            'regex_match' => "Country code should follow this format: +961",
            'is_unique' => 'The country code already exists.'
        ],
        'country_name' => [
            'required' => 'Country name is required.',
            'string' => 'Country name must be a string.',
            'max_length' => 'Country name cannot exceed 255 characters.',
            'is_unique' => 'The country name already exists.'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
