<?php

namespace App\Cells\Settings\Location\LocationTable;

use CodeIgniter\View\Cells\Cell;

class LocationTableCell extends Cell
{
    public $countries = [
        [
            'country_id' => 1,
            'country_name' => 'Lebanon',
            'regions' => [
                [
                    'region_id' => 1,
                    'region_name' => 'Beirut',
                    'subregions' => [
                        [
                            'subregion_id' => 1,
                            'subregion_name' => 'Beirut Subregion',
                            'cities' => [
                                ['city_id' => 1, 'city_name' => 'Beirut City'],
                                ['city_id' => 2, 'city_name' => 'Another City']
                            ]
                        ],
                        [
                            'subregion_id' => 2,
                            'subregion_name' => 'Other Subregion',
                            'cities' => []
                        ], [
                            'subregion_id' => 3,
                            'subregion_name' => 'Third Subregion',
                            'cities' => [
                                ['city_id' => 4, 'city_name' => '4th City']
                            ]
                        ]
                    ]
                ],
                [
                    'region_id' => 3,
                    'region_name' => 'Test',
                    'subregions' => [ ]
                ],
                [
                    'region_id' => 2,
                    'region_name' => 'Mount Lebanon',
                    'subregions' => [
                        [
                            'subregion_id' => 3,
                            'subregion_name' => 'Mount Lebanon Subregion',
                            'cities' => [
                                ['city_id' => 4, 'city_name' => 'City Four']
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'country_id' => 2,
            'country_name' => 'USA',
            'regions' => [
                [
                    'region_id' => 3,
                    'region_name' => 'California',
                    'subregions' => [
                        [
                            'subregion_id' => 4,
                            'subregion_name' => 'Southern California',
                            'cities' => [
                                ['city_id' => 5, 'city_name' => 'Los Angeles'],
                                ['city_id' => 6, 'city_name' => 'San Diego']
                            ]
                        ],
                        [
                            'subregion_id' => 5,
                            'subregion_name' => 'Northern California',
                            'cities' => [
                                ['city_id' => 7, 'city_name' => 'San Francisco'],
                                ['city_id' => 8, 'city_name' => 'Sacramento']
                            ]
                        ]
                    ]
                ],
                [
                    'region_id' => 4,
                    'region_name' => 'Texas',
                    'subregions' => [
                        [
                            'subregion_id' => 6,
                            'subregion_name' => 'Central Texas',
                            'cities' => [
                                ['city_id' => 9, 'city_name' => 'Austin'],
                                ['city_id' => 11, 'city_name' => 'TEST']
                            ]
                        ],
                        [
                            'subregion_id' => 7,
                            'subregion_name' => 'East Texas',
                            'cities' => [
                                ['city_id' => 10, 'city_name' => 'Houston']
                            ]
                        ]
                    ]
                ]
            ]
        ],
        // Add more countries, regions, subregions, and cities as needed
    ];
}
