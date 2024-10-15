<div>
    <h2 class="secondary-title">Apartment Details</h2>


    <div class="my-4">
        <label class="main-label" for="apartment_gender_name">Apartment Gender:</label>
        <div class="flex flex-col w-full">
            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search Apartment Gender',
                'data' => $apartmentGender,
                'selectedId' => "apartment_gender_id",
                'selectedName' => 'apartment_gender_name'
            ]) ?>
        </div>
    </div>


    <div>
        <label class="main-label" for="ad_terrace">Terrace:</label>
        <input type="checkbox" id="ad_terrace" name="ad_terrace" class="main-input">
        
        <label class="main-label" for="ad_terrace_area">Terrace Area (sqm):</label>
        <input type="number" id="ad_terrace_area" name="ad_terrace_area" class="main-input">
    </div>

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

    <label class="main-label" for="partition_extra_features">Extra Features:</label>
    <textarea id="partition_extra_features" name="partition_extra_features" class="main-input"></textarea><br>
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

</div>