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
                'name'   => 'admin',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'admin',
            ],
            [
                'name'   => 'user',
                'password'   => password_hash('user123', PASSWORD_BCRYPT),
                'role'       => 'user',
            ],
        ];

        // Generate additional fake data
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'   => $faker->unique()->userName,
                'password'   => password_hash($faker->password, PASSWORD_BCRYPT),
                'role'       => 'user',
            ];
        }
        
        $this->db->table('employee')->insertBatch($data);
    }
}

