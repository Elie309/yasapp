<?php

namespace App\Cells\Utils\Powergrid;

use CodeIgniter\View\Cells\Cell;

class PowergridCell extends Cell
{

    public $tableId;

    public $tableHeaders ;
    
    public $tableData;

    // Button details
    public $AddButtonName;
    public $addButtonModelId;


    public $JSFunctionToRunOnClick;

}
