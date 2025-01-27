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

        // Under construction - Ready to move - Pre-booking - Pre sales
        $property_status = [
            ['property_status_name' => 'Under Construction'],
            ['property_status_name' => 'Pre Booking'],
            ['property_status_name' => 'Pre Sales'],
            ['property_status_name' => 'Ready to move'],
           
        ];

        $property_types = [
            ['property_type_name' => 'Luxury'],
            ['property_type_name' => 'Bad'],
            ['property_type_name' => 'High-end'],
            ['property_type_name' => 'Mid-range'],
            ['property_type_name' => 'Low-end'],
            ['property_type_name' => 'Affordable'],
            ['property_type_name' => 'Cheap'],
            ['property_type_name' => 'Expensive'],
            ['property_type_name' => 'Economic'],
            ['property_type_name' => 'Budget'],
            ['property_type_name' => 'Premium'],
            ['property_type_name' => 'Standard'],
            ['property_type_name' => 'Deluxe'],
            ['property_type_name' => 'Executive'],
            ['property_type_name' => 'Elegant'],
            ['property_type_name' => 'Stylish'],
            ['property_type_name' => 'Modern'],
            ['property_type_name' => 'Contemporary'],
            ['property_type_name' => 'Traditional'],
                        
        ];

        $this->db->table('apartment_gender')->insertBatch($apartmentsGender);
        $this->db->table('property_status')->insertBatch($property_status);
        $this->db->table('property_type')->insertBatch($property_types);


    }
}

