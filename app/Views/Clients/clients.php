<div class="container-main">
    <h2 class="main-title-page">Clients List</h2>



    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?php $tableHeaders = [
            'full_name' => 'Full Name',
            'client_email' => 'Email',
            'client_visibility' => 'Visibility',
            'phone_numbers' => 'Phones',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];

        ?>

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


        <span class="flex flex-row justify-end">
            <button class="secondary-btn " onclick='resetURL("clients")'>Clear Filter</button>
        </span>
        <div class="flex flex-col">

            <div class="flex flex-row mb-4 w-full justify-center">
                <div class="flex flex-row align-baseline">
                    <label for="visibility" class="main-label mr-2">Visibility</label>
                    <select name="visibility" id="visibility_select" class="secondary-input">
                        <option value="" <?= isset($_GET['visibility']) ? '' : 'selected' ?>>All</option>
                        <option value="public" <?= isset($_GET['visibility']) && $_GET['visibility'] === 'public' ? 'selected' : '' ?>>Public</option>
                        <option value="private" <?= isset($_GET['visibility']) && $_GET['visibility'] === 'private' ? 'selected' : '' ?>>Private</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-row mb-8 justify-center">
                <div class="flex flex-row">
                    <label for="createdAt" class="main-label mr-2">Created from:</label>
                    <input type="date" name="createdAt" id="createdAt_select"
                        value="<?= isset($_GET['createdAt']) ? $_GET['createdAt'] : '' ?>"
                        class="secondary-input">
                </div>
                <div class="flex flex-row ml-4">
                    <label for="updatedAt" class="main-label mr-2">Updated from:</label>
                    <input type="date" name="updatedAt" id="updatedAt_select"
                        value="<?= isset($_GET['updatedAt']) ? $_GET['updatedAt'] : '' ?>"
                        class="secondary-input">
                </div>
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
                'JSFunctionToRunOnClickRow' => 'redirectToWithId("clients", "client_id");',
                'classOnClickRow' => 'cursor-pointer',
                'isOnClickRowActive' => true,
                'rowsPerPageActive' => true,
                'searchParamActive' => true,
                'searchParam' => [],

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
        const visibilitySelect = document.getElementById('visibility_select');
        const createdAtSelect = document.getElementById('createdAt_select');
        const updatedAtSelect = document.getElementById('updatedAt_select');

        visibilitySelect.addEventListener('change', function() {
            updateURLParameter('visibility', visibilitySelect.value);
        });

        createdAtSelect.addEventListener('change', function() {
            updateURLParameter('createdAt', createdAtSelect.value);
        });

        updatedAtSelect.addEventListener('change', function() {
            updateURLParameter('updatedAt', updatedAtSelect.value);
        });

    });
</script>