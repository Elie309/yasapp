<div class="container-main">
    <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Location Overview</h2>


    <?php if (session()->has('errors')) : ?>
        <div class="error-div" role="alert">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')) : ?>
        <div class="success-div" role="alert">
            <p><?= esc(session('success')) ?></p>
        </div>
    <?php endif; ?>


    <div class="mt-8 bg-white p-10 shadow-md rounded-md w-full overflow-auto">
        <?= view_cell('\App\Cells\Settings\Location\LocationTable\LocationTableCell::render', ['data_location' => $data_location]) ?>
    </div>
</div>