<div class="container-main">
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

        <?php $tableHeaders = [ // Corrected variable name
            'payment_plan_id' => 'ID',
            'payment_plan_name' => 'Payment Plan',
        ];

        $actions = [
            [
                'name' => 'Edit',
                'functions' => "openModal('EditPaymentPlans'); setFormDetails('edit');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>',
                'class' => 'hover:stroke-blue-500 hover:text-blue-500'
            ],
            [
                'name' => 'Delete',
                'functions' => "openModal('DeletePaymentPlans'); setFormDetails('delete');",
                'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                            </svg>',
                'class' => 'hover:stroke-red-500 hover:text-red-500'
            ],
        ];
        ?>

        <?= view_cell(
            '\App\Cells\Utils\Powergrid\PowergridCell::render',
            [
                'tableId' => 'payment_plan_table',
                'tableHeaders' => $tableHeaders,
                'tableData' => $paymentPlans,
                'addButtonModelId' => 'AddPaymentPlans',
                'AddButtonName' => 'Add Payment Plan',
                'modelIdOnClickRow' => '',
                'JSFunctionToRunOnClickRow' => '', //This function is present in the form cell of currencies
                'classOnClickRow' => '',
                'actions' => $actions,

            ]
        ) ?>

    </div>
</div>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'EditPaymentPlans',
    'modalTitle' => 'Edit Payment Plan',
    'modalBody' => view_cell('App\Cells\Settings\PaymentPlan\PaymentPlanCell::render', ['formGetter' => 'edit']),
]) ?>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'AddPaymentPlans',
    'modalTitle' => 'Add Payment Plan',
    'modalBody' => view_cell('App\Cells\Settings\PaymentPlan\PaymentPlanCell::render', ['formGetter' => 'add']),
]) ?>

<?= view_cell('App\Cells\Utils\Modal\ModalCell::render', [
    'modalId' => 'DeletePaymentPlans',
    'modalTitle' => 'Delete Payment Plan',
    'modalBody' => view_cell('App\Cells\Settings\PaymentPlan\PaymentPlanCell::render', ['formGetter' => 'delete']),
]) ?>