<div class="container-main print-container max-w-6xl overflow-auto">


    <div class="flex flex-row md:mt-0">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="main-title-page">Files</h2>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">



        <?= view_cell(
            '\App\Cells\Utils\Carousel\CarouselCell::render',
            [
                'uploads' => $propertyUploads,
                'entity_id' => $property_id

            ]
        ) ?>

        <div class="mt-4 mb-8">
            <h3 class="main-title-page">Documents</h3>
            <?php
            $documentsAvailable = false;
            foreach ($propertyUploads as $upload) {
                if ($upload->upload_file_type === 'document') {
                    $documentsAvailable = true;
                    break;
                }
            }
            ?>
            <?php if (!$documentsAvailable): ?>
                <p class="text-center">No documents Available</p>
            <?php else : ?>
                <div class="flex flex-col gap-2">
                    <?php foreach ($propertyUploads as $upload): ?>
                        <?php if ($upload->upload_file_type === 'document'): ?>
                            <div class="flex items-center justify-between p-2 border border-gray-300 rounded hover:bg-gray-100 transition-colors">
                                <a href="<?= $upload->upload_storage_url; ?>" target="_blank" class="flex items-center">
                                    <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'file', 'class' => 'size-6 fill-gray-700']) ?>
                                    <span class="ml-2 text-lg text-gray-800"><?= $upload->upload_file_name; ?></span>
                                </a>
                                <button class="stroke-red-600 hover:stroke-red-800" onclick="confirmDeleteDocument('<?= $upload->upload_id ?>')">
                                    <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'trash', 'class' => 'size-6']) ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50">
    <div class="loader-red"></div>
</div>

<div popover id="deleteDocument-popover" class="popover px-8 max-w-md">
    <div class="flex flex-col w-full justify-center">
        <h3 class="secondary-title text-lg md:text-2xl text-center">Are you sure you want to delete this document?</h3>
        <div class="grid grid-cols-2 gap-4 w-full my-4">
            <div class="w-full">
                <button type="button" class="primary-btn w-full cursor-pointer" onclick="closePopover('deleteDocument-popover')">Cancel</button>
            </div>
            <div class="w-full">
                <button id="confirmDeleteDocument" type="button" class="secondary-btn w-full cursor-pointer text-center">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDeleteDocument(uploadId) {
        document.getElementById('confirmDeleteDocument').setAttribute('data-upload-id', uploadId);
        showPopover('deleteDocument-popover');
    }

    document.getElementById('confirmDeleteDocument').addEventListener('click', function() {
        const uploadId = this.getAttribute('data-upload-id');
        closePopover('deleteDocument-popover');
        showLoading();
        fetch(`/listings/delete-upload/${uploadId}`, {
                method: 'delete',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                   onError('Error deleting document');
                }
            })
            .catch(error => {
                onError('Error deleting document');
                console.error('Error deleting document:', error);
            })
            .finally(() => {
                hideLoading();
            });
    });

    function showLoading() {
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('loading').classList.add('flex');
    }

    function hideLoading() {
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('loading').classList.remove('flex');
    }

   

</script>