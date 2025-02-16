<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class EmployeeSubregionModel extends Model
{
    protected $table            = 'employee_subregions';
    protected $primaryKey       = 'employee_subregions_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Settings\EmployeeSubregionEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['employee_id', 'subregion_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Validation
    protected $validationRules      = [
        'employee_id' => 'required|integer',
        'subregion_id' => 'required|integer',
    ];
    protected $validationMessages   = [
        'employee_id' => [
            'required' => 'Employee ID is required.',
            'integer' => 'Employee ID must be an integer.',
        ],
        'subregion_id' => [
            'required' => 'Subregion ID is required.',
            'integer' => 'Subregion ID must be an integer.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
