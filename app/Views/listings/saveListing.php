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
            <h2 class="main-title-page">Edit Listing of <?= $request->client_firstname . " " . $request->client_lastname ?></h2>
        <?php endif; ?>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <h2 class="secondary-title">Property Status</h2>
        <label class="main-label" for="property_status_name">Property Status Name:</label>
        <input type="text" id="property_status_name" name="property_status_name" class="main-input">
        <br>
        <hr>

        <h2 class="secondary-title">Property Type</h2>
        <label class="main-label" for="property_type_name">Property Type Name:</label>
        <input type="text" id="property_type_name" name="property_type_name" class="main-input">
        <br>
        <hr>

        <h2 class="secondary-title">Properties</h2>
        <label class="main-label" for="client_id">Client ID:</label>
        <input type="number" id="client_id" name="client_id" class="main-input"><br>

        <label class="main-label" for="employee_id">Employee ID:</label>
        <input type="number" id="employee_id" name="employee_id" class="main-input"><br>

        <label class="main-label" for="payment_plan_id">Payment Plan ID:</label>
        <input type="number" id="payment_plan_id" name="payment_plan_id" class="main-input"><br>

        <label class="main-label" for="city_id">City ID:</label>
        <input type="number" id="city_id" name="city_id" class="main-input"><br>

        <label class="main-label" for="property_type_id">Property Type ID:</label>
        <input type="number" id="property_type_id" name="property_type_id" class="main-input"><br>

        <label class="main-label" for="property_status_id">Property Status ID:</label>
        <input type="number" id="property_status_id" name="property_status_id" class="main-input"><br>

        <label class="main-label" for="property_location">Property Location:</label>
        <input type="text" id="property_location" name="property_location" class="main-input"><br>

        <label class="main-label" for="property_referral_name">Referral Name:</label>
        <input type="text" id="property_referral_name" name="property_referral_name" class="main-input"><br>

        <label class="main-label" for="property_referral_phone">Referral Phone:</label>
        <input type="text" id="property_referral_phone" name="property_referral_phone" class="main-input"><br>

        <label class="main-label" for="property_rent_or_sale">Rent or Sale:</label>
        <select id="property_rent_or_sale" name="property_rent_or_sale" class="main-input">
            <option value="rent">Rent</option>
            <option value="sale">Sale</option>
            <option value="rent_sale">Rent & Sale</option>
        </select><br>

        <label class="main-label" for="property_catch_phrase">Catch Phrase:</label>
        <textarea id="property_catch_phrase" name="property_catch_phrase" class="main-input"></textarea><br>

        <label class="main-label" for="property_size">Property Size (m<span class="">2</span>):</label>
        <input type="number" step="0.01" id="property_size" name="property_size" class="main-input"><br>

        <label class="main-label" for="property_price">Property Price:</label>
        <input type="number" step="0.01" id="property_price" name="property_price" class="main-input"><br>

        <br>
        <hr>

        <h2 class="secondary-title">Land Details</h2>
        <label class="main-label" for="land_type">Land Type:</label>
        <select id="land_type" name="land_type" class="main-input">
            <option value="residential">Residential</option>
            <option value="industrial">Industrial</option>
            <option value="commercial">Commercial</option>
            <option value="agricultural">Agricultural</option>
            <option value="mixed">Mixed</option>
            <option value="other">Other</option>
        </select><br>

        <label class="main-label" for="land_zone_first">Zone First:</label>
        <input type="number" step="0.01" id="land_zone_first" name="land_zone_first" class="main-input"><br>

        <label class="main-label" for="land_zone_second">Zone Second:</label>
        <input type="number" step="0.01" id="land_zone_second" name="land_zone_second" class="main-input"><br>

        <label class="main-label" for="land_extra_features">Extra Features:</label>
        <textarea id="land_extra_features" name="land_extra_features" class="main-input"></textarea>
        <br>
        <hr>

        <h2 class="secondary-title">Apartment Gender</h2>
        <label class="main-label" for="apartment_gender_name">Apartment Gender Name:</label>
        <input type="text" id="apartment_gender_name" name="apartment_gender_name" class="main-input">
        <br>
        <hr>

        <h2 class="secondary-title">Apartment Details</h2>

        <label class="main-label" for="property_id">Property ID:</label>
        <input type="number" id="property_id" name="property_id" class="main-input"><br>

        <label class="main-label" for="ad_terrace">Terrace:</label>
        <input type="checkbox" id="ad_terrace" name="ad_terrace" class="main-input"><br>

        <label class="main-label" for="ad_terrace_area">Terrace Area (sqm):</label>
        <input type="number" id="ad_terrace_area" name="ad_terrace_area" class="main-input"><br>

        <label class="main-label" for="ad_roof">Roof:</label>
        <input type="checkbox" id="ad_roof" name="ad_roof" class="main-input"><br>

        <label class="main-label" for="ad_roof_area">Roof Area (sqm):</label>
        <input type="number" id="ad_roof_area" name="ad_roof_area" class="main-input"><br>

        <label class="main-label" for="ad_gender_id">Apartment Gender ID:</label>
        <input type="number" id="ad_gender_id" name="ad_gender_id" class="main-input"><br>

        <label class="main-label" for="ad_furnished">Furnished:</label>
        <input type="checkbox" id="ad_furnished" name="ad_furnished" class="main-input"><br>

        <label class="main-label" for="ad_furnished_on_provisions">Furnished on Provisions:</label>
        <input type="checkbox" id="ad_furnished_on_provisions" name="ad_furnished_on_provisions" class="main-input"><br>

        <label class="main-label" for="ad_elevator">Elevator:</label>
        <input type="checkbox" id="ad_elevator" name="ad_elevator" class="main-input"><br>

        <label class="main-label" for="ad_status_age">Status/Age:</label>
        <input type="text" id="ad_status_age" name="ad_status_age" class="main-input"><br>

        <label class="main-label" for="ad_floor_level">Floor Level:</label>
        <input type="number" id="ad_floor_level" name="ad_floor_level" class="main-input"><br>

        <label class="main-label" for="ad_apartments_per_floor">Apartments Per Floor:</label>
        <input type="number" id="ad_apartments_per_floor" name="ad_apartments_per_floor" class="main-input"><br>

        <label class="main-label" for="ad_view">View:</label>
        <input type="text" id="ad_view" name="ad_view" class="main-input"><br>

        <label class="main-label" for="ad_type">Type:</label>
        <select id="ad_type" name="ad_type" class="main-input">
            <option value="luxury">Luxury</option>
            <option value="high-end">High-End</option>
            <option value="standard">Standard</option>
            <option value="bad">Bad</option>
        </select><br>

        <label class="main-label" for="ad_architecture_and_interior">Architecture and Interior:</label>
        <textarea id="ad_architecture_and_interior" name="ad_architecture_and_interior" class="main-input"></textarea><br>

        <label class="main-label" for="ad_extra_features">Extra Features:</label>
        <textarea id="ad_extra_features" name="ad_extra_features" class="main-input"></textarea><br>
        <hr>

        <h2 class="secondary-title">Apartment Partitions</h2>

        <label class="main-label" for="partition_salon">Salon:</label>
        <input type="text" id="partition_salon" name="partition_salon" class="main-input"><br>

        <label class="main-label" for="partition_dining">Dining:</label>
        <input type="text" id="partition_dining" name="partition_dining" class="main-input"><br>

        <label class="main-label" for="partition_kitchen">Kitchen:</label>
        <input type="text" id="partition_kitchen" name="partition_kitchen" class="main-input"><br>

        <label class="main-label" for="partition_master_bedroom">Master Bedroom:</label>
        <input type="text" id="partition_master_bedroom" name="partition_master_bedroom" class="main-input"><br>

        <label class="main-label" for="partition_bedroom">Bedroom:</label>
        <input type="text" id="partition_bedroom" name="partition_bedroom" class="main-input"><br>

        <label class="main-label" for="partition_bathroom">Bathroom:</label>
        <input type="text" id="partition_bathroom" name="partition_bathroom" class="main-input"><br>

        <label class="main-label" for="partition_maid_room">Maid Room:</label>
        <input type="text" id="partition_maid_room" name="partition_maid_room" class="main-input"><br>

        <label class="main-label" for="partition_reception_balcony">Reception Balcony:</label>
        <input type="text" id="partition_reception_balcony" name="partition_reception_balcony" class="main-input"><br>

        <label class="main-label" for="partition_sitting_corner">Sitting Corner:</label>
        <input type="text" id="partition_sitting_corner" name="partition_sitting_corner" class="main-input"><br>

        <label class="main-label" for="partition_balconies">Balconies:</label>
        <input type="text" id="partition_balconies" name="partition_balconies" class="main-input"><br>

        <label class="main-label" for="partition_parking">Parking:</label>
        <input type="text" id="partition_parking" name="partition_parking" class="main-input"><br>

        <label class="main-label" for="partition_storage_room">Storage Room:</label>
        <input type="text" id="partition_storage_room" name="partition_storage_room" class="main-input"><br>
        <hr>


        <h2 class="secondary-title">Apartment Specifications</h2>

        <label class="main-label" for="spec_heating_system">Heating System:</label>
        <input type="checkbox" id="spec_heating_system" name="spec_heating_system" class="main-input"><br>

        <label class="main-label" for="spec_heating_system_on_provisions">Heating System on Provisions:</label>
        <input type="checkbox" id="spec_heating_system_on_provisions" name="spec_heating_system_on_provisions" class="main-input"><br>

        <label class="main-label" for="spec_ac_system">AC System:</label>
        <input type="checkbox" id="spec_ac_system" name="spec_ac_system" class="main-input"><br>

        <label class="main-label" for="spec_ac_system_on_provisions">AC System on Provisions:</label>
        <input type="checkbox" id="spec_ac_system_on_provisions" name="spec_ac_system_on_provisions" class="main-input"><br>

        <label class="main-label" for="spec_double_wall">Double Wall:</label>
        <input type="checkbox" id="spec_double_wall" name="spec_double_wall" class="main-input"><br>

        <label class="main-label" for="spec_double_glazing">Double Glazing:</label>
        <input type="checkbox" id="spec_double_glazing" name="spec_double_glazing" class="main-input"><br>

        <label class="main-label" for="spec_shutters_electrical">Electrical Shutters:</label>
        <input type="checkbox" id="spec_shutters_electrical" name="spec_shutters_electrical" class="main-input"><br>

        <label class="main-label" for="spec_tiles">Tiles:</label>
        <select id="spec_tiles" name="spec_tiles" class="main-input">
            <option value="european">European</option>
            <option value="marble">Marble</option>
            <option value="granite">Granite</option>
            <option value="other">Other</option>
        </select><br>

        <label class="main-label" for="spec_oak_doors">Oak Doors:</label>
        <input type="checkbox" id="spec_oak_doors" name="spec_oak_doors" class="main-input"><br>

        <label class="main-label" for="spec_chimney">Chimney:</label>
        <input type="checkbox" id="spec_chimney" name="spec_chimney" class="main-input"><br>

        <label class="main-label" for="spec_indirect_light">Indirect Lighting:</label>
        <input type="checkbox" id="spec_indirect_light" name="spec_indirect_light" class="main-input"><br>

        <label class="main-label" for="spec_wood_panel_decoration">Wood Panel Decoration:</label>
        <input type="checkbox" id="spec_wood_panel_decoration" name="spec_wood_panel_decoration" class="main-input"><br>

        <label class="main-label" for="spec_stone_panel_decoration">Stone Panel Decoration:</label>
        <input type="checkbox" id="spec_stone_panel_decoration" name="spec_stone_panel_decoration" class="main-input"><br>

        <label class="main-label" for="spec_security_door">Security Door:</label>
        <input type="checkbox" id="spec_security_door" name="spec_security_door" class="main-input"><br>

        <label class="main-label" for="spec_alarm_system">Alarm System:</label>
        <input type="checkbox" id="spec_alarm_system" name="spec_alarm_system" class="main-input"><br>

        <label class="main-label" for="spec_solar_heater">Solar Heater:</label>
        <input type="checkbox" id="spec_solar_heater" name="spec_solar_heater" class="main-input"><br>

        <label class="main-label" for="spec_intercom">Intercom:</label>
        <input type="checkbox" id="spec_intercom" name="spec_intercom" class="main-input"><br>

        <label class="main-label" for="spec_garage">Garage:</label>
        <input type="checkbox" id="spec_garage" name="spec_garage" class="main-input"><br>

        <label class="main-label" for="spec_extra_features">Extra Features:</label>
        <textarea id="spec_extra_features" name="spec_extra_features" class="main-input"></textarea>
        <br>
        <hr>

    </div class="main-container">
</div>