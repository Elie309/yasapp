<div class="w-full container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">

        <!-- Will iterate through each country -->
        <?php foreach ($countries as $country) : ?>
            <div class="mb-6">

                <h2 class="text-2xl font-bold mb-2"><?= esc($country['country_name']) ?></h2>

                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Region</th>
                            <th class="px-4 py-2">Subregion</th>
                            <th class="px-4 py-2">City</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php foreach ($country['regions'] as $region) : ?>
                            <!-- To know how much we need to span the first col
                                 we need to know how many cities we have that will decide the span of the row -->
                            <?php
                            $totalCities = 0;
                            foreach ($region['subregions'] as $subregion) {
                                $totalCities += count($subregion['cities']);

                                // If we have no cities inside a subregion we need to now show anything
                                //so we need to add one for the count
                                if (count($subregion['cities']) === 0) {
                                    $totalCities += 1;
                                }
                            }

                            if ($totalCities === 0) {
                                $totalCities = 1;
                            }

                            ?>


                            <tr>
                                <!-- REGION -->
                                <td class="border px-4 py-2 align-top" rowspan="<?= $totalCities ?>">
                                    <?= esc($region['region_name']) ?>
                                </td>

                                <!-- SUBREGION -->
                                <?php foreach ($region['subregions'] as $subregionIndex => $subregion) : ?>
                                    <?php if ($subregionIndex > 0) : ?>
                            <tr>
                            <?php endif; ?>


                            <td class="border px-4 py-2 align-top" rowspan="<?= count($subregion['cities']) === 0 ? 1 : count($subregion['cities']) ?>">
                                <?= esc($subregion['subregion_name']) ?>
                            </td>

                            <!-- CITIES  -->
                            <?php foreach ($subregion['cities'] as $cityIndex => $city) : ?>
                                <?php if ($cityIndex > 0) : ?>
                            <tr>
                            <?php endif; ?>
                            <td class="border px-4 py-2">
                                <?= esc($city['city_name']) ?>
                            </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>

                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</div>