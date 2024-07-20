<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EmployeeEntity::class;

    protected $allowedFields    = ["employee_name", "employee_password", "employee_role", 
            'employee_email', 'employee_phone', 'employee_birthday' , 'employee_address', 'employee_status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

     // Validation
     protected $validationRules      = [
        'employee_id' => 'permit_empty|numeric',
        'employee_name' => 'required|string|max_length[100]',
        'employee_password' => 'required',
        'employee_role' => 'required|in_list[admin,manager,user]',
        'employee_email' => 'valid_email|is_unique[employees.employee_email,employee_id,{employee_id}]',
        'employee_phone' => 'numeric|is_unique[employees.employee_phone,employee_id,{employee_id}]',
        'employee_birthday' => 'permit_empty|valid_date',
        'employee_address' => 'permit_empty|string',
        'employee_status' => 'required|in_list[active,inactive]',
    ];
    protected $validationMessages   = [
        'employee_id' => [
            'numeric' => 'Employee ID must be a number.',
        ],
        'employee_name' => [
            'required' => 'Employee name is required.',
            'string' => 'Employee name must be a string.',
            'max_length' => 'Employee name cannot exceed 100 characters.',
        ],
        'employee_password' => [
            'required' => 'Employee password is required.',
            'min_length' => 'Employee password must be at least 5 characters long.',
        ],
        'employee_role' => [
            'required' => 'Employee role is required.',
            'in_list' => 'Employee role must be one of: admin, manager, or user.',
        ],
        'employee_email' => [
            'valid_email' => 'Employee email must be a valid email address.',
            'is_unique' => 'Employee email must be unique.',
        ],
        'employee_phone' => [
            'numeric' => 'Employee phone must be a number.',
            'is_unique' => 'Employee phone must be unique.',
        ],
        'employee_birthday' => [
            'valid_date' => 'Employee birthday must be a valid date.',
        ],
        'employee_address' => [
            'string' => 'Employee address must be a string.',
        ],
        'employee_status' => [
            'required' => 'Employee status is required.',
            'in_list' => 'Employee status must be one of: active or inactive.',
        ],
    ];

}
