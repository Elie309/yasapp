<?php
namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class RegionCell extends LocationTemplateFormCell
{
    public $title = "Region";
    public $linkPost = "/add-region";

    public $selectFormName = "Country";
    public $selectFormId = "country_id";

    public $selectOptions = [
        ['id' => 1, 'name' => 'Lebanon'],
        ['id' => 2, 'name' => 'USA'],
        ['id' => 3, 'name' => 'Canada'],
    ];

    public $inputFormName = "Region";
    public $inputFormId = "region_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

}
