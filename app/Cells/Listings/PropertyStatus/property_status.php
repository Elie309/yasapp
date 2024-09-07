<div>
    <div class="my-8 bg-white p-10 shadow-md rounded-md">

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'property_status_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $propertyStatus,
                'addButtonModelId' => 'AddPropertyStatus',
                'AddButtonName' => 'Add Property Status',
                'isOnClickRowActive' => true,
                'modelIdOnClickRow' => 'EditPropertyStatus',
                'addButtonModelAdditionalFn' => '',
                'JSFunctionToRunOnClickRow' => 'setFormDetails()',
                'classOnClickRow' => 'cursor-pointer',
            ]
        ) ?>
    </div>

    <div popover class="popover max-w-2xl" id="AddPropertyStatus">
    <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/add-property-status') ?>">
            <h2 class="secondary-title">Add Property Status</h2>
            <div class="flex flex-col mb-8">
                <label for="property_status_name" class="main-label">Property Status</label>
                <input type="text" name="property_status_name" id="property_status_name"
                    placeholder="Enter Property status name"
                    class="secondary-input">
            </div>
            <div class="flex flex-row justify-between mx-4">
                <a onclick="closePopover('AddPropertyStatus')"
                    class="secondary-btn w-1/2 mr-2 cursor-pointer text-center">Close</a>
                <button type="submit"
                    class="primary-btn w-1/2 ml-2">Save</button>
            </div>
        </form>
    </div>

    <div popover class="popover max-w-2xl" id="EditPropertyStatus">
    <div class="flex flex-row justify-between">
            <h2 class="secondary-title">Edit Property Status</h2>
            <div>
                <a onclick="closePopover('EditPropertyStatus')" class="secondary-btn w-16 cursor-pointer text-center">X</a>
            </div>
        </div>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/edit-property-status') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" name="property_status_id" id="property_status_id_edit" value="" />

                <label for="property_status_name" class="main-label">Property Status</label>

                <input type="text" name="property_status_name" id="property_status_name_edit"
                    placeholder="Enter Property status name"
                    class="secondary-input">
            </div>


            <div class="flex flex-row justify-end">
                <button type="submit"
                    class="secondary-btn cursor-pointer w-2/6">
                    Update
                </button>
            </div>
        </form>

        <form method="POST" class="p-4" action="<?= base_url('settings/listings-attributes/delete-property-status') ?>">
            <div class="flex flex-col mb-4">
                <input hidden type="text" readonly name="property_status_id" id="property_status_id_delete" value="" />
                <label for="property_status_name" class="main-label">Property Status</label>
                <input type="text" name="property_status_name" readonly id="property_status_name_delete"
                    placeholder="Enter Property status name"
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
            document.getElementById('property_status_id_edit').value = data.property_status_id;
            document.getElementById('property_status_name_edit').value = data.property_status_name;
            document.getElementById('property_status_id_delete').value = data.property_status_id;
            document.getElementById('property_status_name_delete').value = data.property_status_name;
        }
    </script>

</div>