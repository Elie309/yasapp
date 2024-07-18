<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EmployeeEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'employee_id' => 'int',
        'employee_name' => 'string',
        'employee_email' => 'string',
        'employee_password' => 'string',
        'employee_role' => 'string',
        'employee_phone' => 'string',
        'employee_address' => 'string',
        'employee_birthday' => 'string',
        'employee_status' => 'string',
    ];

    public function setPassword(string $pass)
    {
        $this->attributes['employee_password'] = password_hash($pass, PASSWORD_BCRYPT);

        return $this;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->attributes['employee_password']);
    }
}
