<div id="<?= $modalId ?>" class="hidden fixed w-full min-h-full inset-0 
            bg-gray-900 bg-opacity-50 items-center justify-center py-10">

    <div class="bg-white sm:rounded-lg overflow-auto sm:min-h-fit w-full sm:w-5/6 lg:w-3/4 xl:w-2/6 max-h-screen my-4">
        <div class="flex justify-between w-full text-center p-4 shadow-xl">
            <h3 class="text-xl font-semibold"><?= $modalTitle ?></h3>
            <button class="<?= $closeButtonClass ?>" onclick="closeModal('<?= $modalId ?>')"><?= $closeButtonText ?></button>
        </div>
        <div class="p-4">
            <?= $modalBody ?>
        </div>
        
    </div>
</div>
