<div>
    <h2 class="secondary-title">Apartment Details</h2>


    <div class="my-4">
        <label class="secondary-label" for="apartment_gender_name">Apartment Gender:</label>
        <div class="flex flex-col w-full">
            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search Apartment Gender',
                'data' => $apartmentGender,
                'selectedId' => "ad_gender_id",
                'selectedName' => 'apartment_gender_name'
            ]) ?>
        </div>
    </div>

    <div class="my-4">
        <label class="main-label" for="ad_type_name">Apartment Type</label>
        <div class="flex flex-col w-full">
            <?= view_cell('\App\Cells\Utils\Autocomplete\AutocompleteSearchCell::render', [
                'placeholder' => 'Search Apartment Type',
                'data' => $apartmentTypes,
                'selectedId' => "ad_type_id",
                'selectedName' => 'ad_type_name'
            ]) ?>
        </div>
    </div>


    <div class="my-4 grid grid-cols-2 md:grid-cols-8 gap-4 justify-start items-center">
        <label class="secondary-label" for="ad_terrace">Terrace:</label>
        <input type="checkbox" id="ad_terrace" name="ad_terrace"
            class="main-checkbox" />

        <label class="secondary-label md:col-span-2" for="ad_terrace_area">Terrace Area (sqm):</label>
        <input type="text" id="ad_terrace_area"
            name="ad_terrace_area" disabled
            class="main-input disabled:main-input-readonly md:col-span-4" />

        <label class="secondary-label" for="ad_roof">Roof:</label>
        <input type="checkbox" id="ad_roof" name="ad_roof" class="main-checkbox">

        <label class=" secondary-label md:col-span-2" for="ad_roof_area">Roof Area (sqm):</label>
        <input type="text" id="ad_roof_area"
            name="ad_roof_area" disabled
            class="main-input disabled:main-input-readonly md:col-span-4">

        <label class="secondary-label" for="ad_furnished">Furnished:</label>
        <input type="checkbox" id="ad_furnished" name="ad_furnished"
            class="main-checkbox">

        <label class="secondary-label md:col-span-2" for="ad_furnished_on_provisions">Furnished on Provisions:</label>
        <input type="checkbox" id="ad_furnished_on_provisions"
            name="ad_furnished_on_provisions"
            class="main-checkbox ">

        <label class="secondary-label" for="ad_elevator">Elevator:</label>
        <input type="checkbox" id="ad_elevator" name="ad_elevator" class="main-checkbox">

    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 my-4">

        <label class="secondary-label col-span-2" for="ad_status_age">Status/Age:</label>
        <input type="text" id="ad_status_age" name="ad_status_age" class="main-input col-span-10">

        <label class="secondary-label col-span-2 " for="ad_floor_level">Floor Level:</label>
        <input type="text" id="ad_floor_level" name="ad_floor_level" class="main-input col-span-10">

        <label class="secondary-label col-span-2 " for="ad_apartments_per_floor">Apartments Per Floor:</label>
        <input type="text" id="ad_apartments_per_floor" name="ad_apartments_per_floor" class="main-input col-span-10">

        <label class="secondary-label col-span-2 " for="ad_view">View:</label>
        <input type="text" id="ad_view" name="ad_view" class="main-input col-span-10">

    </div>


    <hr>

    <h2 class="secondary-title">Apartment Partitions</h2>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 mt-4 mb-8">
        <label class="secondary-label col-span-2 " for="partition_salon">Salon:</label>
        <input type="text" id="partition_salon" name="partition_salon" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_dining">Dining:</label>
        <input type="text" id="partition_dining" name="partition_dining" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_kitchen">Kitchen:</label>
        <input type="text" id="partition_kitchen" name="partition_kitchen" class="main-input col-span-10">

        <label class="secondary-label col-span-2 " for="partition_master_bedroom">Master Bedroom:</label>
        <input type="text" id="partition_master_bedroom" name="partition_master_bedroom" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_bedroom">Bedroom:</label>
        <input type="text" id="partition_bedroom" name="partition_bedroom" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_bathroom">Bathroom:</label>
        <input type="text" id="partition_bathroom" name="partition_bathroom" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_maid_room">Maid Room:</label>
        <input type="text" id="partition_maid_room" name="partition_maid_room" class="main-input col-span-10">

        <label class="secondary-label col-span-2 " for="partition_reception_balcony">Reception Balcony:</label>
        <input type="text" id="partition_reception_balcony" name="partition_reception_balcony" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_sitting_corner">Sitting Corner:</label>
        <input type="text" id="partition_sitting_corner" name="partition_sitting_corner" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_balconies">Balconies:</label>
        <input type="text" id="partition_balconies" name="partition_balconies" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_parking">Parking:</label>
        <input type="text" id="partition_parking" name="partition_parking" class="main-input col-span-10">

        <label class="secondary-label col-span-2" for="partition_storage_room">Storage Room:</label>
        <input type="text" id="partition_storage_room" name="partition_storage_room" class="main-input col-span-10">


    </div>

    <hr>


    <h2 class="secondary-title">Apartment Specifications</h2>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 mb-8 items-center">


        <label class="secondary-label" for="spec_heating_system">Heating System:</label>
        <input type="checkbox" id="spec_heating_system" name="spec_heating_system" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_heating_system_on_provisions">Heating System on Provisions:</label>
        <input type="checkbox" id="spec_heating_system_on_provisions" name="spec_heating_system_on_provisions" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_ac_system">AC System:</label>
        <input type="checkbox" id="spec_ac_system" name="spec_ac_system" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_ac_system_on_provisions">AC System on Provisions:</label>
        <input type="checkbox" id="spec_ac_system_on_provisions" name="spec_ac_system_on_provisions" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_double_wall">Double Wall:</label>
        <input type="checkbox" id="spec_double_wall" name="spec_double_wall" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_double_glazing">Double Glazing:</label>
        <input type="checkbox" id="spec_double_glazing" name="spec_double_glazing" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_shutters_electrical">Electrical Shutters:</label>
        <input type="checkbox" id="spec_shutters_electrical" name="spec_shutters_electrical" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_oak_doors">Oak Doors:</label>
        <input type="checkbox" id="spec_oak_doors" name="spec_oak_doors" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_chimney">Chimney:</label>
        <input type="checkbox" id="spec_chimney" name="spec_chimney" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_indirect_light">Indirect Lighting:</label>
        <input type="checkbox" id="spec_indirect_light" name="spec_indirect_light" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_wood_panel_decoration">Wood Panel Decoration:</label>
        <input type="checkbox" id="spec_wood_panel_decoration" name="spec_wood_panel_decoration" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_stone_panel_decoration">Stone Panel Decoration:</label>
        <input type="checkbox" id="spec_stone_panel_decoration" name="spec_stone_panel_decoration" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_security_door">Security Door:</label>
        <input type="checkbox" id="spec_security_door" name="spec_security_door" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_alarm_system">Alarm System:</label>
        <input type="checkbox" id="spec_alarm_system" name="spec_alarm_system" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_solar_heater">Solar Heater:</label>
        <input type="checkbox" id="spec_solar_heater" name="spec_solar_heater" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_intercom">Intercom:</label>
        <input type="checkbox" id="spec_intercom" name="spec_intercom" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_garage">Garage:</label>
        <input type="checkbox" id="spec_garage" name="spec_garage" class="main-checkbox place-self-center">

        <label class="secondary-label" for="specs_jacuzzi">Jacuzzi:</label>
        <input type="checkbox" id="specs_jacuzzi" name="specs_jacuzzi" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_swimming_pool">Swimming Pool:</label>
        <input type="checkbox" id="spec_swimming_pool" name="spec_swimming_pool" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_gym">Gym:</label>
        <input type="checkbox" id="spec_gym" name="spec_gym" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_kitchenette">Kitchenette:</label>
        <input type="checkbox" id="spec_kitchenette" name="spec_kitchenette" class="main-checkbox place-self-center">

        <label class="secondary-label" for="spec_driver_room">Driver Room:</label>
        <input type="checkbox" id="spec_driver_room" name="spec_driver_room" class="main-checkbox place-self-center">




    </div>

    <label class="secondary-label" for="spec_tiles">Tiles:</label>
    <select id="spec_tiles" name="spec_tiles" class="main-input">
        <?php foreach ($tilesOptions as $tile): ?>
            <option value="<?= $tile ?>"><?= ucfirst($tile) ?></option>
        <?php endforeach; ?>
    </select>

    <label class="secondary-label" for="ad_extra_features">Extra Features:</label>
    <textarea id="ad_extra_features" name="ad_extra_features" class="main-input min-h-20"></textarea>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ad_terrace = document.getElementById("ad_terrace");
        const ad_roof = document.getElementById("ad_roof");

        ad_terrace.addEventListener('change', function() {
            const ad_terrace_area = document.getElementById("ad_terrace_area");
            ad_terrace_area.disabled = !ad_terrace.checked;

            if (!ad_terrace.checked) {
                ad_terrace_area.value = "";
            }
        });

        ad_roof.addEventListener('change', function() {
            const ad_roof_area = document.getElementById("ad_roof_area");
            ad_roof_area.disabled = !ad_roof.checked;
            if (!ad_roof.checked) {
                ad_roof_area.value = "";
            }
        });
    });
</script>