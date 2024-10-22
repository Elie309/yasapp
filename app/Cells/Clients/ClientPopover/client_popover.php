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
            client_firstname_form.value = data.client_firstname;
            client_lastname_form.value = data.client_lastname;
            client_email_form.value = data.client_email;

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

                    phoneSection.appendChild(newPhoneInput);

                });

            }

        }
    }
</script>