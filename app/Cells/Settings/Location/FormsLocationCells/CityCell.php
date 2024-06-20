<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CityCell extends LocationTemplateFormCell
{
    public $title = "City";
    public $linkPost = "/add-city";

    public $selectFormName = "Subregion";
    public $selectFormId = "subregion_name";

    public $selectOptions = [
        ['id' => 1, 'name' => 'Lebanon'],
        ['id' => 2, 'name' => 'USA'],
        ['id' => 3, 'name' => 'Canada'],
    ];

    public $inputFormName = "City";
    public $inputFormId = "city_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";


}
