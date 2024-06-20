<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CountryCell extends LocationTemplateFormCell
{
    public $title = "Country";
    public $linkPost = "/add-country";

    public $selectFormName = "Country";
    public $selectFormId = "country_id";

    public $selectOptions = [
        ['id' => 1, 'name' => 'Lebanon'],
        ['id' => 2, 'name' => 'USA'],
        ['id' => 3, 'name' => 'Canada'],
    ];

    public $inputFormName = "Country";
    public $inputFormId = "country_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

}
