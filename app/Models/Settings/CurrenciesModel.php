<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class CurrenciesModel extends Model
{
    protected $table            = 'Currencies';
    protected $primaryKey       = 'currency_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Settings\CurrenciesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['currency_id', 'currency_code', 'currency_name', 'currency_symbol'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Validation
    
    protected $validationRules = [
        'currency_code' => 'required|alpha|exact_length[3]|is_unique[Currencies.currency_code,currency_id,{currency_id}]',
        'currency_name' => 'required|string|max_length[255]|is_unique[Currencies.currency_name,currency_id,{currency_id}]',
        'currency_symbol' => 'required|string|max_length[10]|is_unique[Currencies.currency_symbol,currency_id,{currency_id}]',
    ];
    
    protected $validationMessages = [
        'currency_code' => [
            'required' => 'The Currency Code is required.',
            'alpha' => 'The Currency Code must only contain alphabetical characters.',
            'exact_length' => 'The Currency Code must be exactly 3 characters long.',
            'is_unique' => 'The Currency Code must be unique.',
        ],
        'currency_name' => [
            'required' => 'The Currency Name is required.',
            'string' => 'The Currency Name must be a valid string.',
            'max_length' => 'The Currency Name cannot exceed 255 characters.',
            'is_unique' => 'The Currency name must be unique.',

        ],
        'currency_symbol' => [
            'required' => 'The Currency Symbol is required.',
            'string' => 'The Currency Symbol must be a valid string.',
            'max_length' => 'The Currency Symbol cannot exceed 10 characters.',
            'is_unique' => 'The Currency Symbol must be unique.',

        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
