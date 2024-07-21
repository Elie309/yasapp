<?php

namespace App\Cells\Settings\Currencies;

use CodeIgniter\View\Cells\Cell;

class CurrenciesCell extends Cell
{
    public $title = "Currency";
    public $linkPostAdd = "/settings/currencies/add-currency";
    public $linkPostEdit = "/settings/currencies/edit-currency";
    public $linkPostDelete = "/settings/currencies/delete-currency";

    public $selectedOptions = [];

    public $formGetter;

    public $inputFormName = "currency_name";
    public $inputFormId = "currency_id";


    public function formEdit(){
        return view_cell('Settings/Currencies/CurrenciesCell::render', ['formGetter' => 'edit']);

    }

    public function formDelete(){
        return view_cell('Settings/Currencies/CurrenciesCell::render', ['formGetter' => 'delete']);
    }

    public function formAdd(){
        return view_cell('Settings/Currencies/CurrenciesCell::render', ['formGetter' => 'add']);
    }


}
