<div>

    <div class="my-8 bg-white p-10 shadow-md rounded-md">


        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'property_types_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $propertyType,
                'addButtonModelId' => 'AddPropertyType',
                'AddButtonName' => 'Add Property Type',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'EditPropertyType',
                'addButtonModelAdditionalFn' => '',
                'JSFunctionToRunOnClickRow' => 'setFormDetails()',
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>


    </div>


    <div popover class="popover max-w-2xl" id="AddPropertyType">
        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/add-property-types') ?>">
            <h2 class="secondary-title">Add Property Type</h2>
            <div class="flex flex-col mb-8">
                <label for="property_type_name" class="main-label">Property Type</label>
                <input type="text" name="property_type_name" id="property_type_name"
                    placeholder="Enter Property Type name"
                    class="secondary-input">
            </div>
            <div class="flex flex-row justify-between mx-4">
                <a onclick="closePopover('AddPropertyType')"
                    class="secondary-btn w-1/2 mr-2 cursor-pointer text-center">Close</a>
                <button type="submit"
                    class="primary-btn w-1/2 ml-2">Save</button>
            </div>
        </form>
    </div>

    <div popover class="popover max-w-2xl" id="EditPropertyType">
        <div class="flex flex-row justify-between">
            <h2 class="secondary-title">Edit Property Type</h2>
            <div>
                <a onclick="closePopover('EditPropertyType')" class="secondary-btn w-16 cursor-pointer text-center">X</a>
            </div>
        </div>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/edit-property-types') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" name="property_type_id" id="property_type_id_edit" value="" />

                <label for="property_type_name" class="main-label">Property Type</label>

                <input type="text" name="property_type_name" id="property_type_name_edit"
                    placeholder="Enter Property Type name"
                    class="secondary-input">
            </div>


            <div class="flex flex-row justify-end">
                <button type="submit"
                    class="secondary-btn cursor-pointer w-2/6">
                    Update
                </button>
            </div>
        </form>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/delete-property-types') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" readonly name="property_type_id" id="property_type_id_delete" value="" />
                <label for="property_type_name" class="main-label">Property Type</label>
                <input type="text" name="property_type_name" readonly id="property_type_name_delete"
                    placeholder="Enter Property Type name"
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
            document.getElementById('property_type_id_edit').value = tempData.property_type_id;
            document.getElementById('property_type_name_edit').value = tempData.property_type_name;
            document.getElementById('property_type_id_delete').value = tempData.property_type_id;
            document.getElementById('property_type_name_delete').value = tempData.property_type_name;
        }
    </script>
</div>