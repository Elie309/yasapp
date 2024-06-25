<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;
use App\Models\Location\SubregionModel;

class CityCell extends LocationTemplateFormCell
{
    public $title = "City";
    public $linkPost = "/settings/location/add-city";

    public $selectFormName = "Subregion";
    public $selectFormId = "subregion_id";

    public $selectOptions = [];

    public $inputFormName = "City";
    public $inputFormId = "city_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";


    public function __construct()
    {
        $subregionModel = new SubregionModel();
        $subregions = $subregionModel->findAll();

        foreach ($subregions as $subregion) {
            $this->selectOptions[] = [
                'id' => $subregion->subregion_id,
                'name' => $subregion->subregion_name
            ];
        }
    }



}
