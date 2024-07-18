<link href="https://unpkg.com/tabulator-tables@6.2.3/dist/css/tabulator.min.css" rel="stylesheet">

<div class="flex flex-row justify-between mb-6">
    <div>
        <button id="download-xlsx" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Download XLSX</button>

    </div>
    <div>
        <button id="table-save" class="main-btn min-w-40">Save</button>
    </div>
</div>

<div id="employee-table"></div>
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.3/dist/js/tabulator.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script>
    <?php
    $tableData = json_encode($tableData);

    echo "var tableData = $tableData;";
    ?>

    //define table

    var table = new Tabulator("#employee-table", {
        data: tableData,
        layout: "fitDataStretch",

        // Range selection
        selectableRange: 1,
        //change edit trigger mode to make cell navigation smoother
        editTriggerEvent: "dblclick",

        //configure clipboard to allow copy and paste of range format data
        clipboard: true,
        clipboardCopyStyled: false,
        clipboardCopyConfig: {
            rowHeaders: false,
            columnHeaders: false,
        },
        clipboardCopyRowRange: "range",
        clipboardPasteParser: "range",
        clipboardPasteAction: "range",


        autoColumns: false,
        columns: [{
                title: "Name",
                field: "employee_name",
                editor: "input",
                validator: ["required", 'unique']
            },
            {
                title: 'Role',
                field: 'employee_role',
                editor: "input",
                validator: ["required", 'in:admin|manager|user']
            },
            {
                title: 'Email',
                field: 'employee_email',
                editor: "input",
                validator: ["required", 'unique']
            },
            {
                title: 'Phone',
                field: 'employee_phone',
                editor: "input",
                validator: ["required", 'unique']
            },
            {
                title: 'Birthday',
                field: 'employee_birthday',
                editor: "input",
                validator: ["required", 'unique']
            },
            {
                title: 'Status',
                field: 'employee_status',
                editor: "input",
                validator: ["required", 'in:active|inactive']
            },
            {
                title: 'Address',
                field: 'employee_address',
                editor: "input"
            },
        ],
    });
    table.on("validationFailed", function(cell, value, validators) {
        //    Handler failure
        console.log("Validation failed for cell:", cell.getComponent());
        console.log("Value:", value);
        console.log("Validators:", validators);
    });


    //trigger download of data.xlsx file
    document.getElementById("download-xlsx").addEventListener("click", function() {
        table.download("xlsx", "data.xlsx", {
            sheetName: "Employee Data"
        });
    });

    // Save data
    document.getElementById("table-save").addEventListener("click", function() {
        var data = table.getEditedCells()
        console.log(data);
    });
</script>