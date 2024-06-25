<?php
namespace App\Cells\Settings\Location\FormsLocationCells;

use App\Cells\Settings\Location\LocationTemplateFormCell;
use App\Models\Location\CountryModel;

class RegionCell extends LocationTemplateFormCell
{
    public $title = "Region";
    public $linkPost = "/settings/location/add-region";

    public $selectFormName = "Country";
    public $selectFormId = "country_id";

    public $selectOptions = [];

    public $inputFormName = "Region";
    public $inputFormId = "region_name";

    protected string $view = APPPATH. "Cells/Settings/Location/location_template_form.php";

    public function __construct()
    {
        $countryModel = new CountryModel();
        $countries = $countryModel->findAll();

        foreach ($countries as $country) {
            $this->selectOptions[] = [
                'id' => $country->country_id,
                'name' => $country->country_name
            ];
        }
    }

}
