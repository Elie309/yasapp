<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class CountryCell extends LocationTemplateFormCell
{
    public $title = "Country";
    public $linkPostAdd = "/settings/locations/add-country";
    public $linkPostEdit = "/settings/locations/edit-country";
    public $linkPostDelete = "/settings/locations/delete-country";

    public $selectedOptionsCurrent = [];

    public $selectFormName = "Country";
    public $selectFormId = "country_id";


    public $inputFormName = "country_name";
    public $inputFormId = "country_id";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

    public $searchLink = "/api/locations/get-countries";

}
