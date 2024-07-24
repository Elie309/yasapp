<div class="container-main">
    <h2 class="main-title-page">Edit Profile</h2>

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


    <form action="#" method="POST" class="mt-3 mb-8 bg-white p-10 shadow-md rounded-md">
        <h2 class="block text-gray-700 text-xl font-bold mb-2">Edit Employee Profile</h2>

        <input type="hidden"  id="employee_id" name="employee_id" value="<?php echo esc($employee->employee_id); ?>" class="main-input" readonly>

        <div class="mb-4">
            <label for="employee_name" class="main-label">Name:</label>
            <input type="text" id="employee_name" name="employee_name" value="<?php echo esc($employee->employee_name); ?>" class="main-input">
        </div>

        <div class="mb-4">
            <label for="employee_email" class="main-label">Email:</label>
            <input type="email" id="employee_email" name="employee_email" value="<?php echo esc($employee->employee_email); ?>" class="main-input">
        </div>

        <div class="mb-4">
            <label for="employee_password" class="main-label">Password</label>
            <!-- Note this will change the passsword -->
            <p class="text-red-500 text-sm font-semibold italic">To set a new password only </p>
            <input type="password" id="employee_password" class="main-input" name="employee_password" autocomplete="off">
        </div>

        <div class="mb-4">
            <label for="employee_phone" class="main-label">Phone:</label>
            <input type="text" id="employee_phone" name="employee_phone" value="<?php echo esc($employee->employee_phone); ?>" class="main-input">
        </div>

        <div class="mb-4">
            <label for="employee_birthday" class="main-label">Birthday:</label>
            <input type="date" id="employee_birthday" name="employee_birthday" value="" class="main-input">
        </div>

        <div class="mb-4">
            <label for="employee_address" class="main-label">Address:</label>
            <textarea id="employee_address" name="employee_address" class="main-input"><?php echo esc($employee->employee_address); ?></textarea>
        </div>

        <div class="mb-4">
            <!-- Readonly -->
            <label for="dump_role" class="main-label">Status:</label>
            <input type="text" id="dump_role" name="dump_role" value="<?php echo esc($employee->employee_role); ?>" class="main-input-readonly" readonly>
        </div>

        <div class="mb-4">
            <!-- Readonly -->
            <label for="dump_status" class="main-label">Status:</label>
            <input type="text" id="dump_status" name="dump_status" value="<?php echo esc($employee->employee_status); ?>" class="main-input-readonly" readonly>
        </div>

        <div class="flex items-center justify-center w-full">
            <button type="submit" class="main-btn w-full sm:w-2/6">
                Update Profile
            </button>
        </div>
    </form>

    <script>
        const employeeData = <?php echo json_encode($employee); ?>;
        const [day, month, year] = employeeData.employee_birthday.split('-');
        const formattedInputDate = `${year}-${month}-${day}`;

        const date = new Date(formattedInputDate);
        const formattedDate = date.toISOString().substring(0, 10); // Format as "yyyy-mm-dd" to match input[type="date"] requirements
        document.getElementById('employee_birthday').value = formattedDate;
    </script>
</div>