<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class DBWipeCommand extends BaseCommand
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
    protected $name = 'db:wipe';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Drops all tables from the database.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:wipe [options]';

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--force'            => 'Force the operation to run without confirmation prompt',
        '--force-production' => 'Allow the operation to run in production environment (use with caution)',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        // Check if we're in production environment
        if (strtolower(ENVIRONMENT) === 'production' || ENVIRONMENT === 'testing') {
            $forceProduction = array_key_exists('force-production', $params) || CLI::getOption('force-production');
            
            if (!$forceProduction) {
                CLI::error('This command cannot be executed in production environment for safety reasons.');
                CLI::write('If you really need to run this command in production, use the --force-production flag.', 'yellow');
                CLI::write('WARNING: This will delete ALL data in your database!', 'red');
                return;
            }
            
            CLI::write('WARNING: Running database wipe in PRODUCTION environment!', 'red');
            CLI::write('All data will be permanently deleted!', 'red');
        }
        
        $force = array_key_exists('force', $params) || CLI::getOption('force');

        if (!$force && !CLI::prompt('Are you sure you want to wipe all tables? This cannot be undone', ['y', 'n']) === 'y') {
            CLI::write('Operation aborted.', 'yellow');
            return;
        }

        try {
            $db = Database::connect();
            $prefix = $db->getPrefix();
            
            // Get all tables
            $tables = $db->listTables();
            
            if (empty($tables)) {
                CLI::write('No tables found in the database.', 'yellow');
                return;
            }
            
            // Disable foreign key checks first
            $db->query('SET FOREIGN_KEY_CHECKS = 0');
            
            CLI::write('Dropping tables...', 'yellow');
            
            foreach ($tables as $table) {
                
                $db->query("DROP TABLE IF EXISTS `{$table}`");
                CLI::write("Dropped table: {$table}", 'green');
            }
            
            // Re-enable foreign key checks
            $db->query('SET FOREIGN_KEY_CHECKS = 1');
            
            CLI::write('All tables have been dropped successfully.', 'green');
        } catch (\Exception $e) {
            CLI::error($e->getMessage());
        }
    }
}
