<?php

namespace App\Entities\Listings\Attributes;

use App\Models\Listings\Attributes\ApartmentTypeModel;
use CodeIgniter\Entity\Entity;

class ApartmentTypeEntity extends Entity
{
    protected $datamap = [];

    protected $casts   = [
        'apartment_type_id' => 'integer',
        'apartment_type_name' => 'string',
    ];

    public function getApartmentTypes(){

        //Get all apartment types
        $apartmentTypesModel = new ApartmentTypeModel();
        $apartmentTypes = $apartmentTypesModel->findAll();

        $apartmentTypes = array_map(function ($apartmentType) {
            return [
                'id' => $apartmentType->apartment_type_id,
                'name' => $apartmentType->apartment_type_name
            ];
        }, $apartmentTypes);

        return $apartmentTypes;
    }
}
