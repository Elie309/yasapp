<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Listings\Attributes\PropertyStatusModel;
use App\Models\Listings\PropertyModel;
use App\Services\propertyServices;

class ListingStatusAPIController extends BaseController
{


    public function updatePropertyStatus($id, $status_id)
    {

        try {


            $property_id = intval(esc($id));
            $status = intval(esc($status_id));

            if ($property_id == '' || $status == '') {
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid property status update']);
            }

            if($status == 0){
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid property status update']);
            }

            $propertyStatusModel = new PropertyStatusModel();

            if(!$propertyStatusModel->find($status)){
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid property status update']);
            }

            $propertyModel = new PropertyModel();

            $property = $propertyModel->find($property_id);
            log_message('info', 'Property ID: ' . json_encode($property));

            if (!$property) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'property not found']);
            }

            if ($property->property_state == $status) {
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'property status is already ' . $status]);
            }

            $employee_id = $this->session->get('id');

            if ($property->employee_id != $employee_id) {
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'You are not authorized to update this property']);
            }

            if (!$propertyModel->update($id, ['property_status_id' => $status])) {
                return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Failed to update property status']);
            }

            return $this->response->setJSON(['success' => true, 'status' => 'success', 'message' => 'property status updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
