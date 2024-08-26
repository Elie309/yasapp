<div class="container-main">
    <h2 class="main-title-page">Request</h2>
    <div class="mt-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">


        <span class="flex flex-row justify-end">
            <button class="secondary-btn " onclick='resetURL()'>Clear Filter</button>
        </span>
        <div class="flex flex-col">

            <div class="flex flex-row mb-4 w-full justify-center">
                <div class="flex flex-row align-baseline">
                    <label for="request_type" class="main-label mr-2">Request Type:</label>
                    <select name="request_type" id="request_type" class="secondary-input">
                        <option value="" <?= isset($_GET['requestType']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($requestTypes as $requestType): ?>
                            <option value="<?= $requestType ?>"
                                <?= isset($_GET['requestType']) && $_GET['requestType'] === $requestType ? 'selected' : '' ?>><?= $requestType ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-row ml-4">
                    <label for="request_state" class="main-label mr-2">Request State:</label>
                    <select name="request_state" id="request_state" class="secondary-input">
                        <option value="" <?= isset($_GET['requestState']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($requestStates as $requestState): ?>
                            <option value="<?= $requestState ?>"
                                <?= isset($_GET['requestState']) && $_GET['requestState'] === $requestState ? 'selected' : '' ?>><?= $requestState ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-row ml-4">
                    <label for="request_priority" class="main-label mr-2">Request Priority:</label>
                    <select name="request_priority" id="request_priority" class="secondary-input">
                        <option value="" <?= isset($_GET['requestPriority']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($requestPriorities as $requestPriority): ?>
                            <option value="<?= $requestPriority ?>"
                                <?= isset($_GET['requestPriority']) && $_GET['requestPriority'] === $requestPriority ? 'selected' : '' ?>><?= $requestPriority ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="flex flex-row mb-8 justify-center">
                <div class="flex flex-row">
                    <label for="start_date" class="main-label mr-2">Start Date:</label>
                    <input type="date" name="start_date" id="start_date"
                        value="<?= isset($_GET['startDate']) ? $_GET['startDate'] : '' ?>"
                        class="secondary-input">
                </div>
                <div class="flex flex-row ml-4">
                    <label for="end_date" class="main-label mr-2">End Date:</label>
                    <input type="date" name="end_date" id="end_date"
                        value="<?= isset($_GET['endDate']) ? $_GET['endDate'] : '' ?>"
                        class="secondary-input">
                </div>
            </div>
        </div>

        <?php $tableHeaders = [
            'client_name' => 'Client',
            'city_name' => 'City',
            'payment_plan_name' => 'Payment Plan',
            'request_fees' => 'Budget',
            'request_state' => 'State',
            'request_priority' => 'Priority',
            'request_type' => 'Type',
            'comments' => 'Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'request_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $requests,
                'addButtonModelId' => '',
                'addButtonRedirectLink' => 'requests/add',
                'AddButtonName' => 'Add Request',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => 'redirectToWithId("requests", "request_id");',
                'classOnClickRow' => 'cursor-pointer',
                // 'actions' => $actions,
                'isOnClickRowActive' => true,
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'searchParam' => [
                    'client_name' => 'Client Name',
                    'city_name' => 'City Name',
                    'plan_name' => 'Payment Plan',
                    'request_budget' => 'Budget',
                    'comments' => 'Comments',
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const requestType = document.getElementById('request_type');
        const requestState = document.getElementById('request_state');
        const requestPriority = document.getElementById('request_priority');
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        requestType.addEventListener('change', function() {
            updateURLParameter('requestType', requestType.value);
        });

        requestState.addEventListener('change', function() {
            updateURLParameter('requestState', requestState.value);
        });

        requestPriority.addEventListener('change', function() {
            updateURLParameter('requestPriority', requestPriority.value);
        });

        startDate.addEventListener('change', function() {
            updateURLParameter('startDate', startDate.value);
        });

        endDate.addEventListener('change', function() {
            updateURLParameter('endDate', endDate.value);
        });
    });

    function resetURL() {
        window.location.href = '<?= base_url('requests') ?>';
    }
</script>