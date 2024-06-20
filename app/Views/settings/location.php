<div class="w-full bg-gray-100 min-h-full flex flex-col items-start justify-center">
    <div class="container mx-auto p-4 w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

        <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

        <br />


        <h2 class="w-full my-8 text-3xl font-bold text-center">Location Management</h2>

        <div class="container w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">



            <?= view_cell('\App\Cells\Settings\Location\FormsLocationCells\CountryCell::render') ?>
            <?= view_cell('\App\Cells\Settings\Location\FormsLocationCells\RegionCell::render') ?>
            <?= view_cell('\App\Cells\Settings\Location\FormsLocationCells\SubregionCell::render') ?>
            <?= view_cell('\App\Cells\Settings\Location\FormsLocationCells\CityCell::render') ?>
        </div>
    </div>

    <br />

    <h2 class="w-full my-8 text-3xl font-bold text-center">Location Overview</h2>

    <div class="container mx-auto p-4 w-full">
        <?= view_cell('\App\Cells\Settings\Location\LocationTable\LocationTableCell::render') ?>
    </div>
</div>