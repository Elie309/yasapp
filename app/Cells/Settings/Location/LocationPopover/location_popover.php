<div popover id="location-popover" class="popover">
    <?= view_cell('\App\Cells\Utils\Search\SearchCell::render', [
        'title' => 'Location',
        'tableHeaders' => [
            'country_name' => 'Country',
            'region_name' => 'Region',
            'subregion_name' => 'Subregion',
            'city_name' => 'City'
        ],
        'selectedClassName' => 'selected-row-location',
        'onSelect' => 'onSelectLocation()',
        'url' => '/api/locations/search?search='
    ]) ?>

</div>

<script>
    function onSelectLocation() {
        //Close the popover
        closePopover('location-popover');

        const selectedRow = document.querySelector('.selected-row-location');

        if (selectedRow) {
            const data = JSON.parse(selectedRow.dataset.data);
            document.getElementById('city_id').value = data.city_id;
            document.getElementById('country_name').value = data.country_name;
            document.getElementById('region_name').value = data.region_name;
            document.getElementById('subregion_name').value = data.subregion_name;
            document.getElementById('city_name').value = data.city_name;
        }
    }
</script>