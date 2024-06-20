<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class SubregionCell extends LocationTemplateFormCell
{
    public $title = "Subregion";
    public $linkPost = "/add-subregion";

    public $selectFormName = "Region";
    public $selectFormId = "region_id";

    public $selectOptions = [
        ['id' => 1, 'name' => 'Lebanon'],
        ['id' => 2, 'name' => 'USA'],
        ['id' => 3, 'name' => 'Canada'],
    ];

    public $inputFormName = "Subregion";
    public $inputFormId = "subregion_name";

    protected string $view = APPPATH . "Cells/Settings/Location/location_template_form.php";

}
