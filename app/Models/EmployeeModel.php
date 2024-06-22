<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EmployeeEntity::class;

    protected $allowedFields    = ["employee_name", "employee_password", "employee_role"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

     // Validation
     protected $validationRules      = [
        'employee_name' => 'required|string|max_length[100]',
        'employee_password' => 'required|string|min_length[8]',
        'employee_role' => 'required|in_list[admin,manager,user]',
    ];
    protected $validationMessages   = [
        'employee_name' => [
            'required' => 'Employee name is required.',
            'string' => 'Employee name must be a string.',
            'max_length' => 'Employee name cannot exceed 100 characters.',
        ],
        'employee_password' => [
            'required' => 'Employee password is required.',
            'string' => 'Employee password must be a string.',
            'min_length' => 'Employee password must be at least 8 characters long.',
        ],
        'employee_role' => [
            'required' => 'Employee role is required.',
            'in_list' => 'Employee role must be one of: admin, manager, or user.',
        ],
    ];

}
