<div class="container-main">
    <h2 class="main-title-page">Listings</h2>


    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

        <div class="flex flex-row justify-end mb-4">
            <button class="secondary-btn " onclick='resetURL("listings")'>Clear Filter</button>
        </div>
        <div class="flex flex-col">

            <div class="flex flex-col md:flex-row mb-4 w-full justify-center">

                <?php if (isset($agents) && !empty($agents)) : ?>
                    <div class="my-2 md:my-0 md:ml-4">
                        <label for="agent" class="main-label mr-2 text-wrap">Agent:</label>
                        <select name="agent" id="agent" class="secondary-input min-w-40">
                            <option value="" <?= isset($_GET['agent']) ? '' : 'selected' ?>>All</option>
                            <?php foreach ($agents as $agent): ?>
                                <option value="<?= $agent->employee_name ?>"
                                    <?= isset($_GET['agent']) && $_GET['agent'] === $agent->employee_name ? 'selected' : '' ?>><?= ucfirst($agent->employee_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="my-2 md:my-0 md:ml-4">
                    <label for="propertyType" class="main-label mr-2 text-wrap">Property Type:</label>
                    <select name="propertyType" id="propertyType" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['propertyType']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($propertyType as $type): ?>
                            <option value="<?= $type->property_type_name ?>"
                                <?= isset($_GET['propertyType']) && $_GET['propertyType'] === $type->property_type_name ? 'selected' : '' ?>><?= ucfirst($type->property_type_name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="my-2 md:my-0 md:ml-4">
                    <label for="propertyStatus" class="main-label mr-2 text-wrap">Property Status:</label>
                    <select name="propertyStatus" id="propertyStatus" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['propertyStatus']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($propertyStatus as $status): ?>
                            <option value="<?= $status->property_status_name ?>"
                                <?= isset($_GET['propertyStatus']) && $_GET['propertyStatus'] === $status->property_status_name ? 'selected' : '' ?>><?= ucfirst($status->property_status_name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
               

            </div>

            <div class="flex flex-col md:flex-row mb-8 justify-center">
                <div class="my-2 md:my-0">
                    <label for="createdAt" class="main-label mr-2 text-wrap">Created Date:</label>
                    <input type="date" name="createdAt" id="createdAt"
                        value="<?= isset($_GET['createdAt']) ? $_GET['createdAt'] : '' ?>"
                        class="secondary-input">
                </div>
                <div class=" my-2 md:my-0 md:ml-4">
                    <label for="updatedAt" class="main-label mr-2 text-wrap">Updated At:</label>
                    <input type="date" name="updatedAt" id="updatedAt"
                        value="<?= isset($_GET['updatedAt']) ? $_GET['updatedAt'] : '' ?>"
                        class="secondary-input">
                </div>

            </div>
        </div>

        <?php

        $tableHeaders = [
            'client_name' => 'Vendor',
            'employee_name' => 'Employee',
            'city_name' => 'City',
            'property_type_name' => 'Type',
            'property_status_name' => 'Status',
            'property_budget' => 'Price',
            'property_dimension' => 'Size',
            'property_rent_or_sale' => 'Rent/Sale',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

        ];


        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'listings_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $properties,
                'addButtonModelId' => '',
                'addButtonRedirectLink' => 'listings/add',
                'AddButtonName' => 'Add Property',
                'modelIdOnClickRow' => '',
                'classOnClickRow' => 'cursor-pointer',
                'exportToExcelLink' => 'listings/export',
                'isOnClickRowActive' => false, //This will be used to redirect to a page when a row is clicked
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'redirectOnClickRow' => 'listings',
                'dataRowActive' => false,
                'id_field' => 'property_id',
                'searchParam' => [
                    'client_name' => 'Vendor',
                    'city_name' => 'City',
                    'plan_name' => 'Payment Plan',
                    'property_price' => 'Budget',
                ],

            ]
        ) ?>

        <?php if (isset($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>

            <div>
                <span class="main-label">Current Page: <?= count($properties) ?> / <?= $pager->getPerPage() ?></span>
                <span class="main-label">Total Properties: <?= $pager->getTotal() ?></span>

            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const propertyStatus = document.getElementById('propertyStatus');
        const propertyType = document.getElementById('propertyType');
        const createdAt = document.getElementById('createdAt');
        const updatedAt = document.getElementById('updatedAt');

        <?php if (isset($agents) && !empty($agents)) : ?>
            const agent = document.getElementById('agent');

            agent.addEventListener('change', function() {
                updateURLParameter('agent', agent.value);
            });
        <?php endif; ?>

        propertyStatus.addEventListener('change', function() {
            updateURLParameter('propertyStatus', propertyStatus.value);
        });

        propertyType.addEventListener('change', function() {
            updateURLParameter('propertyType', propertyType.value);
        });

        createdAt.addEventListener('change', function() {
            updateURLParameter('createdAt', createdAt.value);
        });

        updatedAt.addEventListener('change', function() {
            updateURLParameter('updatedAt', updatedAt.value);
        });

    });
</script>