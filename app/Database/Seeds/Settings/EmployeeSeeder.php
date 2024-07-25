<?php

namespace App\Database\Seeds\Settings;

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
                'employee_email'     => 'admin@admin.com',
                'employee_phone'     => '1234567890',
                'employee_birthday'  => $faker->date,
                'employee_address'   => $faker->address,
                'employee_status'    => 'active',

            ],
            [
                'employee_name'   => 'user',
                'employee_password'   => password_hash('user123', PASSWORD_BCRYPT),
                'employee_role'       => 'user',
                'employee_email'     => 'user@user.com',
                'employee_phone'     => '123456780',
                'employee_birthday'  => $faker->date,
                'employee_address'   => $faker->address,
                'employee_status'    => 'active',

            ],
        ];

        $this->db->table('employees')->insertBatch($data);

    }
}

