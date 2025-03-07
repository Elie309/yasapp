<?php

namespace App\Services;

use App\Models\Settings\BackupLogsModel;
use Exception;

class BackupServices extends BaseServices
{

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
        $backupFile = FCPATH . 'backups/DB-BACKUP-' . date('Y-m-d-H:i:s') . '.sql';

        try {
            $this->db->query("SET FOREIGN_KEY_CHECKS=0;");

            $tables = $this->db->query("SHOW TABLES")->getResultArray(); // Ensure an array is returned
            $backupSQL = "-- Database Backup for `{$this->db->database}` \n-- Generated on " . date('Y-m-d H:i:s') . "\n\n";
            
            $backupSQL .= "CREATE SCHEMA IF NOT EXISTS `{$this->db->database}` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n";
            $backupSQL .= "USE `{$this->db->database}`;\n";

            $backupSQL .= "SET AUTOCOMMIT = 0;\n";
            $backupSQL .= "START TRANSACTION;\n";            
            $backupSQL .= "SET FOREIGN_KEY_CHECKS=0;\n";



            foreach ($tables as $tableRow) {
                $table = reset($tableRow);
            
                // Get CREATE TABLE statement
                $createTable = $this->db->query("SHOW CREATE TABLE `$table`")->getRowArray();
                $backupSQL .= "-- Table structure for `$table` \nDROP TABLE IF EXISTS `$table`;\n" . $createTable['Create Table'] . ";\n\n";
            
                // Get table data
                $rows = $this->db->query("SELECT * FROM `$table`")->getResultArray();
                if (!empty($rows)) {
                    $backupSQL .= "-- Data for `$table` \n";
                    foreach ($rows as $row) {
                        $values = array_map(function ($value) {
                            if (is_null($value)) {
                                return "NULL";
                            } elseif ($value === '') {
                                return "''";
                            } else {
                                return "'" . addslashes($value) . "'";
                            }
                        }, array_values($row));
            
                        $columns = implode("`, `", array_keys($row));
                        $valuesString = implode(", ", $values);
                        $backupSQL .= "INSERT INTO `$table` (`$columns`) VALUES ($valuesString);\n";
                    }
                    $backupSQL .= "\n";
                }
            }
            

            $backupSQL .= "SET FOREIGN_KEY_CHECKS=1;\n";
            $backupSQL .= "COMMIT;\n";
            $backupSQL .= "SET AUTOCOMMIT = 1;\n";


            // Save backup locally
            if (!file_exists(FCPATH . 'backups')) {
                mkdir(FCPATH . 'backups', 0777, true);
            }
            file_put_contents($backupFile, $backupSQL);

            // Upload backup to AWS S3
            $uploadAWSClient = new UploadAWSClientServices();
            $backupUrl = $uploadAWSClient->uploadBackup($backupFile, basename($backupFile));

            if ($backupUrl) {
                // Save backup to database
                $backupModel = new BackupLogsModel();
                $saved = $backupModel->save([
                    'backup_name' => basename($backupFile),
                    'backup_file_size' => filesize($backupFile),
                    'backup_file_path' => $backupUrl,
                ]);

                if ($saved) {
                    // Delete local backup

                    $size = filesize($backupFile);
                    $basename = basename($backupFile);

                    // unlink($backupFile);

                    return [
                        'success' => true,
                        'backup_id' => $backupModel->getInsertID(),
                        'backup_name' => $basename,
                        'backup_file_size' => $size,
                        'backup_file_path' => $backupUrl,
                    ];
                } else {
                    $uploadAWSClient->deleteFile($backupUrl);

                    return [
                        'error' => 'Database backup failed: Unable to save backup to database',
                        'success' => false
                    ];
                }
            } else {
                return [
                    'error' => 'Database backup failed: Unable to upload backup to AWS S3',
                    'success' => false
                ];
            }
        } catch (Exception $e) {
            log_message('error', 'Database backup failed: ' . print_r($e));
            return [
                'error' => 'Database backup failed: ' . $e->getMessage(),
                'success' => false
            ];
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
                $uploadAWSClient->deleteFile($backup->backup_file_path);
                $backupModel->delete($backupId);
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
