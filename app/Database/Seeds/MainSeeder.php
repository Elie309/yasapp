<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        if (ENVIRONMENT === 'development') {
            // Seed all data for development
            $this->call('App\Database\Seeds\Settings\CurrenciesSeeder');
            $this->call('App\Database\Seeds\Settings\EmployeeSeeder');
            $this->call('App\Database\Seeds\Settings\LocationSeeder');
            $this->call('App\Database\Seeds\Settings\ListingsAttributesSeeder');
            $this->call('App\Database\Seeds\ClientSeeder');
            $this->call('App\Database\Seeds\RequestSeeder');
            $this->call('App\Database\Seeds\PropertySeeder');
            $this->call('App\Database\Seeds\NotificationSeeder');
        } else {
            // Seed only the necessary data for production
            $this->call('App\Database\Seeds\Settings\CurrenciesSeeder');
            $this->call('App\Database\Seeds\Settings\EmployeeSeeder');
            $this->call('App\Database\Seeds\Settings\LocationSeeder');
            $this->call('App\Database\Seeds\Settings\ListingsAttributesSeeder');
        }
    }
}
