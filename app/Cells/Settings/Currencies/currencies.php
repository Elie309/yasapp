<div class="container mx-auto p-4">

    <!-- FROM ADD -->
    <h1 class="text-2xl font-bold text-center mb-8">Add <?php echo $title ?></h1>

    <form action="<?= $linkPostAdd ?>" method="POST" class="mx-auto my-3 w-5/6">

        <label for="currency_name" class="main-label"><?php echo $title ?> Name</label>
        <input type="text" name="currency_name" id="currency_name" class="main-input" required>

        <label for="currency_code" class="main-label"><?php echo $title ?> Code</label>
        <input type="text" name="currency_code" id="currency_code" class="main-input" required>

        <label for="currency_symbol" class="main-label"><?php echo $title ?> Symbol</label>
        <input type="text" name="currency_symbol" id="currency_symbol" class="main-input" required>


        <button type="submit" class="mt-2 w-full main-btn">Add <?php echo $title ?></button>
    </form>

    </br>

    <!-- FROM EDIT -->

    <h1 class="text-2xl font-bold text-center mb-8">Edit <?php echo $title ?></h1>

    <form action="<?= $linkPostEdit ?>" method="POST" class="mx-auto my-3 w-5/6">

    <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
            'placeholder' => 'Search ' . $title,
            'data' => $selectedOptions,
            'selectedId' => $inputFormId,
            'selectedName' => $inputFormName . '_edit'
        ]) ?>

        <label for="currency_name" class="main-label"><?php echo $title ?> Name</label>
        <input type="text" name="currency_name" id="currency_name" class="main-input" required>

        <label for="currency_code" class="main-label"><?php echo $title ?> Code</label>
        <input type="text" name="currency_code" id="currency_code" class="main-input" required>

        <label for="currency_symbol" class="main-label"><?php echo $title ?> Symbol</label>
        <input type="text" name="currency_symbol" id="currency_symbol" class="main-input" required>
        
        <button type="submit" class="mt-2 w-full main-btn">Edit <?php echo $title ?></button>
    </form>

    </br>

    <!-- FROM DELETE -->

    <h1 class="text-2xl font-bold text-center mb-8">Delete <?php echo $title ?></h1>

    <form action="<?= $linkPostDelete ?>" method="POST" class="mx-auto my-3 w-5/6">

        <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
            'placeholder' => 'Search ' . $title,
            'data' => $selectedOptions,
            'selectedId' => $inputFormId,
            'selectedName' => $inputFormName . '_delete'
        ]) ?>


        <button type="submit" class="mt-2 w-full main-btn">Delete <?php echo $title ?></button>
    </form>


</div>