<div class="container-main">

    <div class="flex flex-row items-center justify-between md:justify-center gap-4 mb-6">
        <h2 class="main-title-page text-start pl-4 md:p-0">Requests</h2>
        <a href="<?= base_url('requests/add') ?>" class="flex items-center gap-2 border-2 border-gray-900 bg-white 
                                shadow-md text-gray-900 font-bold py-2 px-4 rounded-lg text-nowrap 
                                hover:bg-gray-900 hover:text-white transition duration-300 ease-in-out">
            <i class="fas fa-plus"></i>
            <span class="hidden md:inline">Add Request</span>
        </a>
    </div>




    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

        <div class="flex flex-col">
            <!-- Filter Section Header -->
            <div class="mb-4 border-b pb-2">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <i class="fas fa-filter text-gray-600"></i> Filter Requests
                </h3>
            </div>

            <!-- Main Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <?php if (isset($agents) && !empty($agents)) : ?>
                    <div class="filter-item">
                        <label for="agent" class="main-label flex items-center mb-1">
                            <i class="fas fa-user-tie text-gray-500 mr-2"></i>Agent
                        </label>
                        <select name="agent" id="agent" class="secondary-input w-full">
                            <option value="" <?= isset($_GET['agent']) ? '' : 'selected' ?>>All Agents</option>
                            <?php foreach ($agents as $agent): ?>
                                <option value="<?= $agent->agent_name ?>"
                                    <?= isset($_GET['agent']) && $_GET['agent'] === $agent->agent_name ? 'selected' : '' ?>><?= ucfirst($agent->agent_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="filter-item">
                    <label for="request_priority" class="main-label flex items-center mb-1">
                        <i class="fas fa-flag text-gray-500 mr-2"></i>Priority
                    </label>
                    <select name="request_priority" id="request_priority" class="secondary-input w-full">
                        <option value="" <?= isset($_GET['requestPriority']) ? '' : 'selected' ?>>All Priorities</option>
                        <?php foreach ($requestPriorities as $requestPriority): ?>
                            <option value="<?= $requestPriority ?>"
                                <?= isset($_GET['requestPriority']) && $_GET['requestPriority'] === $requestPriority ? 'selected' : '' ?>><?= ucfirst($requestPriority) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-item">
                    <label for="request_state" class="main-label flex items-center mb-1">
                        <i class="fas fa-tasks text-gray-500 mr-2"></i>Status
                    </label>
                    <select name="request_state" id="request_state" class="secondary-input w-full">
                        <option value="" <?= isset($_GET['requestState']) ? '' : 'selected' ?>>All States</option>
                        <?php foreach ($requestStates as $requestState): ?>
                            <option value="<?= $requestState ?>"
                                <?= isset($_GET['requestState']) && $_GET['requestState'] === $requestState ? 'selected' : '' ?>><?= ucfirst($requestState) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-item flex items-end">
                    <button class="secondary-btn w-full flex items-center justify-center gap-2" onclick='resetURL("requests")'>
                        <i class="fas fa-undo-alt"></i>
                        <span>Clear Filters</span>
                    </button>
                </div>
            </div>

            <!-- Date Range Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-6">
                <div class="filter-item">
                    <label for="start_date" class="main-label flex items-center mb-1">
                        <i class="far fa-calendar-alt text-gray-500 mr-2"></i>Create after
                    </label>
                    <input type="date" name="start_date" id="start_date"
                        value="<?= isset($_GET['startDate']) ? $_GET['startDate'] : '' ?>"
                        class="secondary-input w-full">
                </div>

                <div class="filter-item">
                    <label for="end_date" class="main-label flex items-center mb-1">
                        <i class="far fa-calendar-check text-gray-500 mr-2"></i>End before
                    </label>
                    <input type="date" name="end_date" id="end_date"
                        value="<?= isset($_GET['endDate']) ? $_GET['endDate'] : '' ?>"
                        class="secondary-input w-full">
                </div>
            </div>
        </div>

        <?php

        $adminHeaders = [];

        if (isset($agents) && !empty($agents)) {
            $adminHeaders['agent_name'] = 'Agent';
        }



        $tableHeaders = [
            'client_name' => 'Client',
            'phone_numbers' => 'Phones',
            'subregion_name' => 'District',
            'city_name' => 'City',
            'request_payment_plan' => 'Payment Plan',
            'request_fees' => 'Budget',
            'request_state' => 'State',
            'request_priority' => 'Priority',
            'comments' => 'Comments',
            'request_created_at' => 'Created At',
            'request_updated_at' => 'Updated At',
        ];

        $tableHeaders = array_merge($adminHeaders, $tableHeaders);

        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'request_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $requests,
                // 'addButtonModelId' => '',
                // 'addButtonRedirectLink' => 'requests/add',
                // 'AddButtonName' => 'Add Request',
                // 'modelIdOnClickRow' => '',
                'classOnClickRow' => 'cursor-pointer',
                'exportToExcelLink' => 'requests/export',
                'isOnClickRowActive' => false, //This will be used to redirect to a page when a row is clicked
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'redirectOnClickRow' => 'requests',
                'dataRowActive' => false,
                'id_field' => 'request_id',
                'searchParam' => [
                    'client_name' => 'Client Name',
                    'request_payment_plan' => 'Payment Plan',
                    'request_budget' => 'Budget',
                    'comments' => 'Comments',
                    'city_name' => 'City',
                    'subregion_name' => 'District',
                ],

            ]
        ) ?>

        <?php if (isset($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>

            <div>
                <span class="main-label">Current Page: <?= count($requests) ?> / <?= $pager->getPerPage() ?></span>
                <span class="main-label">Total Requests: <?= $pager->getTotal() ?></span>

            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const requestState = document.getElementById('request_state');
        const requestPriority = document.getElementById('request_priority');
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        <?php if (isset($agents) && !empty($agents)) : ?>
            const agent = document.getElementById('agent');

            agent.addEventListener('change', function() {
                updateURLParameter('agent', agent.value);
            });
        <?php endif; ?>
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
</script>