<div class="phone-input flex flex-row w-full my-1">

    <select class="main-input max-w-20 mr-2 phone-country" name="country_id[]">
        <?php foreach ($countries as $country) : ?>

            <?php if (strtolower($country->country_name) == 'lebanon') : ?>
                <option selected value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
            <?php else : ?>
                <option value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
            <?php endif; ?>
        <?php endforeach; ?>

    </select>

    <input type="text" class="main-input mx-2 phone-number" name="phone_number[]" placeholder="Phone Number">
    
    <button type="button" class="remove-phone-btn" onclick="removeParent(this)">
        <svg class=" text-gray-800 size-6 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </button>
   
</div>