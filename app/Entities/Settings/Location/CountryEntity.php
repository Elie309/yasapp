<?php

namespace App\Entities\Settings\Location;

use CodeIgniter\Entity\Entity;

class CountryEntity extends Entity
{
    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'country_id' => 'integer',
        'country_code' => 'string',
        'country_name' => 'string',
    ];

    public function getRegions()
    {
        $regionModel = new \App\Models\Settings\Location\RegionModel();
        return $regionModel->where('country_id', $this->country_id)->findAll();
    }
}
