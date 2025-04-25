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
        $currencyIds = $this->db->table('currencies')->select('currency_id')->get()->getResultArray();

        $employeeIds = $this->db->table('employees')->select('employee_id')->get()->getResultArray();

        //Get EmployeeSubregion data
        $employeeSubregionData = $this->db->table('employee_subregions')->get()->getResultArray();

        //Get subregions ID for each employee
        $SubregionIds = [];
        foreach ($employeeSubregionData as $employeeSubregion) {
            $SubregionIds[$employeeSubregion['employee_id']][] = $employeeSubregion['subregion_id'];
        }

        //Get all cities and their IDs
        $cityIds = [];

        //Merge array of cities and subregions depending on the subregionsIds (do not add non-existing subregions)
        foreach ($SubregionIds as $employeeId => $subregionIds) {
            $cities = $this->db->table('cities')->whereIn('subregion_id', $subregionIds)->select('city_id')->get()->getResultArray();
            foreach ($cities as $city) {
                $cityIds[$employeeId][] = $city['city_id'];
            }
        }



        // Seed Requests
        $requests = [];
        for ($i = 0; $i < 200; $i++) {

            //Random Employee
            $employeeId = $faker->randomElement($employeeIds)['employee_id'];
            $cityId = $faker->randomElement($cityIds[$employeeId]);

            $requests[] = [
                'client_id' => $faker->randomElement($clientIds)['client_id'],
                'currency_id' => $faker->randomElement($currencyIds)['currency_id'],

                'agent_id' => $employeeId,
                'city_id' => $cityId,

                'request_payment_plan' => $faker->randomElement(['cash to be paid directly', 'installments for over 30 years', 'loan from bank', 'other']),
                'request_location' => $faker->address(),
                'request_budget' => $faker->randomFloat(2, 10000, 1000000),
                'request_state' => $faker->randomElement(['pending', 'finishing', 'rejected', 'cancelled', 'on-hold', 'on-track']),
                'request_priority' => $faker->randomElement(['low', 'medium', 'high']),
                'request_comments' => $faker->text(),
            ];
        }

        $this->db->table('requests')->insertBatch($requests);
    }
}
