<?php

namespace App\Entities\Clients;

use CodeIgniter\Entity\Entity;

class ClientEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'client_id' => 'int',
        'employee_id' => 'int',
        'client_firstname' => 'string',
        'client_lastname' => 'string',
        'client_email' => 'string',
        'client_visibility' => 'string',
    ];

    public function getFullName(): string
    {
        return $this->client_firstname . ' ' . $this->client_lastname;
    }
    
}
