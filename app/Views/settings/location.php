<div class="w-full bg-gray-100 min-h-full flex flex-col">
    <div class="container mx-auto p-4 w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

        <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

        <br />

        <h2 class="w-full my-8 text-3xl font-bold text-center">Location Overview</h2>


        <?php if (session()->has('errors')) : ?>
            <div class="text-sm my-4 bg-red-100 border border-red-800 text-red-800 text-center px-4 py-3 rounded relative" role="alert">
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')) : ?>
            <div class=" text-sm my-2 bg-green-100 border border-green-800 text-green-800 text-center px-4 py-3 rounded relative" role="alert">
                <p><?= esc(session('success')) ?></p>
            </div>
        <?php endif; ?>




        <div class="container mx-auto p-4 w-full">
            <?= view_cell('\App\Cells\Settings\Location\LocationTable\LocationTableCell::render', ['data_location' => $data_location]) ?>
        </div>
    </div>

</div>