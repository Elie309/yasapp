<?php

namespace App\Entities\Listings\Attributes;

use App\Models\Listings\Attributes\PropertyStatusModel;
use CodeIgniter\Entity\Entity;

class PropertyStatusEntity extends Entity
{
    protected $datamap = [];
    protected $casts   = [
        'property_status_id' => 'integer',
        'property_status_name' => 'string',
    ];

    public function getPropertyStatuses(){

        //Get all property statuses
        $propertyStatusesModel = new PropertyStatusModel();
        $propertyStatuses = $propertyStatusesModel->findAll();

        $propertyStatuses = array_map(function ($propertyStatus) {
            return [
                'id' => $propertyStatus->property_status_id,
                'name' => $propertyStatus->property_status_name
            ];
        }, $propertyStatuses);

        return $propertyStatuses;
    }
}
