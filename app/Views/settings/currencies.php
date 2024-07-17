<div class="w-full bg-gray-100 min-h-full flex flex-col">
    <div class="container mx-auto p-4 w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

        <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

        <br />

        <h2 class="main-title-page">Currencies Overview</h2>


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

        <!-- TABLE SHOW CURRENT PRODUCT -->

        <div class="mt-8 bg-white p-10 shadow-md rounded-md">

            <table class="w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 border-b ">
                            Currency Name
                        </th>
                        <th class="px-4 py-2 bg-gray-200 border-b ">
                            Currency Code
                        </th>
                        <th class="px-4 py-2 bg-gray-200 border-b">
                            Currency Symbol
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $data = []; ?>
                    <?php foreach ($currencies as $currency) : ?>
                        <!-- Create a new array which has id and name as keys -->
                        <?php $data[] = [
                            'id' => $currency->currency_id, 'name' => $currency->currency_name,
                            'code' => $currency->currency_code,'symbol' => $currency->currency_symbol,
                        ];
                        ?>
                        <tr>
                            <td class="px-4 py-2 text-center border-b"><?= esc($currency->currency_name) ?></td>
                            <td class="px-4 py-2 text-center border-b"><?= esc($currency->currency_code) ?></td>
                            <td class="px-4 py-2 text-center border-b"><?= esc($currency->currency_symbol) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="flex justify-end my-3 ">
                <button onclick="openModal('EditCurrencies')" class="main-btn">
                    <h3>Edit Currencies</h3>
                </button>
            </div>
        </div>
    </div>
</div>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditCurrencies',
    'modalTitle' => 'Edit Currencies',
    'modalBody' => view_cell('App\Cells\Settings\Currencies\CurrenciesCell::render', [
        'selectedOptions' => $data,
    ])
]) ?>