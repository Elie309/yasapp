<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CountryCell extends LocationTemplateFormCell
{
    public $title = "Country";
    public $linkPost = "/settings/location/add-country";

    public $selectFormName = "Country";
    public $selectFormId = "country_id";


    public $inputFormName = "Country";
    public $inputFormId = "country_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

}
