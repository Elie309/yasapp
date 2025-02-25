<?php

namespace App\Controllers\Uploads;

namespace App\Services;

use App\Models\Uploads\PropertyUploadsModel;
use App\Entities\Uploads\PropertyUploadsEntity;
use App\Models\Listings\PropertyModel;

class PropertyUploadServices
{
    protected $propertyUploadsModel;

    public function __construct()
    {
        $this->propertyUploadsModel = new PropertyUploadsModel();
    }

    public function create(array $data)
    {
        $entity = new PropertyUploadsEntity($data);
        return $this->propertyUploadsModel->save($entity);
    }

    public function read(int $id)
    {
        return $this->propertyUploadsModel->find($id);
    }

    public function update(int $id, array $data)
    {
        $entity = new PropertyUploadsEntity($data);
        return $this->propertyUploadsModel->update($id, $entity);
    }

    public function delete(int $id)
    {
        return $this->propertyUploadsModel->delete($id);
    }

    public function getAll()
    {
        return $this->propertyUploadsModel->findAll();
    }

    //Get by property id
    public function getByPropertyId(int $property_id)
    {
        return $this->propertyUploadsModel->where('property_id', $property_id)->findAll();
    }

    public function verifyEmployeeForProperty(int $property_id, int $employee_id): bool
    {
        $propertyModel = new PropertyModel();

        $property = $propertyModel->where('property_id', $property_id)
            ->where('employee_id', $employee_id)
            ->first();
        return $property !== null;
    }
}
