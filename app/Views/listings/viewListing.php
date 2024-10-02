<div class="container-main">

    <!-- Property Details -->
    <h2 class="main-title-page">General Information</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto text-lg">
        <h2 class="secondary-title">Property</h2>

        <table>
            <tr>
                <th>Location</th>
                <td><?= esc($property->property_location) ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?= esc($property->property_price) ?> USD</td>
            </tr>
            <tr>
                <th>Size</th>
                <td><?= esc($property->property_size) ?> sqm</td>
            </tr>
            <tr>
                <th>Catch Phrase</th>
                <td><?= esc($property->property_catch_phrase) ?></td>
            </tr>
            <tr>
                <th>Visibility</th>
                <td><?= esc($property->property_visibility) ?></td>
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
                    <td><?= esc($landDetails->land_zone_first) ?> sqm</td>
                </tr>
                <tr>
                    <th>Zone 2</th>
                    <td><?= esc($landDetails->land_zone_second) ?> sqm</td>
                </tr>
                <tr>
                    <th>Extra Features</th>
                    <td><?= esc($landDetails->land_extra_features) ?></td>
                </tr>
            </table>

        <?php endif; ?>

        <br>
        <hr>
        <br>

        <?php if ($apartmentDetails): ?>
            <!-- Apartment Details -->
            <h2 class="secondary-title">Apartment Details</h2>
            <table>
                <tr>
                    <th>Floor Level</th>
                    <td><?= esc($apartmentDetails->ad_floor_level) ?></td>
                </tr>
                <tr>
                    <th>Apartments per Floor</th>
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
                    <th>Architecture</th>
                    <td><?= esc($apartmentDetails->ad_architecture_and_interior) ?></td>
                </tr>
            </table>

            <br>
            <hr>
            <br>

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
            </table>

            <br>
            <hr>
            <br>

            <!-- Apartment Specifications -->
            <h2 class="secondary-title">Apartment Specifications</h2>
            <table>
                <tr>
                    <th>Heating System</th>
                    <td><?= $apartmentDetails->spec_heating_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>AC System</th>
                    <td><?= $apartmentDetails->spec_ac_system ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Tiles</th>
                    <td><?= esc($apartmentDetails->spec_tiles) ?></td>
                </tr>
                <tr>
                    <th>Security Door</th>
                    <td><?= $apartmentDetails->spec_security_door ? 'Yes' : 'No' ?></td>
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

            <br>
            <hr>
            <br>
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