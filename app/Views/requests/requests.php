<div class="container-main">
    <div class="flex flex-row items-center">

        <h2 class="main-title-page text-start pl-4 md:p-0 md:text-center">Requests</h2>
        <a href="<?= base_url('requests/add') ?>" class=" border-2 border-gray-900 bg-white shadow-xl text-gray-900
                        font-bold size-14 rounded-full text-4xl flex items-center justify-center
                        hover:bg-gray-900 hover:text-white transition duration-300 ease-in-out">
            <span class="pb-2">+</span>
        </a>
    </div>



    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

        <div class="flex flex-col">

            <div class="flex flex-col md:flex-row mb-4 w-full justify-center">
                <?php if (isset($agents) && !empty($agents)) : ?>
                    <div class="my-2 md:my-0 md:ml-4 order-2">
                        <label for="agent" class="main-label mr-2 text-wrap">Agent:</label>
                        <select name="agent" id="agent" class="secondary-input min-w-40">
                            <option value="" <?= isset($_GET['agent']) ? '' : 'selected' ?>>All</option>
                            <?php foreach ($agents as $agent): ?>
                                <option value="<?= $agent->agent_name ?>"
                                    <?= isset($_GET['agent']) && $_GET['agent'] === $agent->agent_name ? 'selected' : '' ?>><?= ucfirst($agent->agent_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="my-2 md:my-0 md:ml-4 order-3">
                    <label for="request_priority" class="main-label mr-2 text-wrap">Request Priority:</label>
                    <select name="request_priority" id="request_priority" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['requestPriority']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($requestPriorities as $requestPriority): ?>
                            <option value="<?= $requestPriority ?>"
                                <?= isset($_GET['requestPriority']) && $_GET['requestPriority'] === $requestPriority ? 'selected' : '' ?>><?= ucfirst($requestPriority) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="my-2 md:my-0 md:ml-4 order-4">
                    <label for="request_state" class="main-label mr-2 text-wrap">Request State:</label>
                    <select name="request_state" id="request_state" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['requestState']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($requestStates as $requestState): ?>
                            <option value="<?= $requestState ?>"
                                <?= isset($_GET['requestState']) && $_GET['requestState'] === $requestState ? 'selected' : '' ?>><?= ucfirst($requestState) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="my-2 md:my-0 md:ml-4 order-1 md:order-5 flex items-end">
                    <button class="secondary-btn w-full min-w-40 " onclick='resetURL("requests")'>Clear Filter</button>
                </div>
            </div>

            <div class="flex flex-col md:flex-row mb-8 justify-center">
                <div class=" my-2 md:my-0">
                    <label for="start_date" class="main-label mr-2 text-wrap">Start Date:</label>
                    <input type="date" name="start_date" id="start_date"
                        value="<?= isset($_GET['startDate']) ? $_GET['startDate'] : '' ?>"
                        class="secondary-input min-w-40">
                </div>
                <div class="my-2 md:my-0 md:ml-4">
                    <label for="end_date" class="main-label mr-2 text-wrap">End Date:</label>
                    <input type="date" name="end_date" id="end_date"
                        value="<?= isset($_GET['endDate']) ? $_GET['endDate'] : '' ?>"
                        class="secondary-input min-w-40">
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