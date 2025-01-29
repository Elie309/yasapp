<?php

namespace App\Models\Notifications;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'notification_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Notifications\NotificationEntity::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'notification_id',
        'employee_id',
        'notification_title',
        'notification_message',
        'notification_type',
        'notification_status',
        'notification_link'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'notification_id' => 'int',
        'employee_id' => 'int',
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'notification_created_at';
    protected $updatedField  = 'notification_updated_at';
    protected $deletedField  = 'notification_deleted_at';

    // Validation
    protected $validationRules      = [
        'notification_id' => 'integer|permit_empty',
        'employee_id' => 'required|integer',
        'notification_title' => 'required|string|max_length[255]',
        'notification_message' => 'required|string',
        'notification_type' => 'required|in_list[info,warning,error]',
        'notification_status' => 'required|in_list[read,unread]',
        'notification_link' => 'permit_empty|string|valid_url'
    ];
    protected $validationMessages   = [
        'employee_id' => [
            'required' => 'Employee ID is required',
            'integer' => 'Employee ID must be an integer'
        ],
        'notification_title' => [
            'required' => 'Notification title is required',
            'string' => 'Notification title must be a string',
            'max_length' => 'Notification title must not exceed 255 characters'
        ],
        'notification_message' => [
            'required' => 'Notification message is required',
            'string' => 'Notification message must be a string'
        ],
        'notification_type' => [
            'required' => 'Notification type is required',
            'in_list' => 'Notification type must be either info, warning or error'
        ],
        'notification_status' => [
            'required' => 'Notification status is required',
            'in_list' => 'Notification status must be either read or unread'
        ],
        'notification_link' => [
            'valid_url' => 'Notification link must be a valid URL'
        ]

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
