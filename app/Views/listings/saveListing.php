<div class="container-main max-w-4xl">

    <div class="flex flex-row ">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="main-title-page">
            <?= $method == 'NEW_REQUEST' ? 'Add Listing'
                : 'Edit Listing of ' . $property->client_firstname . ' ' . $property->client_lastname ?>
        </h2>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 p-4 min-w-full overflow-auto">

        <form action="<?= $method == 'NEW_REQUEST' ? '/listings/add' : '/listings/edit/' . $property->property_id ?>" method="POST">
            <!-- Client details -->
            <h3 class="secondary-title">Client</h3>

            <div class="form-section">
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

            <h3 class="secondary-title">Referral</h3>

            <!-- Referral -->
            <div class="form-section">
                <div class="flex flex-row w-full mb-4">
                    <div class="w-1/2 mr-2">
                        <label class="main-label" for="property_referral_name">Referral Name:</label>
                        <input type="text" id="property_referral_name" name="property_referral_name" class="main-input">
                    </div>
                    <div class="w-1/2 ml-2">
                        <label class="main-label" for="property_referral_phone">Referral Phone:</label>
                        <input type="text" id="property_referral_phone" name="property_referral_phone" class="main-input">
                    </div>
                </div>
            </div>

            <!-- Location -->
            <h3 class="secondary-title">Location</h3>

            <div class="form-section">

                <div class="flex flex-col w-full mb-4">
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
                                'defaultCityId' => $location->city_id,
                                'employee_id' => $employee_id,
                                'role' => $role
                            ]
                        ) ?>
                    <?php endif; ?>


                    <div>
                        <label class="main-label" for="property_location">Location Details:</label>
                        <textarea class="main-input" placeholder="Location address"
                            name="property_location" id="property_location"></textarea>
                    </div>
                </div>
            </div>

            <h3 class="secondary-title">Property Size (m²):</h3>

            <div class="form-section">

                <input type="number" id="property_size" name="property_size" placeholder="Enter property size in m²" class="main-input">

            </div>


            <?php if ($method == 'UPDATE_REQUEST') : ?>

                <?php if ($property->property_land_or_apartment == 'land') : ?>
                    <div class=" w-full flex border-y border-gray-300">
                        <button type="button" id="land-btn"
                            class=" w-full py-4 text-center 
                            font-medium text-gray-700 focus:outline-none 
                            hover:bg-gray-200">
                            Land
                        </button>
                    </div>

                <?php else : ?>
                    <div class=" w-full flex border-y border-gray-300">

                        <button type="button" id="apartment-btn"
                            class="w-full py-4 text-center font-medium text-gray-700  focus:outline-none
                                hover:bg-gray-200">
                            Apartment
                        </button>

                    </div>
                <?php endif; ?>


            <?php else : ?>

                <!-- Choose between -->

                <h3 class="secondary-title">Property Type</h3>

                <div class=" w-full flex my-4 border-gray-300">
                    <button type="button" id="apartment-btn" onclick="showPropertyForm('apartment')"
                        class="w-1/2 button-property-land-or-appartment">
                        Apartment
                    </button>
                    <button type="button" id="land-btn" onclick="showPropertyForm('land')"
                        class=" w-1/2 button-property-land-or-appartment">
                        Land
                    </button>

                </div>

            <?php endif; ?>

            <input id="property_land_or_apartment" type="text" hidden name="property_land_or_apartment" value="property">

            <div id="show-land" class="hidden">
                <?= view_cell('App\Cells\Listings\LandForm\LandFormCell', ['landTypes' => $landTypes]) ?>
            </div>

            <div id="show-apartment" class="hidden">
                <?= view_cell('App\Cells\Listings\ApartmentForm\ApartmentFormCell', [
                    'apartmentGender' => $apartmentGender,
                    'apartmentTypes' => $apartmentTypes,
                    'tilesOptions' => $tilesOptions
                ]) ?>
            </div>

            <h3 class="secondary-title">Property Details</h3>

            <!-- Property Details -->
            <div class="form-section">

                <div class="my-4">
                    <label class="main-label" for="property_status_name">Property Status</label>
                    <select name="property_status_id" id="property_status_id" class="main-input" required>
                        <option value="" selected disabled>Search Property Status</option>
                        <?php foreach ($propertyStatus as $status) : ?>
                            <option value="<?= $status['id'] ?>"><?= $status['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>




                <div class="my-4">
                    <label class="main-label" for="property_catch_phrase">Catch Phrase:</label>
                    <textarea id="property_catch_phrase" name="property_catch_phrase" class="main-input"></textarea><br>

                </div>


                <!-- Property Availability -->
                <div class="flex flex-col mb-4">
                    <h3 class="main-label">Property Availability</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                        <!-- Rent Option -->
                        <div class="flex flex-col border rounded p-3 hover:bg-gray-50">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="property_rent" name="prices[rent][is_enabled]" value="1" class="main-checkbox" onchange="togglePriceInput('rent')">
                                <label for="prices[rent][is_enabled]" class="ml-2 font-medium cursor-pointer">For Rent</label>
                            </div>

                            <div class="flex items-center mt-2">
                                <select id="rent_currency" name="prices[rent][currency_id]" class="secondary-input w-1/4" disabled>
                                    <?php foreach ($currencies as $currency) : ?>
                                        <option value="<?= $currency->currency_id ?>" <?= $currency->currency_symbol === '$' ? 'selected' : '' ?>>
                                            <?= $currency->currency_symbol ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <input type="text" id="property_rent_price_display" name="prices[rent][price_display]" class="secondary-input ml-2 w-3/4" placeholder="Rental price" oninput="updatePriceInput('rent')" disabled>
                                <input type="hidden" name="prices[rent][price]" id="property_rent_price">
                            </div>

                            <div class="mt-2" id="rent_additional_fields" style="display: none;">
                                <div class="flex items-center mb-2">
                                    <label for="rent_period" class="text-sm w-1/3">Rent Period:</label>
                                    <select id="rent_period" name="prices[rent][period]" class="secondary-input w-2/3">
                                        <option value="monthly" selected>Monthly</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="daily">Daily</option>
                                    </select>
                                </div>
                                <div class="w-full flex items-center justify-around my-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" id="rent_negotiable" name="prices[rent][is_negotiable]" value="1">
                                        <span class="ml-2 text-sm">Is Negotiable</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" id="rent_primary" name="prices[rent][is_primary]" value="1">
                                        <span class="ml-2 text-sm">Is Primary</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Option -->
                        <div class="flex flex-col border rounded p-3 hover:bg-gray-50">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="property_sale" name="prices[sale][is_enabled]" value="1" class="main-checkbox" onchange="togglePriceInput('sale')">
                                <label for="property_sale" class="ml-2 font-medium cursor-pointer">For Sale</label>
                            </div>

                            <div class="flex items-center mt-2">
                                <select id="sale_currency" name="prices[sale][currency_id]" class="secondary-input w-1/4" disabled>
                                    <?php foreach ($currencies as $currency) : ?>
                                        <option value="<?= $currency->currency_id ?>" <?= $currency->currency_symbol === '$' ? 'selected' : '' ?>>
                                            <?= $currency->currency_symbol ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <input type="text" id="property_sale_price_display" name="prices[sale][price_display]" class="secondary-input ml-2 w-3/4" placeholder="Sale price" oninput="updatePriceInput('sale')" disabled>
                                <input type="hidden" name="prices[sale][price]" id="property_sale_price">
                            </div>

                            <div class="mt-2" id="sale_additional_fields" style="display: none;">
                                <div class="flex items-center mb-2">
                                    <label for="sale_payment_terms" class="text-sm w-1/3">Payment Terms:</label>
                                    <select id="sale_payment_terms" name="prices[sale][payment_terms]" class="secondary-input w-2/3">
                                        <option value="cash" selected>Cash</option>
                                        <option value="installments">Installments</option>
                                        <option value="mortgage">Mortgage</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                <div class="w-full flex items-center justify-around my-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" id="sale_negotiable" name="prices[sale][is_negotiable]" value="1">
                                        <span class="ml-2 text-sm">Is Negotiable</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" id="sale_primary" name="prices[sale][is_primary]" value="1">
                                        <span class="ml-2 text-sm">Is Primary</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="main-label">Payment Plan</h3>
                <textarea class="main-input" placeholder="Property Payment Plan Details"
                    name="property_payment_plan" id="property_payment_plan"></textarea>
            </div>

            <!-- Submit & Cancel -->
            <div class="form-section">
                <div class="flex flex-col sm:flex-row w-full justify-evenly gap-4">
                    <?php if ($method == 'UPDATE_REQUEST') : ?>
                        <button
                            type="button"
                            popovertarget="delete-popover"
                            class="group secondary-btn w-full sm:w-1/2 flex items-center justify-center">
                            Delete
                            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'trash', 'class' => 'group-hover:fill-white stroke-gray-800 size-5 ml-2']) ?>

                        </button>
                    <?php else: ?>
                        <button
                            id="clear-btn"
                            type="button"
                            disabled
                            class="secondary-btn disabled:secondary-btn-disabled w-full sm:w-1/2 flex items-center justify-center">
                            Clear
                            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'trash', 'class' => 'size-5']) ?>
                        </button>
                    <?php endif; ?>

                    <button
                        id="submit-btn"
                        type="submit"
                        class="group primary-btn disabled:primary-btn-disabled w-full sm:w-1/2 flex items-center  justify-center">
                        <?= $method == 'NEW_REQUEST' ? 'Add Property' : 'Update Property' ?>
                        <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'save', 'class' => 'group-hover:fill-white fill-red-800 size-5 ml-2 transition-colors ease-in-out']) ?>

                    </button>
                </div>
            </div>

        </form>
    </div>
</div>


<?php if ($method === 'UPDATE_REQUEST') : ?>
    <div popover id="delete-popover" class="popover max-w-md">
        <div class="flex flex-col w-full justify-center">
            <h3 class="secondary-title text-center">Are you sure you want to delete this property?</h3>
            <div class="grid grid-cols-2 gap-4 w-full my-4">
                <div class=" w-full">
                    <button type="button" class="primary-btn w-full cursor-pointer" onclick="closePopover('delete-popover')">Cancel</button>
                </div>
                <div class="w-full">
                    <button onclick="window.location.href='/listings/delete/<?= $property->property_id ?>'"
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
    ?>

    <?php if ($method == 'UPDATE_REQUEST' && !$data) : ?>
        var data = <?= json_encode($property) ?>;
        var landDetails = <?= json_encode($landDetails) ?>;
        var apartmentDetails = <?= json_encode($apartmentDetails) ?>;
        var phonesMain = <?= json_encode($phones) ?>;
        data.country_id = [];
        data.phone_number = [];
        data.phone_id = [];
        phonesMain.forEach((phone, index) => {
            data.phone_number.push(phone.phone_number);
            data.country_id.push(phone.country_id);
            data.phone_id.push(phone.phone_id);
        });


        if (landDetails) {
            data = Object.assign(data, landDetails);
        }

        if (apartmentDetails) {
            data = Object.assign(data, apartmentDetails);
        }


        populateField(data);


    <?php endif; ?>

    <?php

    if ($data) {


        echo "var data = " . json_encode($data) . ";";

        echo "populateField(data);";
    }

    ?>


    /**
     * Populate the form fields with the provided data.
     * @param {Object} data - The data to populate the fields with.
     */
    function populateField(data) {
        // Helper function to set value on simple fields
        function setValue(id, value) {
            const element = document.getElementById(id);
            if (element && value !== undefined) {
                element.value = value;
            }
        }

        // Helper function to set checkbox state
        function setCheckbox(id, value) {
            const element = document.getElementById(id);
            if (element && value !== undefined) {
                element.checked = value;
            }
        }

        // Client details
        setValue('client_id', data.client_id);
        setValue('client_firstname', data.client_firstname);
        setValue('client_lastname', data.client_lastname);
        setValue('client_email', data.client_email);

        // Handle phone numbers
        if (data.phone_number?.length > 0) {
            const phoneSection = document.getElementById('phone-section');
            phoneSection.innerHTML = '';

            data.phone_number.forEach((phone, index) => {
                const newPhoneInput = document.createElement('div');
                newPhoneInput.innerHTML = `<?= view_cell('App\Cells\Clients\Phone\PhoneFormCell::render', ['countries' => $countries]) ?>`;

                newPhoneInput.querySelector('.phone-country').value = data.country_id[index];
                newPhoneInput.querySelector('.phone-number').value = phone;
                newPhoneInput.querySelector('.phone-id').value = data.phone_id[index];

                phoneSection.appendChild(newPhoneInput);
            });
        }

        // Basic property details
        setValue('property_referral_name', data.property_referral_name);
        setValue('property_referral_phone', data.property_referral_phone);
        setValue('property_location', data.property_location);

        // Numeric values with conversion
        if (data.property_size) setValue('property_size', parseFloat(data.property_size));

        // Price with special formatting
        if (data.prices) {
            populatePriceSection('rent', data.prices.rent);
            populatePriceSection('sale', data.prices.sale);
        }

        setValue('property_catch_phrase', data.property_catch_phrase);
        setValue('property_payment_plan', data.property_payment_plan);
        setValue('property_status_id', data.property_status_id);

        // Property type selection (land or apartment)
        if (data.property_land_or_apartment) {
            setValue('property_land_or_apartment', data.property_land_or_apartment);

            if (data.property_land_or_apartment === 'land') {
                showPropertyForm('land');

                // Land specific fields
                setValue('land_type', data.land_type);
                if (data.land_zone_first) setValue('land_zone_first', parseFloat(data.land_zone_first));
                if (data.land_zone_second) setValue('land_zone_second', parseFloat(data.land_zone_second));
            } else {
                showPropertyForm('apartment');

                // Apartment basic fields
                if (data.ad_gender_id) {
                    setValue('result_id_apartment_gender_name', data.ad_gender_id);
                    setValue('search_apartment_gender_name', data.info_apartment_gender_name ?? data.apartment_gender_name);
                }

                if (data.ad_type_id) {
                    setValue('result_id_ad_type_name', data.ad_type_id);
                    setValue('search_ad_type_name', data.info_ad_type_name ?? data.ad_type_name);
                }

                // Special fields with dependencies
                if (data.ad_terrace !== undefined) {
                    setCheckbox('ad_terrace', data.ad_terrace);
                    const terraceArea = document.getElementById('ad_terrace_area');
                    if (terraceArea) {
                        terraceArea.disabled = !data.ad_terrace;
                        if (data.ad_terrace && data.ad_terrace_area) {
                            terraceArea.value = data.ad_terrace_area;
                        }
                    }
                }

                if (data.ad_roof !== undefined) {
                    setCheckbox('ad_roof', data.ad_roof);
                    const roofArea = document.getElementById('ad_roof_area');
                    if (roofArea) {
                        roofArea.disabled = !data.ad_roof;
                        if (data.ad_roof && data.ad_roof_area) {
                            roofArea.value = data.ad_roof_area;
                        }
                    }
                }

                // Apartment features - using arrays to reduce repetition
                const checkboxFields = [
                    'ad_furnished', 'ad_elevator',
                    'spec_heating_system', 'spec_heating_system_provision',
                    'spec_ac_system', 'spec_ac_system_provision',
                    'spec_double_wall', 'spec_double_glazing', 'spec_shutters_electrical',
                    'spec_oak_doors', 'spec_chimney', 'spec_indirect_light',
                    'spec_wood_panel_decoration', 'spec_stone_panel_decoration',
                    'spec_security_door', 'spec_alarm_system', 'spec_solar_heater',
                    'spec_intercom', 'spec_garage', 'specs_jacuzzi',
                    'spec_swimming_pool', 'spec_gym', 'spec_kitchenette', 'spec_driver_room'
                ];

                checkboxFields.forEach(field => setCheckbox(field, data[field]));

                // Text field groups
                const textFields = [
                    'ad_status_age', 'ad_floor_level', 'ad_apartments_per_floor', 'ad_view',
                    'partition_salon', 'partition_dining', 'partition_kitchen',
                    'partition_master_bedroom', 'partition_bedroom', 'partition_bathroom',
                    'partition_maid_room', 'partition_reception_balcony',
                    'partition_sitting_corner', 'partition_balconies',
                    'partition_parking', 'partition_storage_room', 'spec_tiles'
                ];

                textFields.forEach(field => setValue(field, data[field]));
            }
        }
    }

    /**
     * Populate the price section based on the type and values provided.
     * @param {string} type - The type of price (e.g., 'rent', 'sale')
     */
    function populatePriceSection(type, values) {
        if (!values) return;

        const checkbox = document.getElementById(`property_${type}`);
        const currency = document.getElementById(`${type}_currency`);
        const displayInput = document.getElementById(`property_${type}_price_display`);
        const hiddenInput = document.getElementById(`property_${type}_price`);
        const additionalFields = document.getElementById(`${type}_additional_fields`);

        if (values.is_enabled) {
            checkbox.checked = true;
            currency.disabled = false;
            displayInput.disabled = false;
            additionalFields.style.display = 'block';
        }

        if (values.currency_id !== undefined) currency.value = values.currency_id;
        if (values.price !== undefined) {
            displayInput.value = priceDisplay(values.price);
            hiddenInput.value = parseFloat(values.price);
        }

        if (type === 'rent' && values.period !== undefined) {
            setValue('rent_period', values.period);
        }

        if (type === 'sale' && values.payment_terms !== undefined) {
            setValue('sale_payment_terms', values.payment_terms);
        }

        setCheckbox(`${type}_negotiable`, values.is_negotiable);
        setCheckbox(`${type}_primary`, values.is_primary);
    }

    function showPropertyForm(type) {
        const landForm = document.getElementById('show-land');
        const apartmentForm = document.getElementById('show-apartment');
        const landBtn = document.getElementById('land-btn');
        const apartmentBtn = document.getElementById('apartment-btn');

        const propertyTypeInput = document.getElementById('property_land_or_apartment');

        if (type === 'land') {
            landBtn?.classList.add('bg-gray-200');
            apartmentBtn?.classList.remove('bg-gray-200');
            apartmentForm.classList.add('hidden');
            landForm.classList.remove('hidden');
        } else {
            apartmentBtn?.classList.add('bg-gray-200');
            landBtn?.classList.remove('bg-gray-200');
            landForm.classList.add('hidden');
            apartmentForm.classList.remove('hidden');
        }

        propertyTypeInput.value = type;
        document.getElementById('clear-btn').disabled = false;
        document.getElementById('submit-btn').disabled = false;
    }

    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('clear-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to clear all fields?')) {
                document.querySelector('form').reset();
            }
        });




    });

    function updatePriceInput(type) {
        const displayInput = document.getElementById(`property_${type}_price_display`);
        const hiddenInput = document.getElementById(`property_${type}_price`);
        hiddenInput.value = displayInput.value.replace(/,/g, '');
    }

    function togglePriceInput(type) {
        const isChecked = document.getElementById(`property_${type}`).checked;
        const currencySelect = document.getElementById(`${type}_currency`);
        const priceInput = document.getElementById(`property_${type}_price_display`);
        const additionalFields = document.getElementById(`${type}_additional_fields`);

        currencySelect.disabled = !isChecked;
        priceInput.disabled = !isChecked;

        // Toggle visibility of additional fields
        if (additionalFields) {
            additionalFields.style.display = isChecked ? 'block' : 'none';
        }

        if (!isChecked) {
            priceInput.value = '';
            document.getElementById(`property_${type}_price`).value = '';
        }
    }

    function priceDisplay(value) {
        return parseFloat(value).toLocaleString();
    }
</script>