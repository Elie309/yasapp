<div class="w-full">

    <div class="flex flex-row justify-between mb-6">
        <div>
            <button id="download-xlsx" onclick="fnExcelReport()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Download XLSX</button>
        </div>
        <div>
            <button onclick="openModal('<?= $addButtonModelId ?>')" class="secondary-btn">
                <?= $AddButtonName ?>
            </button>
        </div>
    </div>

    <div class="my-4 w-full grid grid-cols-2 gap-10 justify-around ">
        <select id="columnSelect_<?= $tableId ?>" class="main-select ">
            <?php foreach ($tableHeaders as $key => $value) : ?>
                <option value='<?= $value ?>'><?= $value ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" onkeyup="filterTable(document.getElementById('columnSelect_<?= $tableId ?>').value, this.value)" placeholder="Search" class="main-input">
    </div>


    <table id="<?= $tableId ?>" class="table-responsive max-w-full overflow-auto">
        <!-- Generate table using HTML CSS AND PHP -->

        <thead>
            <tr>
                <?php foreach ($tableHeaders as $key => $value) : ?>
                    <th class="bg-gray-200 border border-gray-500">
                        <?= $value ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tableData as $data) {
                echo "<tr class='clickable-row' data-row-data='" . htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') . "'>";
                foreach ($tableHeaders as $key => $value) {
                    echo "<td class='border px-4 py-2'>" . $data->$key . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <style>
        <?= '#' . $tableId . " " ?>,
        .table-responsive {
            overflow-x: auto;
            /* Enables horizontal scrolling */
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on touch devices */
        }

        <?= '#' . $tableId . " "  ?>,

        table {
            width: 100%;
            /* Ensures the table takes up the full width */
            border-collapse: collapse;
            /* Optional: for styling */

        }

        <?= '#' . $tableId . " " ?>th,
        td {
            text-align: left;
            /* Optional: for styling */
            padding: 3px;
            /* Optional: for styling */
        }

        /* Body styles */
        <?= '#' . $tableId . " " ?>td {
            border: 1px solid #ddd;
            /* Light gray border */
            padding: 3px;
            /* Adjust padding as needed */
        }

        /* Alternating row background colors */
        <?= '#' . $tableId . " " ?>tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Light gray for even rows */
        <?= '#' . $tableId . " " ?>tr:nth-child(odd) {
            background-color: #ffffff;
        }


        <?= '#' . $tableId . " " ?>tbody tr:hover {
            background-color: #3b82f6;
            color: white;
            cursor: pointer;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
    <script>
        function filterTable(columnKey, searchValue) {
            let td, i, txtValue;
            let <?= $tableId ?>_table = document.getElementById("<?= $tableId ?>"); // Make sure to replace 'yourTableId' with the actual ID of your table
            let tr = <?= $tableId ?>_table.getElementsByTagName("tr");

            let columnIndex = -1;

            // First, find the index of the column to filter on by matching it with the header row's cells
            let headers = tr[0].getElementsByTagName("th");
            for (let i = 0; i < headers.length; i++) {
                if (headers[i].textContent.trim().toUpperCase() === columnKey.toUpperCase()) {
                    columnIndex = i;
                    break;
                }
            }

            // If the column was found, proceed with filtering
            if (columnIndex !== -1) {
                for (let i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                    let td = tr[i].getElementsByTagName("td")[columnIndex];
                    if (td) {
                        let txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(searchValue.toUpperCase()) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }

        function fnExcelReport() {
            var tab = document.getElementById('<?= $tableId ?>'); // id of table
            var wb = XLSX.utils.table_to_book(tab, {
                sheet: "Sheet JS"
            });
            var wbout = XLSX.write(wb, {
                bookType: 'xlsx',
                bookSST: true,
                type: 'binary'
            });

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }

            saveAs(new Blob([s2ab(wbout)], {
                type: "application/octet-stream"
            }), 'Report.xlsx');
        }


        // TODO: Make this script non-specific to the employee
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function() {
                var rowData = JSON.parse(this.getAttribute('data-row-data'));

                sessionStorage.setItem('tempTableData', JSON.stringify(rowData));
                
                openModal('<?= $addButtonModelId ?>');
                <?php echo $JSFunctionToRunOnClick ?>

                setTimeout(() => {
                   sessionStorage.removeItem('tempTableData');
                   sessionStorage.getItem('tempTableData', JSON.stringify(rowData));
                }, 5000);

            });
        });
    </script>

</div>