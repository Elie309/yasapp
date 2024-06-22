<?php
namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class RegionCell extends LocationTemplateFormCell
{
    public $title = "Region";
    public $linkPost = "/settings/location/add-region";

    public $selectFormName = "Country";
    public $selectFormId = "country_id";

    public $selectOptions = [];

    public $inputFormName = "Region";
    public $inputFormId = "region_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

    public function __construct($countries)
    {
        $this->selectOptions = $countries;
    }
}
