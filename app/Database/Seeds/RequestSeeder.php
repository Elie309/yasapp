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
        $paymentPlanIds = $this->db->table('paymentplans')->select('payment_plan_id')->get()->getResultArray();
        $currencyIds = $this->db->table('currencies')->select('currency_id')->get()->getResultArray();
        $employeeIds = $this->db->table('employees')->select('employee_id')->get()->getResultArray();

        // Seed Requests
        $requests = [];
        for ($i = 0; $i < 20; $i++) {
            $requests[] = [
                'client_id' => $faker->randomElement($clientIds)['client_id'],
                'city_id' => $faker->randomElement($cityIds)['city_id'],
                'payment_plan_id' => $faker->randomElement($paymentPlanIds)['payment_plan_id'],
                'currency_id' => $faker->randomElement($currencyIds)['currency_id'],
                'employee_id' => $faker->randomElement($employeeIds)['employee_id'],
                'request_location' => $faker->address,
                'request_visibility' => $faker->randomElement(['public', 'private']),
                'request_budget' => $faker->randomFloat(2, 10000, 1000000),
                'request_state' => $faker->randomElement(['pending', 'fulfilled', 'rejected', 'cancelled']),
                'request_priority' => $faker->randomElement(['low', 'medium', 'high']),
                'request_type' => $faker->randomElement(['normal', 'urgent']),
                'comments' => $faker->text,
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ];
        }

        $this->db->table('requests')->insertBatch($requests);
    }
}