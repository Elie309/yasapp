<?php

namespace App\Controllers\Uploads;

use App\Controllers\BaseController;
use App\Services\UploadServices;
use CodeIgniter\HTTP\ResponseInterface;

class UploadController extends BaseController
{
    private $uploadServices;

    public function __construct()
    {
        $this->uploadServices = new UploadServices();
    }

    //Main view for the upload page
    public function index()
    {
        return view("template/header") . view('uploads/upload') . view("template/footer");
    }

    // BELOW APIS CALLS THE FUNCTION UPLOADIMAGE AND UPLOADVIDEO FROM THE UPLOADSERVICES CLASS
    public function uploadImage()
    {
        try {
            $file = $this->request->getFile('image');
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->getTempName();
                $fileName = $file->getName();
                $result = $this->uploadServices->uploadImage($filePath, $fileName);
                return $this->response->setJSON(['url' => $result]);
            }
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                                  ->setJSON(['error' => 'Invalid file upload']);
        } catch (\Exception $e) {
            log_message('error', 'Error uploading image: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                                  ->setJSON(['error' => 'An error occurred while uploading the image']);
        }
    }

    public function uploadVideo()
    {
        try {
            $file = $this->request->getFile('video');
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->getTempName();
                $fileName = $file->getName();
                $result = $this->uploadServices->uploadVideo($filePath, $fileName);
                return $this->response->setJSON(['url' => $result]);
            }
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                                  ->setJSON(['error' => 'Invalid file upload']);
        } catch (\Exception $e) {
            log_message('error', 'Error uploading video: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                                  ->setJSON(['error' => 'An error occurred while uploading the video']);
        }
    }
}
