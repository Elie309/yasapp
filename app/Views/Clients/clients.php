<div class="container-main">
    <h2 class="main-title-page">Clients List</h2>
    <div class="mt-8 bg-white p-10 shadow-md rounded-md">
        <?php $tableHeaders = [
            'client_id' => 'ID',
            'client_firstname' => 'FirstName',
            'client_lastname' => 'Lastname',
            'client_email' => 'Email',
            'client_visibility' => 'Visibility',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

        ];

        $actions = [];
        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'client_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $clients,
                'addButtonModelId' => 'ClientForm',
                'AddButtonName' => 'Add Client',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '',
                'classOnClickRow' => '',
                'actions' => $actions,

            ]
        ) ?>
    </div>
</div>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'ClientForm',
    'modalTitle' => 'Add Client',
    'modalBody' => view_cell('App\Cells\Clients\ClientFormCell::render', ['employee_id' => $employee_id, 'countries' => $countries]),
]) ?>
