<div class="my-2">
    <h2 class="secondary-title">Land Details</h2>

    <div class="my-4">
        <label class="main-label" for="land_type">Land Type:</label>
        <select id="land_type" name="land_type" class="main-input">
            <?php foreach ($landTypes as $landType) : ?>
                <option value="<?= $landType ?>"><?= ucfirst($landType) ?></option>
            <?php endforeach; ?>
        </select><br>

    </div>
    <div class="my-4">
        <label class="main-label" for="land_zone_first">Zone First (%):</label>
        <input type="text" id="land_zone_first" name="land_zone_first" class="main-input">
    </div>

    <div class="my-4">
        <label class="main-label" for="land_zone_second">Zone Second (%):</label>
        <input type="text" id="land_zone_second" name="land_zone_second" class="main-input">
    </div>
    <div class="my-4">

        <label class="main-label" for="land_extra_features">Extra Features:</label>
        <textarea id="land_extra_features" name="land_extra_features" class="main-input"></textarea>
    </div>
</div>