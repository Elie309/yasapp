<?php

namespace App\Models\Uploads;

use CodeIgniter\Model;

class PropertyUploadsModel extends Model
{
    protected $table            = 'property_uploads';
    protected $primaryKey       = 'upload_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_id',
        'upload_file_name',
        'upload_file_type',
        'upload_mime_type',
        'upload_file_size',
        'upload_storage_url',
        'upload_status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'upload_id' => 'integer',
        'property_id' => 'integer',
        'file_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'upload_created_at';
    protected $updatedField  = 'upload_updated_at';
    protected $deletedField  = 'upload_deleted_at';

    // Validation
    protected $validationRules      = [
        'property_id' => 'required|integer',
        'upload_file_name' => 'required|string|max_length[255]',
        'upload_file_type' => 'required|in_list[image,video,document]',
        'upload_mime_type' => 'required|string|max_length[100]',
        'upload_file_size' => 'required|integer',
        'upload_storage_url' => 'required|string',
        'upload_status' => 'required|in_list[pending,uploaded,failed]'
    ];
    protected $validationMessages   = [
        'property_id' => [
            'required' => 'Property ID is required',
            'integer' => 'Property ID must be an integer'
        ],
        'upload_file_name' => [
            'required' => 'File name is required',
            'string' => 'File name must be a string',
            'max_length' => 'File name must not exceed 255 characters'
        ],
        'upload_file_type' => [
            'required' => 'File type is required',
            'in_list' => 'File type must be one of: image, video, document'
        ],
        'upload_mime_type' => [
            'required' => 'MIME type is required',
            'string' => 'MIME type must be a string',
            'max_length' => 'MIME type must not exceed 100 characters'
        ],
        'upload_file_size' => [
            'required' => 'File size is required',
            'integer' => 'File size must be an integer'
        ],
        'upload_storage_url' => [
            'required' => 'Storage URL is required',
            'string' => 'Storage URL must be a string'
        ],
        'upload_status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be one of: pending, uploaded, failed'
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
