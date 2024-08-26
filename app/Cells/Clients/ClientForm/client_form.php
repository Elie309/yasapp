<div class="container-main">

    <?php
    $clientDataOnError = session()->get('_ci_old_input');

    ?>

    <div class="flex flex-row ">

        <!-- Return back in history -->
        <a href="/clients" class="my-auto cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>

        <?php if (isset($clientFromRequest) && $clientFromRequest == 'edit') : ?>
            <h2 class="main-title-page">Edit Client</h2>
        <?php else : ?>
            <h2 class="main-title-page">Add Client</h2>
        <?php endif; ?>

    </div>


    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <form action="" method="POST" class="mt-3 mb-8 bg-white p-10 shadow-md rounded-md">

        <?php if (isset($clientFromRequest) && $clientFromRequest == 'edit') : ?>
            <input type="hidden" id="client_id" name="client_id" value="">
        <?php endif; ?>

        <input type="hidden" name="employee_id" value="<?= $employee_id ?>">

        <div class="mt-4">
            <label for="client_firstname" class="main-label">First Name<span class="text-red-800">*</span></label>
            <input type="text" class="main-input" id="client_firstname" name="client_firstname" required>
        </div>
        <div class="mt-4">
            <label for="client_lastname" class="main-label">Last Name<span class="text-red-800">*</span></label>
            <input type="text" class="main-input" id="client_lastname" name="client_lastname" required>
        </div>
        <div class="mt-4">
            <label for="client_email" class="main-label">Email</label>
            <input type="text" class="main-input" id="client_email" name="client_email">
        </div>

        <!-- Visiblity -->

        <div class="mt-4">
            <label for="client_visibility" class="main-label">Visibility<span class="text-red-800">*</span></label>
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

                <button type="button" id="add-phone-btn">
                    <svg class=" text-gray-800 size-6 hover:text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>


            </div>
            <div id="phone-section">

            </div>

        </div>


        <!-- Line -->

        <div class="w-full flex justify-center my-3">
            <button type="submit" class="main-btn w-2/6">Save</button>
        </div>
    </form>

    <script>
        document.getElementById('add-phone-btn').addEventListener('click', function() {
            var phoneSection = document.getElementById('phone-section');
            var newPhoneInput = document.createElement('div');
            newPhoneInput.classList.add('phone-input');
            newPhoneInput.classList.add('flex');
            newPhoneInput.classList.add('flex-row');

            newPhoneInput.innerHTML = `
            <?= view_cell('App\Cells\Clients\Phone\PhoneFormCell::render', ['countries' => $countries]) ?>
        `;
            phoneSection.appendChild(newPhoneInput);
        });

        function removeParent(event) {
            event.parentElement.remove();
        }


        <?php if ((isset($clientFromRequest) && $clientFromRequest == 'edit') || isset($clientDataOnError)) : ?>

            setData();


            function setData() {

                <?php if (isset($clientDataOnError)) : ?>
                    let data = JSON.parse("<?= addslashes(json_encode($clientDataOnError['post'])) ?>");
                    var client = data;
                <?php else : ?>
                    var client = JSON.parse("<?= addslashes(json_encode($client)) ?>");
                    var phones = JSON.parse('<?= addslashes(json_encode($phones)) ?>');
                    var countries = JSON.parse('<?= addslashes(json_encode($countries)) ?>');
                <?php endif; ?>


                document.getElementById('client_firstname').value = client.client_firstname;
                document.getElementById('client_lastname').value = client.client_lastname;
                document.getElementById('client_email').value = client.client_email;
                document.getElementById('client_visibility').value = client.client_visibility;


                <?php if (isset($clientFromRequest) && $clientFromRequest == 'edit') : ?>
                    document.getElementById('client_id').value = client.client_id;


                    var phoneSection = document.getElementById('phone-section');
                    phoneSection.innerHTML = '';

                    phones.forEach(phone => {
                        var newPhoneInput = document.createElement('div');
                        newPhoneInput.classList.add('phone-input');
                        newPhoneInput.classList.add('flex');
                        newPhoneInput.classList.add('flex-row');

                        newPhoneInput.innerHTML = `
                        <?= view_cell('App\Cells\Clients\Phone\PhoneFormCell::render', ['countries' => $countries]) ?>
                        `;

                        newPhoneInput.querySelector('.phone-country').value = phone.country_id;
                        newPhoneInput.querySelector('.phone-number').value = phone.phone_number;

                        phoneSection.appendChild(newPhoneInput);
                    });

                <?php endif; ?>

            }

        <?php endif; ?>
    </script>
</div>