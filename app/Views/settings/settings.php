<div class="container-main">
    <h1 class="main-title-page">Settings</h1>
    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br>
    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

</div>