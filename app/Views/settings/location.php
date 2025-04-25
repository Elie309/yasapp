<div class="container-main">
    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Location Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md w-full overflow-auto">
        <?php $tableHeaders = [ // Corrected variable name
            'country_name' => 'Country Name',
            'region_name' => 'Region Name',
            'subregion_name' => 'Subregion Name',
            'city_names' => 'Cities'
        ];
        ?>
        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'location_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $data_location,
                'addButtonModelId' => '',
                'dataRowActive' =>false,
                'AddButtonName' => 'Edit Locations',
                'addButtonRedirectLink' => 'locations/add',
                'isOnClickRowActive' => false,
                'modelIdOnClickRow' => '',
                'addButtonModelAdditionalFn' => '',
                'JSFunctionToRunOnClickRow' => '', 
                'classOnClickRow' => '',
                'isStyleOnHoverDisabled' => true,
            ]
        ) ?>
    </div>
</div>
</div>