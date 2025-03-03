<div class="container-main">
    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Currencies Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <!-- TABLE SHOW CURRENT PRODUCT -->

    <div class="my-8 bg-white p-10 shadow-md rounded-md">

        <?php $tableHeaders = [ // Corrected variable name
            'currency_id' => 'ID',
            'currency_name' => 'Currency Name',
            'currency_code' => 'Currency Code',
            'currency_symbol' => 'Currency Symbol',
        ];

        $actions = [
            [
                'name' => 'Edit',
                'popovertarget' => 'EditCurrencies',
                'functions' => "setFormDetails('edit');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>',
                'class' => 'hover:stroke-blue-500 hover:text-blue-500'
            ],
            [
                'name' => 'Delete',
                'popovertarget' => 'DeleteCurrencies',
                'functions' => "setFormDetails('delete');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                            </svg>',
                'class' => 'hover:stroke-red-500 hover:text-red-500'
            ],
        ];
        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'currency_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $currencies,
                'addButtonModelId' => 'AddCurrencies',
                'AddButtonName' => 'Add Currency',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '', //This function is present in the form cell of currencies
                'classOnClickRow' => '',
                'actions' => $actions,

            ]
        ) ?>

    </div>
</div>

<div popover class="popover max-w-lg" id="AddCurrencies">
    <?= view_cell('App\Cells\Settings\Currencies\CurrenciesCell::formAdd') ?>
</div>

<div popover class="popover max-w-lg" id="EditCurrencies">
    <?= view_cell('App\Cells\Settings\Currencies\CurrenciesCell::formEdit') ?>
</div>

<div popover class="popover max-w-lg" id="DeleteCurrencies">
    <?= view_cell('App\Cells\Settings\Currencies\CurrenciesCell::formDelete') ?>
</div>