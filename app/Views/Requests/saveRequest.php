<div class="container-main">

    <div class="flex flex-row ">
        <a href="/requests" class="my-auto cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>
        <?php if ($method == 'NEW_REQUEST') : ?>
            <h2 class="main-title-page">Add Request</h2>
        <?php elseif ($method == "UPDATE_REQUEST") : ?>
            <h2 class="main-title-page">Edit Request of <?= $request->client_firstname . " " . $request->client_lastname ?></h2>
        <?php endif; ?>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="mt-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">



        <?php if ($method == 'NEW_REQUEST') : ?>
            <form action="/requests/add" method="POST">
            <?php elseif ($method == "UPDATE_REQUEST") : ?>
                <form action="/requests/edit/<?= $request->request_id ?>" method="POST">
                <?php endif; ?>


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
                        <!-- on click focus on the input -->
                        <button type="button" class="secondary-btn mx-auto w-5/12"

                            popovertarget="client-popover" onclick="document.getElementById('search_Client').focus()">
                            Select Client
                        </button>
                    </div>

                </div>

                <hr class="mx-2" />

                <div>
                    <h3 class="secondary-title">Location</h3>
                    <input type="hidden" name="city_id" id="city_id" required><br>

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
                            <button type="button" popovertarget="location-popover" onclick="document.getElementById('search_Location').focus()" class="secondary-btn mx-auto w-5/12">Select Location</button>
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
                            'data' => $paymentPlans,
                            'selectedId' => "payment_plan_id",
                            'selectedName' => 'Payment Plan'
                        ]) ?>
                    </div>
                </div>

                <hr class="mx-2" />

                <div class="flex flex-col w-full mb-4">
                    <h3 class="secondary-title">Employee</h3>
                    <?php if ($method == 'NEW_REQUEST') : ?>
                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee_id ?>" required><br>
                        <input type="text" class="main-input-readonly" readonly name="employee_name" id="employee_name" value="<?= $employee_name ?>" required><br>
                    <?php elseif ($method == "UPDATE_REQUEST") : ?>
                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $request->employee_id ?>" required><br>
                        <input type="text" class="main-input-readonly" readonly name="employee_name" id="employee_name" value="<?= $request->employee_name ?>" required><br>
                    <?php endif; ?>
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

                        <input type="text" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" class="secondary-input ml-2 w-10/12" id="request_budget_display" required><br>
                        <input type="hidden" name="request_budget" id="request_budget">
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
                        <label class="main-label">Type</label>
                        <select class="secondary-input" name="request_type" id="request_type" required>
                            <option value="normal" selected>Normal</option>
                            <option value="urgent">Urgent</option>
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
                </div>


                <hr class="mx-2" />

                <div>
                    <label class="main-label" for="comments">Comments:</label>
                    <textarea class="secondary-input" name="comments" id="comments"></textarea><br>
                </div>

                <?php if ($method == 'UPDATE_REQUEST') : ?>
                    <div class="flex flex-row w-full">
                        <div class="w-1/2 flex flex-row justify-center">
                            <!-- TODO: Delete button -->
                            <button class="secondary-btn my-4 w-full sm:w-5/12 cursor-pointer">Delete</button>
                        </div>
                        <div class="w-1/2 flex flex-row justify-center">
                            <input type="submit" class="main-btn my-4 w-full sm:w-5/12 cursor-pointer" value="submit">
                        </div>
                    </div>

                <?php else : ?>

                    <div class="w-full flex flex-row justify-center">
                        <input type="submit" class="main-btn my-4 w-full sm:w-5/12 cursor-pointer" value="Submit">
                    </div>

                <?php endif; ?>

                </form>


    </div>

    <div popover id="client-popover" class="w-full px-8 sm:px-2 md:w-3/4 max-h-screen overflow-auto">
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

    <div popover id="location-popover" class="w-full px-8 sm:px-2 md:w-3/4 max-h-screen overflow-auto">
        <?= view_cell('\App\Cells\Utils\Search\SearchCell::render', [
            'title' => 'Location',
            'tableHeaders' => [
                'country_name' => 'Country',
                'region_name' => 'Region',
                'subregion_name' => 'Subregion',
                'city_name' => 'City'
            ],
            'selectedClassName' => 'selected-row-location',
            'onSelect' => 'onSelectLocation()',
            'url' => '/api/locations/search?search='
        ]) ?>

    </div>
</div>

<script>
    <?php

    $session = service('session');

    $data = $session->get('_ci_old_input');

    if (isset($data)) {
        echo "var data = " . json_encode($data['post']) . ";";

        echo "populateFields(data);";
    }

    if ($method == 'UPDATE_REQUEST') {
        echo "var data = " . json_encode($request) . ";";
        echo "populateFields(data);";
        echo "console.log(data);";
    }

    ?>


    function populateFields(data) {

        if (data.client_id) {
            document.getElementById('client_id').value = data.client_id;
        }

        if (data.client_firstname) {
            document.getElementById('client_firstname').value = data.client_firstname;
        }

        if (data.client_lastname) {
            document.getElementById('client_lastname').value = data.client_lastname;
        }

        if (data.client_email) {
            document.getElementById('client_email').value = data.client_email;
        }

        if (data.client_phone) {
            document.getElementById('client_phone').value = data.client_phone;
        }

        if (data.city_id) {
            document.getElementById('city_id').value = data.city_id;
        }

        if (data.country) {
            document.getElementById('country').value = data.country;
        }

        if (data.region) {
            document.getElementById('region').value = data.region;
        }

        if (data.subregion) {
            document.getElementById('subregion').value = data.subregion;
        }

        if (data.city) {
            document.getElementById('city').value = data.city;
        }

        if (data.payment_plan_id && data.payment_plan_name) {
            document.getElementById('result_id_payment_plan_id').value = data.payment_plan_id;
            document.getElementById('search_payment_plan_id').value = data.payment_plan_name;

        }

        if (data.currency_id) {
            document.getElementById('currency_id').value = data.currency_id;
        }

        if (data.request_budget) {
            document.getElementById('request_budget').value = data.request_budget;
            document.getElementById('request_budget_display').value = parseFloat(data.request_budget).toLocaleString();
        }

        if (data.request_priority) {
            document.getElementById('request_priority').value = data.request_priority;
        }

        if (data.request_state) {
            document.getElementById('request_state').value = data.request_state;
        }

        if (data.request_type) {
            document.getElementById('request_type').value = data.request_type;
        }

        if (data.comments) {
            document.getElementById('comments').value = data.comments;
        }


    }

    function onSelectClient() {
        //Close the popover
        closePopover('client-popover');

        const selectedRow = document.querySelector('.selected-row-client');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);
            document.getElementById('client_id').value = data.client_id;
            document.getElementById('client_firstname').value = data.client_firstname;
            document.getElementById('client_lastname').value = data.client_lastname;
            document.getElementById('client_email').value = data.client_email;
            document.getElementById('client_phone').value = data.phone_numbers;
        }
    }

    function onSelectLocation() {
        //Close the popover
        closePopover('location-popover');

        const selectedRow = document.querySelector('.selected-row-location');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);
            document.getElementById('city_id').value = data.city_id;
            document.getElementById('country').value = data.country_name;
            document.getElementById('region').value = data.region_name;
            document.getElementById('subregion').value = data.subregion_name;
            document.getElementById('city').value = data.city_name;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('request_budget_display');
        const hiddenInput = document.getElementById('request_budget');

        displayInput.addEventListener('input', function(e) {
            let value = e.target.value;
            value = value.replace(/,/g, ''); // Remove existing commas
            if (!isNaN(value) && value !== '') {
                hiddenInput.value = value; // Update hidden input with numeric value
                value = parseFloat(value).toLocaleString(); // Format value with commas
            } else {
                hiddenInput.value = ''; // Clear hidden input if value is not a number
            }
            e.target.value = value;
        });
    });
</script>