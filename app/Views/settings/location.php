<div class="w-full bg-gray-100 min-h-full flex flex-col">
    <div class="container mx-auto p-4 w-full">
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




        <div class="container mx-auto p-4 w-full">
            <?= view_cell('\App\Cells\Settings\Location\LocationTable\LocationTableCell::render', ['data_location' => $data_location]) ?>
        </div>
    </div>

</div>