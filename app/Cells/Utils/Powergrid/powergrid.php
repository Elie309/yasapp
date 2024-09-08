<div class="w-full">

    <?php $emptyTable = ($tableData == null || count($tableData) == 0) ?>

    <?php $nonCheckedCols = isset($_COOKIE['nonCheckedCols_' . $tableId]) ? explode(',', $_COOKIE['nonCheckedCols_' . $tableId]) : [];

    $initialCols = $tableHeaders;
    //remove the col from the headers
    if ($nonCheckedCols != null) {
        foreach ($nonCheckedCols as $col) {
            $key = str_replace('_col', '', $col);
            unset($tableHeaders[$key]);
        }
    }
    ?>


    <div class="flex flex-col justify-center sm:flex-row sm:justify-between mb-6">
        <div class="flex flex-row align-middle mx-2 my-2 sm:my-0">
            <?php if (isset($rowsPerPageActive) && $rowsPerPageActive) : ?>
                <!-- Row per page -->
                <label for="rowPerPage_<?= $tableId ?>" class="main-label ">Rows per page:</label>
                <select id="rowPerPage_<?= $tableId ?>" <?= $emptyTable == true ? 'disabled' : '' ?> class="secondary-btn mx-2">
                    <!-- Get rowsPerPage using the link -->
                    <?php $rowsPerPage = isset($_GET['rowsPerPage']) ? $_GET['rowsPerPage'] : 10; ?>
                    <!-- Set the selected depending on the link -->
                    <option value="10" <?= isset($rowsPerPage) && $rowsPerPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= isset($rowsPerPage) && $rowsPerPage == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= isset($rowsPerPage) && $rowsPerPage == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= isset($rowsPerPage) && $rowsPerPage == 100 ? 'selected' : '' ?>>100</option>
                </select>
            <?php endif; ?>
        </div>

        <div class="flex flex-row w-full sm:mx-0 sm:w-fit justify-end ">

            <!-- EXCEL BUTTON -->
            <?php if (!isset($exportToExcelLink)) : ?>
                <button id="download-xlsx" <?= $emptyTable == true ? 'disabled' : '' ?> onclick="fnExcelReport()" 
                    class="secondary-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </button>
            <?php else : ?>

                <?php
                $currentParams = $_GET;
                $queryString = http_build_query($currentParams);
                $exportToExcelLinkWithParams = $exportToExcelLink . '?' . $queryString;
                ?>
                <a href="<?= $exportToExcelLinkWithParams  ?> " class="secondary-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
            <?php endif; ?>

            <!-- ADD REQUEST BUTTON -->
            <?php if (isset($addButtonRedirectLink)) : ?>
                <a href="<?= $addButtonRedirectLink ?>" class="secondary-btn ml-2">
                    <?= $AddButtonName ?>
                </a>
            <?php else : ?>
                <button popovertarget="<?= $addButtonModelId ?>" id="addButtonPopover" class="secondary-btn ml-2">
                    <?= $AddButtonName ?>
                </button>
            <?php endif; ?>

        </div>
    </div>


    <div class="my-4 w-full flex flex-col sm:flex-row justify-start">
        <?php if (isset($searchParamActive) && $searchParamActive) : ?>

            <div class="w-full flex flex-col sm:flex-row">

                <?php if (isset($searchParam) && count($searchParam) > 0) : ?>
                    <!-- SELECT INPUT FIELD -->
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
                <?php endif; ?>

                <!-- Search INPUT FIELD -->
                <input type="text" id="search_<?= $tableId ?>" onkeypress="onEnterButtonPress()" name="search_<?= $tableId ?>" placeholder="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="secondary-input">
                <div class="mx-auto my-2 sm:my-0 sm:mx-2">
                    <button onclick="searchAndSearchParamURLSetters()" class="secondary-btn h-full size-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>

            </div>
            <div class="mx-auto my-2 sm:my-0 sm:mx-2">
                <button popovertarget="visible-columns" onclick="" class="secondary-btn h-full text-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </button>
            </div>

        <?php else : ?>

            <select id="columnSelect_<?= $tableId ?>" class="secondary-btn w-1/2 sm:w-2/12 my-2 sm:my-0 mx-auto sm:mx-2">
                <?php foreach ($tableHeaders as $key => $value) : ?>
                    <option value='<?= $value ?>'><?= $value ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" class="main-input col-span-6" onkeyup="filterTable_<?= $tableId ?>(document.getElementById('columnSelect_<?= $tableId ?>').value, this.value)" placeholder="Search">
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
                            <th class="bg-gray-200 text-start ">
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
                            echo "<td class='truncate overflow-hidden whitespace-nowrap text-ellipsis'>" . $cellData . "</td>";
                        }

                        $data = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                        if (isset($actions) && count($actions) > 0) {
                            echo "<td>";
                            echo "<div class='flex flex-row justify-evenly'>";

                            foreach ($actions as $action) {
                                echo "<button ";
                                echo "class='actionsBtn " . ($action['class'] ?? '') . "' ";
                                echo 'popovertarget="' . $action['popovertarget'] . '" ';
                                echo "data-row-data='" . $data . "' ";
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


        <div popover id="visible-columns">
            <div class="flex flex-col p-4">

                <div class="grid grid-cols-8 gap-4 items-center">
                    <h1 class="secondary-title col-span-7">Visible Columns</h1>
                    <button class="secondary-btn h-fit" onclick="closePopover('visible-columns')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ul class="">
                    <?php foreach ($initialCols as $key => $value) : ?>
                        <li class="w-full my-2 rounded-t-lg">
                            <input
                                <?php if (!isset($nonCheckedCols) || !in_array($key . "_col", $nonCheckedCols)) : ?> checked <?php endif; ?>
                                id="<?= $key ?>_col"
                                type="checkbox"
                                value=""
                                class="cols-tag w-4 h-4 main-checkbox">
                            <label for="<?= $key ?>_col" class="w-full py-3 ms-2 text-lg font-medium"><?= $value ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="flex flex-row justify-center mt-4 mb-2 w-full">
                    <button onclick="removedColumns()" class="secondary-btn w-1/2">Apply</button>
                </div>

            </div>
        </div>

    </div>
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

<?php if (!isset($exportToExcelLink)) : ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

<?php endif; ?>
<script>
    function removedColumns() {

        const colsTag = document.querySelectorAll('.cols-tag');

        let nonCheckedCols = [];


        colsTag.forEach(col => {
            if (!col.checked) {
                nonCheckedCols.push(col.id);
            }
        });

        //save non checked cols in the cookies with the table id
        console.log(nonCheckedCols);
        document.cookie = "nonCheckedCols_<?= $tableId ?>=" + nonCheckedCols.join(',');
        location.reload();
    }

    function filterTable_<?= $tableId ?>(columnKey, searchValue) {
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

    <?php if (!isset($exportToExcelLink)) : ?>

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

    <?php endif; ?>


    function actionStoreDataOnClickEvent(data) {
        sessionStorage.setItem('tempTableData', JSON.stringify(data));
        setTimeout(() => {
            sessionStorage.removeItem('tempTableData');
        }, 5000);
    }

    <?php if (!isset($addButtonRedirectLink)) : ?>

        document.getElementById('addButtonPopover').addEventListener('click', function() {
            <?= isset($addButtonModelAdditionalFn) ? $addButtonModelAdditionalFn : '' ?>
        });

    <?php endif; ?>

    <?php if (isset($isOnClickRowActive) && $isOnClickRowActive) : ?>

        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function() {
                var rowData = JSON.parse(this.getAttribute('data-row-data'));

                sessionStorage.setItem('tempTableData', JSON.stringify(rowData));

                <?php
                if (isset($modelIdOnClickRow) && $modelIdOnClickRow != '') {
                    echo 'showPopover("' . $modelIdOnClickRow . '");';
                }

                ?>

                <?= isset($JSFunctionToRunOnClickRow) ? $JSFunctionToRunOnClickRow : '' ?>

                setTimeout(() => {
                    sessionStorage.removeItem('tempTableData');
                }, 5000);

            });
        });

    <?php endif; ?>


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

        function onEnterButtonPress() {
            if (event.key === 'Enter') {
                searchAndSearchParamURLSetters();
            }
        }

        function searchAndSearchParamURLSetters() {
            <?php if (isset($searchParam) && count($searchParam) > 0) : ?>
                let col = document.getElementById('columnSelect_<?= $tableId ?>');
                let search = document.getElementById('search_<?= $tableId ?>');

                updateURLParameter(['search', 'searchParam'], [search.value, col.options[col.selectedIndex].value]);
            <?php else : ?>
                let search = document.getElementById('search_<?= $tableId ?>');
                updateURLParameter('search', search.value);
            <?php endif; ?>

        }

    <?php endif; ?>

    <?php if (isset($actions) && count($actions) > 0) : ?>

        document.querySelectorAll('.actionsBtn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                var data = JSON.parse(event.currentTarget.getAttribute('data-row-data')); // Use event.currentTarget instead of event.target
                actionStoreDataOnClickEvent(data);

                <?php echo "var actionsDetails =" . json_encode($actions); ?>;

                actionsDetails.forEach(function(action) {
                    if (action.popovertarget == event.currentTarget.getAttribute('popovertarget')) {
                        if (action.functions) {
                            eval(action.functions);
                        }
                    }
                });

            });
        });

    <?php endif; ?>


    function redirectToWithId(base_link, id) {
        var data = sessionStorage.getItem('tempTableData');
        if (data) {
            var id = JSON.parse(data)[id];
            sessionStorage.removeItem('tempTableData');

            window.location.href = base_link + '/' + id;
        }
    }

    function getCurrentURLParam() {
        return new URLSearchParams(window.location.search);
    }
</script>