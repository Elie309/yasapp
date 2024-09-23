<div class="container w-full my-2">
    <div class="container relative">
        <input type="text" id="search_<?= $selectedName ?>" name="dump_info" class="select-all main-input" placeholder="<?= $placeholder ?>" autocomplete="off" required>

        <!-- THIS INPUT WILL BE TAKEN TO THE FORM SUBMIT -->
        <input type="hidden" id="result_id_<?= $selectedName ?>" name="<?= $selectedId ?>" value="0" />
        <div id="result_<?= $selectedName ?>" class=" max-h-80 overflow-y-auto absolute z-50 mt-2 bg-white shadow-md w-full rounded-lg">

        </div>
    </div>

    <script>
        <?php echo 'var items_' . $selectedName . ' = ' .   json_encode($data); ?>;

        function setSearchResult_<?= $selectedName  ?>(item, id) {
            const search = document.getElementById('search_<?= $selectedName  ?>');
            const result_id = document.getElementById('result_id_<?= $selectedName  ?>');

            search.value = item;
            result_id.value = id;
            const result = document.getElementById('result_<?= $selectedName  ?>');
            result.innerHTML = ''
        }


        document.addEventListener('DOMContentLoaded', function() {
            const search = document.getElementById('search_<?= $selectedName  ?>');
            const result = document.getElementById('result_<?= $selectedName  ?>');

            <?php if (isset($searchLink)): ?>

                search.addEventListener('input', function() {

                    const query = search.value.toLowerCase();
                    if (query !== '' && query.length > 2) {


                        result.innerHTML = '<div class="w-full flex flex-row justify-center"><div class="loader"></div></div>';

                        fetch('<?= $searchLink ?>?search=' + query)
                            .then(response => response.json())
                            .then(data => {
                                let output = '<ul class="py-4 px-2">';
                                data.forEach(item => {
                                    output +=
                                        `<li><button class="p-2 text-center cursor-pointer text-lg rounded-lg 
                                            focus:bg-red-800 focus:text-white outline-none  
                                            hover:text-white hover:bg-red-800 
                                            w-full"

                                            onclick="setSearchResult_<?= $selectedName  ?>('${item['name']}', '${item['id']}')">
                                            ${item['name']}
                                        </button></li>`;
                                });

                                if (data.length === 0) {
                                    output += '<li class="p-2 list-none text-center text-lg rounded-lg">Nothing found</li>';
                                }

                                output += '</ul>';
                                result.innerHTML = output;
                            });

                    } else {
                        result.innerHTML = '';
                    }

                });
            <?php else: ?>

                search.addEventListener('focus', function() {

                    const query = search.value.toLowerCase();

                    let filteredArray = <?= 'items_' . $selectedName  ?>.filter(item => item['name'].toLowerCase().includes(query));

                    let output = '<ul class="py-4 px-2">';
                    filteredArray.forEach(item => {
                        output +=
                            `<li><button class="p-2 text-center cursor-pointer text-lg rounded-lg 
                            focus:bg-red-800 focus:text-white outline-none  
                            hover:text-white hover:bg-red-800 
                            w-full"

                            onclick="setSearchResult_<?= $selectedName  ?>('${item['name']}', '${item['id']}')">
                            ${item['name']}
                        </button></li>`;
                    });

                    if (filteredArray.length === 0) {
                        output += '<li class="p-2 list-none text-center text-lg rounded-lg">Nothing found</li>';
                    }

                    output += '</ul>';
                    result.innerHTML = output;
                });

                search.addEventListener('input', function() {

                    const query = search.value.toLowerCase();

                    let filteredArray = <?= 'items_' . $selectedName  ?>.filter(item => item['name'].toLowerCase().includes(query));

                    let output = '<ul class="py-4 px-2">';
                    filteredArray.forEach(item => {
                        output +=
                            `<li><button class="p-2 text-center cursor-pointer text-lg rounded-lg 
                            focus:bg-red-800 focus:text-white outline-none  
                            hover:text-white hover:bg-red-800 
                            w-full"

                            onclick="setSearchResult_<?= $selectedName  ?>('${item['name']}', '${item['id']}')">
                            ${item['name']}
                        </button></li>`;
                    });

                    if (filteredArray.length === 0) {
                        output += '<li class="p-2 list-none text-center text-lg rounded-lg">Nothing found</li>';
                    }

                    output += '</ul>';
                    result.innerHTML = output;
                });

               

            <?php endif; ?>


            search.addEventListener('blur', function() {
                    setTimeout(() => {
                        result.innerHTML = '';
                    }, 200);
                });

        });
    </script>
</div>