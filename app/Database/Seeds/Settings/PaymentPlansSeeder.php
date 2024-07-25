<?php

namespace App\Database\Seeds\Settings;

use CodeIgniter\Database\Seeder;

class PaymentPlansSeeder extends Seeder
{
    public function run()
    {

    $data = [
        ['payment_plan_name' => 'Down payment'],
        ['payment_plan_name' => 'Construction-linked plan'],
        ['payment_plan_name' => 'Flexi payment plan'],
        ['payment_plan_name' => 'Time linked plan'],
        ['payment_plan_name' => 'Deferred payment plan'],
        ['payment_plan_name' => 'Payment in inaugurations until handover'],
        ['payment_plan_name' => 'Advantages of investing in off-plan properties'],
        ['payment_plan_name' => 'Rent-to-own payments'],
       ];


         $this->db->table('paymentplans')->insertBatch($data);
    }
}
