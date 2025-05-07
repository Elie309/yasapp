<div>
    <div class="space-y-2 mb-4">
        <div>
            <label for="country_id" class="main-label">Country</label>
            <select class="secondary-input" id="country_id" onchange="fetchRegions(this.value)">
                <option value="">Select Country</option>
                <?php foreach ($countries as $country): ?>
                    <option value="<?= $country->country_id ?>" <?= $country->country_id == $defaultCountryId ? 'selected' : '' ?>><?= $country->country_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="region_id" class="main-label">Region</label>
            <select class="secondary-input" id="region_id" <?= isset($defaultData['regions']) && count($defaultData['regions']) > 0 ? '' : 'disabled' ?> onchange="fetchSubregions(this.value)">
                <option value="">Select Region</option>
                <?php if (isset($defaultData['regions'])): ?>
                    <?php foreach ($defaultData['regions'] as $region): ?>
                        <option value="<?= $region->id ?>" <?= $region->id == $defaultRegionId ? 'selected' : '' ?>><?= $region->name ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <label for="subregion_id" class="main-label">Subregion</label>
            <select class="secondary-input" id="subregion_id" <?= isset($defaultData['subregions']) && count($defaultData['subregions']) > 0 ? '' : 'disabled' ?> onchange="fetchCities(this.value)">
                <option value="">Select Subregion</option>
                <?php if (isset($defaultData['subregions'])): ?>
                    <?php foreach ($defaultData['subregions'] as $subregion): ?>
                        <option value="<?= $subregion->id ?>" <?= $subregion->id == $defaultSubregionId ? 'selected' : '' ?>><?= $subregion->name ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <label for="city_id" class="main-label">City</label>
            <select class="secondary-input" id="city_id" name="city_id" <?= isset($defaultData['cities']) && count($defaultData['cities']) > 0 ? '' : 'disabled' ?>>
                <option value="">Select City</option>
                <?php if (isset($defaultData['cities'])): ?>
                    <?php foreach ($defaultData['cities'] as $city): ?>
                        <option value="<?= $city->id ?>" <?= $city->id == $defaultCityId ? 'selected' : '' ?>><?= $city->name ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
</div>

<script>
    <?php if (!isset($defaultData['regions'])) : ?>

        function selectLebanon() {

            const countries = <?= json_encode($countries) ?>;

            const countrySelect = document.getElementById('country_id');
            for (let i = 0; i < countrySelect.options.length; i++) {
                if (countrySelect.options[i].text === 'Lebanon') {
                    countrySelect.selectedIndex = i;
                    fetchRegions(countrySelect.value);
                    break;
                }
            }
        }
        selectLebanon();
    <?php endif; ?>

    function fetchRegions(countryId) {
        if (!countryId) return;
        fetch(`<?= $searchRegionLink ?>?country_id=${countryId}`)
            .then(response => response.json())
            .then(data => {

                if (data.success === false) {
                    alert(data.errors);
                    return;
                }

                data = data.data;

                const regionSelect = document.getElementById('region_id');
                regionSelect.innerHTML = '<option value="">Select Region</option>';
                data.forEach(region => {
                    regionSelect.innerHTML += `<option value="${region.id}">${region.name}</option>`;
                });
                regionSelect.disabled = false;

                var subregionSelect = document.getElementById('subregion_id');
                var citySelect = document.getElementById('city_id');
                subregionSelect.innerHTML = '<option value="">Select Subregion</option>';
                citySelect.innerHTML = '<option value="">Select City</option>';
                subregionSelect.disabled = true;
                citySelect.disabled = true;
                subregionSelect.value = '';
                citySelect.value = '';


            });
    }

    function fetchSubregions(regionId) {
        if (!regionId) return;
        fetch(`<?= $searchSubregionLink ?>?region_id=${regionId}`)
            .then(response => response.json())
            .then(data => {

                if (data.success === false) {
                    alert(data.errors);
                    return;
                }

                data = data.data;

                const subregionSelect = document.getElementById('subregion_id');
                subregionSelect.innerHTML = '<option value="">Select Subregion</option>';
                data.forEach(subregion => {
                    subregionSelect.innerHTML += `<option value="${subregion.id}">${subregion.name}</option>`;
                });
                subregionSelect.disabled = false;
                //Reset City
                var citySelect = document.getElementById('city_id');
                citySelect.innerHTML = '<option value="">Select City</option>';
                //Disable
                citySelect.disabled = true;
                //value
                citySelect.value = '';
               

            });
    }

    function fetchCities(subregionId) {
        if (!subregionId) return;
        fetch(`<?= $searchCityLink ?>?subregion_id=${subregionId}`)
            .then(response => response.json())
            .then(data => {

                if (data.success === false) {
                    alert(data.errors);
                    return;
                }

                data = data.data;

                const citySelect = document.getElementById('city_id');
                citySelect.innerHTML = '<option value="">Select City</option>';
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
                citySelect.disabled = false;

            });
    }
</script>