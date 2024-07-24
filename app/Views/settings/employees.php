<div class="container-main">
    <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Employees Overview</h2>


    <?php if (session()->has('errors')) : ?>
        <div class="error-div" role="alert">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')) : ?>
        <div class="success-div" role="alert">
            <p><?= esc(session('success')) ?></p>
        </div>
    <?php endif; ?>

    <div class="mt-8 bg-white p-10 shadow-md rounded-md">
        <?php $tableHeaders = [ // Corrected variable name
            'employee_id' => 'ID',
            'employee_name' => 'Name',
            'employee_email' => 'Email',
            'employee_phone' => 'Phone',
            'employee_address' => 'Address',
            'employee_birthday' => 'Birthday',
            'employee_role' => 'Role',
            'employee_status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
        ?>
        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'employee_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $employeeData,
                'addButtonModelId' => 'EditEmployee',
                'AddButtonName' => 'Add Employee',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'EditEmployee',
                'addButtonModelAdditionalFn' => 'clearFormDetails();',
                'JSFunctionToRunOnClickRow' => 'setFormDetails();', //This function is present on the EditEmployee modal
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>
    </div>
</div>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditEmployee',
    'modalTitle' => 'Edit Employee',
    'modalBody' => view_cell('App\Cells\Settings\Employee\EmployeeFormCell::render')
]) ?>