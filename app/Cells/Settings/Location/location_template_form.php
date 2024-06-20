<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold text-center mb-8">Add <?php echo $title ?></h1>

    <form action="<?= $linkPost ?>" method="POST" class="bg-white p-6 rounded shadow-md">


        <?php if (strtolower($title) === "country") { ?>

            <div class="mb-4">
                <label for="country_code" class="block text-gray-700">Country Code</label>
                <input type="text" id="country_code" name="country_code" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
            </div>


        <?php } else { ?>

            <div class="mb-4">
                <label for="<?= $selectFormId ?>" class="block text-gray-700"><?php echo $selectFormName ?> name</label>
                <select id="<?= $selectFormId ?>" name="<?= $selectFormId ?>" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
                    <?php foreach ($selectOptions as $option) : ?>
                        <option value="<?= esc($option['id']) ?>"><?= esc($option['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        <?php } ?>

        <div class="mb-4">
            <label for="<?= $inputFormId ?>" class="block text-gray-700"><?php echo $inputFormName ?></label>
            <input type="text" id="<?= $inputFormId ?>" name="<?= $inputFormId ?>" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>
        </div>
        <button type="submit" class="w-full bg-red-800 text-white py-2 rounded hover:bg-red-900">Add <?php echo $inputFormName ?></button>
    </form>

</div>