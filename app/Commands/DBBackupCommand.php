<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class DBBackupCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Database';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:backup';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Backup the database to a SQL file.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:backup [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--filename' => 'Custom filename for the backup (default: backup_YYYY-MM-DD_HH-MM-SS.sql)',
        '--path'     => 'Custom path for storing the backup (default: ROOTPATH/writable/backups)',
    ];

    /**
     * Actually execute a command.
     */
    public function run(array $params)
    {
        // Get database connection
        $db = \Config\Database::connect();
        $driver = $db->DBDriver; // Correct driver name
    
        // Create backup directory if it doesn't exist
        $backupPath = $params['path'] ?? WRITEPATH . 'backups/';
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 755, true);
        }
    
        // Generate backup filename
        $defaultFilename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filename = $params['filename'] ?? $defaultFilename;
        $backupFile = $backupPath . $filename;
    
        CLI::write('Starting database backup...', 'yellow');
        CLI::write("Backup file: {$backupFile}", 'green');

        try {
            // Execute backup based on database driver
            switch ($driver) {
                case 'MySQLi':
                    $this->backupMysql($db, $backupFile);
                    break;
                case 'Postgre':
                    $this->backupPostgre($db, $backupFile);
                    break;
                default:
                    throw new \RuntimeException("Backup not supported for {$driver} driver.");
            }
            
            CLI::write('Database backup completed successfully!', 'green');
            CLI::write("Backup saved to: {$backupFile}", 'green');
            
        } catch (\Exception $e) {
            // Delete the backup file if it exists
            if (file_exists($backupFile)) {
                if (unlink($backupFile)) {
                    CLI::write("Partial backup file deleted: {$backupFile}", 'yellow');
                } else {
                    CLI::write("Warning: Could not delete partial backup file: {$backupFile}", 'yellow');
                }
            }
            
            CLI::error($e->getMessage());
            exit(1);
        }
    }
    
    /**
     * Backup MySQL database using the mysqldump utility
     */
    private function backupMysql($config, $backupFile)
    {
        $command = sprintf(
            'mysqldump -h %s -u %s %s %s > %s',
            escapeshellarg($config->hostname),
            escapeshellarg($config->username),
            !empty($config->password) ? '-p' . escapeshellarg($config->password) : '',
            escapeshellarg($config->database),
            escapeshellarg($backupFile)
        );

        CLI::write('Executing mysqldump command...', 'yellow');
        
        // Use proc_open instead of exec to capture stderr
        $descriptorspec = [
            0 => ['pipe', 'r'],  // stdin
            1 => ['pipe', 'w'],  // stdout
            2 => ['pipe', 'w'],  // stderr
        ];
        
        $process = proc_open($command, $descriptorspec, $pipes);
        
        if (is_resource($process)) {
            // Close stdin
            fclose($pipes[0]);
            
            // Read stdout
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            
            // Read stderr
            $error = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            
            // Close process
            $returnVar = proc_close($process);
            
            if ($returnVar !== 0) {
                throw new \RuntimeException('Database backup failed. Error details: ' . 
                    ($error ?: 'No error details available. Make sure mysqldump is installed and accessible.'));
            }
        } else {
            throw new \RuntimeException('Failed to execute command. Check if the required utilities are installed.');
        }
    }

    /**
     * Backup PostgreSQL database using the pg_dump utility
     */
    private function backupPostgre($config, $backupFile)
    {
        $command = sprintf(
            'PGPASSWORD=%s pg_dump -h %s -U %s -d %s -f %s',
            escapeshellarg($config->password),
            escapeshellarg($config->hostname),
            escapeshellarg($config->username),
            escapeshellarg($config->database),
            escapeshellarg($backupFile)
        );

        CLI::write('Executing pg_dump command...', 'yellow');
        
        // Use proc_open instead of exec to capture stderr
        $descriptorspec = [
            0 => ['pipe', 'r'],  // stdin
            1 => ['pipe', 'w'],  // stdout
            2 => ['pipe', 'w'],  // stderr
        ];
        
        $process = proc_open($command, $descriptorspec, $pipes);
        
        if (is_resource($process)) {
            // Close stdin
            fclose($pipes[0]);
            
            // Read stdout
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            
            // Read stderr
            $error = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            
            // Close process
            $returnVar = proc_close($process);
            
            if ($returnVar !== 0) {
                throw new \RuntimeException('Database backup failed. Error details: ' . 
                    ($error ?: 'No error details available. Make sure pg_dump is installed and accessible.'));
            }
        } else {
            throw new \RuntimeException('Failed to execute command. Check if the required utilities are installed.');
        }
    }
}
