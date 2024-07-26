<div class="container mx-auto p-4">

    <?php if ($formGetter == 'add') : ?>


        <!-- FROM ADD -->

        <form action="<?= $linkPostAdd ?>" method="POST" class="mx-auto my-3 w-5/6">

            <div class="mb-4">
                <label for="<?= $inputFormName ?>" class="main-label"><?php echo $title ?><span class="text-red-800">*</span></label>
                <input type="text" id="add_<?= $inputFormName ?>" placeholder="<?= $title ?> name" name="<?= $inputFormName ?>" class="main-input" required>
            </div>

            <button type="submit" class="w-full main-btn">Add <?php echo $title ?></button>
        </form>

    <?php endif; ?>

    <?php if ($formGetter == 'edit') : ?>

        <!-- FROM EDIT -->

        <form action="<?= $linkPostEdit ?>" method="POST" class="mx-auto my-3 w-5/6">

            <input type="hidden" name="<?= $inputFormId ?>" id="edit_<?= $inputFormId ?>" />

            <div class="mb-4">
                <label for="<?= $inputFormName ?>" class="main-label"><?php echo $title ?></label>
                <input type="text" id="edit_<?= $inputFormName ?>" placeholder="<?= $title ?> name" name="<?= $inputFormName ?>" class="main-input" required>
            </div>

            <button type="submit" class="w-full main-btn">Edit <?php echo $title ?></button>
        </form>

    <?php endif; ?>

    <?php if ($formGetter == 'delete') : ?>


        <form action="<?= $linkPostDelete ?>" method="POST" class="mx-auto my-3 w-5/6">

            <p class="text-center text-red-500">Are you sure you want to delete this <?php echo $title ?>?</p>

            <input type="hidden" name="<?= $inputFormId ?>" id="delete_<?= $inputFormId ?>" />

            <div class="mb-4">
                <label for="<?= $inputFormName ?>" class="main-label"><?php echo $title ?></label>
                <input type="text" id="delete_<?= $inputFormName ?>" readonly placeholder="<?= $title ?> name" name="<?= $inputFormName ?>" class="main-input-readonly" required>
            </div>

            <button type="submit" class="w-full main-btn">Delete <?php echo $title ?></button>
        </form>

    <?php endif; ?>

</div>

<script>
    function setFormDetails(action) {

        var data = JSON.parse(sessionStorage.getItem('tempTableData'));

        if (action == 'edit') {

            document.getElementById('edit_<?= $inputFormId ?>').value = data.payment_plan_id;
            document.getElementById('edit_<?= $inputFormName ?>').value = data.payment_plan_name;
        }
        
        if (action == 'delete') {

            document.getElementById('delete_<?= $inputFormId ?>').value = data.payment_plan_id;
            document.getElementById('delete_<?= $inputFormName ?>').value = data.payment_plan_name;
        }

    }
</script>