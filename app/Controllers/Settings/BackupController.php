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
    public function downloadBackup($backupId)
    {

        if($this->session->get('role') != 'admin'){
            return redirect()->back()->with('errors', 'You are not authorized to download this record');
        }

        $backupServices = new BackupServices();
        $backup = $backupServices->getBackup($backupId);
        if($backup['success']){
            // Download backup from URL
            // Get files content

            $file = $backup['backup']['backup_url'];
            $fileContent = file_get_contents($file);
            $fileName = basename($file);

            // Force download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Length: ' . strlen($fileContent));
            header('Connection: close');

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
