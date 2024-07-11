<div id="<?= $modalId ?>" class="hidden fixed w-full h-full inset-0 bg-gray-900 bg-opacity-50 items-center justify-center">

    <div class="bg-white sm:rounded-lg h-full w-full sm:h-5/6 overflow-auto sm:w-3/4 lg:w-1/2">
        <div class="fixed bg-white text-center rounded-br-2xl z-30 p-4 shadow-xl">
            <h3 class="text-xl font-semibold"><?= $modalTitle ?></h3>
        </div>
        <div class="p-4">
            <?= $modalBody ?>
        </div>
        <div class="p-4 border-t flex justify-end space-x-2">
            <button class="<?= $cancelButtonClass ?>" onclick="closeModal('<?= $modalId ?>')"><?= $cancelButtonText ?></button>
            <button id="modalConfirmButton-<?= $modalId ?>" class="<?= $confirmButtonClass ?>"><?= $confirmButtonText ?></button>
        </div>
    </div>
</div>
