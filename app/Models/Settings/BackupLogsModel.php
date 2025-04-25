<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class BackupLogsModel extends Model
{
    protected $table            = 'backup_logs';
    protected $primaryKey       = 'backup_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Settings\BackupLogsEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'backup_name',
        'backup_file_size',
        'backup_file_path',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'backup_created_at';
    protected $updatedField  = 'backup_updated_at';
    protected $deletedField  = 'backup_deleted_at';

    // Validation
    protected $validationRules      = [
        'backup_name' => 'required|string|max_length[255]',
        'backup_file_size' => 'required|numeric',
        'backup_file_path' => 'required|string',
    ];
    protected $validationMessages   = [
        'backup_name' => [
            'required' => 'Backup name is required',
            'string' => 'Backup name must be a string',
            'max_length' => 'Backup name must be less than 255 characters',
        ],
        'backup_file_size' => [
            'required' => 'Backup file size is required',
            'numeric' => 'Backup file size must be a number',
        ],
        'backup_file_path' => [
            'required' => 'Backup file path is required',
            'string' => 'Backup file path must be a string',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
