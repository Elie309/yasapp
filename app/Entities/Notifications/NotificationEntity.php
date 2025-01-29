<?php

namespace App\Entities\Notifications;

use CodeIgniter\Entity\Entity;

class NotificationEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'notification_created_at', 
        'notification_updated_at', 
        'notification_deleted_at'
    ];
    protected $casts   = [];
}
