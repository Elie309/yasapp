<?php

namespace App\Entities\Uploads;

use CodeIgniter\Entity\Entity;

class PropertyUploadsEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'upload_created_at',
        'upload_updated_at',
        'upload_deleted_at',
    ];
    protected $casts   = [
        'upload_id' => 'integer',
        'property_id' => 'integer',
        'upload_file_size' => 'integer',
    ];
}
