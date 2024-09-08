<?php

namespace App\Controllers\Settings\ListingsAttributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\ApartmentGenderModel;
use App\Entities\Listings\Attributes\ApartmentGenderEntity;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ApartmentGenderController extends BaseController
{

    public function save()
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $apartmentGenderEntity = new ApartmentGenderEntity();
        $apartmentGenderEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($apartmentGenderModel->save($apartmentGenderEntity)) {
            return redirect()->back()->with('success', 'Apartment gender saved successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentGenderModel->errors());
        }
    }

    public function update()
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $apartmentGenderEntity = new ApartmentGenderEntity();
        $apartmentGenderEntity->fill(esc($this->request->getPost()));

        if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to update this record');
        }

        $id = esc($apartmentGenderEntity->apartment_gender_id);

        if ($apartmentGenderModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if ($apartmentGenderModel->update($id, $apartmentGenderEntity)) {
            return redirect()->back()->with('success', 'Apartment gender updated successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentGenderModel->errors());
        }
    }

    public function delete()
    {
        try {

            $apartmentGenderModel = new ApartmentGenderModel();

            if (!in_array($this->session->get('role'), ['admin', 'manager'])) {
                return redirect()->back()->with('errors', 'You are not authorized to delete this record');
            }

            $id = esc($this->request->getPost('apartment_gender_id'));

            if ($apartmentGenderModel->find($id) === null) {
                return redirect()->back()->with('errors', 'Record not found');
            }

            if ($apartmentGenderModel->delete($id)) {
                return redirect()->back()->with('success', 'Apartment gender deleted successfully');
            } else {
                return redirect()->back()->with('errors', $apartmentGenderModel->errors());
            }
        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Apartment Gender cannot be deleted']);
        }
    }
}
