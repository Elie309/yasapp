<div>
    <label for="client_firstname" class="main-label">First Name<span class="text-red-800">*</span></label>
    <input type="text" class="main-input" id="client_firstname" name="client_firstname" required>
</div>
<div class="mt-4">
    <label for="client_lastname" class="main-label">Last Name<span class="text-red-800">*</span></label>
    <input type="text" class="main-input" id="client_lastname" name="client_lastname" required>
</div>
<div class="mt-4">
    <label for="client_email" class="main-label">Email</label>
    <input type="text" class="main-input" id="client_email" name="client_email">
</div>

<!-- Line -->
<hr class="mt-8 mb-3 mx-2">

<!-- Phone section -->

<div class="mt-4">
    <div class="my-2 flex flex-row justify-start align-baseline">

        <label class="text-lg mr-4">Phone Numbers</label>

        <button type="button" onclick="onClickAddPhone()">
            <svg class=" text-gray-800 size-6 hover:text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>


    </div>

    <div id="phone-section">
        <?= view_cell(
            'App\Cells\Clients\Phone\PhoneFormCell::render',
            ['countries' => $countries]
        ) ?>
    </div>
</div>

<script>
    function onClickAddPhone() {
        var phoneSection = document.getElementById('phone-section');
        var phone = document.createElement('div');
        var html = ` <?= view_cell(
                            'App\Cells\Clients\Phone\PhoneFormCell::render',
                            ['countries' => $countries]
                        ) ?> `;

        phone.innerHTML = html;

        phoneSection.appendChild(phone);
    }

    function removeParent(event) {
        event.parentElement.remove();
    }
</script>