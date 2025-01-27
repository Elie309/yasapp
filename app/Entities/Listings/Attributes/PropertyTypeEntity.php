<?php

namespace App\Entities\Listings\Attributes;

use App\Models\Listings\Attributes\PropertyTypeModel;
use CodeIgniter\Entity\Entity;

class PropertyTypeEntity extends Entity
{
    protected $datamap = [];

    protected $casts   = [
        'property_type_id' => 'integer',
        'property_type_name' => 'string',
    ];

    public function getPropertyTypes(){

        //Get all property types
        $propertyTypesModel = new PropertyTypeModel();
        $propertyTypes = $propertyTypesModel->findAll();

        $propertyTypes = array_map(function ($propertyType) {
            return [
                'id' => $propertyType->property_type_id,
                'name' => $propertyType->property_type_name
            ];
        }, $propertyTypes);

        return $propertyTypes;
    }
}
