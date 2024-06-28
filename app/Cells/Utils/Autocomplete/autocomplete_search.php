<div class="container w-full">
    <h2 class="text-center">Autocomplete</h2>
    <div class="container relative">
        <input type="text" id="search" name="dump_info" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" placeholder="Search" autocomplete="off">
        <input type="hidden" id="result_id" name="<?= $selectedName ?>" value="0" />
        <div id="result" class="absolute z-50 mt-2 bg-white shadow-md w-full rounded-lg"></div>

    </div>



    <script>
        // PHP JSON data embedded directly into JavaScript
        var items = <?php echo json_encode($data); ?>;

        function setSearchResult(item, id) {
            const search = document.getElementById('search');
            const result_id = document.getElementById('result_id');

            search.value = item;
            result_id.value = id;
            const result = document.getElementById('result');
            result.innerHTML = ''
        }

        document.addEventListener('DOMContentLoaded', function() {
            const search = document.getElementById('search');
            const result = document.getElementById('result');

            search.addEventListener('input', function() {
                const query = search.value.toLowerCase(); // Convert to lowercase for case-insensitive search

                if (query !== '') {
                    let filteredArray = items.filter(item => item['name'].toLowerCase().includes(query));

                    let output = '<ul class="py-4 px-2">';
                    filteredArray.forEach(item => {
                        output +=
                            `<li><button class="p-2 text-center cursor-pointer text-lg rounded-lg 
                                focus:bg-red-800 focus:text-white outline-none  
                                hover:text-white hover:bg-red-800 
                                w-full"

                                onclick="setSearchResult('${item['name']}', '${item['id']}')">
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