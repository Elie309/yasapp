<div class="container-main">
    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Backup Logs</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md">

        <?php $tableHeaders = [
            'backup_id' => 'ID',
            'backup_name' => 'Backup Name',
            'backup_file_size' => 'File Size',
            'backup_created_at' => 'Created At',
        ];

        $actions = [
            [
                'name' => 'Download',
                'popovertarget' => 'DownloadBackup',
                'functions' => "setFormDetails('download');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="<?= $class ?>">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>',
                'class' => 'hover:stroke-blue-500 hover:text-blue-500'
            ],
            [
                'name' => 'Delete',
                'popovertarget' => 'DeleteBackup',
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
                'tableId' => 'backup_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $backups,
                'addButtonModelId' => 'createBackup',
                'AddButtonName' => 'Create Backup',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '', //This function is present in the form cell of currencies
                'classOnClickRow' => '',
                'actions' => $actions,

            ]
        ) ?>

    </div>
</div>

<div popover class="popover max-w-lg" id="createBackup">
    <div>
        <h3 class="secondary-title">
            Are you sure you want to create a backup?
        </h3>
        <form action="/settings/backup/backup-database"></form>
    </div>
</div>


<div popover class="popover max-w-lg" id="DeleteBackup">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Delete Backup</h2>
        <form id="deleteBackupForm" action="/settings/backup/delete" method="post">

            <p class="text-lg font-semibold text-center">Are you sure you want to delete this backup?</p>
            <div class="mt-4 text-gray-500 w-1/2 mx-auto">
                <p>Backup:</p>
                <span id="backup_name"></span>
            </div>
            <input type="hidden" name="backup_id" id="backup_id" value="">
            <div class="flex justify-center w-full mt-4">
                <button type="button" class="primary-btn w-1/4 mr-4" onclick="closePopover('DeleteBackup')">Cancel</button>
                <button type="submit" class="secondary-btn w-1/4">Delete</button>
            </div>
        </form>



    </div>
</div>

<script>
    function setFormDetails(action) {
        const data = JSON.parse(sessionStorage.getItem('tempTableData'));
        if (action === 'delete') {

            document.getElementById('backup_name').innerText = data.backup_name;
            document.getElementById('backup_id').value = data.backup_id;

        }

    }
</script>