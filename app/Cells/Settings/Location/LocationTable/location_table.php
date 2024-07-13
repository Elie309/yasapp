<div class="w-full container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">

        <!-- Will iterate through each country -->
        <?php foreach ($data_location as $country) : ?>
            <div class="mb-6">

                <h2 class="text-2xl font-bold mb-2">
                    <button onclick="openModal('EditCountry')" class=" flex flex-row justify-center text-blue-600 hover:text-blue-800">
                        <?= esc($country->country_name) ?> - (code: <?= esc($country->country_code) ?> )  
                        <img class="w-5 mx-2" src="<?= base_url("images/icons/edit_pen.png") ?>" alt="Edit">
                    </button>
                </h2>

                <!-- Make only openModel on the first iteration -->
                    

                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">
                                <button onclick="openModal('EditRegion')" class=" flex flex-row justify-center text-blue-600 hover:text-blue-800">
                                    Region
                                    <img class="w-5 mx-2" src="<?= base_url("images/icons/edit_pen.png") ?>" alt="Edit">
                                </button>
                            </th>
                            <th class="px-4 py-2">
                                <button onclick="openModal('EditSubregion')" class="flex flex-row justify-center text-blue-600 hover:text-blue-800">
                                    Subregion
                                    <img class="w-5 mx-2" src="<?= base_url("images/icons/edit_pen.png") ?>" alt="Edit">
                                </button>
                            </th>
                            <th class="px-4 py-2">
                                <button onclick="openModal('EditCity')" class="flex flex-row justify-center text-blue-600 hover:text-blue-800">
                                    City
                                    <img class="w-5 mx-2" src="<?= base_url("images/icons/edit_pen.png") ?>" alt="Edit">
                                </button>
                            </th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php foreach ($country->regions as $region) : ?>
                            <!-- To know how much we need to span the first col
                                 we need to know how many cities we have that will decide the span of the row -->
                            <?php
                            $totalCities = 0;
                            foreach ($region->subregions as $subregion) {
                                $totalCities += count($subregion->cities);

                                // If we have no cities inside a subregion we need to now show anything
                                //so we need to add one for the count
                                if (count($subregion->cities) === 0) {
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
                                    <?= esc($region->region_name) ?>
                                </td>

                                <!-- SUBREGION -->
                                <?php foreach ($region->subregions as $subregionIndex => $subregion) : ?>
                                    <?php if ($subregionIndex > 0) : ?>
                            <tr>
                            <?php endif; ?>


                            <td class="border px-4 py-2 align-top" rowspan="<?= count($subregion->cities) === 0 ? 1 : count($subregion->cities) ?>">
                                <?= esc($subregion->subregion_name) ?>
                            </td>

                            <!-- CITIES  -->
                            <?php foreach ($subregion->cities as $cityIndex => $city) : ?>
                                <?php if ($cityIndex > 0) : ?>
                            <tr>
                            <?php endif; ?>
                            <td class="border px-4 py-2">
                                <?= esc($city->city_name) ?>
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

<!-- Extract all necessary data from above using neceassry iterations since data_location hold many countries and each countires has regions...-->

<?php

$countries = [];
$regions = [];
$subregions = [];
$cities = [];

// Extract all countries using Foreach loop
foreach ($data_location as $country) {
    // create an array for countires name and id
    $countries[] = [
        'id' => $country->country_id,
        'name' => $country->country_name
    ];

    // Extract all regions using Foreach loop
    foreach ($country->regions as $region) {
        // create an array for regions name and id
        $regions[] = [
            'id' => $region->region_id,
            'name' => $region->region_name
        ];

        // Extract all subregions using Foreach loop
        foreach ($region->subregions as $subregion) {
            // create an array for subregions name and id
            $subregions[] = [
                'id' => $subregion->subregion_id,
                'name' => $subregion->subregion_name
            ];

            // Extract all cities using Foreach loop
            foreach ($subregion->cities as $city) {
                // create an array for cities name and id
                $cities[] = [
                    'id' => $city->city_id,
                    'name' => $city->city_name
                ];
            }
        }
    }
}


?>




<!-- TODO: EDIT BELOW CELLS -->

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditCountry',
    'modalTitle' => 'Edit Country',
    'modalBody' => view_cell('App\Cells\Settings\Location\FormsLocationCells\CountryCell::render', [
        'selectedOptionsCurrent' => $countries,
    ])
]) ?>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditRegion',
    'modalTitle' => 'Edit Region',
    'modalBody' => view_cell('App\Cells\Settings\Location\FormsLocationCells\RegionCell::render', [
        'selectOptionsParent' => $countries,
        'selectedOptionsCurrent' => $regions,
    ])
]) ?>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditSubregion',
    'modalTitle' => 'Edit Subregion',
    'modalBody' => view_cell('App\Cells\Settings\Location\FormsLocationCells\SubregionCell::render', [
        'selectOptionsParent' => $regions,
        'selectedOptionsCurrent' => $subregions,
    ])
]) ?>


<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditCity',
    'modalTitle' => 'Edit City',
    'modalBody' => view_cell('App\Cells\Settings\Location\FormsLocationCells\CityCell::render', [
        'selectOptionsParent' => $subregions,
        'selectedOptionsCurrent' => $cities,
    ])
]) ?>
