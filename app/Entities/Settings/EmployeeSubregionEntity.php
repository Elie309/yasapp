<?php

namespace App\Entities\Settings;

use CodeIgniter\Entity\Entity;

class EmployeeSubregionEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $attributes = [
        'employee_id' => null,
        'subregion_id' => null,
    ];

    protected $casts = [
        'employee_subregions_id' => 'int',
        'employee_id' => 'int',
        'subregion_id' => 'int',
    ];
}
