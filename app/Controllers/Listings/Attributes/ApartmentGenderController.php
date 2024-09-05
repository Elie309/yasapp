<?php

namespace App\Controllers\Listings\Attributes;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\ApartmentGenderModel;
use App\Entities\Listings\Attributes\ApartmentGenderEntity;

class ApartmentGenderController extends BaseController
{

    public function getAll()
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $data = $apartmentGenderModel->findAll();
        return $this->response->setJSON($data);
    }

    public function get($id)
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $data = $apartmentGenderModel->find($id);
        return $this->response->setJSON($data);
    }

    public function save()
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $apartmentGenderEntity = new ApartmentGenderEntity();
        $apartmentGenderEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to save this record');
        }

        if ($apartmentGenderModel->save($apartmentGenderEntity)) {
            return redirect()->back()->with('success', 'Apartment gender saved successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentGenderModel->errors());
        }

    }

    public function update($id)
    {
        $apartmentGenderModel = new ApartmentGenderModel();
        $apartmentGenderEntity = new ApartmentGenderEntity();
        $apartmentGenderEntity->fill($this->request->getPost());

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to update this record');
        }

        if($apartmentGenderModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if ($apartmentGenderModel->update($id, $apartmentGenderEntity)) {
            return redirect()->back()->with('success', 'Apartment gender updated successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentGenderModel->errors());
        }

    }

    public function delete($id)
    {
        $apartmentGenderModel = new ApartmentGenderModel();

        if(!in_array($this->session->get('role'), ['admin', 'manager'])) {
            return redirect()->back()->with('errors', 'You are not authorized to delete this record');
        }

        if($apartmentGenderModel->find($id) === null) {
            return redirect()->back()->with('errors', 'Record not found');
        }

        if($apartmentGenderModel->delete($id)) {
            return redirect()->back()->with('success', 'Apartment gender deleted successfully');
        } else {
            return redirect()->back()->with('errors', $apartmentGenderModel->errors());
        }

    }
    
}
