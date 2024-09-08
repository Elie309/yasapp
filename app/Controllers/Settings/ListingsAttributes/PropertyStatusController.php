<?php

namespace App\Controllers\Settings\ListingsAttributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\PropertyStatusModel;
use \App\Entities\Listings\Attributes\PropertyStatusEntity;
use CodeIgniter\Database\Exceptions\DatabaseException;

class PropertyStatusController extends BaseController
{

    public function save()
    {
        $propertyStatusModel = new PropertyStatusModel();
        $propertyStatusEntity = new PropertyStatusEntity();
        $propertyStatusEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($propertyStatusModel->save($propertyStatusEntity)) {
            return redirect()->back()->with('success', 'Property Status saved successfully');
        } else {
            return redirect()->back()->with('errors', $propertyStatusModel->errors());
        }
    }

    public function update()
    {
        $propertyStatusModel = new PropertyStatusModel();
        $propertyStatusEntity = new PropertyStatusEntity();

        $propertyStatusEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to update this record');
        }

        $id = esc($propertyStatusEntity->property_status_id);
        if ($propertyStatusModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if ($propertyStatusModel->update($id, $propertyStatusEntity)) {
            return redirect()->back()->with('success', 'Property Status updated successfully');
        } else {
            return redirect()->back()->with('errors', $propertyStatusModel->errors());
        }
    }

    public function delete()
    {
        try {


            $propertyStatusModel = new PropertyStatusModel();

            if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
                return redirect()->back()->with('errors', 'You are not authorized to delete this record');
            }

            $id = esc($this->request->getPost('property_status_id'));

            if ($propertyStatusModel->find($id) === null) {
                return redirect()->back()->with('errors', 'Record not found');
            }

            if ($propertyStatusModel->delete($id)) {
                return redirect()->back()->with('success', 'Property Status deleted successfully');
            } else {
                return redirect()->back()->with('errors', $propertyStatusModel->errors());
            }
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Property status cannot be deleted']);
        }
    }
}
