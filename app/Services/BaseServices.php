<?php
namespace App\Services;

class BaseServices
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
}
