<div class="container-main max-w-4xl">

    <div class="flex flex-row ">
        <button onclick="window.history.back()" class="my-auto cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </button>
        <?php if ($method == 'NEW_REQUEST') : ?>
            <h2 class="main-title-page">Add Listing</h2>
        <?php elseif ($method == "UPDATE_REQUEST") : ?>
            <h2 class="main-title-page">Edit Listing of <?= $property->client_firstname . " " . $property->client_lastname ?></h2>
        <?php endif; ?>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <?php if ($method == 'NEW_REQUEST') : ?>
            <form action="/listings/add" method="POST">
            <?php elseif ($method == "UPDATE_REQUEST") : ?>
                <form action="/listings/edit/<?= $property->property_id ?>" method="POST">
                <?php endif; ?>


                <!-- Client details -->
                <div>

                    <h3 class="secondary-title">Client</h3>
                    <div class="w-full text-end">
                        <button type="button" popovertarget="client-popover"
                            class="secondary-btn left-0">
                            Select Client
                        </button>

                    </div>

                    <input type="hidden" name="client_id" id="client_id"><br>

                    <div class="flex flex-col w-full mb-4">
                        <?= view_cell('App\Cells\Clients\ClientForm\ClientFormCell::render', ['countries' => $countries]) ?>
                    </div>

                </div>

                <hr class="mx-2" />


                <!-- Referral -->
                <div class="mb-4">
                    <h3 class="secondary-title">Referral</h3>

                    <label class="main-label" for="property_referral_name">Referral Name:</label>
                    <input type="text" id="property_referral_name" name="property_referral_name" class="main-input"><br>

                    <label class="main-label" for="property_referral_phone">Referral Phone:</label>
                    <input type="text" id="property_referral_phone" name="property_referral_phone" class="main-input"><br>
                </div>

                <hr class="mx-2" />

                <!-- Location -->
                <div>
                    <h3 class="secondary-title">Location</h3>
                    <input type="hidden" name="city_id" id="city_id" required><br>

                    <div class="flex flex-col w-full mb-4">
                        <div class="w-full flex flex-row my-2">
                            <input type="text" class="main-input-readonly mr-2" placeholder="Country" readonly name="country_name" id="country_name" required>
                            <input type="text" class="main-input-readonly" placeholder="Region" readonly name="region_name" id="region_name" required>
                        </div>
                        <div class="w-full flex flex-row my-2">
                            <input type="text" class="main-input-readonly mr-2" placeholder="Subregion" readonly name="subregion_name" id="subregion_name" required>
                            <input type="text" class="main-input-readonly " placeholder="City" readonly name="city_name" id="city_name" required>
                        </div>

                        <div class="w-full my-2 flex flex-row justify-center">
                            <button type="button" popovertarget="location-popover" onclick="document.getElementById('search_Location').focus()" class="secondary-btn mx-auto w-5/12">Select Location</button>
                        </div>

                        <div>
                            <label class="main-label" for="property_location">Location Details:</label>
                            <textarea class="main-input" placeholder="Location address"
                                name="property_location" id="property_location"></textarea>
                        </div>
                    </div>
                </div>

                <hr class="mx-2" />

                <!-- Payment plans -->
                <div>
                    <h3 class="secondary-title">Payment Plan</h3>
                    <div class="flex flex-col w-full mb-4">
                        <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                            'placeholder' => 'Search Payment Plan',
                            'data' => $paymentPlans,
                            'selectedId' => "payment_plan_id",
                            'selectedName' => 'payment_plan_name'
                        ]) ?>
                    </div>
                </div>

                <hr class="mx-2" />

                <!-- Property Details -->
                <div>
                    <h3 class="secondary-title">Details</h3>

                    <div class="my-4">
                        <label class="main-label" for="property_type_name">Property Type</label>
                        <div class="flex flex-col w-full">
                            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                                'placeholder' => 'Search Property Type',
                                'data' => $propertyType,
                                'selectedId' => "property_type_id",
                                'selectedName' => 'property_type_name'
                            ]) ?>
                        </div>

                    </div>


                    <div class="my-4">
                        <label class="main-label" for="property_status_name">Property Status</label>
                        <div class="flex flex-col w-full">
                            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                                'placeholder' => 'Search Property Status',
                                'data' => $propertyStatus,
                                'selectedId' => "property_status_id",
                                'selectedName' => 'property_status_name'
                            ]) ?>
                        </div>
                    </div>


                    <div class="my-4">

                        <label class="main-label" for="property_size">Property Size (m²):</label>
                        <input type="number" step="1" id="property_size" name="property_size" class="main-input"><br>

                    </div>

                    <div class="my-4 flex flex-col">
                        <label class="main-label" for="property_price_display">Price:</label>
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

                            <input type="text" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" class="secondary-input ml-2 w-10/12" id="property_price_display" required><br>
                            <input type="hidden" name="property_price" id="property_price">
                        </div>


                    </div>

                    <div class="my-4">
                        <label class="main-label" for="property_catch_phrase">Catch Phrase:</label>
                        <textarea id="property_catch_phrase" name="property_catch_phrase" class="main-input"></textarea><br>

                    </div>

                </div>

                <br>

                <div class=" w-full flex border-y border-gray-300">
                    <button type="button" id="land-btn" onclick="showLandForm()"
                        class=" w-1/2 py-4 text-center 
                            font-medium text-gray-700 focus:outline-none 
                            hover:bg-gray-200
                            ">
                        Land
                    </button>
                    <button type="button" id="apartment-btn" onclick="showApartmentForm()"
                        class="w-1/2 py-4 text-center font-medium text-gray-700  focus:outline-none
                        hover:bg-gray-200
                    ">
                        Apartment
                    </button>

                </div>
                <input id="land_apartment" type="text" hidden name="property_land_or_apartment" value="property">

                <div id="show-land" class="hidden">
                    <?= view_cell('App\Cells\Listings\LandForm\LandFormCell', ['landTypes' => $landTypes]) ?>
                </div>

                <div id="show-apartment" class="hidden">

                    <?= view_cell('App\Cells\Listings\ApartmentForm\ApartmentFormCell', ['apartmentGender' => $apartmentGender]) ?>

                </div>

                <div class="my-4 flex flex-row w-full justify-evenly">
                    <button id="clear-btn" type="button" disabled class="secondary-btn-disabled w-2/6">Clear</button>
                    <button id="submit-btn" type="submit" disabled class="primary-btn-disabled w-2/6">Save</button>
                </div>

                </form>

    </div>
</div>

<?= view_cell('App\Cells\Settings\Location\LocationPopover\LocationPopoverCell::render') ?>

<?= view_cell('App\Cells\Clients\ClientPopover\ClientPopoverCell::render', ['countries' => $countries]) ?>

<script>
    function showLandForm() {

        var form = document.getElementById('show-land');
        var apartmentForm = document.getElementById('show-apartment');
        var land_apartment = document.getElementById('land_apartment');
        var clear_btn = document.getElementById('clear-btn');
        var submit_btn = document.getElementById('submit-btn');

        var landBtn = document.getElementById('land-btn');
        var apartmentBtn = document.getElementById('apartment-btn');


        landBtn.classList.add('bg-gray-200');
        apartmentBtn.classList.remove('bg-gray-200');

        apartmentForm.classList.add('hidden');
        form.classList.remove('hidden');

        land_apartment.value = 'land';
        clear_btn.disabled = false;
        submit_btn.disabled = false;
        clear_btn.classList.remove('secondary-btn-disabled');
        submit_btn.classList.remove('primary-btn-disabled');
        clear_btn.classList.add('secondary-btn');
        submit_btn.classList.add('primary-btn');




    }

    function showApartmentForm() {

        var form = document.getElementById('show-apartment');
        var landForm = document.getElementById('show-land');
        var land_apartment = document.getElementById('land_apartment');
        var clear_btn = document.getElementById('clear-btn');
        var submit_btn = document.getElementById('submit-btn');

        var landBtn = document.getElementById('land-btn');
        var apartmentBtn = document.getElementById('apartment-btn');

        apartmentBtn.classList.add('bg-gray-200');
        landBtn.classList.remove('bg-gray-200');

        landForm.classList.add('hidden');
        form.classList.remove('hidden');

        land_apartment.value = 'apartment';
        clear_btn.disabled = false;
        submit_btn.disabled = false;
        clear_btn.classList.remove('secondary-btn-disabled');
        submit_btn.classList.remove('primary-btn-disabled');
        clear_btn.classList.add('secondary-btn');
        submit_btn.classList.add('primary-btn');

    }

    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('property_price_display');
        const hiddenInput = document.getElementById('property_price');

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