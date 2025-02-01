<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Requests\RequestModel;
use App\Services\RequestServices;

class RequestAPIController extends BaseController
{

    private $requestStates;
    private $requestPriorities;

    public function __construct()
    {
        $this->requestStates = RequestServices::$RequestStatuses;
        $this->requestPriorities = RequestServices::$RequestPriorities;
    }

    public function updateRequestStatus($id, $status)
    {

        $request_id = esc($id);
        $status = esc($status);

        if($request_id == '' || $status == ''){
            return $this->response->setJSON(['success' => false,'status' => 'error', 'message' => 'Invalid request status update']);
        }

        if(!in_array(strtolower($status), $this->requestStates)){
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid request status']);
        }

        $requestModel = new RequestModel();
        if(!$requestModel->find($request_id)){
            return $this->response->setJSON(['status' => 'error', 'message' => 'Request not found']);
        }


        if(!$requestModel->update($id, ['request_state' => $status])){
            return $this->response->setJSON(['success' => false,'status' => 'error', 'message' => 'Failed to update request status']);
        }

        return $this->response->setJSON(['success' => true,'status' => 'success', 'message' => 'Request status updated successfully']);
    }

    public function updateRequestPriority($id, $priority)
    {

        $request_id = esc($id);
        $priority = esc($priority);

        if($request_id == '' || $priority == ''){
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid request priority update']);
        }

        if(!in_array(strtolower($priority), $this->requestPriorities)){
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Invalid request priority']);
        }

        $requestModel = new RequestModel();
        if(!$requestModel->find($request_id)){
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Request not found']);
        }

        if(!$requestModel->update($id, ['request_priority' => $priority])){
            return $this->response->setJSON(['success' => false, 'status' => 'error', 'message' => 'Failed to update request priority']);
        }

        return $this->response->setJSON(['success' => true, 'status' => 'success', 'message' => 'Request priority updated successfully']);
    }
}
