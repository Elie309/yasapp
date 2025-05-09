<div class="container-main">

    <div class="flex flex-row items-center justify-between md:justify-center gap-4 mb-6">
        <h2 class="main-title-page text-start pl-4 md:p-0">Listings</h2>
        <a href="<?= base_url('listings/add') ?>" class="flex items-center gap-2 border-2 border-gray-900 bg-white 
                                shadow-md text-gray-900 font-bold py-2 px-4 rounded-lg text-nowrap 
                                hover:bg-gray-900 hover:text-white transition duration-300 ease-in-out">
            <i class="fas fa-plus"></i>
            <span class="hidden md:inline">Add Listing</span>
        </a>
    </div>



    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


        <div class="flex flex-col">
            <!-- Filter Section Header -->
            <div class="mb-4 border-b pb-2">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <i class="fas fa-filter text-gray-600"></i> Filter Listings
                </h3>
            </div>

            <!-- Main Filters Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                <?php if (isset($agents) && !empty($agents)) : ?>
                    <div class="filter-item">
                        <label for="agent" class="main-label flex items-center mb-1">
                            <i class="fas fa-user-tie text-gray-500 mr-2"></i>Agent
                        </label>
                        <select name="agent" id="agent" class="secondary-input w-full">
                            <option value="" <?= isset($_GET['agent']) ? '' : 'selected' ?>>All Agents</option>
                            <?php foreach ($agents as $agent): ?>
                                <option value="<?= $agent->employee_name ?>"
                                    <?= isset($_GET['agent']) && $_GET['agent'] === $agent->employee_name ? 'selected' : '' ?>><?= ucfirst($agent->employee_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="filter-item">
                    <label for="land_apartment" class="main-label flex items-center mb-1">
                        <i class="fas fa-home text-gray-500 mr-2"></i>Property Type
                    </label>
                    <select name="land_apartment" id="land_apartment" class="secondary-input w-full">
                        <option value="" <?= isset($_GET['landOrApartment']) ? '' : 'selected' ?>>All Types</option>
                        <option value="land" <?= isset($_GET['landOrApartment']) && $_GET['landOrApartment'] === 'land' ? 'selected' : '' ?>>Land</option>
                        <option value="apartment" <?= isset($_GET['landOrApartment']) && $_GET['landOrApartment'] === 'apartment' ? 'selected' : '' ?>>Apartment</option>
                    </select>
                </div>

                <div class="filter-item">
                    <label for="propertyStatus" class="main-label flex items-center mb-1">
                        <i class="fas fa-tag text-gray-500 mr-2"></i>Status
                    </label>
                    <select name="propertyStatus" id="propertyStatus" class="secondary-input w-full">
                        <option value="" <?= isset($_GET['propertyStatus']) ? '' : 'selected' ?>>All Status</option>
                        <?php foreach ($propertyStatus as $status): ?>
                            <option value="<?= $status['name'] ?>"
                                <?= isset($_GET['propertyStatus']) && $_GET['propertyStatus'] === $status['name'] ? 'selected' : '' ?>><?= ucfirst($status['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Date Filters Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="filter-item">
                    <label for="createdAt" class="main-label flex items-center mb-1">
                        <i class="far fa-calendar-plus text-gray-500 mr-2"></i>Created after date
                    </label>
                    <input type="date" name="createdAt" id="createdAt"
                        value="<?= isset($_GET['createdAt']) ? $_GET['createdAt'] : '' ?>"
                        class="secondary-input w-full">
                </div>

                <div class="filter-item">
                    <label for="updatedAt" class="main-label flex items-center mb-1">
                        <i class="far fa-calendar-check text-gray-500 mr-2"></i>Updated after date
                    </label>
                    <input type="date" name="updatedAt" id="updatedAt"
                        value="<?= isset($_GET['updatedAt']) ? $_GET['updatedAt'] : '' ?>"
                        class="secondary-input w-full">
                </div>

                <div class="filter-item flex items-end">
                    <button class="secondary-btn w-full flex items-center justify-center gap-2" onclick='resetURL("listings")'>
                        <i class="fas fa-undo-alt"></i>
                        <span>Clear Filters</span>
                    </button>
                </div>
            </div>
        </div>

        <?php

        $adminHeaders = [];

        if (isset($agents) && !empty($agents)) {
            $adminHeaders['employee_name'] = 'Agent';
        }
        $tableHeaders = [
            'client_name' => 'Vendor',
            'phone_number' => 'Phone',
            'subregion_name' => 'District',
            'city_name' => 'City',
            'property_land_or_apartment' => 'Land/Apartment',
            'property_status_name' => 'Status',
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
                    'subregion_name' => 'District',
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