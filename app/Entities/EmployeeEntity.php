<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

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

    public function __get($name)
{
    if ($name === 'created_at' || $name === 'updated_at') {
        $time = new Time($this->attributes[$name]);
        return $time->setTimezone('Asia/Beirut')->format('Y-m-d H:i:s');
    }

    // Change format a birthday
    if ($name === 'employee_birthday') {
        $time = new Time($this->attributes[$name]);
        return $time->setTimezone('Asia/Beirut')->format('d-m-Y');
    }

    return parent::__get($name);
}


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
