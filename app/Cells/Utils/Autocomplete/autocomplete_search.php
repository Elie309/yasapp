<div class="container w-full my-2">
    <div class="container relative">
        <input type="text" id="search_<?= $selectedId ?>" name="dump_info" class="select-all main-input" placeholder="<?= $placeholder ?>" autocomplete="off" required>
        
        <!-- THIS INPUT WILL BE TAKEN TO THE FORM SUBMIT -->
        <input type="hidden" id="result_id_<?= $selectedId ?>" name="<?= $selectedId ?>" value="0" />
        <div id="result_<?= $selectedId ?>" class=" max-h-80 overflow-y-auto absolute z-50 mt-2 bg-white shadow-md w-full rounded-lg">

        </div>
    </div>

    <script>
        <?php echo 'var items_' . $selectedId . ' = ' .   json_encode($data); ?>;
        var selectedName_<?= $selectedId  ?> = '<?= $selectedId ?>';

        function setSearchResult_<?= $selectedId  ?>(item, id) {
            const search = document.getElementById('search_' + selectedName_<?= $selectedId  ?>);
            const result_id = document.getElementById('result_id_' + selectedName_<?= $selectedId  ?>);

            search.value = item;
            result_id.value = id;
            const result = document.getElementById('result_' + selectedName_<?= $selectedId  ?>);
            result.innerHTML = ''
        }

        document.addEventListener('DOMContentLoaded', function() {
            const search = document.getElementById('search_' + selectedName_<?= $selectedId  ?>);
            const result = document.getElementById('result_' + selectedName_<?= $selectedId  ?>);

            search.addEventListener('input', function() {

                const query = search.value.toLowerCase();

                if (query !== '') {
                    let filteredArray = <?= 'items_' . $selectedId  ?>.filter(item => item['name'].toLowerCase().includes(query));

                    let output = '<ul class="py-4 px-2">';
                    filteredArray.forEach(item => {
                        output +=
                            `<li><button class="p-2 text-center cursor-pointer text-lg rounded-lg 
                                focus:bg-red-800 focus:text-white outline-none  
                                hover:text-white hover:bg-red-800 
                                w-full"

                                onclick="setSearchResult_<?= $selectedId  ?>('${item['name']}', '${item['id']}')">
                                ${item['name']}
                            </button></li>`;
                    });

                    if (filteredArray.length === 0) {
                        output += '<li class="p-2 list-none text-center text-lg rounded-lg">Nothing found</li>';
                    }

                    output += '</ul>';
                    result.innerHTML = output;

                } else {
                    result.innerHTML = '';
                }
            });
        });
    </script>
</div>