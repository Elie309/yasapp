<?php

namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;
use App\Models\Location\CountryModel;

class CountryCell extends LocationTemplateFormCell
{
    public $title = "Country";
    public $linkPostAdd = "/settings/location/add-country";
    public $linkPostEdit = "/settings/location/edit-country";
    public $linkPostDelete = "/settings/location/delete-country";

    public $selectOptions = [];
    

    public $selectFormName = "Country";
    public $selectFormId = "country_id";


    public $inputFormName = "Country";
    public $inputFormId = "country_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

    public function __construct()
    {
        $countryModel = new CountryModel();
        $countries = $countryModel->findAll();

        foreach ($countries as $subregion) {
            $this->selectOptions[] = [
                'id' => $subregion->subregion_id,
                'name' => $subregion->subregion_name
            ];
        }
    }

}
