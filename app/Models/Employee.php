<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Employee::class;

    protected $allowedFields    = ["employee_name", "employee_password", "employee_role"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
