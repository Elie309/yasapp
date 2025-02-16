<div class="container-main print-container max-w-6xl overflow-auto">
    <img class="mx-auto hidden print-only w-64" src="/logo.png" alt="">
    <div class="flex flex-row md:mt-0">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <p>Return</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Request Of <?= $request->client_name ?></h2>

        <div class="flex flex-row ml-auto space-x-4 ">
            <button onclick="window.print()" class="my-auto flex space-x-2 cursor-pointer no-print">
                <p>Print</p>
                <svg class="size-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 16.75H16C15.8011 16.75 15.6103 16.671 15.4697 16.5303C15.329 16.3897 15.25 16.1989 15.25 16C15.25 15.8011 15.329 15.6103 15.4697 15.4697C15.6103 15.329 15.8011 15.25 16 15.25H18C18.3315 15.25 18.6495 15.1183 18.8839 14.8839C19.1183 14.6495 19.25 14.3315 19.25 14V10C19.25 9.66848 19.1183 9.35054 18.8839 9.11612C18.6495 8.8817 18.3315 8.75 18 8.75H6C5.66848 8.75 5.35054 8.8817 5.11612 9.11612C4.8817 9.35054 4.75 9.66848 4.75 10V14C4.75 14.3315 4.8817 14.6495 5.11612 14.8839C5.35054 15.1183 5.66848 15.25 6 15.25H8C8.19891 15.25 8.38968 15.329 8.53033 15.4697C8.67098 15.6103 8.75 15.8011 8.75 16C8.75 16.1989 8.67098 16.3897 8.53033 16.5303C8.38968 16.671 8.19891 16.75 8 16.75H6C5.27065 16.75 4.57118 16.4603 4.05546 15.9445C3.53973 15.4288 3.25 14.7293 3.25 14V10C3.25 9.27065 3.53973 8.57118 4.05546 8.05546C4.57118 7.53973 5.27065 7.25 6 7.25H18C18.7293 7.25 19.4288 7.53973 19.9445 8.05546C20.4603 8.57118 20.75 9.27065 20.75 10V14C20.75 14.7293 20.4603 15.4288 19.9445 15.9445C19.4288 16.4603 18.7293 16.75 18 16.75Z" fill="#000000" />
                    <path d="M16 8.75C15.8019 8.74741 15.6126 8.66756 15.4725 8.52747C15.3324 8.38737 15.2526 8.19811 15.25 8V4.75H8.75V8C8.75 8.19891 8.67098 8.38968 8.53033 8.53033C8.38968 8.67098 8.19891 8.75 8 8.75C7.80109 8.75 7.61032 8.67098 7.46967 8.53033C7.32902 8.38968 7.25 8.19891 7.25 8V4.5C7.25 4.16848 7.3817 3.85054 7.61612 3.61612C7.85054 3.3817 8.16848 3.25 8.5 3.25H15.5C15.8315 3.25 16.1495 3.3817 16.3839 3.61612C16.6183 3.85054 16.75 4.16848 16.75 4.5V8C16.7474 8.19811 16.6676 8.38737 16.5275 8.52747C16.3874 8.66756 16.1981 8.74741 16 8.75Z" fill="#000000" />
                    <path d="M15.5 20.75H8.5C8.16848 20.75 7.85054 20.6183 7.61612 20.3839C7.3817 20.1495 7.25 19.8315 7.25 19.5V12.5C7.25 12.1685 7.3817 11.8505 7.61612 11.6161C7.85054 11.3817 8.16848 11.25 8.5 11.25H15.5C15.8315 11.25 16.1495 11.3817 16.3839 11.6161C16.6183 11.8505 16.75 12.1685 16.75 12.5V19.5C16.75 19.8315 16.6183 20.1495 16.3839 20.3839C16.1495 20.6183 15.8315 20.75 15.5 20.75ZM8.75 19.25H15.25V12.75H8.75V19.25Z" fill="#000000" />
                </svg>
            </button>
            <?php if ($request->agent_id === $employee_id) : ?>
                <a href="/requests/edit/<?= $request->request_id ?>" class="my-auto flex space-x-2 cursor-pointer no-print">
                    <p>Edit</p>
                    <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
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


    <div class="my-8 bg-white p-10 shadow-md rounded-md overflow-auto text-lg w-full max-w-6xl mx-auto print-container">


        <table id="request_personal_table">
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
                <td><?= $request->request_location ?></td>
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
                <td><?= $request->comments ?></td>
            </tr>

        </table>
    </div>
</div>

<style>
    #request_personal_table {
        width: 100%;
        border-collapse: collapse;
    }

    #request_personal_table td {
        border: 1px solid lightgray;
        padding: 8px;
        text-align: left;
    }

    #request_personal_table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    #request_personal_table tr:hover {
        background-color: #f1f1f1;
    }

    #request_personal_table th {
        border: 1px solid lightgray;
        padding: 8px;
        text-align: left;
        width: 250px;
        font-weight: bold;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const requestPriority = document.getElementById('request_priority');
        const requestState = document.getElementById('request_state');
        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');

        requestPriority.addEventListener('change', async function() {
            const priority = requestPriority.value;
            const request_id = <?= $request->request_id ?>;
            try {

                await fetch(`/api/requests/update-priority/${request_id}/${priority}`)
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
            const request_id = <?= $request->request_id ?>;

            try {

                await fetch(`/api/requests/update-status/${request_id}/${state}`)
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