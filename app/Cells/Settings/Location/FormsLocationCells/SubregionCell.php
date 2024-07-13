<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;
use App\Models\Location\RegionModel;

class SubregionCell extends LocationTemplateFormCell
{
    public $title = "Subregion";
    public $linkPostAdd = "/settings/location/add-subregion";
    public $linkPostEdit = "/settings/location/edit-subregion";
    public $linkPostDelete = "/settings/location/delete-subregion";

    public $selectFormName = "Region";
    public $selectFormId = "region_id";

    public $data_location = [];

    public $selectOptionsParent = [];
    public $selectedOptionsCurrent = [];

    public $inputFormName = "subregion_name";
    public $inputFormId = "subregion_id";

    protected string $view = APPPATH . "Cells/Settings/Location/location_template_form.php";


}
