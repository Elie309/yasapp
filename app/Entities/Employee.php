<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);

        return $this;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->attributes['password']);
    }
}
