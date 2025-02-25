<?php

namespace App\Controllers\Files;

use App\Controllers\BaseController;
use App\Services\UploadAWSClientServices;
use App\Services\PropertyUploadServices;
use CodeIgniter\HTTP\ResponseInterface;

class UploadController extends BaseController
{
    private $uploadAWSClientServices;
    private $propertyUploadServices;

    public function __construct()
    {
        $this->uploadAWSClientServices = new UploadAWSClientServices();
        $this->propertyUploadServices = new PropertyUploadServices();
    }

    // Main view for the upload page
    public function uploadPage($property_id)
    {
        $employee_id = $this->session->get('id');

        // Verify if the employee is allowed to upload for this property
        if (!$this->propertyUploadServices->verifyEmployeeForProperty($property_id, $employee_id)) {
            return redirect()->back()->with('errors', 'You are not authorized to upload files for this property');
        }

        $propertyUploads = [];

        $propertyResults = $this->propertyUploadServices->getByPropertyId($property_id);

        if ($propertyResults) {
            $propertyUploads = $propertyResults;
        }


        return view("template/header", [
            'title' => 'Uploads',
        ]) . view('uploads/upload', [
            'property_id' => $property_id,
            'propertyUploads' => $propertyUploads
        ]) . view("template/footer");
    }

    public function viewFiles($property_id)
    {

        $propertyUploads = [];

        $employee_id = $this->session->get('id');
        $role = $this->session->get('role');
        $uploadOwner = false;

        if ($role !== 'admin') {
            // Verify if the employee is allowed to view files for this property
            $uploadOwner = $this->propertyUploadServices->verifyEmployeeForProperty($property_id, $employee_id);
            if (!$uploadOwner) {
                return redirect()->back()->with('errors', 'You are not authorized to upload files for this property');
            }
        }

        $propertyResults = $this->propertyUploadServices->getByPropertyId($property_id);


        if ($propertyResults) {
            $propertyUploads = $propertyResults;
        }

        return view("template/header") . view('listings/viewFiles', [
            'property_id' => $property_id,
            'propertyUploads' => $propertyUploads,
            'uploadOwner' => $uploadOwner,
        ]) . view("template/footer");
    }

    // Unified upload function
    public function uploads()
    {
        $property_id = esc($this->request->getPost('property_id'));

        if (!$property_id) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['error' => 'Invalid request']);
        }

        $employee_id = $this->session->get('id');

        if (!$this->propertyUploadServices->verifyEmployeeForProperty($property_id, $employee_id)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)
                ->setJSON(['error' => 'You are not authorized to upload files for this property']);
        }


        if ($this->request->getFile('filepond')) {
            return $this->handleFilePondUpload($property_id, $employee_id);
        }

        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
            ->setJSON(['error' => 'Invalid request']);
    }

    private function handleFilePondUpload($property_id, $employee_id)
    {
        try {
            $file = $this->request->getFile('filepond');
            $type = $this->determineFileType($file);

            if ($file->isValid() && !$file->hasMoved()) {
                // Verify the type of the uploaded file
                if (!$this->verifyUploadType($file, $type)) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                        ->setJSON(['error' => 'Uploaded file type does not match the expected type']);
                }

                $filePath = $file->getTempName();
                $fileName = $this->generateUniqueFileName($file->getExtension());

                if ($type === 'image') {
                    $filePath = $this->convertToWebP($filePath);
                    $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
                    $mimeType = 'image/webp';
                    $fileSize = filesize($filePath); // Update file size after conversion
                } else {
                    $mimeType = $file->getMimeType();
                    $fileSize = $file->getSize();
                }

                // $result = $type === 'image' ? 
                //     $this->uploadAWSClientServices->uploadImage($filePath, $fileName) : 
                //     $this->uploadAWSClientServices->uploadVideo($filePath, $fileName);

                if($type === 'image'){
                    $result = $this->uploadAWSClientServices->uploadImage($filePath, $fileName);
                }elseif($type === 'video'){
                    $result = $this->uploadAWSClientServices->uploadVideo($filePath, $fileName);
                }else{
                    $result = $this->uploadAWSClientServices->uploadDocument($filePath, $fileName);
                }

                $data = [
                    'property_id' =>   $property_id,
                    'employee_id' => $employee_id,
                    'upload_file_name' => $fileName,
                    'upload_file_type' => $type,
                    'upload_mime_type' => $mimeType, // Use updated MIME type
                    'upload_file_size' => $fileSize, // Use updated file size
                    'upload_storage_url' => $result,
                    'upload_status' => 'uploaded'
                ];

                $uploadId = $this->propertyUploadServices->create($data);
                if ($uploadId) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)->setJSON(['url' => $result]);
                } else {
                    $this->uploadAWSClientServices->deleteFile($result);

                    // Delete the file from the server if it was uploaded
                    if (isset($filePath) && file_exists($filePath)) {
                        unlink($filePath);
                    }

                    return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                        ->setJSON(['error' => 'Failed to save upload details to database']);
                }
            }


            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['error' => 'Invalid file upload']);
        } catch (\Exception $e) {
            // Delete the file from the server if it was uploaded
            if (isset($filePath) && file_exists($filePath)) {
                unlink($filePath);
            }
            // Delete the file from AWS if it was uploaded
            if (isset($result)) {
                $this->uploadAWSClientServices->deleteFile($result);
            }
            log_message('error', 'Error uploading file: ' . $e->getMessage());
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['error' => 'An error occurred while uploading the file']);
        }
    }

    private function generateUniqueFileName($extension)
    {
        return uniqid() . '.' . $extension;
    }

    private function convertToWebP($filePath)
    {
        $image = imagecreatefromstring(file_get_contents($filePath));
        $webpPath = tempnam(sys_get_temp_dir(), 'webp') . '.webp';
        imagewebp($image, $webpPath);
        imagedestroy($image);
        return $webpPath;
    }

    private function verifyUploadType($file, $type)
    {
        $mimeType = $file->getMimeType();
        $validMimeTypes = [
            'document' => ['application/pdf', 'application/msword', 
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ],
            'image' => ['image/jpeg', 'image/png', 'image/webp'],
            'video' => ['video/mp4', 'video/x-msvideo', 'video/x-matroska']
        ];

        return in_array($mimeType, $validMimeTypes[$type]);
    }

    private function determineFileType($file)
    {
        $mimeType = $file->getMimeType();
        if (strpos($mimeType, 'image/') === 0) {
            return 'image';
        } elseif (strpos($mimeType, 'video/') === 0) {
            return 'video';
        } else {
            return 'document';
        }
    }
}
