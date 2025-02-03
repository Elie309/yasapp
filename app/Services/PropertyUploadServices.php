<?php 

namespace App\Controllers\Uploads;

namespace App\Services;

use App\Models\Uploads\PropertyUploadsModel;
use App\Entities\Uploads\PropertyUploadsEntity;

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
        return $this->propertyUploadsModel->insert($entity);
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
}

