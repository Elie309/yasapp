<div class="container-main">

    <div class="flex flex-row items-center">

        <h2 class="main-title-page text-start pl-4 md:p-0 md:text-center">Listings</h2>
        <a href="<?= base_url('listings/add') ?>" class=" border-2 border-gray-900 bg-white shadow-xl text-gray-900
                                font-bold size-14 rounded-full text-4xl flex items-center justify-center
                                hover:bg-gray-900 hover:text-white transition duration-300 ease-in-out">
           <span class="pb-2">+</span>
        </a>
    </div>



    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


        <div class="flex flex-col">

            <div class="flex flex-col md:flex-row mb-4 flex-nowrap w-full justify-center">

                <?php if (isset($agents) && !empty($agents)) : ?>
                    <div class="my-2 md:my-0 md:ml-4 order-2">
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
                <div class="my-2 md:my-0 md:ml-4 order-3">
                    <label for="land_apartment" class="main-label mr-2 text-wrap">Land/Apartment:</label>
                    <select name="land_apartment" id="land_apartment" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['landOrApartment']) ? '' : 'selected' ?>>All</option>
                        <option value="land" <?= isset($_GET['landOrApartment']) && $_GET['landOrApartment'] === 'land' ? 'selected' : '' ?>>Land</option>
                        <option value="apartment" <?= isset($_GET['landOrApartment']) && $_GET['landOrApartment'] === 'apartment' ? 'selected' : '' ?>>Apartment</option>
                    </select>
                </div>
                <div class="my-2 md:my-0 md:ml-4 order-5">
                    <label for="propertyStatus" class="main-label mr-2 text-wrap">Status:</label>
                    <select name="propertyStatus" id="propertyStatus" class="secondary-input min-w-40">
                        <option value="" <?= isset($_GET['propertyStatus']) ? '' : 'selected' ?>>All</option>
                        <?php foreach ($propertyStatus as $status): ?>
                            <option value="<?= $status['name'] ?>"
                                <?= isset($_GET['propertyStatus']) && $_GET['propertyStatus'] === $status['name'] ? 'selected' : '' ?>><?= ucfirst($status['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="my-2 md:my-0 md:ml-4 order-1 md:order-6 flex items-end">
                    <button class="secondary-btn w-full min-w-40  " onclick='resetURL("listings")'>Clear Filter</button>
                </div>


            </div>

            <div class="flex flex-col md:flex-row mb-8 justify-center">
                <div class="my-2 md:my-0">
                    <label for="createdAt" class="main-label mr-2 text-wrap">Created At:</label>
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

        $adminHeaders = [];
                            
        if (isset($agents) && !empty($agents)){
            $adminHeaders['employee_name'] = 'Agent';
        }
        $tableHeaders = [
            'client_name' => 'Vendor',
            'phone_number' => 'Phone',
            'city_name' => 'City',
            'property_land_or_apartment' => 'Land/Apartment',
            'property_status_name' => 'Status',
            'property_budget' => 'Price',
            'property_dimension' => 'Size',
            'property_created_at' => 'Created At',
            'property_updated_at' => 'Updated At',
        ];

        $tableHeaders = array_merge($adminHeaders, $tableHeaders);

        //TODO: Change this to a less manual way
        for ($i = 0; $i < count($properties); $i++) {
            if ($properties[$i]->property_land_or_apartment !== null) {
                $properties[$i]->property_land_or_apartment = 'Land';
            } else {
                $properties[$i]->property_land_or_apartment = 'Apartment';
            }
        }

        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'listings_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $properties,
                // 'addButtonModelId' => '',
                // 'addButtonRedirectLink' => 'listings/add',
                // 'AddButtonName' => 'Add Property',
                // 'modelIdOnClickRow' => '',
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
        const createdAt = document.getElementById('createdAt');
        const updatedAt = document.getElementById('updatedAt');
        const land_apartment = document.getElementById('land_apartment');


        <?php if (isset($agents) && !empty($agents)) : ?>
            const agent = document.getElementById('agent');

            agent.addEventListener('change', function() {
                updateURLParameter('agent', agent.value);
            });
        <?php endif; ?>

        propertyStatus.addEventListener('change', function() {
            updateURLParameter('propertyStatus', propertyStatus.value);
        });

        createdAt.addEventListener('change', function() {
            updateURLParameter('createdAt', createdAt.value);
        });

        updatedAt.addEventListener('change', function() {
            updateURLParameter('updatedAt', updatedAt.value);
        });

        land_apartment.addEventListener('change', function() {
            updateURLParameter('landOrApartment', land_apartment.value);
        });

    });
</script>