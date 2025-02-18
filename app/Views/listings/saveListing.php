<div class="container-main max-w-4xl">

    <div class="flex flex-row ">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
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

                <hr class="mx-2" />


                <?php if ($method == 'UPDATE_REQUEST') : ?>

                    <?php if ($property->property_land_or_apartment == 'land') : ?>
                        <div class=" w-full flex border-y border-gray-300">
                            <button type="button" id="land-btn"
                                class=" w-full py-4 text-center 
                            font-medium text-gray-700 focus:outline-none 
                            hover:bg-gray-200
                            ">
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

                <!-- Property Details -->
                <div>
                    <h3 class="secondary-title">Property Details</h3>

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
                        <input type="text" id="property_size" name="property_size" class="main-input"><br>

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


                <!-- Payment plans & Rent/Sale -->
                <div>

                    <!-- Rent or Sale checkbox -->
                    <div class="flex flex-col justify-between mb-4 text-xl">
                        <h3 class="secondary-title">Rent or Sale</h3>
                        <div class="flex flex-row justify-around">
                            <label for="property_rent">Rent</label>
                            <input type="checkbox" id="property_rent" name="property_rent" class="mr-2">
                            <br>
                            <label for="property_sale">Sale</label>
                            <input type="checkbox" id="property_sale" name="property_sale" class="ml-4 mr-2">
                        </div>
                    </div>

                    <h3 class="secondary-title">Payment Plan</h3>
                    <textarea class="main-input" placeholder="Property Payment Plan Details"
                        name="property_payment_plan" id="property_payment_plan"></textarea>
                </div>

                <div class="my-4 flex flex-row w-full justify-evenly">
                    <?php if ($method == 'UPDATE_REQUEST') : ?>
                        <button type="button" popovertarget="delete-popover"
                            class="secondary-btn w-1/2 mr-2 md:w-2/6">Delete
                        </button>
                    <?php endif; ?>

                    <button id="clear-btn" <?php echo $method == "UPDATE_REQUEST" ? 'hidden' : '' ?>
                        type="button" disabled
                        class="secondary-btn disabled:secondary-btn-disabled w-1/2 mr-2 md:w-2/6">Clear</button>
                    <button id="submit-btn" type="submit" disabled
                        class="primary-btn disabled:primary-btn-disabled w-1/2 ml-2 md:w-2/6">Save</button>
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


    function populateField(data) {

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
                newPhoneInput.querySelector('.phone-id').value = data.phone_id[index];

                phoneSection.appendChild(newPhoneInput);

            });
        }


        if (data.property_referral_name) {
            document.getElementById('property_referral_name').value = data.property_referral_name;
        }
        if (data.property_referral_phone) {
            document.getElementById('property_referral_phone').value = data.property_referral_phone;
        }

        if (data.property_rent) {
            document.getElementById('property_rent').checked = data.property_rent;
        }

        if (data.property_sale) {
            document.getElementById('property_sale').checked = data.property_sale;
        }

        if (data.property_location) {
            document.getElementById('property_location').value = data.property_location;
        }

        if (data.property_size) {
            document.getElementById('property_size').value = parseFloat(data.property_size);
        }

        if (data.property_price) {
            document.getElementById('property_price_display').value = priceDisplay(data.property_price);
            document.getElementById('property_price').value = parseFloat(data.property_price);
        }

        if (data.property_catch_phrase) {
            document.getElementById('property_catch_phrase').value = data.property_catch_phrase;
        }

        if (data.property_payment_plan) {
            document.getElementById('property_payment_plan').value = data.property_payment_plan;
        }



        if (data.property_status_id) {
            document.getElementById('result_id_property_status_name').value = data.property_status_id;
            document.getElementById('search_property_status_name').value = data.info_property_status_name ?? data.property_status_name;
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
                document.getElementById('land_zone_first').value = parseFloat(data.land_zone_first);
            }

            if (data.land_zone_second) {
                document.getElementById('land_zone_second').value = parseFloat(data.land_zone_second);
            }

            if (data.land_extra_features) {
                document.getElementById('land_extra_features').value = data.land_extra_features;
            }

        } else {
            if (data.ad_gender_id) {
                document.getElementById("result_id_apartment_gender_name").value = data.ad_gender_id;
                document.getElementById("search_apartment_gender_name").value = data.info_apartment_gender_name ?? data.apartment_gender_name;
            }

            if (data.ad_type_id) {
                document.getElementById('result_id_ad_type_name').value = data.ad_type_id;
                document.getElementById('search_ad_type_name').value = data.info_ad_type_name ?? data.ad_type_name;
            }

            if (data.ad_terrace) {
                document.getElementById("ad_terrace").checked = data.ad_terrace;
                document.getElementById("ad_terrace_area").disabled = !data.ad_terrace;
                if (data.ad_terrace && data.ad_terrace_area) {
                    document.getElementById("ad_terrace_area").value = data.ad_terrace_area;
                }
            }

            if (data.ad_roof) {
                document.getElementById("ad_roof").checked = data.ad_roof;
                document.getElementById("ad_roof_area").disabled = !data.ad_roof;
                if (data.ad_roof && data.ad_roof_area) {
                    document.getElementById("ad_roof_area").value = data.ad_roof_area;
                }
            }


            if (data.ad_furnished) {
                document.getElementById("ad_furnished").checked = data.ad_furnished;
            }

            if (data.ad_furnished_on_provisions) {
                document.getElementById("ad_furnished_on_provisions").checked = data.ad_furnished_on_provisions;
            }

            if (data.ad_elevator) {
                document.getElementById("ad_elevator").checked = data.ad_elevator;
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


            if (data.spec_heating_system) {
                document.getElementById("spec_heating_system").checked = data.spec_heating_system;
            }

            if (data.spec_heating_system_on_provisions) {
                document.getElementById("spec_heating_system_on_provisions").checked = data.spec_heating_system_on_provisions;
            }

            if (data.spec_ac_system) {
                document.getElementById("spec_ac_system").checked = data.spec_ac_system;
            }

            if (data.spec_ac_system_on_provisions) {
                document.getElementById("spec_ac_system_on_provisions").checked = data.spec_ac_system_on_provisions;
            }

            if (data.spec_double_wall) {
                document.getElementById("spec_double_wall").checked = data.spec_double_wall;
            }

            if (data.spec_double_glazing) {
                document.getElementById("spec_double_glazing").checked = data.spec_double_glazing;
            }

            if (data.spec_shutters_electrical) {
                document.getElementById("spec_shutters_electrical").checked = data.spec_shutters_electrical;
            }

            if (data.spec_oak_doors) {
                document.getElementById("spec_oak_doors").checked = data.spec_oak_doors;
            }

            if (data.spec_chimney) {
                document.getElementById("spec_chimney").checked = data.spec_chimney;
            }

            if (data.spec_indirect_light) {
                document.getElementById("spec_indirect_light").checked = data.spec_indirect_light;
            }

            if (data.spec_wood_panel_decoration) {
                document.getElementById("spec_wood_panel_decoration").checked = data.spec_wood_panel_decoration;
            }

            if (data.spec_stone_panel_decoration) {
                document.getElementById("spec_stone_panel_decoration").checked = data.spec_stone_panel_decoration;
            }

            if (data.spec_security_door) {
                document.getElementById("spec_security_door").checked = data.spec_security_door;
            }

            if (data.spec_alarm_system) {
                document.getElementById("spec_alarm_system").checked = data.spec_alarm_system;
            }

            if (data.spec_solar_heater) {
                document.getElementById("spec_solar_heater").checked = data.spec_solar_heater;
            }

            if (data.spec_intercom) {
                document.getElementById("spec_intercom").checked = data.spec_intercom;
            }

            if (data.spec_garage) {
                document.getElementById("spec_garage").checked = data.spec_garage;
            }
            if (data.specs_jacuzzi) {
                document.getElementById("specs_jacuzzi").checked = data.specs_jacuzzi;
            }
            if (data.spec_swimming_pool) {
                document.getElementById("spec_swimming_pool").checked = data.spec_swimming_pool;
            }
            if (data.spec_gym) {
                document.getElementById("spec_gym").checked = data.spec_gym;
            }
            if (data.spec_kitchenette) {
                document.getElementById("spec_kitchenette").checked = data.spec_kitchenette;
            }
            if (data.spec_driver_room) {
                document.getElementById("spec_driver_room").checked = data.spec_driver_room;
            }
            if (data.spec_tiles) {
                document.getElementById("spec_tiles").value = data.spec_tiles;
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


        landBtn?.classList.add('bg-gray-200');
        apartmentBtn?.classList.remove('bg-gray-200');

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

        apartmentBtn?.classList.add('bg-gray-200');
        landBtn?.classList.remove('bg-gray-200');

        landForm?.classList.add('hidden');
        form?.classList.remove('hidden');

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
                value = priceDisplay(value); // Format value with commas
            } else {
                hiddenInput.value = ''; // Clear hidden input if value is not a number
            }
            e.target.value = value;
        });


    });

    function priceDisplay(value) {
        return parseFloat(value).toLocaleString();
    }
</script>