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
                    <button type="button" class="secondary-btn mx-auto w-5/12" onclick="openModal('client')">Select Client</button>
                </div>

            </div>

            <hr class="mx-2" />

            <div>
                <h3 class="secondary-title">Location</h3>
                <input type="hidden" name="location_id" id="location_id" required><br>

                <div class="flex flex-col w-full mb-4">
                    <div class="w-full flex flex-row my-2">
                        <input type="text" class="main-input-readonly mx-2" placeholder="Country" readonly name="location_country" id="location_country" required>
                        <input type="text" class="main-input-readonly mx-2" placeholder="City" readonly name="location_city" id="location_city" required>
                    </div>
                    <div class="w-full flex flex-row my-2">
                        <input type="text" class="main-input-readonly mx-2" placeholder="Street" readonly name="location_street" id="location_street" required>
                        <input type="text" class="main-input-readonly mx-2" placeholder="Zip Code" readonly name="location_zip_code" id="location_zip_code" required>
                    </div>
                    <div class="w-full my-2 flex flex-row justify-center">
                        <button type="button" class="secondary-btn mx-auto w-5/12" onclick="openModal('location')">Select Location</button>
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
                <input type="hidden" name="employee_id" id="employee_id" required><br>
                <input type="text" class="main-input-readonly" readonly name="employee_name" id="employee_name" required><br>
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
</div>