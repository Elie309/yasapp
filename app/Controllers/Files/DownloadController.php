<?php

namespace App\Controllers\Files;

use App\Controllers\BaseController;
use App\Models\Listings\PropertyModel;
use App\Services\PropertyUploadServices;
use ZipArchive;

class DownloadController extends BaseController
{
    private $propertyUploadServices;

    public function __construct()
    {
        $this->propertyUploadServices = new PropertyUploadServices();
    }

    public function download($upload_id)
    {

        //E.g:  https://yasapp.s3.eu-central-003.backblazeb2.com/images/67b4e8aa2f746.webp


        $upload = $this->propertyUploadServices->read($upload_id);


        if ($upload) {
            $file = $upload['upload_storage_url'];
            $path = pathinfo($file);
            $filename = $path['basename'];

            // Download the file from the third-party URL
            $fileContent = file_get_contents($file);
            if ($fileContent !== false) {
                return $this->response->setHeader('Content-Type', 'application/octet-stream')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($fileContent);
            }
        }

        return redirect()->back()->with('errors', 'File not found');
    }

    public function downloadAll($property_id)
    {
        $propertyModel = new PropertyModel();
        $property = $propertyModel->find($property_id);

        if ($property) {
            $uploads = $this->propertyUploadServices->getByPropertyId($property_id);

            // Generate a unique name
            $property->property_name = time();

            if ($uploads) {
                $zip = new ZipArchive();
                $zipFileName = $property->property_name . '.zip';
                $zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;

                if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
                    log_message('error', 'Failed to create zip file');
                    return redirect()->back()->with('errors', 'Failed to create zip file');
                }

                foreach ($uploads as $upload) {
                    // Download the file content from the third-party URL
                    $fileContent = file_get_contents($upload['upload_storage_url']);
                    if ($fileContent !== false) {
                        // Add the file content to the Zip archive
                        $zip->addFromString($property->property_name . '/' . $upload['upload_file_name'], $fileContent);
                    }
                }

                $zip->close();

                // Read the zip file content
                $zipContent = file_get_contents($zipFilePath);

                unlink($zipFilePath);

                // Return the Zip file as a download
                return $this->response->setHeader('Content-Type', 'application/zip')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $zipFileName . '"')
                    ->setBody($zipContent);
            }
        }

        return redirect()->back()->with('errors', 'Files not found');
    }
}
