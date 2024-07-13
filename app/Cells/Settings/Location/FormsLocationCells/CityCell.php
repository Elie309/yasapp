<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CityCell extends LocationTemplateFormCell
{
    public $title = "City";
    public $linkPostAdd = "/settings/location/add-city";
    public $linkPostEdit = "/settings/location/edit-city";
    public $linkPostDelete = "/settings/location/delete-city";

    public $selectFormName = "Subregion";
    public $selectFormId = "subregion_id";

    public $data_location = [];


    public $selectOptionsParent = [];
    public $selectedOptionsCurrent = [];

    public $inputFormName = "city_name";
    public $inputFormId = "city_id";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";


}
