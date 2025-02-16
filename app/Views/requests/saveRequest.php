<div class="container-main max-w-4xl">

    <div class="flex flex-row ">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <p>Return</p>
        </button>
        <?php if ($method == 'NEW_REQUEST') : ?>
            <h2 class="main-title-page">Add Request</h2>
        <?php elseif ($method == "UPDATE_REQUEST") : ?>
            <h2 class="main-title-page">Edit Request of <?= $request->client_firstname . " " . $request->client_lastname ?></h2>
        <?php endif; ?>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">



        <?php if ($method == 'NEW_REQUEST') : ?>
            <form action="/requests/add" method="POST">
            <?php elseif ($method == "UPDATE_REQUEST") : ?>
                <form action="/requests/edit/<?= $request->request_id ?>" method="POST">
                <?php endif; ?>


                <h3 class="secondary-title">Client</h3>
                <div class="w-full text-end">
                    <button type="button" popovertarget="client-popover"
                        class="secondary-btn left-0">
                        Select Client
                    </button>

                </div>

                <input type="hidden" name="client_id" id="client_id" required><br>

                <div class="flex flex-col w-full mb-4">
                    <?= view_cell('App\Cells\Clients\ClientForm\ClientFormCell::render', ['countries' => $countries]) ?>
                </div>

                <hr class="mx-2" />

                <div>
                    <?php if ($method == 'NEW_REQUEST'): ?>
                        <?= view_cell('App\Cells\Utils\LocationFormHandler\LocationInternalFormCell::render') ?>
                    <?php else : ?>
                        <?= view_cell(
                            'App\Cells\Utils\LocationFormHandler\LocationInternalFormCell::render',
                            [
                                'isFetchPossible' => true,
                                'defaultCountryId' => $location->country_id,
                                'defaultRegionId' => $location->region_id,
                                'defaultSubregionId' => $location->subregion_id,
                                'defaultCityId' => $location->city_id
                            ]
                        ) ?>
                    <?php endif; ?>

                    <div>
                        <label class="main-label" for="request_location">Location Details:</label>
                        <textarea class="main-input" placeholder="Location address"
                            name="request_location" id="request_location"></textarea>
                    </div>
                    </textarea>
                </div>

                <hr class="mx-2" />

                <div>

                    <h3 class="secondary-title">Payment Plan</h3>

                    <textarea class="main-input" placeholder="Request Payment plan options"
                        name="request_payment_plan" id="request_payment_plan"></textarea>

                </div>

                <hr class="mx-2" />

                <div class="flex flex-col w-full mb-4">
                    <div>
                        <label class="main-label" for="agent">Agent:</label>

                        <select class="secondary-input" name="agent_id" id="agent" required>

                            <?php foreach ($agents as $agent) : ?>

                                <?php if ($method == 'NEW_REQUEST') : ?>
                                    <?php if ($agent->agent_id == $employee_id) : ?>
                                        <option value="<?= $agent->agent_id ?>" selected><?= $agent->agent_name ?></option>
                                    <?php else : ?>
                                        <option value="<?= $agent->agent_id ?>"><?= $agent->agent_name ?></option>
                                    <?php endif; ?>
                                <?php elseif ($method == "UPDATE_REQUEST") : ?>

                                    <?php if ($agent->agent_id == $request->agent_id) : ?>
                                        <option value="<?= $agent->agent_id ?>" selected><?= $request->agent_name ?></option>
                                    <?php else : ?>
                                        <option value="<?= $agent->agent_id ?>"><?= $agent->agent_name ?></option>
                                    <?php endif; ?>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </div>
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
                            <?php foreach ($requestPriorities as $requestPriority) : ?>
                                <?php if ($requestPriority == 'medium') : ?>
                                    <option value="<?= $requestPriority ?>" selected><?= ucfirst($requestPriority) ?></option>
                                <?php else : ?>
                                    <option value="<?= $requestPriority ?>"><?= ucfirst($requestPriority) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select><br>
                    </div>
                    <div class="my-4">
                        <label class="main-label">Status</label>
                        <select class="secondary-input" name="request_state" id="request_state" required>
                            <?php foreach ($requestStates as $requestState) : ?>
                                <?php if ($requestState == 'pending') : ?>
                                    <option value="<?= $requestState ?>" selected><?= ucfirst($requestState) ?></option>
                                <?php else : ?>
                                    <option value="<?= $requestState ?>"><?= ucfirst($requestState) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select><br>
                    </div>
                </div>


                <hr class="mx-2" />

                <div>
                    <label class="main-label" for="comments">Comments:</label>
                    <textarea class="secondary-input" rows="5" name="comments" id="comments"></textarea><br>
                </div>

                <?php if ($method == 'UPDATE_REQUEST') : ?>
                    <div class="grid grid-cols-2 gap-4 w-full my-4">
                        <div class="w-full flex flex-row justify-center">
                            <button popovertarget="delete-popover" type="button" class="secondary-btn my-4 w-full sm:w-5/12 cursor-pointer">Delete</button>
                        </div>
                        <div class="w-full flex flex-row justify-center">
                            <input type="submit" class="primary-btn my-4 w-full sm:w-5/12 cursor-pointer" value="submit">
                        </div>
                    </div>

                <?php else : ?>

                    <div class="w-full flex flex-row justify-center">
                        <input type="submit" class="primary-btn my-4 w-full sm:w-5/12 cursor-pointer" value="Submit">
                    </div>

                <?php endif; ?>

                </form>


    </div>



    <?php if ($method === 'UPDATE_REQUEST') : ?>
        <div popover id="delete-popover" class="popover max-w-md">
            <div class="flex flex-col w-full justify-center">
                <h3 class="secondary-title text-center">Are you sure you want to delete this request?</h3>
                <div class="grid grid-cols-2 gap-4 w-full my-4">
                    <div class=" w-full">
                        <button type="button" class="primary-btn w-full cursor-pointer" onclick="closePopover('delete-popover')">Cancel</button>
                    </div>
                    <div class="w-full">
                        <button onclick="window.location.href='/requests/delete/<?= $request->request_id ?>'"
                            class="secondary-btn w-full cursor-pointer text-center">
                            Confirm
                        </button>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?= view_cell('App\Cells\Clients\ClientPopover\ClientPopoverCell::render', ['countries' => $countries]) ?>

    <script>
        <?php

        $session = service('session');

        $data = $session->get('_ci_old_input');


        if ($method === 'UPDATE_REQUEST' && !$data) {
            echo "var data = " . json_encode($request) . ";";
            echo 'var phones = ' . json_encode($phones) . ';';
            echo "data.phone_number = [];";
            echo "data.country_id = [];";
            echo "phones.forEach((phone, index) => {";
            echo "data.phone_number.push(phone.phone_number);";
            echo "data.country_id.push(phone.country_id);";
            echo "});";
            echo "populateFields(data);";
        }

        if (isset($data)) {
            echo "var data = " . json_encode($data['post']) . ";";
            echo "populateFields(data);";
        }



        ?>


        function populateFields(data) {

            <?php if ($method === 'UPDATE_REQUEST') : ?>
                if (data.client_id) {
                    document.getElementById('client_id').value = data.client_id;
                }
            <?php endif; ?>


            if (data.client_firstname) {
                document.getElementById('client_firstname').value = data.client_firstname;
            }

            if (data.client_lastname) {
                document.getElementById('client_lastname').value = data.client_lastname;
            }

            if (data.client_email) {
                document.getElementById('client_email').value = data.client_email;
            }

            if (data.phone_number && data.phone_number.length > 0) {
                var phones = data.phone_number;

                var phoneSection = document.getElementById('phone-section');
                phoneSection.innerHTML = '';

                phones.forEach((phone, index) => {
                    var newPhoneInput = document.createElement('div');

                    newPhoneInput.innerHTML = `
                        <?= view_cell('App\Cells\Clients\Phone\PhoneFormCell::render', ['countries' => $countries]) ?>
                        `;
                    newPhoneInput.querySelector('.phone-country').value = data.country_id[index];
                    newPhoneInput.querySelector('.phone-number').value = data.phone_number[index];

                    phoneSection.appendChild(newPhoneInput);

                });

            }


            if (data.request_location) {
                document.getElementById('request_location').value = data.request_location;
            }



            if (data.request_payment_plan) {
                document.getElementById('request_payment_plan').value = data.request_payment_plan;
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

            if (data.comments) {
                document.getElementById('comments').value = data.comments;
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

</div>