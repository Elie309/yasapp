<?php

namespace App\Tasks;

use App\Services\BackupServices;
use CodeIgniter\I18n\Time;

class DatabaseBackupTask
{
    /**
     * Run the daily database backup task
     * 
     * @return array
     */
    public function dailyBackup()
    {
        $backupService = new BackupServices();
        $result = $backupService->backupDatabase();
        
        if ($result['success']) {
            log_message('info', 'Automated daily database backup created successfully: ' . $result['backup_name']);
        } else {
            log_message('error', 'Automated daily database backup failed: ' . $result['error']);
        }
        
        return $result;
    }
    
    /**
     * Run the backup cleanup task (remove backups older than 30 days)
     * This is already done in BackupServices but can be run separately if needed
     * 
     * @return array
     */
    public function cleanupOldBackups()
    {
        try {
            $backupModel = new \App\Models\Settings\BackupLogsModel();
            $thirtyDaysAgo = new Time('-30 days');

            // Find backups older than 30 days
            $oldBackups = $backupModel->where('backup_created_at <', $thirtyDaysAgo->toDateTimeString())->findAll();

            if (!empty($oldBackups)) {
                $uploadAWSClient = new \App\Services\UploadAWSClientServices();
                
                foreach ($oldBackups as $backup) {
                    // Delete from S3
                    $uploadAWSClient->deleteFile($backup['backup_url']);
                    
                    // Delete from database
                    $backupModel->delete($backup['backup_id']);
                    
                    log_message('info', 'Task: Deleted old backup: ' . $backup['backup_name']);
                }
                
                log_message('info', 'Task: Cleaned up ' . count($oldBackups) . ' old database backups');
                return [
                    'success' => true,
                    'count' => count($oldBackups)
                ];
            } else {
                log_message('info', 'Task: No old backups to clean up');
                return [
                    'success' => true,
                    'count' => 0
                ];
            }
        } catch (\Exception $e) {
            log_message('error', 'Task: Cleanup of old backups failed: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
