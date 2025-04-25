<div class="container mx-auto p-6 max-w-4xl space-y-4">
    <div class="accordion-sections space-y-4">
        <!-- Add Section -->
        <div class="accordion-section rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <button
                class="accordion-toggle flex justify-between items-center w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200 transition duration-200 font-semibold text-gray-800"
                data-target="#content-<?= strtolower($title) ?>-add"
                type="button">
                <span>Add <?php echo $title ?></span>
                <span class="accordion-icon text-xl transition-transform">+</span>
            </button>
            <div id="content-<?= strtolower($title) ?>-add" class="accordion-content bg-white max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                <div class="p-6">
                    <form action="<?= $linkPostAdd ?>" method="POST" class="space-y-4 max-w-lg mx-auto">
                        <?php if (strtolower($title) === "country") { ?>
                            <div>
                                <label for="country_code" class="block text-sm font-medium text-gray-700 mb-1">Country Code<span class="text-red-600">*</span></label>
                                <input type="text" id="country_code" placeholder="+961"
                                    name="country_code" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200" required>
                            </div>
                        <?php } else { ?>
                            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                                'placeholder' => 'Search ' . $selectFormName,
                                'selectedId' => $selectFormId,
                                'selectedName' => $selectFormId,
                                'searchLink' => $searchParentLink
                            ]) ?>
                        <?php } ?>

                        <div>
                            <label for="<?= $inputFormName ?>" class="block text-sm font-medium text-gray-700 mb-1"><?php echo $title ?></label>
                            <input type="text" id="<?= $inputFormName ?>" name="<?= $inputFormName ?>" placeholder="<?= $title ?> name" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">Add <?php echo $title ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Section -->
        <div class="accordion-section rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <button
                class="accordion-toggle flex justify-between items-center w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200 transition duration-200 font-semibold text-gray-800"
                data-target="#content-<?= strtolower($title) ?>-edit"
                type="button">
                <span>Edit <?php echo $title ?></span>
                <span class="accordion-icon text-xl transition-transform">+</span>
            </button>
            <div id="content-<?= strtolower($title) ?>-edit" class="accordion-content bg-white max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                <div class="p-6">
                    <form action="<?= $linkPostEdit ?>" method="POST" class="space-y-4 max-w-lg mx-auto">
                        <?php if (strtolower($title) === "country") { ?>
                            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                                'placeholder' => 'Search ' . $title,
                                'selectedId' => $inputFormId,
                                'selectedName' => $selectFormName . '_edit',
                                'searchLink' => $searchLink
                            ]) ?>
                            <div>
                                <label for="country_code" class="block text-sm font-medium text-gray-700 mb-1">Country Code</label>
                                <input type="text" id="country_code" name="country_code" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200" required>
                            </div>
                        <?php } else { ?>
                            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                                'placeholder' => 'Search ' . $title,
                                'selectedId' => $inputFormId,
                                'selectedName' => $inputFormName . '_edit',
                                'searchLink' => $searchLink
                            ]) ?>
                        <?php } ?>

                        <div>
                            <label for="<?= $inputFormName ?>" class="block text-sm font-medium text-gray-700 mb-1"><?php echo $title ?></label>
                            <input type="text" id="<?= $inputFormName ?>" name="<?= $inputFormName ?>" placeholder="<?= $title ?> name" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">Edit <?php echo $title ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Section -->
        <div class="accordion-section rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <button
                class="accordion-toggle flex justify-between items-center w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200 transition duration-200 font-semibold text-gray-800"
                data-target="#content-<?= strtolower($title) ?>-delete"
                type="button">
                <span>Delete <?php echo $title ?></span>
                <span class="accordion-icon text-xl transition-transform">+</span>
            </button>
            <div id="content-<?= strtolower($title) ?>-delete" class="accordion-content bg-white max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                <div class="p-6">
                    <form action="<?= $linkPostDelete ?>" method="POST" class="space-y-4 max-w-lg mx-auto">
                        <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                            'placeholder' => 'Search ' . $title,
                            'selectedId' => $inputFormId,
                            'selectedName' => $inputFormName . '_delete',
                            'searchLink' => $searchLink
                        ]) ?>

                        <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-200">Delete <?php echo $title ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script is included in the edit-location -->
</div>