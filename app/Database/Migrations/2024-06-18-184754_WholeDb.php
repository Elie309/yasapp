<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WholeDb extends Migration
{
    public function up()
    {
        // Path to your SQL file
        $filePath = APPPATH . "Database/DATABASE.sql";

        $sql = file_get_contents($filePath);

        // Split the SQL file into individual queries
        $queries = array_filter(array_map('trim', explode(';', $sql)));

        foreach ($queries as $query) {
            if (!empty($query)) {
                $this->db->query($query);
            }
        }
    }

    public function down()
    {
        // Drop the whole database
        // We would rather not do this in production
        //$this->db->query('DROP DATABASE IF EXISTS `yasapp`');
    }
}
