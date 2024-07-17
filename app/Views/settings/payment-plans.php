<div class="w-full bg-gray-100 min-h-full flex flex-col">
    <div class="container mx-auto p-4 w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>

        <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

        <br />

        <h2 class="main-title-page">Payment plans Overview</h2>


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
                        <th class="px-4 py-2 bg-gray-200 border-b flex justify-center">
                                Payment Plan Name
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $data = []; ?>
                    <?php foreach ($paymentPlans as $plan) : ?>
                        <!-- Create a new array which has id and name as keys -->
                        <?php $data[] = ['id' => $plan->payment_plan_id, 'name' => $plan->payment_plan_name]; ?>
                        <tr>
                            <td class="px-4 py-2 text-center border-b"><?= esc($plan->payment_plan_name) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="flex justify-end my-3 ">
                <button onclick="openModal('EditPaymentPlans')" class="main-btn">
                    <h3>Edit Payment Plans</h3>
                </button>
            </div>
        </div>
    </div>
</div>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditPaymentPlans',
    'modalTitle' => 'Edit Payment Plan',
    'modalBody' => view_cell('App\Cells\Settings\PaymentPlan\PaymentPlanCell::render', [
        'selectedOptions' => $data,
    ])
]) ?>