<div class="container-main print-container max-w-6xl overflow-auto">
    <div class="flex flex-row ">
    <button onclick="window.history.back()" class="my-auto cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
    </button>
        <h2 class="main-title-page"><?= $client->client_firstname . " " . $client->client_lastname ?> </h2>

        <a href="/clients/edit/<?= $client->client_id ?>" class="my-auto cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
            </svg>
        </a>

    </div>
    <div class="my-8 bg-white p-10 shadow-md rounded-md overflow-auto text-lg w-full max-w-6xl mx-auto print-container">

        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

        <div class="flex flex-col w-full">
            <table class="view-table">
                <tr>
                    <th>Firstname:</th>
                    <td><?= $client->client_firstname ?></td>
                </tr>
                <tr>
                    <th>Lastname:</th>
                    <td><?= $client->client_lastname ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $client->client_email ?></td>
                </tr>
                <tr>
                    <th>Employee:</th>
                    <td><?= $client->employee_name ?></td>
                </tr>

                <?php foreach ($phones as $key => $phone) : ?>
                    <tr>
                        <th>Phone number (<?= $key +1 ?>):</th>
                        <td><?= $phone->country_code ?> <?= $phone->phone_number ?></td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                <th>Created At</th>
                <td><?= esc((new DateTime($client->created_at))->format('d-M-Y H:i:s T')) ?></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td><?= esc((new DateTime($client->updated_at))->format('d-M-Y H:i:s T')) ?></td>
            </tr>
            </table>
        </div>
    </div>
    <!-- TODO: ADD Listing and requests for the client -->
</div>
