<div class="w-full">

    <div class="flex flex-row justify-end mb-6">
        <button id="download-xlsx" onclick="fnExcelReport()" class="secondary-btn mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
        </button>
        <?php if (isset($addButtonRedirectLink)) : ?>
            <a href="<?= $addButtonRedirectLink ?>" class="secondary-btn mx-2">
                <?= $AddButtonName ?>
            </a>
        <?php else : ?>
            <button onclick="openModal('<?= $addButtonModelId ?>'); <?= isset($addButtonModelAdditionalFn) ? $addButtonModelAdditionalFn : ''  ?>" class="secondary-btn mx-2">
                <?= $AddButtonName ?>
            </button>
        <?php endif; ?>
    </div>

    <div class="my-4 w-full grid grid-cols-2 gap-10 justify-around ">
        <select id="columnSelect_<?= $tableId ?>" class="main-select">
            <?php foreach ($tableHeaders as $key => $value) : ?>
                <option value='<?= $value ?>'><?= $value ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" onkeyup="filterTable(document.getElementById('columnSelect_<?= $tableId ?>').value, this.value)" placeholder="Search" class="main-input">
    </div>

    <div class='w-full overflow-auto'>

        <table id="<?= $tableId ?>" class="table-auto w-full">

            <thead class="table-header-group">
                <tr class="border border-gray-300">
                    <?php foreach ($tableHeaders as $key => $value) : ?>
                        <th class="bg-gray-200 text-center ">
                            <?= $value ?>
                        </th>
                    <?php endforeach; ?>
                    <?php if (isset($actions) && count($actions) > 0) : ?>
                        <th class="bg-gray-200">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                <?php
                $row_count = 0;
                foreach ($tableData as $data) {

                    echo "<tr class='clickable-row " . (isset($classOnClickRow) ? $classOnClickRow : ' ') . "' data-row-data='" . htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') . "'>";
                    foreach ($tableHeaders as $key => $value) {
                        $cellData = $data->$key;
                        if (is_array($cellData)) {
                            $cellData = implode('; ', $cellData);
                        }
                        echo "<td class=''>" . $cellData . "</td>";
                    }

                    $data = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                    if (isset($actions) && count($actions) > 0) {
                        echo "<td>";
                        echo "<div class='flex flex-row justify-evenly'>";

                        foreach ($actions as $action) {
                            echo "<button ";
                            echo "class='actionsBtn " . ($action['class'] ?? '') . "' ";
                            echo 'onclick="actionStoreDataOnClickEvent(' . $data . '); ' . $action['functions'] .  ' "';
                            // echo "data-row-data='" . $data ."'";
                            echo ">";
                            echo isset($action['img']) ? ($action['img']) : ($action['name']);

                            echo "</button>";
                        }
                        echo "</div>";

                        echo "</td>";
                    }

                    echo "</tr>";
                    $row_count++;
                }
                ?>
            </tbody>
        </table>

    </div>


    <!-- Styles even and odd rows -->
    <style>
        <?= '#' . $tableId . ' ' ?>tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        <?= '#' . $tableId . ' ' ?>tbody tr:hover {
            background-color: #1f2937;
            color: white;
        }

        <?= '#' . $tableId . ' ' ?>th,
        <?= '#' . $tableId . ' ' ?>td {
            padding: 8px;
        }

        <?= '#' . $tableId . ' ' ?>th {
            background-color: #f2f2f2;
        }

        <?= '#' . $tableId . ' ' ?>td {
            border: 1px solid #ddd;
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


        function actionStoreDataOnClickEvent(data) {

            sessionStorage.setItem('tempTableData', JSON.stringify(data));
            setTimeout(() => {
                sessionStorage.removeItem('tempTableData');
            }, 5000);
        }




        <?php if (isset($isOnClickRowActive) && $isOnClickRowActive) : ?>

            document.querySelectorAll('.clickable-row').forEach(function(row) {
                row.addEventListener('click', function() {
                    var rowData = JSON.parse(this.getAttribute('data-row-data'));

                    sessionStorage.setItem('tempTableData', JSON.stringify(rowData));

                    openModal('<?= isset($modelIdOnClickRow) ? $modelIdOnClickRow : $addButtonModelId ?>');
                    <?= isset($JSFunctionToRunOnClickRow) ? $JSFunctionToRunOnClickRow : '' ?>

                    setTimeout(() => {
                        sessionStorage.removeItem('tempTableData');
                    }, 5000);

                });
            });

        <?php endif; ?>
    </script>

</div>