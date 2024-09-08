<?php

namespace App\Controllers\Settings\ListingsAttributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\PropertyTypeModel;
use \App\Entities\Listings\Attributes\PropertyTypeEntity;
use CodeIgniter\Database\Exceptions\DatabaseException;

class PropertyTypesController extends BaseController
{

    public function save()
    {
        $propertyTypeModel = new PropertyTypeModel();
        $propertyTypeEntity = new PropertyTypeEntity();
        $propertyTypeEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($propertyTypeModel->save($propertyTypeEntity)) {
            return redirect()->back()->with('success', 'Property Type saved successfully');
        } else {
            return redirect()->back()->with('errors', $propertyTypeModel->errors());
        }
    }

    public function update()
    {
        $propertyTypeModel = new PropertyTypeModel();
        $propertyTypeEntity = new PropertyTypeEntity();
        $propertyTypeEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', ['You are not authorized to update this record']);
        }

        $id = esc($propertyTypeEntity->property_type_id);


        if ($propertyTypeModel->find($id) === null) {
            return redirect()->back()->with('errors', ['Record not found']);
        }

        if ($propertyTypeModel->update($id, $propertyTypeEntity)) {
            return redirect()->back()->with('success', 'Property Type updated successfully');
        } else {
            return redirect()->back()->with('errors', $propertyTypeModel->errors());
        }
    }

    public function delete()
    {
        try {
            $propertyTypeModel = new PropertyTypeModel();

            if ($this->session->get('role') != 'admin') {
                return redirect()->back()->with('errors', 'You are not authorized to delete this record');
            }

            $id = esc($this->request->getPost('property_type_id'));

            if ($propertyTypeModel->find($id) === null) {
                return redirect()->back()->with('errors', ['Record not found']);
            }

            if ($propertyTypeModel->delete($id)) {
                return redirect()->back()->with('success', 'Property Type deleted successfully');
            } else {
                return redirect()->back()->with('errors', $propertyTypeModel->errors());
            }
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Property Type cannot be deleted']);
        }
    }
}
