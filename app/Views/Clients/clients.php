<div class="container-main">
    <h2 class="main-title-page">Clients List</h2>
    <div class="mt-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?php $tableHeaders = [
            'client_id' => 'ID',
            'client_firstname' => 'First Name',
            'client_lastname' => 'Last Name',
            'client_email' => 'Email',
            'client_visibility' => 'Visibility',
            'phone_numbers' => 'Phones',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

        ];

        $actions = [
            [
                'name' => 'Edit',
                'functions' => "redirectToWithId('clients/edit');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>',
                'class' => 'hover:stroke-blue-500 hover:text-blue-500'
            ]
        ];
        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'client_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $clients,
                'addButtonModelId' => '',
                'addButtonRedirectLink' => 'clients/add',
                'AddButtonName' => 'Add Client',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '',
                'classOnClickRow' => '',
                'actions' => $actions,
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'searchParam' => [
                    'firstname' => 'First Name',
                    'lastname' => 'Last Name',
                    'email' => 'Email',
                    'visibility' => 'Visibility',
                    'phone_number' => 'Phones',
                ],

            ]
        ) ?>

        <?php if (isset($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>

    </div>
</div>