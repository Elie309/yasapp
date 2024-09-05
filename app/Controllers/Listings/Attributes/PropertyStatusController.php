<?php

namespace App\Controllers\Listings\Attributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\PropertyStatusModel;
use \App\Entities\Listings\Attributes\PropertyStatusEntity;

class PropertyStatusController extends BaseController
{
    public function getAll()
    {
        $propertyStatusModel = new PropertyStatusModel();
        $data = $propertyStatusModel->findAll();
        return $this->response->setJSON($data);
    }

    public function get($id)
    {
        $propertyStatusModel = new PropertyStatusModel();
        $data = $propertyStatusModel->find($id);
        return $this->response->setJSON($data);
    }

    public function save()
    {
        $propertyStatusModel = new PropertyStatusModel();
        $propertyStatusEntity = new PropertyStatusEntity();
        $propertyStatusEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($propertyStatusModel->save($propertyStatusEntity)) {
            return redirect()->back()->with('success', 'Property Status saved successfully');
        } else {
            return redirect()->back()->with('errors', $propertyStatusModel->errors());
        }
    }

    public function update($id)
    {
        $propertyStatusModel = new PropertyStatusModel();
        $propertyStatusEntity = new PropertyStatusEntity();

        $propertyStatusEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to update this record');
        }

        if($propertyStatusModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if ($propertyStatusModel->update($id, $propertyStatusEntity)) {
            return redirect()->back()->with('success', 'Property Status updated successfully');
        } else {
            return redirect()->back()->with('errors', $propertyStatusModel->errors());
        }

    }

    public function delete($id)
    {
        $propertyStatusModel = new PropertyStatusModel();

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to delete this record');
        }

        if($propertyStatusModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if ($propertyStatusModel->delete($id)) {
            return redirect()->back()->with('success', 'Property Status deleted successfully');
        } else {
            return redirect()->back()->with('errors', $propertyStatusModel->errors());
        }
    }

}
