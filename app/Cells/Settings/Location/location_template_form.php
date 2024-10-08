<div class="container mx-auto p-4">

    <!-- FROM ADD -->
    <h1 class="text-2xl font-bold text-center mb-8">Add <?php echo $title ?></h1>

    <form action="<?= $linkPostAdd ?>" method="POST" class="mx-auto my-3 w-5/6">


        <?php if (strtolower($title) === "country") { ?>

            <div class="mb-4">
                <label for="country_code" class="main-label">Country Code<span class="text-red-800">*</span></label>
                <input type="text" id="country_code" name="country_code" class="main-input" required>
            </div>


        <?php } else { ?>

            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $selectFormName,
                'selectedId' => $selectFormId,
                'selectedName' => $selectFormId,
                'searchLink' => $searchParentLink
            ]) ?>

        <?php } ?>

        <div class="mb-4">
            <label for="<?= $inputFormName ?>" class="main-label"><?php echo $title ?></label>
            <input type="text" id="<?= $inputFormName ?>" name="<?= $inputFormName ?>" placeholder="<?= $title ?> name" class="main-input" required>
        </div>
        <button type="submit" class="w-full main-btn">Add <?php echo $title ?></button>
    </form>

    </br>

    <!-- FROM EDIT -->

    <h1 class="text-2xl font-bold text-center mb-8">Edit <?php echo $title ?></h1>

    <form action="<?= $linkPostEdit ?>" method="POST" class="mx-auto my-3 w-5/6">


        <?php if (strtolower($title) === "country") { ?>

            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $title,
                'selectedId' => $inputFormId,
                'selectedName' => $selectFormName . '_edit',
                'searchLink' => $searchLink

            ]) ?>


            <div class="my-4">
                <label for="country_code" class="main-label">Country Code</label>
                <input type="text" id="country_code" name="country_code" class="main-input" required>
            </div>


        <?php } else { ?>

            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search ' . $title,
                'selectedId' => $inputFormId,
                'selectedName' => $inputFormName . '_edit',
                'searchLink' => $searchLink
            ]) ?>

        <?php } ?>

        <div class="mb-4">
            <label for="<?= $inputFormName ?>" class="main-label"><?php echo $title ?></label>
            <input type="text" id="<?= $inputFormName ?>" placeholder="<?= $title ?> name" name="<?= $inputFormName ?>" class="main-input" required>
        </div>
        <button type="submit" class="w-full main-btn">Edit <?php echo $title ?></button>
    </form>

    </br>

    <!-- FROM DELETE -->


    <h1 class="text-2xl font-bold text-center mb-8">Delete <?php echo $title ?></h1>

    <form action="<?= $linkPostDelete ?>" method="POST" class="mx-auto my-3 w-5/6">


        <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
            'placeholder' => 'Search ' . $title,
            'selectedId' => $inputFormId,
            'selectedName' => $inputFormName . '_delete',
            'searchLink' => $searchLink
        ]) ?>

        <button type="submit" class="mt-2 w-full main-btn">Delete <?php echo $title ?></button>
    </form>


</div>