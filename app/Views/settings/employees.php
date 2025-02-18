<div class="container-main">
    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Employees Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md">
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
                'addButtonModelId' => 'AddEmployee',
                'AddButtonName' => 'Add Employee',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'AddEmployee',
                'addButtonModelAdditionalFn' => 'clearFormDetails();',
                'JSFunctionToRunOnClickRow' => 'setFormDetails();', //This function is present on the EditEmployee modal
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>
    </div>
</div>

<div popover class="popover max-w-2xl" id="AddEmployee">
    <?= view_cell('App\Cells\Settings\Employee\EmployeeFormCell::render') ?>
</div>