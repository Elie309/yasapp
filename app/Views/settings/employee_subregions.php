<div class="container-main">
    <h1 class="text-4xl font-bold text-center mb-8">Employee Subregions</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Employee Subregions Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md">

        <?php $tableHeaders = [
            'employee_name' => 'Employee',
            'subregion_name' => 'Subregion',
        ];

        $actions = [
            [
                'name' => 'Delete',
                'popovertarget' => 'DeleteEmployeeSubregion',
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
                'tableId' => 'location_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $results,
                'addButtonModelId' => 'AddEmployeeSubregion',
                'AddButtonName' => 'Add Employee Subregion',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '',
                'classOnClickRow' => '',
                'actions' => $actions,
            ]
        ) ?>

    </div>

</div>


<div popover class="popover max-w-lg" id="AddEmployeeSubregion">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Add Employee Subregion</h2>
        <form action="<?= base_url('settings/employee-subregions/add') ?>" method="post">
            <div class=" mb-4">
                <label for="employee_id" class="main-label">Employee</label>
                <select name="employee_id" id="employee_id" class="main-input">
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee->employee_id ?>"><?= $employee->employee_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class=" mb-4">
                <label for="subregion_id" class="main-label">Subregion</label>
                <select name="subregion_id" id="subregion_id" class="main-input">
                    <?php foreach ($subregions as $subregion): ?>
                        <option value="<?= $subregion->subregion_id ?>"><?= $subregion->subregion_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end w-full">
                <button type="submit" class="secondary-btn w-1/4">Add</button>
            </div>
        </form>
    </div>
</div>


<div popover class="popover max-w-lg" id="DeleteEmployeeSubregion">
    <!-- GENERATE THE DELETE FORM -->
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Delete Employee Subregion</h2>
        <form action="<?= base_url('settings/employee-subregions/delete') ?>" method="post">

            <p class="text-lg font-semibold text-center">Are you sure you want to delete this Employee Subregion?</p>
            <div class="mt-4 text-gray-500 grid grid-cols-2 gap-2 w-1/2 mx-auto">
                <p>Employee:</p>
                <span id="employee_name"></span>
                <p>Subregion: </p>
                <span id="subregion_name"></span>
            </div>
            <input type="hidden" name="employee_subregions_id" id="employee_subregions_id" value="">
            <div class="flex justify-center w-full mt-4">
                <button type="button" class="primary-btn w-1/4 mr-4" onclick="closePopover('DeleteEmployeeSubregion')">Cancel</button>
                <button type="submit" class="secondary-btn w-1/4">Delete</button>
            </div>
        </form>



    </div>

    <script>
        function setFormDetails(action) {
            const data = JSON.parse(sessionStorage.getItem('tempTableData'));

            if (action === 'delete') {
                document.getElementById('employee_name').innerText = data.employee_name;
                document.getElementById('subregion_name').innerText = data.subregion_name;
                document.getElementById('employee_subregions_id').value = data.employee_subregions_id;
            }

        }
    </script>