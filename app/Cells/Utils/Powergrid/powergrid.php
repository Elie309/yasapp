<div class="w-full">

    <?php $emptyTable = ($tableData == null || count($tableData) == 0) ?>


    <div class="flex flex-col justify-center sm:flex-row sm:justify-between mb-6">
        <div class="flex flex-row justify-center align-middle mx-2 my-2 sm:my-0">
            <?php if (isset($rowsPerPageActive) && $rowsPerPageActive) : ?>
                <!-- Row per page -->
                <label for="rowPerPage_<?= $tableId ?>" class="main-label ">Rows per page:</label>
                <select id="rowPerPage_<?= $tableId ?>" <?= $emptyTable == true ? 'disabled' : '' ?> class="secondary-btn mx-2">
                    <!-- Get rowsPerPage using the link -->
                    <?php $rowsPerPage = isset($_GET['rowsPerPage']) ? $_GET['rowsPerPage'] : 5; ?>
                    <!-- Set the selected depending on the link -->
                    <option value="5" <?= isset($rowsPerPage) && $rowsPerPage == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= isset($rowsPerPage) && $rowsPerPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= isset($rowsPerPage) && $rowsPerPage == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= isset($rowsPerPage) && $rowsPerPage == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= isset($rowsPerPage) && $rowsPerPage == 100 ? 'selected' : '' ?>>100</option>
                </select>
            <?php endif; ?>
        </div>

        <div class="grid grid-rows-3 w-full px-5 gap-3 sm:mx-0 sm:w-fit sm:flex sm:flex-row sm:justify-end align-middle">
            <button onclick="printTable()" <?= $emptyTable == true ? 'disabled' : '' ?> class="secondary-btn mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
            </button>
            <button id="download-xlsx" <?= $emptyTable == true ? 'disabled' : '' ?> onclick="fnExcelReport()" class="secondary-btn mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
            </button>
            <?php if (isset($addButtonRedirectLink)) : ?>
                <a href="<?= $addButtonRedirectLink ?>" class="secondary-btn mx-auto">
                    <?= $AddButtonName ?>
                </a>
            <?php else : ?>
                <button onclick="openModal('<?= $addButtonModelId ?>'); <?= isset($addButtonModelAdditionalFn) ? $addButtonModelAdditionalFn : ''  ?>" class="secondary-btn mx-auto">
                    <?= $AddButtonName ?>
                </button>
            <?php endif; ?>

        </div>
    </div>


    <div class="my-4 w-full flex flex-col sm:flex-row justify-start">
        <?php if (isset($searchParamActive) && $searchParamActive) : ?>

            <form class="w-full flex flex-col sm:flex-row" onsubmit="searchParam()" method="GET">
                <select id="columnSelect_<?= $tableId ?>" name="searchParam" class="secondary-btn w-full my-2 sm:my-0 sm:w-2/12 mr-2">
                <?php $searchParamInLink = isset($_GET['searchParam']) ? $_GET['searchParam'] : 'firstname'; ?>
                    <?php if (isset($searchParam) && $searchParam != '') : ?>
                        <?php foreach ($searchParam as $key => $value) : ?>
                            <option value='<?= $key ?>' <?= $key == $searchParamInLink ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value='<?= $searchParam ?>'><?= $searchParam ?></option>
                    <?php endif; ?>

                </select>
                <input type="text" name="search" placeholder="Search" class="secondary-input">
                <div class="mx-auto my-2 sm:my-0 sm:mx-2">
                    <button type="submit" class="secondary-btn h-full size-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>

                    </button>
                </div>

            </form>
            <div class="mx-auto my-2 sm:my-0 sm:mx-2">
                <button onclick="" class="secondary-btn h-full size-12">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>

                </button>
            </div>

        <?php else : ?>

            <select id="columnSelect_<?= $tableId ?>" class="secondary-btn w-2/12 mx-2">
                <?php foreach ($tableHeaders as $key => $value) : ?>
                    <option value='<?= $value ?>'><?= $value ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" class="main-input col-span-6" onkeyup="filterTable(document.getElementById('columnSelect_<?= $tableId ?>').value, this.value)" placeholder="Search">
        <?php endif; ?>
    </div>

    <div class='w-full overflow-auto'>

        <?php if ($emptyTable) : ?>
            <!-- Empty Table -->
            <div class="flex flex-row justify-center align-middle">
                <h1 class="main-label text-2xl">No data available</h1>
            </div>

        <?php else : ?>

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
        <?php endif; ?>

    </div>


    <!-- Styles even and odd rows -->
    <style>
        <?= '#' . $tableId . ' ' ?>tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        <?php if (!$isStyleOnHoverDisabled) : ?><?= '#' . $tableId . ' ' ?>tbody tr:hover {
            background-color: #1f2937;
            color: white;
        }

        <?php endif; ?><?= '#' . $tableId . ' ' ?>th,
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


        function printTable() {
            var table = document.getElementById("<?= $tableId ?>").outerHTML;
            var newWindow = window.open('', '', '');
            newWindow.document.write('<html><head><title>Print Table</title>');
            newWindow.document.write('<style>');
            newWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
            newWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
            newWindow.document.write('th, td { padding: 5px; border: 1px solid #ddd; text-align: left; }');
            newWindow.document.write('th { background-color: #f2f2f2; font-weight: bold; }');
            newWindow.document.write('tr:nth-child(even) { background-color: #f9f9f9; }');
            newWindow.document.write('tr:hover { background-color: #f1f1f1; }');
            newWindow.document.write('.clickable-row { cursor: pointer; }');
            newWindow.document.write('</style>');
            newWindow.document.write('</head><body>');
            newWindow.document.write(table);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }

        <?php if (isset($rowsPerPageActive) && $rowsPerPageActive) : ?>

            document.addEventListener('DOMContentLoaded', function() {
                const tableId = '<?= $tableId ?>';
                const rowPerPageSelect = document.getElementById(`rowPerPage_${tableId}`);

                rowPerPageSelect.addEventListener('change', function() {
                    const rowsPerPage = this.value;
                    //Add to the URL the number of rows per page
                    updateURLParameter('rowsPerPage', rowsPerPage);
                });


            });
        <?php endif; ?>


        <?php if (isset($searchParamActive) && $searchParamActive) : ?>

            function searchParam() {
                updateURLParameter('search', this.value);
            }

        <?php endif; ?>

        function updateURLParameter(key, value) {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Update or add the parameter
            params.set(key, value);

            // Construct the new URL
            url.search = params.toString();
            window.location.href = url.toString();
        }

        function redirectToWithId(base_link) {
            var data = sessionStorage.getItem('tempTableData');
            if (data) {
                var id = JSON.parse(data).client_id;
                sessionStorage.removeItem('tempTableData');

                window.location.href = base_link + '/' + id;
            }
        }
    </script>

</div>