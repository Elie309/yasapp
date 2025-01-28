<div class="container-main">

    <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Listings Attributes - Overview</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>


    <div class="flex border-b border-gray-300">
        <a href="<?= base_url('settings/listings-attributes/property-status') ?>"
            class="tabBtn w-1/2 py-4 text-center 
            font-medium text-gray-700 focus:outline-none 
            <?= $id == "propertyStatus" ? 'bg-gray-200' : 'bg-gray-100' ?>">
            Property Status
        </a>
        <a href="<?= base_url('settings/listings-attributes/apartment-types') ?>"
            class="tabBtn w-1/2 py-4 text-center font-medium text-gray-700  focus:outline-none
            <?= $id == "apartmentType" ? 'bg-gray-200' : 'bg-gray-100' ?>">
            Apartment Type
        </a>
        <a href="<?= base_url('settings/listings-attributes/apartment-gender') ?>"
            class="tabBtn w-1/2 py-4 text-center font-medium text-gray-700   focus:outline-none
            <?= $id == "apartmentGender" ? 'bg-gray-200' : 'bg-gray-100' ?>">
            Apartment Gender
        </a>
    </div>

    <div>
        <?php
        $tableHeaders_ApartmentType = [
            "id" => "ID",
            "name" => "Apartment Type",
        ];

        $tableHeaders_PropertyStatus = [
            "id" => "ID",
            "name" => "Property Status",
        ];

        $tableHeaders_ApartmentGender = [
            'id' => 'ID',
            'name' => 'Apartment Gender'
        ];
        ?>

        <?php if ($id == "propertyStatus") : ?>
           
            <?= view_cell("\App\Cells\Listings\PropertyStatus\PropertyStatusCell::render", [
                'tableHeaders' => $tableHeaders_PropertyStatus,
                'propertyStatus' => $propertyStatus,
            ]) ?>

        <?php elseif ($id == "apartmentType") : ?>

          <?= view_cell("\App\Cells\Listings\ApartmentType\ApartmentTypeCell::render", [
            'tableHeaders' => $tableHeaders_ApartmentType,
            'apartmentType' => $apartmentType,
          ]) ?>

        <?php elseif ($id == "apartmentGender") : ?>

          <?= view_cell("\App\Cells\Listings\ApartmentGender\ApartmentGenderCell::render", [
            'tableHeaders' => $tableHeaders_ApartmentGender,
            'apartmentGender' => $apartmentGender,
          ]) ?>

        <?php endif; ?>

    </div>
 
</div>