<?php

namespace App\Entities\Settings;

use CodeIgniter\Entity\Entity;

class BackupLogsEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'backup_created_at',
        'backup_updated_at',
        'backup_deleted_at'
    ];
    protected $casts   = [];
}
