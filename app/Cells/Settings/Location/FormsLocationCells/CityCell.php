<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CityCell extends LocationTemplateFormCell
{
    public $title = "City";
    public $linkPostAdd = "/settings/locations/add-city";
    public $linkPostEdit = "/settings/locations/edit-city";
    public $linkPostDelete = "/settings/locations/delete-city";

    public $selectFormName = "Subregion";
    public $selectFormId = "subregion_id";

    public $selectOptionsParent = [];
    public $selectedOptionsCurrent = [];

    public $inputFormName = "city_name";
    public $inputFormId = "city_id";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";


}
