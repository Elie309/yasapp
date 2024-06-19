<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class SettingsCell extends Cell
{
    
    public $settings = [
        [
            'url' => '/settings/location',
            'img' => 'https://via.placeholder.com/300x150',
            'title' => 'Location',
            'description' => 'Manage Countries, Regions, Subregions, and Cities.',
        ],
        [
            'url' => '/settings/payment-plans',
            'img' => 'https://via.placeholder.com/300x150',
            'title' => 'Payment Plans',
            'description' => 'Manage Payment Plans Availability.',
        ],
        [
            'url' => '/settings/currencies',
            'img' => 'https://via.placeholder.com/300x150',
            'title' => 'Currencies',
            'description' => 'Manage Currencies.',
        ],
        [
            'url' => '/settings/employee',
            'img' => 'https://via.placeholder.com/300x150',
            'title' => 'Employee',
            'description' => 'Register Employees and Assign Roles.',
        ],
    ];

   
}
