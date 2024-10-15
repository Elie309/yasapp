<div class="p-4 overflow-auto">

    <h3 class="secondary-title text-center">Search <?= $title ?></h3>
    <input type="text" placeholder="Search for <?= $title ?>" autocomplete="off"
        class="main-input" id="search_<?= $title ?>" name="search" required
        onkeyup="search_<?= $title ?>('<?= $url ?>', 'search_<?= $title ?>', 'search-results_<?= $title ?>')" />

    <div class="flex flex-col w-full my-4 overflow-auto ">
        <table class="table-auto w-full">
            <thead class="table-header-group">
                <tr class="border border-gray-300">
                    <?php foreach ($tableHeaders as $key => $header) : ?>
                        <th class="bg-gray-200 text-start p-2"><?= $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody id="search-results_<?= $title ?>">
            </tbody>
        </table>
    </div>

</div>

<script>
    function search_<?= $title ?>(url, search, searchResults) {
        var search = document.getElementById(search).value;
        var searchResults = document.getElementById(searchResults);

        //Loading sign
        searchResults.innerHTML = `
            <tr>
                <td colspan="<?= count($tableHeaders) ?>" class="">
                    <div class="loader mx-auto my-2"></div>
                </td>
            </tr>
        `;

        if (search.length > 2) {
            // Transform the search into a query string without spaces
            search = search.replace(/\s/g, '+');
            fetch(url + search)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';

                    data.forEach(element => {
                        var tr = document.createElement('tr');
                        tr.classList.add('border', 'border-gray-300',
                            'hover:bg-gray-700', 'hover:text-white', 'cursor-pointer',
                            'transition', 'duration-150', 'linear',
                            'focus:bg-gray-700', 'focus:text-white', 'focus:outline-none'
                        );
                        tr.dataset.data = JSON.stringify(element);
                        tr.innerHTML = `
                            <?php foreach ($tableHeaders as $key => $header) : ?>
                              <td class="p-2 truncate overflow-hidden whitespace-nowrap text-ellipsis">${element['<?= $key ?>'] === null ? '' : element['<?= $key ?>']}</td>
                            <?php endforeach; ?>
                        `;
                        searchResults.appendChild(tr);
                        tr.addEventListener('click', function() {
                            var selectedRow = document.querySelector("<?= $selectedClassName ?>");
                            if (selectedRow) {
                                selectedRow.classList.remove("<?= $selectedClassName ?>");
                            }

                            this.classList.add("<?= $selectedClassName ?>");

                            <?php if (isset($onSelect)) : ?>
                                <?= $onSelect ?>
                            <?php endif; ?>
                        });
                    });

                    if (data.length == 0) {
                        searchResults.innerHTML = `
                            <tr>
                                <td colspan="<?= count($tableHeaders) + 1 ?>" class="text-center">
                                    <p class="font-italic font-semibold text-sm my-2">
                                    No search results found.
                                    </p>
                                </td>
                            </tr>
                        `;
                    }
                }).catch(error => {
                    searchResults.innerHTML = `
                        <tr>
                            <td colspan="<?= count($tableHeaders) + 1 ?>" class="text-center">
                                <p class="font-italic font-semibold text-red-800 text-sm my-2">
                                An error occurred while fetching search results.
                                </p>
                            </td>
                        </tr>
                    `;
                });
        } else {
            //no search results
            searchResults.innerHTML = `
                <tr>
                    <td colspan="<?= count($tableHeaders) + 1 ?>" class="text-center">
                       <p class="font-italic font-semibold text-sm my-2">
                       Please type at least 3 characters to see search results.
                       </p>
                    </td>
                </tr>
                `;
        }
    }
</script>