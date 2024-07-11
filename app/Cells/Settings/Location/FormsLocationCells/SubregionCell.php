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

    public $selectOptions = [];

    public $inputFormName = "Subregion";
    public $inputFormId = "subregion_name";

    protected string $view = APPPATH . "Cells/Settings/Location/location_template_form.php";

    public function __construct()
    {
        $regionModel = new RegionModel();
        $regions = $regionModel->findAll();

        foreach ($regions as $region) {
            $this->selectOptions[] = [
                'id' => $region->region_id,
                'name' => $region->region_name
            ];
        }
    }

}
