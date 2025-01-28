<?php

namespace App\Controllers\Settings\ListingsAttributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\ApartmentTypeModel;
use \App\Entities\Listings\Attributes\ApartmentTypeEntity;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ApartmentTypeController extends BaseController
{

    public function save()
    {
        $apartmentTypeModel = new ApartmentTypeModel();
        $apartmentTypeEntity = new ApartmentTypeEntity();
        $apartmentTypeEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($apartmentTypeModel->save($apartmentTypeEntity)) {
            return redirect()->back()->with('success', 'Apartment Type saved successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentTypeModel->errors());
        }
    }

    public function update()
    {
        $apartmentTypeModel = new ApartmentTypeModel();
        $apartmentTypeEntity = new ApartmentTypeEntity();
        $apartmentTypeEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', ['You are not authorized to update this record']);
        }

        $id = esc($apartmentTypeEntity->apartment_type_id);


        if ($apartmentTypeModel->find($id) === null) {
            return redirect()->back()->with('errors', ['Record not found']);
        }

        if ($apartmentTypeModel->update($id, $apartmentTypeEntity)) {
            return redirect()->back()->with('success', 'Apartment Type updated successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentTypeModel->errors());
        }
    }

    public function delete()
    {
        try {
            $apartmentTypeModel = new ApartmentTypeModel();

            if ($this->session->get('role') != 'admin') {
                return redirect()->back()->with('errors', 'You are not authorized to delete this record');
            }

            $id = esc($this->request->getPost('apartment_type_id'));

            if ($apartmentTypeModel->find($id) === null) {
                return redirect()->back()->with('errors', ['Record not found']);
            }

            if ($apartmentTypeModel->delete($id)) {
                return redirect()->back()->with('success', 'Apartment Type deleted successfully');
            } else {
                return redirect()->back()->with('errors', $apartmentTypeModel->errors());
            }
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Apartment Type cannot be deleted']);
        }
    }
}
