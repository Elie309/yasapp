<?php
namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;

class RegionCell extends LocationTemplateFormCell
{
    public $title = "Region";
    public $linkPostAdd = "/settings/location/add-region";
    public $linkPostEdit = "/settings/location/edit-region";
    public $linkPostDelete = "/settings/location/delete-region";


    public $selectFormName = "Country";
    public $selectFormId = "country_id";

    public $selectOptionsParent = [];
    public $selectedOptionsCurrent = [];

    public $inputFormName = "region_name";
    public $inputFormId = "region_id";
    

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";


}
