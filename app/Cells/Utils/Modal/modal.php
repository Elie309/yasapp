<div id="<?= $modalId ?>" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg overflow-hidden w-3/4 lg:w-1/2">
        <div class="p-4 border-b">
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
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
