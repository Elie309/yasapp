<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;


class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [
            [
                'employee_name'   => 'admin',
                'employee_password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'employee_role'       => 'admin',
            ],
            [
                'employee_name'   => 'user',
                'employee_password'   => password_hash('user123', PASSWORD_BCRYPT),
                'employee_role'       => 'user',
            ],
        ];

        // Generate additional fake data
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'employee_name'   => $faker->unique()->userName,
                'employee_password'   => password_hash($faker->password, PASSWORD_BCRYPT),
                'employee_role'       => 'user',
            ];
        }
        
        $this->db->table('employees')->insertBatch($data);
    }
}

