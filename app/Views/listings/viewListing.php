<div class="container-main print-container max-w-6xl overflow-auto">

    <img class="mx-auto hidden print-only w-64" src="/logo.png" alt="">

    <!-- Property Details -->
    <div class="flex flex-row">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <p>Return</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Property of <?= esc($property->client_name) ?></h2>

        <div class="flex flex-row ml-auto space-x-4 ">
            <button onclick="window.print()" class="my-auto flex space-x-2 cursor-pointer no-print">
                <p>Print</p>
                <svg class="size-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 16.75H16C15.8011 16.75 15.6103 16.671 15.4697 16.5303C15.329 16.3897 15.25 16.1989 15.25 16C15.25 15.8011 15.329 15.6103 15.4697 15.4697C15.6103 15.329 15.8011 15.25 16 15.25H18C18.3315 15.25 18.6495 15.1183 18.8839 14.8839C19.1183 14.6495 19.25 14.3315 19.25 14V10C19.25 9.66848 19.1183 9.35054 18.8839 9.11612C18.6495 8.8817 18.3315 8.75 18 8.75H6C5.66848 8.75 5.35054 8.8817 5.11612 9.11612C4.8817 9.35054 4.75 9.66848 4.75 10V14C4.75 14.3315 4.8817 14.6495 5.11612 14.8839C5.35054 15.1183 5.66848 15.25 6 15.25H8C8.19891 15.25 8.38968 15.329 8.53033 15.4697C8.67098 15.6103 8.75 15.8011 8.75 16C8.75 16.1989 8.67098 16.3897 8.53033 16.5303C8.38968 16.671 8.19891 16.75 8 16.75H6C5.27065 16.75 4.57118 16.4603 4.05546 15.9445C3.53973 15.4288 3.25 14.7293 3.25 14V10C3.25 9.27065 3.53973 8.57118 4.05546 8.05546C4.57118 7.53973 5.27065 7.25 6 7.25H18C18.7293 7.25 19.4288 7.53973 19.9445 8.05546C20.4603 8.57118 20.75 9.27065 20.75 10V14C20.75 14.7293 20.4603 15.4288 19.9445 15.9445C19.4288 16.4603 18.7293 16.75 18 16.75Z" fill="#000000" />
                    <path d="M16 8.75C15.8019 8.74741 15.6126 8.66756 15.4725 8.52747C15.3324 8.38737 15.2526 8.19811 15.25 8V4.75H8.75V8C8.75 8.19891 8.67098 8.38968 8.53033 8.53033C8.38968 8.67098 8.19891 8.75 8 8.75C7.80109 8.75 7.61032 8.67098 7.46967 8.53033C7.32902 8.38968 7.25 8.19891 7.25 8V4.5C7.25 4.16848 7.3817 3.85054 7.61612 3.61612C7.85054 3.3817 8.16848 3.25 8.5 3.25H15.5C15.8315 3.25 16.1495 3.3817 16.3839 3.61612C16.6183 3.85054 16.75 4.16848 16.75 4.5V8C16.7474 8.19811 16.6676 8.38737 16.5275 8.52747C16.3874 8.66756 16.1981 8.74741 16 8.75Z" fill="#000000" />
                    <path d="M15.5 20.75H8.5C8.16848 20.75 7.85054 20.6183 7.61612 20.3839C7.3817 20.1495 7.25 19.8315 7.25 19.5V12.5C7.25 12.1685 7.3817 11.8505 7.61612 11.6161C7.85054 11.3817 8.16848 11.25 8.5 11.25H15.5C15.8315 11.25 16.1495 11.3817 16.3839 11.6161C16.6183 11.8505 16.75 12.1685 16.75 12.5V19.5C16.75 19.8315 16.6183 20.1495 16.3839 20.3839C16.1495 20.6183 15.8315 20.75 15.5 20.75ZM8.75 19.25H15.25V12.75H8.75V19.25Z" fill="#000000" />
                </svg>
            </button>
            <?php if ($property->employee_id === $employee_id) : ?>
                <a href="/listings/edit/<?= $property->property_id ?>" class="my-auto space-x-2 flex cursor-pointer no-print">
                    <p>Edit</p>

                    <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                </a>
            <?php endif; ?>

        </div>
    </div>

    <h2 class="md:hidden main-title-page">Property of <?= esc($property->client_name) ?></h2>

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



    <div class="my-8 bg-white p-10 shadow-md rounded-md overflow-auto text-lg w-full max-w-6xl mx-auto print-container">


        <h2 class="secondary-title">Vendor</h2>
        <table>
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

        <table>
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
            <table>
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
            <table>
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
                    <th>Furnished On Provisions</th>
                    <td><?= $apartmentDetails->ad_furnished_on_provisions ? 'Yes' : 'No' ?></td>
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
            <table>
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
            <table>
                <tr>
                    <th>Heating System</th>
                    <td><?= $apartmentDetails->spec_heating_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Heating System On Provisions</th>
                    <td><?= $apartmentDetails->spec_heating_system_on_provisions ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>AC System</th>
                    <td><?= $apartmentDetails->spec_ac_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>AC System On Provisions</th>
                    <td><?= $apartmentDetails->spec_ac_system_on_provisions ? 'Yes' : 'No' ?></td>
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
                    <th>Tiles</th>
                    <td><?= esc(ucfirst($apartmentDetails->spec_tiles)) ?></td>
                </tr>
            </table>

            <br class="no-print">
            <hr class="no-print">
            <br class="no-print">
        <?php endif; ?>

    </div>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table td,
        table th {
            border: 1px solid lightgray;
            padding: 8px;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table th {
            font-weight: bold;
            width: 250px;
        }
    </style>

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