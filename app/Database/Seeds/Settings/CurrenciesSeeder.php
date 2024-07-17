<?php

namespace App\Database\Seeds\Settings;

use CodeIgniter\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'currency_code' => 'LBP',
                'currency_name' => 'Lebanese Pound',
                'currency_symbol' => 'L.L.',
            ],
            [
                'currency_code' => 'EUR',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
            ],
            [
                'currency_code' => 'USD',
                'currency_name' => 'United States Dollar',
                'currency_symbol' => '$',
            ],
        ];
    
        $this->db->table('currencies')->insertBatch($data);
    }
}
