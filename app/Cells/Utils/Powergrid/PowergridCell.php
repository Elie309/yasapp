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
    public $addButtonRedirectLink;
    public $addButtonModelAdditionalFn;

    public $isOnClickRowActive;
    public $modelIdOnClickRow;
    public $JSFunctionToRunOnClickRow;
    public $classOnClickRow;
    
    public $redirectOnClickRow;
    public $dataRowActive;
    public $id_field;

    public $actions = [];

    public $rowsPerPageActive;
    public $searchParamActive;
    public $searchParam;
    
    public $isStyleOnHoverDisabled;


    


    public $exportToExcelLink;
    

}
