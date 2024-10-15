<div popover id="client-popover" class="popover">
    <?= view_cell('\App\Cells\Utils\Search\SearchCell::render', [
        'title' => 'Client',
        'tableHeaders' => [
            'client_firstname' => 'Firstname',
            'client_lastname' => 'Lastname',
            'client_email' => 'Email',
            'phone_numbers' => 'Phone'
        ],
        'selectedClassName' => 'selected-row-client',
        'onSelect' => 'onSelectClient()',
        'url' => '/api/clients/search?search='
    ]) ?>
</div>

<script>
    function onSelectClient() {
        //Close the popover
        closePopover('client-popover');

        const selectedRow = document.querySelector('.selected-row-client');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);

            var client_id_form = document.getElementById('client_id');
            var client_firstname_form = document.getElementById('client_firstname');
            var client_lastname_form = document.getElementById('client_lastname');
            var client_email_form = document.getElementById('client_email');


            client_id_form.value = data.client_id;
            // client_id_form.readOnly = true;
            // client_id_form.classList += ' main-input-readonly';
            client_firstname_form.value = data.client_firstname;
            // client_firstname_form.readOnly = true;
            // client_firstname_form.classList += ' main-input-readonly';
            client_lastname_form.value = data.client_lastname;
            // client_lastname_form.readOnly = true;
            // client_lastname_form.classList += ' main-input-readonly';
            client_email_form.value = data.client_email;
            // client_email_form.readOnly = true;
            // client_email_form.classList += ' main-input-readonly';

            var phones = data.phones;

            var phoneSection = document.getElementById('phone-section');

            if (phones === null || phones.length === 0) {
                phoneSection.innerHTML = '';
            } else {

                phoneSection.innerHTML = '';

                phones.forEach((phone, index) => {
                    var newPhoneInput = document.createElement('div');

                    newPhoneInput.innerHTML = `
                        <?= view_cell('App\Cells\Clients\Phone\PhoneFormCell::render', ['countries' => $countries]) ?>
                        `;
                    var phoneCountry = newPhoneInput.querySelector('.phone-country');
                    var phoneNumber = newPhoneInput.querySelector('.phone-number');
                    phoneCountry.value = phone['country_id'];
                    phoneNumber.value = phone['phone_number'];
                    //readOnly
                    // phoneCountry.disabled = true;
                    // phoneNumber.readOnly = true;

                    // phoneCountry.classList += ' main-input-readonly';
                    // phoneNumber.classList += ' main-input-readonly';

                    phoneSection.appendChild(newPhoneInput);

                });

            }

        }
    }
</script>