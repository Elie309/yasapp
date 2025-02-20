<div class="container-main print-container max-w-6xl overflow-auto">


    <div class="flex flex-row md:mt-0">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="main-title-page">Files</h2>
    </div>


    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">

        

        <?= view_cell('\App\Cells\Utils\Carousel\CarouselCell::render', 
        [
            'uploads' => $propertyUploads,
            'entity_id' => $property_id

        ]) ?>

        <div class="mt-4 mb-8">
            <h3 class="main-title-page">Documents</h3>
            <?php 
            $documentsAvailable = false;
            foreach ($propertyUploads as $upload) {
                if ($upload['upload_file_type'] === 'document') {
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
                        <?php if ($upload['upload_file_type'] === 'document'): ?>
                            <a href="<?= $upload['upload_storage_url']; ?>" target="_blank"
                                class="flex items-center p-2 border border-gray-300 
                            rounded hover:bg-gray-100 transition-colors">
                                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'file', 'class' => 'size-6 fill-gray-700']) ?>
                                <span class="ml-2 text-lg text-gray-800"><?= $upload['upload_file_name']; ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>