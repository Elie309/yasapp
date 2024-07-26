<?php

namespace App\Models\Clients;

use CodeIgniter\Model;
use Config\App;

class ClientModel extends Model
{
    protected $table            = 'clients';
    protected $primaryKey       = 'client_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Clients\ClientEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['client_id', 'client_firstname', 'client_lastname', 'client_email', 'client_visibility', 'employee_id', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'client_firstname' => 'required|string|max_length[255]',
        'client_lastname' => 'required|string|max_length[255]',
        'client_email' => 'valid_email',
        'client_visibility' => 'required|in_list[public,private]',
        'employee_id' => 'required|is_natural_no_zero',
    ];
    protected $validationMessages   = [
        'client_firstname' => [
            'required' => 'The client first name is required.',
            'string' => 'The client first name must be a valid string.',
            'max_length' => 'The client first name cannot exceed 255 characters.',
        ],
        'client_lastname' => [
            'required' => 'The client last name is required.',
            'string' => 'The client last name must be a valid string.',
            'max_length' => 'The client last name cannot exceed 255 characters.',
        ],
        'client_email' => [
            'valid_email' => 'The client email must be a valid email address.',
        ],
        'client_visibility' => [
            'required' => 'The client visibility is required.',
            'in_list' => 'The client visibility must be either public or private.',
        ],
        'employee_id' => [
            'required' => 'The employee id is required.',
            'is_natural_no_zero' => 'The employee id must be a natural number greater than zero.',
        ],
    ];


    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
