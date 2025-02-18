<div class="container-main print-container max-w-6xl overflow-auto">

    <img class="mx-auto hidden print-only w-64" src="/logo.png" alt="">

    <!-- Property Details -->
    <div class="flex flex-row">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Property of <?= esc($property->client_name) ?></h2>


    </div>

    <h2 class="md:hidden main-title-page">Property of <?= esc($property->client_name) ?></h2>


    <div class="flex flex-row justify-around w-full items-center no-print py-2 my-4 ">
        <a href="/listings/<?= esc($property->property_id) ?>/images" class="my-auto flex space-x-2 cursor-pointer no-print">
            <p>Images</p>
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'images', 'class' => 'size-6']) ?>
        </a>

        <button onclick="window.print()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <p>Print</p>
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'printer', 'class' => 'size-6']) ?>
        </button>
        <?php if ($property->employee_id === $employee_id) : ?>
            <a href="/listings/edit/<?= $property->property_id ?>" class="my-auto space-x-2 flex cursor-pointer no-print">
                <p>Edit</p>
                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'edit', 'class' => 'size-6']) ?>
            </a>
        <?php endif; ?>

    </div>


    <div class="no-print">
        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    </div>

    <div class="no-print flex flex-col md:flex-row justify-around space-y-4 md:space-y-0 md:space-x-4 w-full">
        <div class=" w-full md:w-3/6 grid grid-cols-2 gap-2 place-items-center">
            <strong>Property State:</strong>
            <select id="property-state" <?= $property->employee_id !== $employee_id ? 'disabled' : '' ?>
                class="secondary-input min-w-40 max-w-60">
                <?php foreach ($propertyStatuses as $propertyState): ?>
                    <option value="<?= $propertyState['id'] ?>"
                        <?= strtolower($propertyState['id']) === strtolower($property->property_status_id) ? 'selected' : '' ?>><?= ucfirst($propertyState['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>



    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">


        <h2 class="secondary-title">Vendor</h2>
        <table class="view-table">
            <tr>
                <th>Client</th>
                <td><?= esc($property->client_name) ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?= esc($property->client_email) ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?= esc($property->client_phone) ?></td>
            </tr>
            <tr>
                <th>Referral Name</th>
                <td><?= esc($property->property_referral_name) ?></td>
            </tr>
            <tr>
                <th>Referral Phone</th>
                <td><?= esc($property->property_referral_phone) ?></td>
            </tr>
        </table>

        <br class="no-print">
        <hr class="no-print">
        <br class="no-print">

        <div class="break-page"></div>
        <h2 class="secondary-title">Property</h2>

        <table  class="view-table">
            <tr>
                <th>Agent</th>
                <td><?= esc($property->employee_name) ?></td>
            </tr>
            <tr>
                <th>Payment Plan</th>
                <td><?= esc($property->property_payment_plan) ?></td>
            </tr>
            <tr>
                <th>Location</th>
                <td><?= esc($property->property_detailed_location) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= esc($property->property_status_name) ?>
                </td>
            </tr>
            <tr>
                <th>Rent</th>
                <td><?= $property->property_rent ? 'Yes' : 'No' ?></td>
            </tr>
            <tr>
                <th>Sale</th>
                <td><?= $property->property_sale ? 'Yes' : 'No' ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?= esc($property->property_budget) ?></td>
            </tr>
            <tr>
                <th>Size</th>
                <td><?= esc($property->property_size) ?> m²</td>
            </tr>
            <tr>
                <th>Catch Phrase</th>
                <td><?= esc($property->property_catch_phrase) ?></td>
            </tr>

            <tr>
                <th>Created At</th>
                <td><?= esc((new DateTime($property->property_created_at))->format('d-M-Y H:i:s T')) ?></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td><?= esc((new DateTime($property->property_updated_at))->format('d-M-Y H:i:s T')) ?></td>
            </tr>
        </table>



        <!-- Land Details -->
        <?php if ($landDetails): ?>

            <br>
            <hr>
            <br>


            <h2 class="secondary-title">Land Details</h2>
             <table class="view-table">
                <tr>
                    <th>Land Type</th>
                    <td><?= esc($landDetails->land_type) ?></td>
                </tr>
                <tr>
                    <th>Zone 1</th>
                    <td><?= esc($landDetails->land_zone_first) ?>%</td>
                </tr>
                <tr>
                    <th>Zone 2</th>
                    <td><?= esc($landDetails->land_zone_second) ?>%</td>
                </tr>
                <tr>
                    <th>Extra Features</th>
                    <td><?= esc($landDetails->land_extra_features) ?></td>
                </tr>
            </table>

        <?php endif; ?>

        <br class="no-print">
        <hr class="no-print">
        <br class="no-print">

        <?php if ($apartmentDetails): ?>
            <!-- Apartment Details -->
            <div class="break-page"></div>
            <h2 class="secondary-title">Apartment Details</h2>
             <table class="view-table">
                <tr>
                    <th>Gender</th>
                    <td><?= esc($apartmentDetails->apartment_gender_name) ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?= esc($apartmentDetails->apartment_type_name) ?></td>
                </tr>

                <tr>
                    <th>Terrace</th>
                    <td><?= $apartmentDetails->ad_terrace ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Terrace Area</th>
                    <td><?= esc($apartmentDetails->ad_terrace_area) ?> m²</td>
                </tr>
                <tr>
                    <th>Roof</th>
                    <td><?= $apartmentDetails->ad_roof ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Roof Area</th>
                    <td><?= esc($apartmentDetails->ad_roof_area) ?> m²</td>
                </tr>
                <tr>
                    <th>Furnished</th>
                    <td><?= $apartmentDetails->ad_furnished ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Furnished Provision</th>
                    <td><?= $apartmentDetails->ad_furnished_provision ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Elevator</th>
                    <td><?= $apartmentDetails->ad_elevator ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Status Age</th>
                    <td><?= esc($apartmentDetails->ad_status_age) ?></td>
                </tr>
                <tr>
                    <th>Floor Level</th>
                    <td><?= esc($apartmentDetails->ad_floor_level) ?></td>
                </tr>
                <tr>
                    <th>Apartments Per Floor</th>
                    <td><?= esc($apartmentDetails->ad_apartments_per_floor) ?></td>
                </tr>
                <tr>
                    <th>View</th>
                    <td><?= esc($apartmentDetails->ad_view) ?></td>
                </tr>
                <tr>
                    <th>Extra Features</th>
                    <td><?= esc($apartmentDetails->ad_extra_features) ?></td>
                </tr>

            </table>

            <br class="no-print">
            <hr class="no-print">
            <br class="no-print">

            <div class="break-page"></div>

            <!-- Apartment Partition -->
            <h2 class="secondary-title">Apartment Partition</h2>
             <table class="view-table">
                <tr>
                    <th>Salon</th>
                    <td><?= esc($apartmentDetails->partition_salon) ?></td>
                </tr>
                <tr>
                    <th>Dining</th>
                    <td><?= esc($apartmentDetails->partition_dining) ?></td>
                </tr>
                <tr>
                    <th>Kitchen</th>
                    <td><?= esc($apartmentDetails->partition_kitchen) ?></td>
                </tr>
                <tr>
                    <th>Master Bedroom</th>
                    <td><?= esc($apartmentDetails->partition_master_bedroom) ?></td>
                </tr>
                <tr>
                    <th>Bedroom</th>
                    <td><?= esc($apartmentDetails->partition_bedroom) ?></td>
                </tr>
                <tr>
                    <th>Bathroom</th>
                    <td><?= esc($apartmentDetails->partition_bathroom) ?></td>
                </tr>
                <tr>
                    <th>Maid Room</th>
                    <td><?= esc($apartmentDetails->partition_maid_room) ?></td>
                </tr>
                <tr>
                    <th>Reception Balcony</th>
                    <td><?= esc($apartmentDetails->partition_reception_balcony) ?></td>
                </tr>
                <tr>
                    <th>Sitting Corner</th>
                    <td><?= esc($apartmentDetails->partition_sitting_corner) ?></td>
                </tr>
                <tr>
                    <th>Balconies</th>
                    <td><?= esc($apartmentDetails->partition_balconies) ?></td>
                </tr>
                <tr>
                    <th>Parking</th>
                    <td><?= esc($apartmentDetails->partition_parking) ?></td>
                </tr>
                <tr>
                    <th>Storage Room</th>
                    <td><?= esc($apartmentDetails->partition_storage_room) ?></td>
                </tr>
            </table>

            <br class="no-print">
            <hr class="no-print">
            <br class="no-print">

            <div class="break-page"></div>

            <!-- Apartment Specifications -->
            <h2 class="secondary-title">Apartment Specifications</h2>
             <table class="view-table">
                <tr>
                    <th>Heating System Installed</th>
                    <td><?= $apartmentDetails->spec_heating_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Heating System Provision</th>
                    <td><?= $apartmentDetails->spec_heating_system_provision ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>AC System Installed</th>
                    <td><?= $apartmentDetails->spec_ac_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>AC System Provision</th>
                    <td><?= $apartmentDetails->spec_ac_system_provision ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Double Wall</th>
                    <td><?= $apartmentDetails->spec_double_wall ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Double Glazing</th>
                    <td><?= $apartmentDetails->spec_double_glazing ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Shutters Electrical</th>
                    <td><?= $apartmentDetails->spec_shutters_electrical ? 'Yes' : 'No' ?></td>
                </tr>

                <tr>
                    <th>Oak Doors</th>
                    <td><?= $apartmentDetails->spec_oak_doors ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Chimney</th>
                    <td><?= $apartmentDetails->spec_chimney ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Indirect Light</th>
                    <td><?= $apartmentDetails->spec_indirect_light ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Wood Panel Decoration</th>
                    <td><?= $apartmentDetails->spec_wood_panel_decoration ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Stone Panel Decoration</th>
                    <td><?= $apartmentDetails->spec_stone_panel_decoration ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Security Door</th>
                    <td><?= $apartmentDetails->spec_security_door ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Alarm System</th>
                    <td><?= $apartmentDetails->spec_alarm_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Solar Heater</th>
                    <td><?= $apartmentDetails->spec_solar_heater ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Intercom</th>
                    <td><?= $apartmentDetails->spec_intercom ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Garage</th>
                    <td><?= $apartmentDetails->spec_garage ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Jacuzzi</th>
                    <td><?= $apartmentDetails->specs_jacuzzi ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Swimming Pool</th>
                    <td><?= $apartmentDetails->spec_swimming_pool ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Gym</th>
                    <td><?= $apartmentDetails->spec_gym ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Kitchenette</th>
                    <td><?= $apartmentDetails->spec_kitchenette ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Driver Room</th>
                    <td><?= $apartmentDetails->spec_driver_room ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Tiles</th>
                    <td><?= esc(ucfirst($apartmentDetails->spec_tiles)) ?></td>
                </tr>
            </table>

            <br class="no-print">
            <hr class="no-print">
            <br class="no-print">
        <?php endif; ?>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const propertyState = document.getElementById('property-state');
        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');


        propertyState.addEventListener('change', async function() {
            const state = propertyState.value;
            const property_id = <?= $property->property_id ?>;

            try {

                await fetch(`/api/listings/update-status/${property_id}/${state}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successDiv.classList.remove('hidden');
                            successDiv.innerHTML = data.message;
                        } else {
                            //Prevent changing the value of the select element
                            propertyState.value = '<?= $property->property_status_id ?>';
                            errorDiv.classList.remove('hidden');
                            errorDiv.innerHTML = data.message;
                        }
                    });

            } catch (e) {
                errorDiv.classList.remove('hidden');
                errorDiv.innerHTML = data.message;
            }
            setTimeout(() => {
                successDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
            }, 5000);

        });

    });
</script>