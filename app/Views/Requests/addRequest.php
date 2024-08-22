<div class="container-main">
    <h2 class="main-title-page">Add Request</h2>
    <div class="mt-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <form action="process_request.php" method="POST">


            <h3 class="secondary-title">Client</h3>
            <input type="hidden" name="client_id" id="client_id" required><br>
            <div class="flex flex-col w-full mb-4">
                <div class="w-full flex flex-row my-2">
                    <input type="text" class="main-input-readonly mx-2" placeholder="Firstname" readonly name="client_firstname" id="client_firstname" required>
                    <input type="text" class="main-input-readonly mx-2" placeholder="Lastname" readonly name="client_lastname" id="client_lastname" required>
                </div>
                <div class="w-full flex flex-row my-2">
                    <input type="text" class="main-input-readonly mx-2" placeholder="Email" readonly name="client_email" id="client_email" required>
                    <input type="text" class="main-input-readonly mx-2" placeholder="Phone" readonly name="client_phone" id="client_phone" required>
                </div>
                <div class="w-full my-2 flex flex-row justify-center">
                    <button type="button" class="secondary-btn mx-auto w-5/12"
                        popovertarget="client-popover">
                        Select Client
                    </button>
                </div>

            </div>

            <hr class="mx-2" />

            <div>
                <h3 class="secondary-title">Location</h3>
                <input type="hidden" name="location_id" id="location_id" required><br>

                <div class="flex flex-col w-full mb-4">
                    <div class="w-full flex flex-row my-2">
                        <input type="text" class="main-input-readonly mx-2" placeholder="Country" readonly name="country" id="country" required>
                        <input type="text" class="main-input-readonly mx-2" placeholder="Region" readonly name="region" id="region" required>
                    </div>
                    <div class="w-full flex flex-row my-2">
                        <input type="text" class="main-input-readonly mx-2" placeholder="Subregion" readonly name="subregion" id="subregion" required>
                        <input type="text" class="main-input-readonly mx-2" placeholder="City" readonly name="city" id="city" required>
                    </div>
                    <div class="w-full my-2 flex flex-row justify-center">
                        <button type="button"  popovertarget="location-popover" class="secondary-btn mx-auto w-5/12">Select Location</button>
                    </div>

                </div>
            </div>


            <hr class="mx-2" />

            <div>

                <h3 class="secondary-title">Payment Plan</h3>
                <input type="hidden" name="payment_plan_id" id="payment_plan_id" required><br>

                <div class="flex flex-col w-full mb-4">
                    <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                        'placeholder' => 'Search Payment Plan',
                        'data' => [],
                        'selectedId' => "payment_plan_id",
                        'selectedName' => 'Payment Plan'
                    ]) ?>
                </div>
            </div>

            <hr class="mx-2" />

            <div class="flex flex-col w-full mb-4">
                <h3 class="secondary-title">Employee</h3>
                <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee_id ?>" required><br>
                <input type="text" class="main-input-readonly" readonly name="employee_name" id="employee_name" value="<?= $employee_name ?>" required><br>
            </div>

            <hr class="mx-2" />

            <div class="flex flex-col w-full mb-4">
                <h3 class="secondary-title">Budget</h3>

                <div class="w-full flex flex-row">

                    <select class="secondary-input w-2/12" name="currency_id" id="currency_id" required>
                        <?php foreach ($currencies as $currency) : ?>
                            <?php if ($currency->currency_symbol == '$') : ?>
                                <option value="<?= $currency->currency_id ?>" selected><?= $currency->currency_symbol ?></option>
                            <?php else : ?>
                                <option value="<?= $currency->currency_id ?>"><?= $currency->currency_symbol ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                    <input type="number" class="secondary-input ml-2 w-10/12" name="request_budget" id="request_budget" required><br>
                </div>

            </div>

            <hr class="mx-2" />

            <div class="mt-4">
                <h3 class="secondary-title my-2">Statuses</h3>

                <div class="my-4">
                    <label class="main-label">Priority</label>
                    <select class="secondary-input" name="request_priority" id="request_priority" required>
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select><br>
                </div>

                <div class="my-4">
                    <label class="main-label">Status</label>
                    <select class="secondary-input" name="request_state" id="request_state" required>
                        <option value="pending" selected>Pending</option>
                        <option value="fulfilled">Fulfilled</option>
                        <option value="rejected">Rejected</option>
                        <option value="cancelled">Cancelled</option>
                    </select><br>
                </div>

                <div class="my-4">
                    <label class="main-label">Type</label>
                    <select class="secondary-input" name="request_type" id="request_type" required>
                        <option value="normal" selected>Normal</option>
                        <option value="urgent">Urgent</option>
                    </select><br>
                </div>
            </div>


            <hr class="mx-2" />

            <div>
                <label class="main-label" for="comments">Comments:</label>
                <textarea class="secondary-input" name="comments" id="comments"></textarea><br>
            </div>

            <div class="w-full flex flex-row justify-center">
                <input type="submit" class="main-btn my-4 w-full sm:w-5/12" value="Submit">
            </div>

        </form>


    </div>

    <div popover id="client-popover" class="w-full px-8 sm:px-2 sm:3/4 md:w-1/2 max-h-screen overflow-auto">
        <?= view_cell('\App\Cells\Utils\Search\SearchCell::render', [
            'title' => 'Client',
            'tableHeaders' => [
                'client_firstname' => 'Firstname',
                'client_lastname' => 'Lastname',
                'client_email' => 'Email',
                'phone_numbers' => 'Phone'
            ],
            'onSelect' => 'onSelectClient()',
            'url' => '/api/clients/search?search='
        ]) ?>
    </div>

    <div popover id="location-popover" class="w-full px-8 sm:px-2 sm:3/4 md:w-1/2 max-h-screen overflow-auto">
        <?= view_cell('\App\Cells\Utils\Search\SearchCell::render', [
            'title' => 'Location',
            'tableHeaders' => [
                'country_name' => 'Country',
                'region_name' => 'Region',
                'subregion_name' => 'Subregion',
                'city_name' => 'City'
            ],
            'onSelect' => 'onSelectLocation()',
            'url' => '/api/locations/search?search='
        ]) ?>

    </div>
</div>

<script>

    function onSelectClient(){
        //Close the popover
        closePopover('client-popover');

        const selectedRow = document.querySelector('.selected-row');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);
            document.getElementById('client_id').value = data.client_id;
            document.getElementById('client_firstname').value = data.client_firstname;
            document.getElementById('client_lastname').value = data.client_lastname;
            document.getElementById('client_email').value = data.client_email;
            document.getElementById('client_phone').value = data.phone_numbers;
        }
    }

    function onSelectLocation(){
        //Close the popover
        closePopover('location-popover');

        const selectedRow = document.querySelector('.selected-row');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);
            document.getElementById('location_id').value = data.city_id;
            document.getElementById('country').value = data.country_name;
            document.getElementById('region').value = data.region_name;
            document.getElementById('subregion').value = data.subregion_name;
            document.getElementById('city').value = data.city_name;
        }
    }

    function closePopover(popoverId) {
        const popover = document.getElementById(popoverId);

        popover.hidePopover();
    }
</script>