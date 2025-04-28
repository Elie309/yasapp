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
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>',
                'class' => 'stroke-blue-500 hover:stroke-blue-700 hover:text-blue-700'
            ],
            [
                'name' => 'Delete',
                'popovertarget' => 'DeleteBackup',
                'functions' => "setFormDetails('delete');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>',
                'class' => 'stroke-red-500 hover:stroke-red-700 hover:text-red-700'
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
                'addButtonModelAdditionalFn' => 'sendCreateDatabaseBackup()',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '', 
                'classOnClickRow' => '',
                'actions' => $actions,
            ]
        ) ?>

    </div>
</div>

<div class="hidden" id="createBackup">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Create Backup</h2>
        <form id="createBackupForm" action="/settings/backup/backup-database" method="post">
            <div class="mb-4">
                <p class="text-gray-600 mb-4">This will create a new backup of your database. The process may take a moment depending on the size of your database.</p>
            </div>
            <button type="submit" class="secondary-btn w-full">Create Backup</button>
        </form>
    </div>
</div>

<div popover class="popover max-w-lg" id="DownloadBackup">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Download Backup</h2>
        <form id="downloadBackupForm" action="/settings/backup/download" method="post">
            <p class="text-lg font-semibold text-center">Download this database backup?</p>
            <div class="mt-4 text-gray-500 text-center">
                <p class="font-semibold">Backup:</p>
                <p id="backup_name_download_text"></p>
                <p class="text-sm mt-2" id="backup_size_download_text"></p>
                <p class="text-sm italic" id="backup_date_download_text"></p>
            </div>
            <input type="hidden" name="backup_id" id="download_backup_id" value="">
            <div class="flex justify-center w-full mt-4">
                <button type="button" class="primary-btn w-1/4 mr-4" onclick="closePopover('DownloadBackup')">Cancel</button>
                <button type="submit" class="secondary-btn w-1/4">Download</button>
            </div>
        </form>
    </div>
</div>

<div popover class="popover max-w-lg" id="DeleteBackup">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Delete Backup</h2>
        <form id="deleteBackupForm" action="/settings/backup/delete" method="post">
            <p class="text-lg font-semibold text-center">Are you sure you want to delete this backup?</p>
            <div class="mt-4 text-gray-500 text-center">
                <p class="font-semibold">Backup:</p>
                <p id="backup_name_delete_text"></p>
                <p class="text-sm mt-2" id="backup_size_delete_text"></p>
                <p class="text-sm italic" id="backup_date_delete_text"></p>
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
    function sendCreateDatabaseBackup() {
        document.getElementById('createBackupForm').submit();
    }

    function setFormDetails(action) {
        try {
            const tempData = sessionStorage.getItem('tempTableData');
            
            if (!tempData) {
                console.error('No data found in sessionStorage');
                return;
            }
            
            const data = JSON.parse(tempData);
            
            if (!data) {
                console.error('Failed to parse data from sessionStorage');
                return;
            }
            
            if (action === 'delete') {
                document.getElementById('backup_name_delete_text').innerText = data.backup_name || 'Unknown';
                document.getElementById('backup_size_delete_text').innerText = `Size: ${data.backup_file_size || 'Unknown'}`;
                document.getElementById('backup_date_delete_text').innerText = `Created: ${data.backup_created_at ? formatDate(data.backup_created_at) : 'Unknown date'}`;
                document.getElementById('backup_id').value = data.backup_id || '';
            } else if (action === 'download') {
                document.getElementById('backup_name_download_text').innerText = data.backup_name || 'Unknown';
                document.getElementById('backup_size_download_text').innerText = `Size: ${data.backup_file_size || 'Unknown'}`;
                document.getElementById('backup_date_download_text').innerText = `Created: ${data.backup_created_at ? formatDate(data.backup_created_at) : 'Unknown date'}`;
                document.getElementById('download_backup_id').value = data.backup_id || '';
            }
        } catch (error) {
            console.error('Error setting form details:', error);
        }
    }

    function formatDate(dateString) {
        try {
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                return 'Invalid date';
            }
            return date.toLocaleString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        } catch (error) {
            console.error('Error formatting date:', error);
            return 'Invalid date';
        }
    }

    function closePopover(id) {
        const popover = document.getElementById(id);
        if (popover && popover.hidePopover) {
            popover.hidePopover();
        }
    }
</script>