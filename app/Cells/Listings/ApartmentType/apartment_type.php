<div>

    <div class="my-8 bg-white p-10 shadow-md rounded-md">


        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'apartment_types_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $apartmentType,
                'addButtonModelId' => 'AddApartmentType',
                'AddButtonName' => 'Add Apartment Type',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'EditApartmentType',
                'addButtonModelAdditionalFn' => '',
                'JSFunctionToRunOnClickRow' => 'setFormDetails()',
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>


    </div>


    <div popover class="popover max-w-2xl" id="AddApartmentType">
        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/add-apartment-types') ?>">
            <h2 class="secondary-title">Add Apartment Type</h2>
            <div class="flex flex-col mb-8">
                <label for="apartment_type_name" class="main-label">Apartment Type</label>
                <input type="text" name="apartment_type_name" id="apartment_type_name"
                    placeholder="Enter apartment Type name"
                    class="secondary-input">
            </div>
            <div class="flex flex-row justify-between mx-4">
                <a onclick="closePopover('AddApartmentType')"
                    class="secondary-btn w-1/2 mr-2 cursor-pointer text-center">Close</a>
                <button type="submit"
                    class="primary-btn w-1/2 ml-2">Save</button>
            </div>
        </form>
    </div>

    <div popover class="popover max-w-2xl" id="EditApartmentType">
        <div class="flex flex-row justify-between">
            <h2 class="secondary-title">Edit Apartment Type</h2>
            <div>
                <a onclick="closePopover('EditApartmentType')" class="secondary-btn w-16 cursor-pointer text-center">X</a>
            </div>
        </div>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/edit-apartment-types') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" name="apartment_type_id" id="apartment_type_id_edit" value="" />

                <label for="apartment_type_name" class="main-label">Apartment Type</label>

                <input type="text" name="apartment_type_name" id="apartment_type_name_edit"
                    placeholder="Enter apartment Type name"
                    class="secondary-input">
            </div>


            <div class="flex flex-row justify-end">
                <button type="submit"
                    class="secondary-btn cursor-pointer w-2/6">
                    Update
                </button>
            </div>
        </form>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/delete-apartment-types') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" readonly name="apartment_type_id" id="apartment_type_id_delete" value="" />
                <label for="apartment_type_name" class="main-label">Apartment Type</label>
                <input type="text" name="apartment_type_name" readonly id="apartment_type_name_delete"
                    placeholder="Enter apartment Type name"
                    class="main-input-readonly">
            </div>
            <div class="flex flex-row justify-end">

                <button type="submit"
                    class="secondary-btn cursor-pointer w-2/6">
                    Delete
                </button>
            </div>
        </form>


    </div>
    
    <script>
        function setFormDetails() {
            const tempData = JSON.parse(sessionStorage.getItem('tempTableData'));
            document.getElementById('apartment_type_id_edit').value = tempData.id;
            document.getElementById('apartment_type_name_edit').value = tempData.name;
            document.getElementById('apartment_type_id_delete').value = tempData.id;
            document.getElementById('apartment_type_name_delete').value = tempData.name;
        }
    </script>
</div>