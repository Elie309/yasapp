<?php

namespace App\Entities\Listings\Attributes;

use CodeIgniter\Entity\Entity;

class ApartmentGenderEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}