<?php

namespace App\Controllers\Files;

use App\Controllers\BaseController;
use App\Services\UploadAWSClientServices;
use App\Services\PropertyUploadServices;
use CodeIgniter\HTTP\ResponseInterface;

class DeleteController extends BaseController
{
    private $uploadAWSClientServices;
    private $propertyUploadServices;

    public function __construct()
    {
        $this->uploadAWSClientServices = new UploadAWSClientServices();
        $this->propertyUploadServices = new PropertyUploadServices();
    }

    public function delete($upload_id)
    {

        $upload_id = intval(esc($upload_id));

        $employee_id = $this->session->get('id');

        $upload = $this->propertyUploadServices->read($upload_id);

        if (!$upload) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['errors' => 'File not found']);
        }

        if($upload->employee_id !== $employee_id) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)
                ->setJSON(['errors' => 'You are not authorized to delete this file']);
        }

        try {
            $this->uploadAWSClientServices->deleteFile($upload->upload_storage_url);
            $this->propertyUploadServices->delete($upload_id);

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['errors' => 'An error occurred while deleting the file']);
        }
    }
}
