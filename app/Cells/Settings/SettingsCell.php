<?php

namespace App\Cells\Settings;

use CodeIgniter\View\Cells\Cell;

class SettingsCell extends Cell
{

    public $settings = [
        [
            'url' => '/settings/locations',
            'img' => "/images/location.webp",
            'title' => 'Location',
            'description' => 'Manage Countries, Regions, Subregions, and Cities.',
        ],
        [
            'url' => '/settings/payment-plans',
            'img' => '/images/payment_plan.webp',
            'title' => 'Payment Plans',
            'description' => 'Manage Payment Plans Availability.',
        ],
        [
            'url' => '/settings/currencies',
            'img' => '/images/currencies.webp',
            'title' => 'Currencies',
            'description' => 'Manage Currencies.',
        ],
        [
            'url' => '/settings/employees',
            'img' => '/images/employee_ill.webp',
            'title' => 'Employee',
            'description' => 'Register Employees and Assign Roles.',
        ],
    ];

   
}
