<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\Settings\CurrenciesSeeder');
        $this->call('App\Database\Seeds\Settings\EmployeeSeeder');
        $this->call('App\Database\Seeds\Settings\LocationSeeder');
        $this->call('App\Database\Seeds\Settings\PaymentPlansSeeder');
        $this->call('App\Database\Seeds\Settings\ListingsAttributesSeeder');
        $this->call('App\Database\Seeds\ClientSeeder');
        $this->call('App\Database\Seeds\RequestSeeder');
    }
}
