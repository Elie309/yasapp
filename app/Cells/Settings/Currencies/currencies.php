<div class="container mx-auto p-4">

    <?php if ($formGetter == 'add') : ?>

        <form id="add_currency" action="<?= $linkPostAdd ?>" method="POST" class="mx-auto my-3 w-5/6">

            <label for="add_currency_name" class="main-label"><?php echo $title ?> Name<span class="text-red-800">*</span></label>
            <input type="text" name="currency_name" id="add_currency_name" class="main-input" required>

            <label for="add_currency_code" class="main-label"><?php echo $title ?> Code<span class="text-red-800">*</span></label>
            <input type="text" name="currency_code" id="add_currency_code" class="main-input" required>

            <label for="add_currency_symbol" class="main-label"><?php echo $title ?> Symbol<span class="text-red-800">*</span></label>
            <input type="text" name="currency_symbol" id="add_currency_symbol" class="main-input" required>


            <button type="submit" class="mt-2 w-full main-btn">Add <?php echo $title ?></button>
        </form>

    <?php elseif ($formGetter == 'edit') : ?>

        <form id="edit_currency" action="<?= $linkPostEdit ?>" method="POST" class="mx-auto my-3 w-5/6">

            <input type="hidden" name="<?= $inputFormId ?>" id="edit_currency_id">

            <label for="edit_currency_name" class="main-label"><?php echo $title ?> Name</label>
            <input type="text" name="currency_name" id="edit_currency_name" class="main-input" required>

            <label for="edit_currency_code" class="main-label"><?php echo $title ?> Code</label>
            <input type="text" name="currency_code" id="edit_currency_code" class="main-input" required>

            <label for="edit_currency_symbol" class="main-label"><?php echo $title ?> Symbol</label>
            <input type="text" name="currency_symbol" id="edit_currency_symbol" class="main-input" required>

            <button type="submit" class="mt-2 w-full main-btn">Edit <?php echo $title ?></button>
        </form>


    <?php elseif ($formGetter == 'delete') : ?>
        <!-- FROM DELETE -->


        <form id="delete_currency" action="<?= $linkPostDelete ?>" method="POST" class="mx-auto my-3 w-5/6">

            <input type="hidden" name="<?= $inputFormId ?>" id="delete_currency_id">

            <p class="text-xl text-center text-red-600 font-semibold">Are you sure you want to delete this <?php echo $title ?>?</p>

            <label for="detele_currency_name" class="main-label"><?php echo $title ?> Name</label>
            <input type="text" name="currency_name" readonly id="detele_currency_name" class="main-input-readonly" required>

            <label for="detele_currency_code" class="main-label"><?php echo $title ?> Code</label>
            <input type="text" name="currency_code" readonly id="detele_currency_code" class="main-input-readonly" required>

            <label for="delete_currency_symbol" class="main-label"><?php echo $title ?> Symbol</label>
            <input type="text" name="currency_symbol" readonly id="delete_currency_symbol" class="main-input-readonly" required>

            <button type="submit" class="mt-2 w-full main-btn">Delete <?php echo $title ?></button>
        </form>

    <?php else : ?>

        <h2 class="main-title-page"><?php echo $title ?> Overview</h2>

    <?php endif; ?>


</div>

<script>
    function setFormDetails(action) {
        //Get temp data
        var data = JSON.parse(sessionStorage.getItem('tempTableData'));

        if (action == null || action == '' || action == undefined) {
            return;
        }

        if (action == 'edit') {

            document.getElementById('edit_currency_id').value = data.currency_id;
            document.getElementById('edit_currency_name').value = data.currency_name;
            document.getElementById('edit_currency_code').value = data.currency_code;
            document.getElementById('edit_currency_symbol').value = data.currency_symbol;
        }

        if (action == 'delete') {
            document.getElementById('delete_currency_id').value = data.currency_id;
            document.getElementById('detele_currency_name').value = data.currency_name;
            document.getElementById('detele_currency_code').value = data.currency_code;
            document.getElementById('delete_currency_symbol').value = data.currency_symbol;
        }


    }
</script>