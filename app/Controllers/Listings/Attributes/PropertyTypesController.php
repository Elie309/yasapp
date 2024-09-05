<?php

namespace App\Controllers\Listings\Attributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\PropertyTypesModel;
use \App\Entities\Listings\Attributes\PropertyTypesEntity;

class PropertyTypesController extends BaseController
{
    public function getAll()
    {
        $propertyTypesModel = new PropertyTypesModel();
        $data = $propertyTypesModel->findAll();
        return $this->response->setJSON($data);
    }

    public function get($id)
    {
        $propertyTypesModel = new PropertyTypesModel();
        $data = $propertyTypesModel->find($id);
        return $this->response->setJSON($data);
    }

    public function save()
    {
        $propertyTypesModel = new PropertyTypesModel();
        $propertyTypesEntity = new PropertyTypesEntity();
        $propertyTypesEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($propertyTypesModel->save($propertyTypesEntity)) {
            return redirect()->back()->with('success', 'Property Type saved successfully');
        } else {
            return redirect()->back()->with('errors', $propertyTypesModel->errors());
        }
    }

    public function update($id)
    {
        $propertyTypesModel = new PropertyTypesModel();
        $propertyTypesEntity = new PropertyTypesEntity();
        $propertyTypesEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', ['You are not authorized to update this record']);
        }

        if($propertyTypesModel->find($id) === null) {
            return redirect()->back()->with('errors', ['Record not found']);
        }

        if ($propertyTypesModel->update($id, $propertyTypesEntity)) {
            return redirect()->back()->with('success', 'Property Type updated successfully');
        } else {
            return redirect()->back()->with('errors', $propertyTypesModel->errors());
        }
    }

    public function delete($id)
    {
        $propertyTypesModel = new PropertyTypesModel();

        if($this->session->get('role') != 'admin') {
            return redirect()->back()->with('errors', 'You are not authorized to delete this record');
        }

        if($propertyTypesModel->find($id) === null) {
            return redirect()->back()->with('errors', ['Record not found']);
        }

        if ($propertyTypesModel->delete($id)) {
            return redirect()->back()->with('success', 'Property Type deleted successfully');
        } else {
            return redirect()->back()->with('errors', $propertyTypesModel->errors());
        }
    }
}
