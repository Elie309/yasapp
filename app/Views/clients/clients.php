<div class="container-main">
    <h2 class="main-title-page">Clients List</h2>



    <div class="my-8 mr-8 bg-white p-8 shadow-md rounded-md min-w-full overflow-auto">

        <?php $tableHeaders = [
            'full_name' => 'Full Name',
            'client_email' => 'Email',
            'phone_numbers' => 'Phones',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];

        ?>

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


        <div class="flex flex-row justify-end mb-2">
            <button class="secondary-btn " onclick='resetURL("clients")'>Clear Filter</button>
        </div>
        <div class="flex flex-col mb-4">
            <div class="grid grid-cols-2 grid-rows-2 gap-2 w-full align my-4 md:flex md:flex-row md:max-w-lg md:mx-auto">

                <label for="createdAt" class="main-label mr-2 align-baseline">Created from:</label>
                <input type="date" name="createdAt" id="createdAt_select"
                    value="<?= isset($_GET['createdAt']) ? $_GET['createdAt'] : '' ?>"
                    class="secondary-input">
                <pre class="hidden md:block"> - </pre>
                <label for="updatedAt" class="main-label mr-2">Updated from:</label>
                <input type="date" name="updatedAt" id="updatedAt_select"
                    value="<?= isset($_GET['updatedAt']) ? $_GET['updatedAt'] : '' ?>"
                    class="secondary-input">
            </div>
        </div>


        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'client_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $clients,
                'addButtonModelId' => '',
                'addButtonRedirectLink' => 'clients/add',
                'AddButtonName' => 'Add Client',
                'exportToExcelLink' => 'clients/export',
                'modelIdOnClickRow' => '',
                'classOnClickRow' => 'cursor-pointer',
                'isOnClickRowActive' => false, //This will not be used to redirect to a page when a row is clicked
                'dataRowActive' => false,
                'redirectOnClickRow' => 'clients',
                'id_field' => 'client_id',
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'searchParam' => [],

            ]
        ) ?>

        <?php if (isset($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links() ?>
            </div>

            <div>
                <span class="main-label">Current Page: <?= count($clients) ?> / <?= $pager->getPerPage() ?></span>
                <span class="main-label">Total Clients: <?= $pager->getTotal() ?></span>

            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const createdAtSelect = document.getElementById('createdAt_select');
        const updatedAtSelect = document.getElementById('updatedAt_select');

        createdAtSelect.addEventListener('change', function() {
            updateURLParameter('createdAt', createdAtSelect.value);
        });

        updatedAtSelect.addEventListener('change', function() {
            updateURLParameter('updatedAt', updatedAtSelect.value);
        });

    });
</script>