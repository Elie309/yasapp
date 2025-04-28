<?php

namespace Config;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\Commands;

class CommandsConfig extends \CodeIgniter\Config\BaseConfig
{
    /**
     * The Commands to register.
     *
     * @var array<string, string>
     */
    public array $commands = [
        'db:wipe' => \App\Commands\DbWipe::class,
        'db:backup' => \App\Commands\DbBackup::class,
    ];
}