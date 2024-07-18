<?php

namespace App\Cells\Utils\Powergrid;

use CodeIgniter\View\Cells\Cell;

class PowergridCell extends Cell
{
    // Create variable with the name of the table header
    public $tableHeader = [
        'ID',
        'Name',
        'Email',
        'Phone',
        'Address',
        'City',
        'Country',
        'Postal Code',
        'Created At',
        'Updated At',
        'Actions'
    ];

    // Create variable with the name of the table data
    public $tableData = [];

}
