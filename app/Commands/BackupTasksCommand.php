<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class BackupTasksCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Task';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'task:backup';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Manage database backup tasks';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'task:backup [action]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'action' => 'Action to perform: run (run daily backup) or cleanup (clean old backups)',
    ];

    /**
     * Actually execute a command.
     */
    public function run(array $params)
    {
        $action = $params[0] ?? 'help';
        
        switch ($action) {
            case 'run':
                CLI::write('Running database backup task...', 'yellow');
                $task = new \App\Tasks\DatabaseBackupTask();
                $task->dailyBackup();
                CLI::write('Database backup task completed.', 'green');
                break;
                
            case 'cleanup':
                CLI::write('Running backup cleanup task...', 'yellow');
                $task = new \App\Tasks\DatabaseBackupTask();
                $task->cleanupOldBackups();
                CLI::write('Backup cleanup task completed.', 'green');
                break;
                
            case 'help':
            default:
                CLI::write('Usage:', 'yellow');
                CLI::write('  php spark task:backup run     - Run the daily database backup task', 'white');
                CLI::write('  php spark task:backup cleanup - Run the backup cleanup task', 'white');
                break;
        }
    }
}
