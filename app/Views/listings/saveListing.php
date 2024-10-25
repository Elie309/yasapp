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
                <input id="property_land_or_apartment" type="text" hidden name="property_land_or_apartment" value="property">

                <div id="show-land" class="hidden">
                    <?= view_cell('App\Cells\Listings\LandForm\LandFormCell', ['landTypes' => $landTypes]) ?>
                </div>

                <div id="show-apartment" class="hidden">

                    <?= view_cell('App\Cells\Listings\ApartmentForm\ApartmentFormCell', ['apartmentGender' => $apartmentGender]) ?>

                </div>

                <div class="my-4 flex flex-row w-full justify-evenly">
                    <button id="clear-btn" type="button" disabled class="secondary-btn disabled:secondary-btn-disabled w-2/6">Clear</button>
                    <button id="submit-btn" type="submit" disabled class="primary-btn disabled:primary-btn-disabled w-2/6">Save</button>
                </div>

                </form>

    </div>
</div>

<?= view_cell('App\Cells\Settings\Location\LocationPopover\LocationPopoverCell::render') ?>

<?= view_cell('App\Cells\Clients\ClientPopover\ClientPopoverCell::render', ['countries' => $countries]) ?>

<script>
    <?php

    $session = service('session');

    $data = $session->get('_ci_old_input');

    if ($method == 'NEW_REQUEST' && $data) {


        $city = [
            'city_id' => $data['post']['city_id'],
            'country_name' => $data['post']['country_name'],
            'region_name' => $data['post']['region_name'],
            'subregion_name' => $data['post']['subregion_name'],
            'city_name' => $data['post']['city_name']
        ];

        $data = array_merge($data['post'], ['city' => $city]);

        echo "var data = " . json_encode($data) . ";";

        echo "populateField(data);";
    }

    ?>


    function populateField(data) {

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



        if (data.employee_id) {
            document.getElementById('employee_id').value = data.employee_id;
        }

        let city = data.city;
        if (city) {
            document.getElementById('city_id').value = city.city_id;

            if (city.country_name) {
                document.getElementById('country_name').value = city.country_name;
            }

            if (city.region_name) {
                document.getElementById('region_name').value = city.region_name;
            }

            if (city.subregion_name) {
                document.getElementById('subregion_name').value = city.subregion_name;
            }

            if (city.city_name) {
                document.getElementById('city_name').value = city.city_name;
            }

        }

        if (data.property_referral_name) {
            document.getElementById('property_referral_name').value = data.property_referral_name;
        }
        if (data.property_referral_phone) {
            document.getElementById('property_referral_phone').value = data.property_referral_phone;
        }

        if (data.property_location) {
            document.getElementById('property_location').value = data.property_location;
        }

        if (data.property_size) {
            document.getElementById('property_size').value = data.property_size;
        }

        if (data.property_price) {
            document.getElementById('property_price_display').value = data.property_price;
            document.getElementById('property_price').value = data.property_price;
        }

        if (data.property_catch_phrase) {
            document.getElementById('property_catch_phrase').value = data.property_catch_phrase;
        }

        if (data.payment_plan_id) {
            document.getElementById('result_id_payment_plan_name').value = data.payment_plan_id;
            document.getElementById('search_payment_plan_name').value = data.info_payment_plan_name;
        }

        if (data.property_type_id) {
            document.getElementById('result_id_property_type_name').value = data.property_type_id;
            document.getElementById('search_property_type_name').value = data.info_property_type_name;
        }

        if (data.property_status_id) {
            document.getElementById('result_id_property_status_name').value = data.property_status_id;
            document.getElementById('search_property_status_name').value = data.info_property_status_name;
        }

        if (data.property_land_or_apartment) {
            document.getElementById('property_land_or_apartment').value = data.property_land_or_apartment;
            if (data.property_land_or_apartment === 'land') {
                showLandForm();
            } else {
                showApartmentForm();
            }
        }

        if (data.property_land_or_apartment === 'land') {

            if (data.land_type) {
                document.getElementById('land_type').value = data.land_type;
            }

            if (data.land_zone_first) {
                document.getElementById('land_zone_first').value = data.land_zone_first;
            }

            if (data.land_zone_second) {
                document.getElementById('land_zone_second').value = data.land_zone_second;
            }

            if (data.land_extra_features) {
                document.getElementById('land_extra_features').value = data.land_extra_features;
            }

        } else {
            if (data.apartment_gender_id) {
                document.getElementById("result_id_apartment_gender_name").value = data.apartment_gender_id;
                document.getElementById("search_apartment_gender_name").value = data.info_apartment_gender_name;
            }

            

            if (data.ad_terrace) {
                document.getElementById("ad_terrace").checked = true;
                document.getElementById("ad_terrace_area").disabled = false;
            }
            if (data.ad_terrace_area) {
                document.getElementById("ad_terrace_area").value = data.ad_terrace_area;
                document.getElementById("ad_terrace_area").disabled = false;
                document.getElementById("ad_terrace").checked = true;
            }
            if (data.ad_roof) {
                document.getElementById("ad_roof").checked = true;
                document.getElementById("ad_roof_area").disabled = false;

            }
            if (data.ad_roof_area) {
                document.getElementById("ad_roof_area").value = data.ad_roof_area;
                document.getElementById("ad_roof_area").disabled = false;
                document.getElementById("ad_roof").checked = true;
            }

            if (data.ad_furnished) {
                document.getElementById("ad_furnished").checked = true;
            }

            if (data.ad_furnished_on_provisions) {
                document.getElementById("ad_furnished_on_provisions").checked = true;
            }

            if (data.ad_elevator) {
                document.getElementById("ad_elevator").checked = true;
            }

            if (data.ad_status_age) {
                document.getElementById("ad_status_age").value = data.ad_status_age;
            }

            if (data.ad_floor_level) {
                document.getElementById("ad_floor_level").value = data.ad_floor_level;
            }

            if (data.ad_apartments_per_floor) {
                document.getElementById("ad_apartments_per_floor").value = data.ad_apartments_per_floor;
            }

            if (data.ad_view) {
                document.getElementById("ad_view").value = data.ad_view;
            }

            if (data.ad_type) {
                document.getElementById("ad_type").value = data.ad_type;
            }

            if (data.ad_architecture_and_interior) {
                document.getElementById("ad_architecture_and_interior").value = data.ad_architecture_and_interior;
            }

            if (data.ad_extra_features) {
                document.getElementById("ad_extra_features").value = data.ad_extra_features;
            }

            if (data.partition_salon) {
                document.getElementById("partition_salon").value = data.partition_salon;
            }

            if (data.partition_dining) {
                document.getElementById("partition_dining").value = data.partition_dining;
            }

            if (data.partition_kitchen) {
                document.getElementById("partition_kitchen").value = data.partition_kitchen;
            }

            if (data.partition_master_bedroom) {
                document.getElementById("partition_master_bedroom").value = data.partition_master_bedroom;
            }

            if (data.partition_bedroom) {
                document.getElementById("partition_bedroom").value = data.partition_bedroom;
            }

            if (data.partition_bathroom) {
                document.getElementById("partition_bathroom").value = data.partition_bathroom;
            }

            if (data.partition_maid_room) {
                document.getElementById("partition_maid_room").value = data.partition_maid_room;
            }

            if (data.partition_reception_balcony) {
                document.getElementById("partition_reception_balcony").value = data.partition_reception_balcony;
            }

            if (data.partition_sitting_corner) {
                document.getElementById("partition_sitting_corner").value = data.partition_sitting_corner;
            }

            if (data.partition_balconies) {
                document.getElementById("partition_balconies").value = data.partition_balconies;
            }

            if (data.partition_parking) {
                document.getElementById("partition_parking").value = data.partition_parking;
            }

            if (data.partition_storage_room) {
                document.getElementById("partition_storage_room").value = data.partition_storage_room;
            }

            if (data.partition_extra_features) {
                document.getElementById("partition_extra_features").value = data.partition_extra_features;
            }

            if (data.spec_heating_system) {
                document.getElementById("spec_heating_system").checked = true;
            }

            if (data.spec_heating_system_on_provisions) {
                document.getElementById("spec_heating_system_on_provisions").checked = true;
            }

            if (data.spec_ac_system) {
                document.getElementById("spec_ac_system").checked = true;
            }

            if (data.spec_ac_system_on_provisions) {
                document.getElementById("spec_ac_system_on_provisions").checked = true;
            }

            if (data.spec_double_wall) {
                document.getElementById("spec_double_wall").checked = true;
            }

            if (data.spec_double_glazing) {
                document.getElementById("spec_double_glazing").checked = true;
            }

            if (data.spec_shutters_electrical) {
                document.getElementById("spec_shutters_electrical").checked = true;
            }

            if (data.spec_oak_doors) {
                document.getElementById("spec_oak_doors").checked = true;
            }

            if (data.spec_chimney) {
                document.getElementById("spec_chimney").checked = true;
            }

            if (data.spec_indirect_light) {
                document.getElementById("spec_indirect_light").checked = true;
            }

            if (data.spec_wood_panel_decoration) {
                document.getElementById("spec_wood_panel_decoration").checked = true;
            }

            if (data.spec_stone_panel_decoration) {
                document.getElementById("spec_stone_panel_decoration").checked = true;
            }

            if (data.spec_security_door) {
                document.getElementById("spec_security_door").checked = true;
            }

            if (data.spec_alarm_system) {
                document.getElementById("spec_alarm_system").checked = true;
            }

            if (data.spec_solar_heater) {
                document.getElementById("spec_solar_heater").checked = true;
            }

            if (data.spec_intercom) {
                document.getElementById("spec_intercom").checked = true;
            }

            if (data.spec_garage) {
                document.getElementById("spec_garage").checked = true;
            }

            if (data.spec_tiles) {
                document.getElementById("spec_tiles").value = data.spec_tiles;
            }

            if (data.spec_extra_features) {
                document.getElementById("spec_extra_features").value = data.spec_extra_features;
            }

        }



    }

    function showLandForm() {

        var form = document.getElementById('show-land');
        var apartmentForm = document.getElementById('show-apartment');
        var property_land_or_apartment = document.getElementById('property_land_or_apartment');
        var clear_btn = document.getElementById('clear-btn');
        var submit_btn = document.getElementById('submit-btn');

        var landBtn = document.getElementById('land-btn');
        var apartmentBtn = document.getElementById('apartment-btn');


        landBtn.classList.add('bg-gray-200');
        apartmentBtn.classList.remove('bg-gray-200');

        apartmentForm.classList.add('hidden');
        form.classList.remove('hidden');

        property_land_or_apartment.value = 'land';
        clear_btn.disabled = false;
        submit_btn.disabled = false;

    }

    function showApartmentForm() {

        var form = document.getElementById('show-apartment');
        var landForm = document.getElementById('show-land');
        var property_land_or_apartment = document.getElementById('property_land_or_apartment');
        var clear_btn = document.getElementById('clear-btn');
        var submit_btn = document.getElementById('submit-btn');

        var landBtn = document.getElementById('land-btn');
        var apartmentBtn = document.getElementById('apartment-btn');

        apartmentBtn.classList.add('bg-gray-200');
        landBtn.classList.remove('bg-gray-200');

        landForm.classList.add('hidden');
        form.classList.remove('hidden');

        property_land_or_apartment.value = 'apartment';
        clear_btn.disabled = false;
        submit_btn.disabled = false;

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