<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Instantiate Faker
        $faker = Factory::create();

        //Get the client data
        $clientData = $this->db->table('clients')->get()->getResultArray();
        $paymentPlanData = $this->db->table('payment_plans')->get()->getResultArray();
        $propertyTypeData = $this->db->table('property_type')->get()->getResultArray();
        $propertyStatusData = $this->db->table('property_status')->get()->getResultArray();
        $apartmentGenderData = $this->db->table('apartment_gender')->get()->getResultArray();
        $currencyData = $this->db->table('currencies')->get()->getResultArray();

        // Seed data for 'properties', 'land_details', 'apartment_details', etc.
        for ($i = 0; $i < 50; $i++) {

            $client = $faker->randomElement($clientData);
            $propertyData = [
                'client_id' => $client['client_id'], // Get random client ID
                'employee_id' => $client['employee_id'], // Assuming employee ID is random
                'payment_plan_id' => $faker->randomElement($paymentPlanData)['payment_plan_id'], // Random payment plan ID
                'city_id' => $faker->numberBetween(1, 1000), // Random city ID
                'property_type_id' => $faker->randomElement($propertyTypeData)['property_type_id'], // Random property type
                'property_status_id' => $faker->randomElement($propertyStatusData)['property_status_id'], // Random property status
                'currency_id' => $faker->randomElement($currencyData)['currency_id'], // Random currency ID
                'property_location' => $faker->address,
                'property_referral_name' => $faker->name,
                'property_referral_phone' => $faker->phoneNumber,
                'property_rent_or_sale' => $faker->randomElement(['rent', 'sale', 'rent_sale']),
                'property_catch_phrase' => $faker->catchPhrase,
                'property_size' => $faker->randomFloat(2, 50, 500),
                'property_price' => $faker->randomFloat(2, 100000, 5000000),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];

            // Insert property data
            $this->db->table('properties')->insert($propertyData);
            $propertyId = $this->db->insertID();

            // Seed data for 'land_details' table
            if ($faker->boolean(40)) {
                $landData = [
                    'property_id' => $propertyId,
                    'land_type' => $faker->randomElement(['residential', 'industrial', 'commercial', 'agricultural', 'mixed', 'other']),
                    'land_zone_first' => $faker->randomFloat(2, 1, 10),
                    'land_zone_second' => $faker->randomFloat(2, 1, 10),
                    'land_extra_features' => $faker->sentence,
                ];

                $this->db->table('land_details')->insert($landData);
            }else {
                $apartmentData = [
                    'property_id' => $propertyId,
                    'ad_terrace' => $faker->boolean,
                    'ad_terrace_area' => $faker->numberBetween(0, 200),
                    'ad_roof' => $faker->boolean,
                    'ad_roof_area' => $faker->numberBetween(0, 200),
                    'ad_gender_id' => $faker->randomElement($apartmentGenderData)['apartment_gender_id'], // Random gender ID
                    'ad_furnished' => $faker->boolean,
                    'ad_furnished_on_provisions' => $faker->boolean,
                    'ad_elevator' => $faker->boolean,
                    'ad_status_age' => $faker->word,
                    'ad_floor_level' => $faker->numberBetween(1, 10),
                    'ad_apartments_per_floor' => $faker->numberBetween(1, 5),
                    'ad_view' => $faker->sentence,
                    'ad_type' => $faker->randomElement(['luxury', 'high-end', 'standard', 'bad']),
                    'ad_architecture_and_interior' => $faker->sentence,
                    'ad_extra_features' => $faker->sentence,
                ];

                $this->db->table('apartment_details')->insert($apartmentData);
                $apartmentId = $this->db->insertID();

                $partitionData = [
                    'apartment_id' => $apartmentId,
                    'partition_salon' => $faker->word,
                    'partition_dining' => $faker->word,
                    'partition_kitchen' => $faker->word,
                    'partition_master_bedroom' => $faker->word,
                    'partition_bedroom' => $faker->word,
                    'partition_bathroom' => $faker->word,
                    'partition_maid_room' => $faker->word,
                    'partition_reception_balcony' => $faker->word,
                    'partition_sitting_corner' => $faker->word,
                    'partition_balconies' => $faker->word,
                    'partition_parking' => $faker->word,
                    'partition_storage_room' => $faker->word,
                ];

                $this->db->table('apartment_partitions')->insert($partitionData);

                // Seed data for 'apartment_specifications'
                $specificationData = [
                    'apartment_id' => $apartmentId,
                    'spec_heating_system' => $faker->boolean,
                    'spec_heating_system_on_provisions' => $faker->boolean,
                    'spec_ac_system' => $faker->boolean,
                    'spec_ac_system_on_provisions' => $faker->boolean,
                    'spec_double_wall' => $faker->boolean,
                    'spec_double_glazing' => $faker->boolean,
                    'spec_shutters_electrical' => $faker->boolean,
                    'spec_tiles' => $faker->randomElement(['european', 'marble', 'granite', 'other']),
                    'spec_oak_doors' => $faker->boolean,
                    'spec_chimney' => $faker->boolean,
                    'spec_indirect_light' => $faker->boolean,
                    'spec_wood_panel_decoration' => $faker->boolean,
                    'spec_stone_panel_decoration' => $faker->boolean,
                    'spec_security_door' => $faker->boolean,
                    'spec_alarm_system' => $faker->boolean,
                    'spec_solar_heater' => $faker->boolean,
                    'spec_intercom' => $faker->boolean,
                    'spec_garage' => $faker->boolean,
                    'spec_extra_features' => $faker->sentence,
                ];

                $this->db->table('apartment_specifications')->insert($specificationData);
            }
        }
    }
}


?>