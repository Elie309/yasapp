<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentDetailsEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}