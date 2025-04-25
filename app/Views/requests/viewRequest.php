<div class="container-main print-container max-w-6xl overflow-auto">
    <img class="mx-auto hidden print-only w-64" src="/logo.png" alt="">
    <div class="flex flex-row md:mt-0">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Request Of <?= $request->client_name ?></h2>

        <div class="flex flex-row ml-auto space-x-4 ">
            <button onclick="window.print()" class="my-auto flex space-x-2 cursor-pointer no-print">
                <p>Print</p>
                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'printer', 'class' => 'size-6']) ?>
            </button>
            <?php if ($request->agent_id === $employee_id) : ?>
                <a href="/requests/edit/<?= $request->request_code ?>" class="my-auto flex space-x-2 cursor-pointer no-print">
                    <p>Edit</p>
                    <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'edit', 'class' => 'size-6']) ?>
                </a>
            <?php endif; ?>
        </div>

    </div>

    <h2 class="md:hidden main-title-page">Request Of <?= $request->client_name ?></h2>

    <div class="no-print">
        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    </div>

    <div class="no-print flex flex-col md:flex-row justify-around space-y-4 md:space-y-0 md:space-x-4 w-full">
        <div class="w-full md:w-2/6 grid grid-cols-2 gap-2 place-items-center">
            <strong class="justify-self-start">Request Priority:</strong>
            <select name="request_priority" id="request_priority" <?= $request->agent_id !== $employee_id ? 'disabled' : '' ?> class="secondary-input min-w-40 max-w-60">
                <?php foreach ($requestPriorities as $requestPriority): ?>
                    <option value="<?= $requestPriority ?>"
                        <?= strtolower($requestPriority) === strtolower($request->request_priority) ? 'selected' : '' ?>><?= ucfirst($requestPriority) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class=" w-full md:w-2/6 grid grid-cols-2 gap-2 place-items-center">
            <strong class="justify-self-start">Request State:</strong>
            <select name="request_state" id="request_state" <?= $request->agent_id !== $employee_id ? 'disabled' : '' ?> class="secondary-input min-w-40 max-w-60">
                <?php foreach ($requestStates as $requestState): ?>
                    <option value="<?= $requestState ?>"
                        <?= strtolower($requestState) === strtolower($request->request_state) ? 'selected' : '' ?>><?= ucfirst($requestState) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="hidden print-only w-3/4 mx-auto ">
        <div class="grid grid-cols-4 gap-4 my-4 ">
            <strong>Request Priority:</strong>
            <p class="main-label"><?= ucfirst($request->request_priority) ?></p>
            <strong>Request State:</strong>
            <p class="main-label"><?= ucfirst($request->request_state) ?></p>
        </div>
    </div>


    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">

        <table class="view-table">
            <tr>
                <th>Client Name:</th>
                <td><?= $request->client_name ?></td>
            </tr>
            <tr>
                <th>Client Email:</th>
                <td><?= $request->client_email ?></td>
            </tr>
            <tr>
                <th>Phone numbers:</th>
                <td><?= $request->phone_numbers ?></td>
            </tr>
            <tr>
                <th>Agent Name:</th>
                <td><?= ucfirst($request->agent_name) ?></td>
            </tr>
            <tr>
                <th>Payment Plan:</th>
                <td><?= $request->request_payment_plan ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td><?= $request->city_name ?></td>
            </tr>
            <tr>
                <th>Location Details</th>
                <td><?= $request->request_detailed_location ?></td>
            </tr>
            <tr>
                <th>Request Budget:</th>
                <td>
                    <span class="p-0 format-price"><?= $request->request_budget ?></span><?= " " . $request->currency_symbol ?>
                </td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?= esc((new DateTime($request->request_created_at))->format('D d M Y H:i:s T')) ?></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td><?= esc((new DateTime($request->request_updated_at))->format('D d M Y H:i:s T')) ?></td>
            </tr>
            <tr>
                <th>Request Description:</th>
                <td><?= $request->request_comments ?></td>
            </tr>

        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const requestPriority = document.getElementById('request_priority');
        const requestState = document.getElementById('request_state');
        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');

        requestPriority.addEventListener('change', async function() {
            const priority = requestPriority.value;
            const request_code = "<?= $request->request_code ?>";
            try {

                await fetch(`/api/requests/update-priority/${request_code}/${priority}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successDiv.classList.remove('hidden');
                            successDiv.innerHTML = data.message;
                        } else {
                            //Prevent changing the value of the select element
                            requestPriority.value = '<?= $request->request_priority ?>';
                            errorDiv.classList.remove('hidden');
                            errorDiv.innerHTML = data.message;
                        }
                    });

            } catch (e) {
                errorDiv.classList.remove('hidden');
                errorDiv.innerHTML = e.message;
            }

            setTimeout(() => {
                successDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
            }, 5000);

        });

        requestState.addEventListener('change', async function() {
            const state = requestState.value;
            const request_code = "<?= $request->request_code ?>";

            try {

                await fetch(`/api/requests/update-status/${request_code}/${state}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successDiv.classList.remove('hidden');
                            successDiv.innerHTML = data.message;
                        } else {
                            //Prevent changing the value of the select element
                            requestState.value = '<?= $request->request_state ?>';
                            errorDiv.classList.remove('hidden');
                            errorDiv.innerHTML = data.message;
                        }
                    });

            } catch (e) {
                errorDiv.classList.remove('hidden');
                errorDiv.innerHTML = data.message;
            }
            setTimeout(() => {
                successDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
            }, 5000);

        });

    });
</script>