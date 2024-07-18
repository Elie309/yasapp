<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;


class SubregionCell extends LocationTemplateFormCell
{
    public $title = "Subregion";
    public $linkPostAdd = "/settings/locations/add-subregion";
    public $linkPostEdit = "/settings/locations/edit-subregion";
    public $linkPostDelete = "/settings/locations/delete-subregion";

    public $selectFormName = "Region";
    public $selectFormId = "region_id";

    public $selectOptionsParent = [];
    public $selectedOptionsCurrent = [];

    public $inputFormName = "subregion_name";
    public $inputFormId = "subregion_id";

    protected string $view = APPPATH . "Cells/Settings/Location/location_template_form.php";


}
