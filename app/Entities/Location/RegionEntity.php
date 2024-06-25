<?php

namespace App\Entities\Location;

use CodeIgniter\Entity\Entity;

class RegionEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'region_id' => 'integer',
        'country_id' => 'integer',
        'region_name' => 'string',
    ];

    public function getSubregions()
    {
        $subregionModel = new \App\Models\Location\SubregionModel();
        return $subregionModel->where('region_id', $this->region_id)->findAll();
    }
}
