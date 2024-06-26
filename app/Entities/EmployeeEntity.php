<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EmployeeEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

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
