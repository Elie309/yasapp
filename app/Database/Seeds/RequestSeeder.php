<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class RequestSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Get existing IDs from related tables
        $clientIds = $this->db->table('clients')->select('client_id')->get()->getResultArray();
        $cityIds = $this->db->table('cities')->select('city_id')->get()->getResultArray();
        $currencyIds = $this->db->table('currencies')->select('currency_id')->get()->getResultArray();
        $employeeIds = $this->db->table('employees')->select('employee_id')->get()->getResultArray();

        // Seed Requests
        $requests = [];
        for ($i = 0; $i < 20; $i++) {
            $requests[] = [
                'client_id' => $faker->randomElement($clientIds)['client_id'],
                'city_id' => $faker->randomElement($cityIds)['city_id'],
                'currency_id' => $faker->randomElement($currencyIds)['currency_id'],
                'agent_id' => $faker->randomElement($employeeIds)['employee_id'],
                'request_payment_plan' => $faker->randomElement(['cash to be paid directly', 'installments for over 30 years', 'loan from bank', 'other']),
                'request_location' => $faker->address(),
                'request_budget' => $faker->randomFloat(2, 10000, 1000000),
                'request_state' => $faker->randomElement(['pending', 'finishing', 'rejected', 'cancelled', 'on-hold', 'on-track']),
                'request_priority' => $faker->randomElement(['low', 'medium', 'high']),
                'comments' => $faker->text(),
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ];
        }

        $this->db->table('requests')->insertBatch($requests);
    }
}