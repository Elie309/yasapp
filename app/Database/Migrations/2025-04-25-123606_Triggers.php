<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Triggers extends Migration
{
    public function up()
    {
        // Trigger for requests
        $this->db->query("
            CREATE TRIGGER trg_before_insert_requests
            BEFORE INSERT ON requests
            FOR EACH ROW
            BEGIN
                DECLARE current_year CHAR(4);
                DECLARE next_id INT;
                DECLARE new_code VARCHAR(20);

                SET current_year = YEAR(NOW());

                SELECT COUNT(*) + 1 INTO next_id
                FROM requests
                WHERE YEAR(request_created_at) = current_year;

                SET new_code = CONCAT(current_year, '-', LPAD(next_id, 4, '0'));

                SET NEW.request_code = new_code;
            END
        ");

        // Trigger for properties
        $this->db->query("
            CREATE TRIGGER trg_before_insert_properties
            BEFORE INSERT ON properties
            FOR EACH ROW
            BEGIN
                DECLARE current_year CHAR(4);
                DECLARE next_id INT;
                DECLARE new_code VARCHAR(20);

                SET current_year = YEAR(NOW());

                SELECT COUNT(*) + 1 INTO next_id
                FROM properties
                WHERE YEAR(created_at) = current_year;

                SET new_code = CONCAT(current_year, '-', LPAD(next_id, 4, '0'));

                SET NEW.property_code = new_code;
            END
        ");
    }

    public function down()
    {
        // Drop triggers if they exist
        $this->db->query("DROP TRIGGER IF EXISTS trg_before_insert_requests");
        $this->db->query("DROP TRIGGER IF EXISTS trg_before_insert_properties");
    }
}
