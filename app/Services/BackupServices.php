<?php

namespace App\Services;

use App\Models\Settings\BackupLogsModel;
use Exception;
use CodeIgniter\I18n\Time;

class BackupServices extends BaseServices
{

    protected $backupDirectory = WRITEPATH . 'backups/';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Backup database
     * @return array
     */
    public function backupDatabase()
    {
        try {
            // Create backup directory if it doesn't exist
            if (!file_exists($this->backupDirectory)) {
                mkdir($this->backupDirectory, 755, true);
            }

            // Generate backup filename
            $backupFilename = 'DB-BACKUP-' . date('Y-m-d-H-i-s') . '.sql';
            $backupFile = $this->backupDirectory . $backupFilename;

            // Execute the DbBackup command
            $command = ROOTPATH . "spark db:backup --filename={$backupFilename} --path={$this->backupDirectory}/";
            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new Exception("Command failed: " . implode("\n", $output));
            }

            // Check if the backup file was created
            if (!file_exists($backupFile)) {
                unlink($backupFile); // Clean up if the file doesn't exist
                throw new Exception("Backup file was not created");
            }

            // Upload backup to AWS S3
            $uploadAWSClient = new UploadAWSClientServices();
            $backupUrl = $uploadAWSClient->uploadBackup($backupFile, $backupFilename);

            if (!$backupUrl) {
                throw new Exception("Failed to upload backup to S3");
            }

            // Save backup to database
            $backupModel = new BackupLogsModel();
            $saved = $backupModel->save([
                'backup_name' => $backupFilename,
                'backup_file_size' => filesize($backupFile),
                'backup_file_path' => $backupFile,
                'backup_url' => $backupUrl
            ]);

            if (!$saved) {
                // Delete the S3 file if database record creation failed
                $uploadAWSClient->deleteFile($backupUrl);
                throw new Exception("Failed to save backup record to database");
            }

            // Delete local backup file after successful S3 upload
            // unlink($backupFile);

            // Clean up old backups (older than 30 days)
            $this->cleanupOldBackups();

            return [
                'success' => true,
                'backup_id' => $backupModel->getInsertID(),
                'backup_name' => $backupFilename,
                'backup_file_size' => filesize($backupFile),
                'backup_url' => $backupUrl,
            ];
        } catch (Exception $e) {
            log_message('error', 'Database backup failed: ' . $e->getMessage());
            return [
                'error' => 'Database backup failed: ' . $e->getMessage(),
                'success' => false
            ];
        }
    }

    /**
     * Delete backups older than 30 days
     * @return void
     */
    private function cleanupOldBackups()
    {
        try {
            $backupModel = new BackupLogsModel();
            $thirtyDaysAgo = new Time('-30 days');

            // Find backups older than 30 days
            $oldBackups = $backupModel->where('backup_created_at <', $thirtyDaysAgo->toDateTimeString())->findAll();

            if (!empty($oldBackups)) {
                $uploadAWSClient = new UploadAWSClientServices();
                
                foreach ($oldBackups as $backup) {
                    // Delete from S3
                    $uploadAWSClient->deleteFile($backup['backup_url']);
                    
                    // Delete from database
                    $backupModel->delete($backup['backup_id']);

                    //Delete local backup file if exists
                    if (file_exists($this->backupDirectory . '/' . $backup['backup_name'])) {
                        unlink($backup['backup_file_path']);
                    }
                    
                    log_message('info', 'Deleted old backup: ' . $backup['backup_name']);
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Cleanup of old backups failed: ' . $e->getMessage());
        }
    }

    /**
     * Get all backups
     * @return array
     */
    public function getBackups()
    {
        try {
            $backupModel = new BackupLogsModel();
            // Find newest to oldest
            $backups = $backupModel->orderBy('backup_created_at', 'DESC')->findAll();

            return [
                'success' => true,
                'backups' => $backups
            ];
        } catch (Exception $e) {
            return [
                'error' => 'Get backups failed: ' . $e->getMessage(),
                'success' => false
            ];
        }
    }

    /**
     * Get backup
     * @param int $backupId
     * @return array
     */
    public function getBackup($backupId)
    {
        try {
            $backupModel = new BackupLogsModel();
            $backup = $backupModel->find($backupId);
            if ($backup) {
                return [
                    'success' => true,
                    'backup' => $backup
                ];
            }

            return [
                'error' => 'Backup not found',
                'success' => false
            ];
        } catch (Exception $e) {
            return [
                'error' => 'Get backup failed: ' . $e->getMessage(),
                'success' => false
            ];
        }
    }

    /**
     * Delete backup
     * @param int $backupId
     * @return array
     */
    public function deleteBackup($backupId)
    {
        try {

            $backupModel = new BackupLogsModel();
            $backup = $backupModel->find($backupId);

            if ($backup) {
                $uploadAWSClient = new UploadAWSClientServices();
                $uploadAWSClient->deleteFile($backup['backup_url']);
                $backupModel->delete($backupId);

                //Delete local backup file if exists
                if (file_exists($this->backupDirectory . '/' . $backup['backup_name'])) {
                    unlink($this->backupDirectory . '/' . $backup['backup_name']);
                }

                return [
                    'success' => true
                ];
            }

            return [
                'error' => 'Backup not found',
                'success' => false
            ];
        } catch (Exception $e) {
            return [
                'error' => 'Delete backup failed: ' . $e->getMessage(),
                'success' => false
            ];
        }
    }
}
