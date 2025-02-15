<?php

namespace App\Entities\Settings;

use CodeIgniter\Entity\Entity;

class EmployeeSubregionEntity extends Entity
{
    protected $attributes = [
        'employee_id' => null,
        'subregion_id' => null,
    ];

    protected $casts = [
        'employee_id' => 'integer',
        'subregion_id' => 'integer',
    ];
}
