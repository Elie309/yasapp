<?php

namespace App\Database\Seeds\Settings;

use CodeIgniter\Database\Seeder;


class ListingsAttributesSeeder extends Seeder
{
    public function run()
    {

        $apartmentsGender = [
            [ 'apartment_gender_name' => 'Apartment'],
            [ 'apartment_gender_name' => 'Penthouse'],
            [ 'apartment_gender_name' => 'Studio'],
            [ 'apartment_gender_name' => 'Loft'],
            [ 'apartment_gender_name' => 'Condo'],
            [ 'apartment_gender_name' => 'Townhouse'],
            [ 'apartment_gender_name' => 'House'],
            [ 'apartment_gender_name' => 'Villa'],
            [ 'apartment_gender_name' => 'Cottage'],
            [ 'apartment_gender_name' => 'Bungalow'],
            [ 'apartment_gender_name' => 'Mansion'],
            [ 'apartment_gender_name' => 'Castle'],
            [ 'apartment_gender_name' => 'Farmhouse'],
            [ 'apartment_gender_name' => 'Ranch'],
            [ 'apartment_gender_name' => 'Cabin'],
            [ 'apartment_gender_name' => 'Chalet'],
            [ 'apartment_gender_name' => 'Mobile Home'],
            [ 'apartment_gender_name' => 'Boat'],
            [ 'apartment_gender_name' => 'Depot'],
            [ 'apartment_gender_name' => 'Shop'],
            [ 'apartment_gender_name' => 'Office'],
            [ 'apartment_gender_name' => 'Warehouse'],
            [ 'apartment_gender_name' => 'Garage'],
            [ 'apartment_gender_name' => 'Other']
        ];

        // Under construction - Ready to move - Pre-booking - Pre sales - Sold - Rented - Available - Unavailable
        $property_status = [
            ['property_status_name' => 'Under Construction'],
            ['property_status_name' => 'Pre Booking'],
            ['property_status_name' => 'Pre Sales'],
            ['property_status_name' => 'Ready to move'],
            ['property_status_name' => 'Sold'],
            ['property_status_name' => 'Rented'],
            ['property_status_name' => 'Available'],
            ['property_status_name' => 'Unavailable'],
            ['property_status_name' => 'Other'],
           
        ];

        $this->db->table('apartment_gender')->insertBatch($apartmentsGender);
        $this->db->table('property_status')->insertBatch($property_status);


    }
}

