<div class="container-main">

    <?php
    $clientDataOnError = session()->get('_ci_old_input');

    ?>

    <div class="flex flex-row ">

        <!-- Return back in history -->
        <button onclick="window.history.back()" class="my-auto cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </button>

        <?php if (isset($method) && $method == 'UPDATE_REQUEST') : ?>
            <h2 class="main-title-page">Edit Client</h2>
        <?php else : ?>
            <h2 class="main-title-page">Add Client</h2>
        <?php endif; ?>

    </div>


    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <form action="" method="POST" class="mt-3 mb-8 bg-white p-10 shadow-md rounded-md">

        <?php if (isset($method) && $method == 'UPDATE_REQUEST') : ?>
            <input type="hidden" id="client_id" name="client_id" value="">
        <?php endif; ?>

        <input type="hidden" name="employee_id" value="<?= $employee_id ?>">

        
        <?= view_cell('App\Cells\Clients\ClientForm\ClientFormCell::render', ['countries' => $countries]) ?>


        <!-- Line -->

        <div class="w-full flex justify-center my-3">
            <button type="submit" class="main-btn w-2/6">Save</button>
        </div>
    </form>

    <script>
        

        <?php if ((isset($method) && $method == 'UPDATE_REQUEST') || isset($clientDataOnError)) : ?>

            setData();


            function setData() {

                <?php if (isset($clientDataOnError)) : ?>
                    let data = JSON.parse("<?= addslashes(json_encode($clientDataOnError['post'])) ?>");
                    var client = data;
                    var phones = [];
                    data.phone_number.forEach((phone, index) => {
                        phones.push({
                            country_id: data.country_id[index],
                            phone_number: phone
                        });
                    });
                <?php else : ?>
                    var client = JSON.parse("<?= addslashes(json_encode($client)) ?>");
                    var phones = JSON.parse('<?= addslashes(json_encode($phones)) ?>');
                    var countries = JSON.parse('<?= addslashes(json_encode($countries)) ?>');
                <?php endif; ?>


                document.getElementById('client_firstname').value = client.client_firstname;
                document.getElementById('client_lastname').value = client.client_lastname;
                document.getElementById('client_email').value = client.client_email;


                <?php if (isset($method) && $method == 'UPDATE_REQUEST') : ?>
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