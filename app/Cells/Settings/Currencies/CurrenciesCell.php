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

    public $inputFormName = "currency_name";
    public $inputFormId = "currency_id";
}
