<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Services\BackupServices;

class BackupController extends BaseController
{
    
    // View page - backup logs
    public function index()
    {

        $backupServices = new BackupServices();
        $backups = $backupServices->getBackups();

        return view('template/header') .
            view('settings/backups', ['backups' => $backups['backups']]) .
            view("template/footer");

    }

    // Backup database
    public function backupDatabase()
    {

        if($this->session->get('role') != 'admin'){
            return redirect()->back()->with('errors', 'You are not authorized to backup the database');
        }

        $backupServices = new BackupServices();
        $backup = $backupServices->backupDatabase();
        if($backup['success']){
            return redirect()->to('/settings/backup')->with('success', "Database backup created successfully");
        }
    
        return redirect()->to('/settings/backup')->with('errors', $backup['error']);

    }

    // Download backup
    public function downloadBackup()
    {
        if($this->session->get('role') != 'admin'){
            return redirect()->back()->with('errors', 'You are not authorized to download this record');
        }

        $backupId = esc($this->request->getPost('backup_id'));

        $backupServices = new BackupServices();
        $backup = $backupServices->getBackup($backupId);
        if($backup['success']){
            // Get file URL from S3
            $fileUrl = $backup['backup']->backup_url;
            
            try {
                // Get file content from S3
                $fileContent = file_get_contents($fileUrl);
                if ($fileContent === false) {
                    throw new \Exception("Unable to fetch file from S3");
                }
                
                $fileName = basename($fileUrl);
                
                // Force download
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $fileName . '"');
                header('Content-Length: ' . strlen($fileContent));
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Pragma: no-cache');
                header('Expires: 0');
                
                // Output file content and exit
                echo $fileContent;
                exit;
            } catch (\Exception $e) {
                return redirect()->to('/settings/backup')->with('errors', 'Error downloading backup: ' . $e->getMessage());
            }
        }

        return redirect()->to('/settings/backup')->with('errors', $backup['error']);
    }

    // Delete backup
    public function deleteBackup()
    {

        if($this->session->get('role') != 'admin'){
            return redirect()->back()->with('errors', 'You are not authorized to delete this record');
        }

        $backupId = $this->request->getPost('backup_id');

        $backupServices = new BackupServices();
        $backup = $backupServices->deleteBackup($backupId);
        if($backup['success']){
            return redirect()->to('/settings/backup')->with('success', "Backup deleted successfully");
        }

        return redirect()->to('/settings/backup')->with('errors', $backup['error']);

    }




}
