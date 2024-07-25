<div>
    <form action="#" method="POST" class="mb-5">

        <input type="hidden" name="employee_id" value="<?= $employee_id ?>">

        <div class="mt-4">
            <label for="client_firstname" class="main-label">First Name</label>
            <input type="text" class="main-input" id="client_firstname" name="client_firstname" required>
        </div>
        <div class="mt-4">
            <label for="client_lastname" class="main-label">Last Name</label>
            <input type="text" class="main-input" id="main-input" name="client_lastname" required>
        </div>
        <div class="mt-4">
            <label for="client_email" class="main-label">Email</label>
            <input type="text" class="main-input" id="main-input" name="client_email">
        </div>

        <!-- Visiblity -->

        <div class="mt-4">
            <label for="client_visibility" class="main-label">Visibility</label>
            <select class="main-input" id="client_visibility" name="client_visibility" required>
                <option value="public">Public</option>
                <option selected value="private">Private</option>
            </select>
        </div>

        <!-- Line -->
        <hr class="mt-8 mb-3 mx-2">

        <!-- Phone section -->

        <div class="mt-4">
            <div class="my-2 flex flex-row justify-start align-baseline">

                <label class="text-lg mr-4">Phone Numbers</label>

                <button type="button" id="add-phone-btn" class="border border-red-800 rounded-sm">
                    <svg class="text-red-800 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>


            </div>
            <div id="phone-section">

                <div class="phone-input flex flex-row">
                    <select class="main-input max-w-20 mx-2" name="country_id">
                        <?php foreach ($countries as $country) : ?>

                            <?php if (strtolower($country->country_code) == 'lebanon') : ?>
                                <option selected value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
                            <?php else : ?>
                                <option value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </select>

                    <input type="text" class="main-input mx-2" name="client_phones[]" placeholder="Phone Number">

                    <button type="button" class="remove-phone-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
                </div>

            </div>

        </div>


        <div class="w-full flex justify-center my-3">
            <button type="submit" class="main-btn w-2/6">Add Client</button>
        </div>
    </form>
</div>


<script>
    document.getElementById('add-phone-btn').addEventListener('click', function() {
        var phoneSection = document.getElementById('phone-section');
        var newPhoneInput = document.createElement('div');
        newPhoneInput.classList.add('phone-input');
        newPhoneInput.classList.add('flex');
        newPhoneInput.classList.add('flex-row');

        newPhoneInput.innerHTML = `
            <select class="main-input max-w-20 mx-2" name="country_id">
                        <?php foreach ($countries as $country) : ?>

                            <?php if (strtolower($country->country_code) == 'lebanon') : ?>
                                <option selected value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
                            <?php else : ?>
                                <option value="<?= $country->country_id ?>"><?= $country->country_code ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </select>

                    <input type="text" class="main-input mx-2" name="client_phones[]" placeholder="Phone Number">

                    <button type="button" class="remove-phone-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
        `;
        phoneSection.appendChild(newPhoneInput);
    });

    document.getElementById('phone-section').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-phone-btn')) {
            e.target.parentElement.remove();
        }
    });
</script>