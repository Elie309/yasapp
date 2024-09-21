<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;


class ClientSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $clients = [];
        for ($i = 0; $i < 100; $i++) {
            $clients[] = [
                'client_firstname' => $faker->firstName,
                'client_lastname' => $faker->lastName,
                'client_email' => $faker->email,
                'employee_id' => $faker->numberBetween(1, 3),
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('clients')->insertBatch($clients);

        // Get client IDs
        $clientIds = $this->db->table('clients')->select('client_id')->get()->getResultArray();

        // Seed Phones
        $phones = [];
        foreach ($clientIds as $clientId) {

            //Generate random number of phones for each client
            $phoneCount = $faker->numberBetween(1, 3);
            for ($i = 0; $i < $phoneCount; $i++) {
                $phones[] = [
                    'client_id' => $clientId['client_id'],
                    'country_id' => $faker->numberBetween(1, 4),
                    'phone_number' => $faker->phoneNumber,
                ];
            }
        }

        $this->db->table('phones')->insertBatch($phones);
    }
}
