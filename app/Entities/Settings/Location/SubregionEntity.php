<?php

namespace App\Entities\Settings\Location;

use CodeIgniter\Entity\Entity;

class SubregionEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'subregion_id' => 'integer',
        'region_id' => 'integer',
        'subregion_name' => 'string',
    ];

    public function getCities()
    {
        $cityModel = new \App\Models\Settings\Location\CityModel();
        return $cityModel->where('subregion_id', $this->subregion_id)->findAll();
    }
}
