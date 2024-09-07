<div>
    <div class="my-8 bg-white p-10 shadow-md rounded-md">
        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'apartment_gender_Table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $apartmentGender,
                'addButtonModelId' => 'AddApartmentGender',
                'AddButtonName' => 'Add Apartment Gender',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'EditApartmentGender',
                'addButtonModelAdditionalFn' => '',
                'JSFunctionToRunOnClickRow' => 'setFormDetails()',
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>
    </div>

    <div popover class="popover max-w-2xl" id="AddApartmentGender">
    <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/add-apartment-gender') ?>">
            <h2 class="secondary-title">Add Apartment Gender</h2>
            <div class="flex flex-col mb-8">
                <label for="apartment_gender_name" class="main-label">Apartment Gender</label>
                <input type="text" name="apartment_gender_name" id="apartment_gender_name"
                    placeholder="Enter Apartment Gender name"
                    class="secondary-input">
            </div>
            <div class="flex flex-row justify-between mx-4">
                <a onclick="closePopover('AddApartmentGender')"
                    class="secondary-btn w-1/2 mr-2 cursor-pointer text-center">Close</a>
                <button type="submit"
                    class="primary-btn w-1/2 ml-2">Save</button>
            </div>
        </form>
    </div>

    <div popover class="popover max-w-2xl" id="EditApartmentGender">
    <div class="flex flex-row justify-between">
            <h2 class="secondary-title">Edit Apartment Gender</h2>
            <div>
                <a onclick="closePopover('EditApartmentGender')" class="secondary-btn w-16 cursor-pointer text-center">X</a>
            </div>
        </div>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/edit-apartment-gender') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" name="apartment_gender_id" id="apartment_gender_id_edit" value="" />

                <label for="apartment_gender_name" class="main-label">Apartment Gender</label>

                <input type="text" name="apartment_gender_name" id="apartment_gender_name_edit"
                    placeholder="Enter Apartment gender name"
                    class="secondary-input">
            </div>


            <div class="flex flex-row justify-end">
                <button type="submit"
                    class="secondary-btn cursor-pointer w-2/6">
                    Update
                </button>
            </div>
        </form>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/delete-apartment-gender') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" readonly name="apartment_gender_id" id="apartment_gender_id_delete" value="" />
                <label for="apartment_gender_name" class="main-label">Apartment Gender</label>
                <input type="text" name="apartment_gender_name" readonly id="apartment_gender_name_delete"
                    placeholder="Enter Apartment gender name"
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
        function setFormDetails(){
            const data = JSON.parse(sessionStorage.getItem('tempTableData'));
            document.getElementById('apartment_gender_id_edit').value = data.apartment_gender_id;
            document.getElementById('apartment_gender_id_delete').value = data.apartment_gender_id;
            document.getElementById('apartment_gender_name_edit').value = data.apartment_gender_name;
            document.getElementById('apartment_gender_name_delete').value = data.apartment_gender_name;

        }
    </script>


</div>