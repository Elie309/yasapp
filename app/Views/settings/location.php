<div class="container-main">
    <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Location Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="mt-8 bg-white p-10 shadow-md rounded-md w-full overflow-auto">
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
                'AddButtonName' => 'Add Location',
                'addButtonRedirectLink' => 'location/add',
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