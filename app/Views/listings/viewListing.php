<div class="container-main print-container max-w-6xl overflow-auto">

    <!-- Property Details -->
    <div class="flex flex-row">
        <button onclick="window.history.back()" class="my-auto cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </button>
        <h2 class="main-title-page text-wrap">Property of <?= esc($property->client_name) ?></h2>

        <a href="/listings/edit/<?= $property->property_id ?>" class="my-auto cursor-pointer no-print">
            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
            </svg>
        </a>

    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

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
                <td><?= esc($property->payment_plan_name) ?></td>
            </tr>
            <tr>
                <th>Location</th>
                <td><?= esc($property->property_detailed_location) ?></td>
            </tr>
            <tr>
                <th>Type</th>
                <td><?= esc($property->property_type_name) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= esc($property->property_status_name) ?></td>
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
                    <th>Gender</th>
                    <td><?= esc($apartmentDetails->apartment_gender_name) ?></td>
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
                    <th>Type</th>
                    <td><?= esc($apartmentDetails->ad_type) ?></td>
                </tr>
                <tr>
                    <th>Architecture and Interior</th>
                    <td><?= esc($apartmentDetails->ad_architecture_and_interior) ?></td>
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
                <tr>
                    <th>Extra Features</th>
                    <td><?= esc($apartmentDetails->partition_extra_features) ?></td>
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
                    <th>Tiles</th>
                    <td><?= esc($apartmentDetails->spec_tiles) ?></td>
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
                    <th>Extra Features</th>
                    <td><?= esc($apartmentDetails->spec_extra_features) ?></td>
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