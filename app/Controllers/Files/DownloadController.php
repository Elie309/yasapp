<?php

namespace App\Controllers\Files;

use App\Controllers\BaseController;
use App\Models\Listings\PropertyModel;
use App\Services\PropertyUploadServices;
use ZipArchive;
use Config\Services;

class DownloadController extends BaseController
{
    private $propertyUploadServices;
    private $cache;

    public function __construct()
    {
        $this->propertyUploadServices = new PropertyUploadServices();
        $this->cache = Services::cache();
    }

    public function download($upload_id)
    {
        try {
            // Check if file info is cached
            $cacheKey = "file_download_{$upload_id}";
            $upload = $this->cache->get($cacheKey);
            
            if (!$upload) {
                $upload = $this->propertyUploadServices->read($upload_id);
                
                // Cache for 1 hour if found
                if ($upload) {
                    $this->cache->save($cacheKey, $upload, 3600);
                }
            }

            if ($upload) {
                $file = $upload->upload_storage_url;
                $path = pathinfo($file);
                $filename = $path['basename'];
                $mimeType = $this->getMimeType($filename);

                // Stream the file instead of loading it all into memory
                $headers = get_headers($file, 1);
                $fileSize = $headers['Content-Length'] ?? 0;
                
                $response = $this->response;
                $response->setHeader('Content-Type', $mimeType)
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
                
                if ($fileSize) {
                    $response->setHeader('Content-Length', $fileSize);
                }
                
                // Use readfile for streaming instead of file_get_contents
                ob_end_clean(); // Clean any output buffers
                $response->sendHeaders();
                
                readfile($file);
                exit;
            }
            
            return redirect()->back()->with('error', 'File not found');
        } catch (\Exception $e) {
            log_message('error', 'Download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error downloading file: ' . $e->getMessage());
        }
    }

    public function downloadAll($property_id)
    {
        try {
            $propertyModel = new PropertyModel();
            $property = $propertyModel->find($property_id);

            if (!$property) {
                return redirect()->back()->with('error', 'Property not found');
            }
            
            $uploads = $this->propertyUploadServices->getByPropertyId($property_id);
            
            if (empty($uploads)) {
                return redirect()->back()->with('error', 'No files found for this property');
            }

            // Use property name or a sanitized version if available
            $zipBaseName = $property->property_name ?? ('property_' . $property_id);
            $zipBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $zipBaseName) . '_' . time();
            $zipFileName = $zipBaseName . '.zip';
            $zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;

            $zip = new ZipArchive();
            if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
                log_message('error', 'Failed to create zip file');
                return redirect()->back()->with('error', 'Failed to create zip file');
            }

            // Track progress for a batch download
            $totalFiles = count($uploads);
            $processedFiles = 0;
            
            foreach ($uploads as $upload) {
                $processedFiles++;
                
                // Create a folder structure in the zip if needed
                $targetPath = $zipBaseName . '/';
                
                // Stream the file directly to the zip if possible or use temp files for large files
                $tempFile = tempnam(sys_get_temp_dir(), 'zip_');
                if (copy($upload->upload_storage_url, $tempFile)) {
                    $zip->addFile($tempFile, $targetPath . $upload->upload_file_name);
                    // Register temp file for deletion after zip is closed
                    register_shutdown_function(function() use ($tempFile) {
                        if (file_exists($tempFile)) {
                            unlink($tempFile);
                        }
                    });
                }
            }

            $zip->close();

            // Return the Zip file as a download using streaming
            $response = $this->response;
            $response->setHeader('Content-Type', 'application/zip')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $zipFileName . '"')
                ->setHeader('Content-Length', filesize($zipFilePath));
            
            ob_end_clean();
            $response->sendHeaders();
            
            readfile($zipFilePath);
            unlink($zipFilePath);
            exit;
        } catch (\Exception $e) {
            log_message('error', 'Batch download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating download package: ' . $e->getMessage());
        }
    }
    
    /**
     * Get MIME type based on file extension
     */
    private function getMimeType($filename)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'txt' => 'text/plain',
            'zip' => 'application/zip',
            // Add more as needed
        ];
        
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return $mimeTypes[$ext] ?? 'application/octet-stream';
    }
}
