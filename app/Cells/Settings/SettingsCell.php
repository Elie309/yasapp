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
            'role' => ['admin', 'manager', 'user']
        ],
        [
            'url' => '/settings/payment-plans',
            'img' => '/images/payment_plan.webp',
            'title' => 'Payment Plans',
            'description' => 'Manage Payment Plans Availability.',
            'role' => ['admin']
        ],
        [
            'url' => '/settings/currencies',
            'img' => '/images/currencies.webp',
            'title' => 'Currencies',
            'description' => 'Manage Currencies.',
            'role' => ['admin']
        ],
        [
            'url' => '/settings/employees',
            'img' => '/images/employee_ill.webp',
            'title' => 'Employee',
            'description' => 'Register Employees and Assign Roles.',
            'role' => ['admin']
        ],
        [
            'url' => '/settings/profile',
            'img' => '/images/profile_ill.svg',
            'title' => 'Profile',
            'description' => 'Update your Profile.',
        ],
        [
            'url' => '/settings/listings-attributes/property-status',
            'img' => '/images/listings_attributes.webp',
            'title' => 'Listings Attributes',
            'description' => 'Manage Listings Attributes.',
            'role' => ['admin', 'manager']
        ]
    ];

    //Get roll
    public function getRole()
    {
        $session = service('session');
        $role = $session->get('role');
        return $role;
    }



   
}
