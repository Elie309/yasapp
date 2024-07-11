<div class="container mx-auto p-4">

    <!-- FROM ADD -->
    <h1 class="text-2xl font-bold text-center mb-8">Add <?php echo $title ?></h1>

    <form action="<?= $linkPostAdd ?>" method="POST" class="mx-auto my-3 w-5/6">


        <?php if (strtolower($title) === "country") { ?>

            <div class="mb-4">
                <label for="country_code" class="block text-gray-700">Country Code</label>
                <input type="text" id="country_code" name="country_code" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
            </div>


        <?php } else { ?>

            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $selectFormName,
                'data' => $selectOptions,
                'selectedId' => $selectFormId,
                'selectedName' => $selectFormId
            ]) ?>

        <?php } ?>

        <div class="mb-4">
            <label for="<?= $inputFormId ?>" class="block text-gray-700"><?php echo $inputFormName ?></label>
            <input type="text" id="<?= $inputFormId ?>" name="<?= $inputFormId ?>" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
        </div>
        <button type="submit" class="w-full bg-red-800 text-white
                        py-2 rounded ease-in-out 
                        hover:bg-red-900 focus:outline-none focus:bg-red-900">Add <?php echo $inputFormName ?></button>
    </form>

    </br>

    <!-- FROM EDIT -->

    <h1 class="text-2xl font-bold text-center mb-8">Edit <?php echo $title ?></h1>

    <form action="<?= $linkPostEdit ?>" method="POST" class="mx-auto my-3 w-5/6">


        <?php if (strtolower($title) === "country") { ?>

            <div class="mb-4">
                <label for="country_code" class="block text-gray-700">Country Code</label>
                <input type="text" id="country_code" name="country_code" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
            </div>


        <?php } else { ?>

            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $selectFormName,
                'data' => $selectOptions,
                'selectedId' => $selectFormId,
                'selectedName' => $selectFormId
            ]) ?>

        <?php } ?>

        <div class="mb-4">
            <label for="<?= $inputFormId ?>" class="block text-gray-700"><?php echo $inputFormName ?></label>
            <input type="text" id="<?= $inputFormId ?>" name="<?= $inputFormId ?>" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
        </div>
        <button type="submit" class="w-full bg-red-800 text-white
                        py-2 rounded ease-in-out 
                        hover:bg-red-900 focus:outline-none focus:bg-red-900">Add <?php echo $inputFormName ?></button>
    </form>

    </br>

    <!-- FROM DELETE -->


    <h1 class="text-2xl font-bold text-center mb-8">Delete <?php echo $title ?></h1>

     <form action="<?= $linkPostDelete ?>" method="POST" class="mx-auto my-3 w-5/6">


            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $title,
                'data' => $selectOptions,
                'selectedName' => $selectFormId
            ]) ?>

        <button type="submit" class="mt-2 w-full bg-red-800 text-white
                        py-2 rounded ease-in-out 
                        hover:bg-red-900 focus:outline-none focus:bg-red-900">Delete <?php echo $inputFormName ?></button>
    </form>


</div>