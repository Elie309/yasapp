<div class="container">
    <h2 class="text-2xl text-center my-2">Employee Form</h2>
    <form action="#" method="POST">

        <input type="hidden" name="employee_id" id="employee_id">

        <label for="employee_name" class="main-label">Name</label>
        <input type="text" class="main-input" id="employee_name" class="main-input" name="employee_name" required>

        <label for="employee_email" class="main-label">Email</label>
        <input type="email" id="employee_email" class="main-input" name="employee_email" required>

        <label for="employee_password" class="main-label">Password</label>
        <!-- Note this will change the passsword -->
        <p class="text-red-500 text-sm font-semibold italic">To set a new password only </p>
        <input type="password" id="employee_password" class="main-input" name="employee_password" autocomplete="off">

        <label for="employee_phone" class="main-label">Phone</label>
        <input type="text" id="employee_phone" class="main-input" name="employee_phone" required>

        <label for="employee_role" class="main-label">Role</label>
        <select id="employee_role" class="main-input" name="employee_role">
            <option value="user">User</option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
        </select>

        <label for="employee_status" class="main-label">Status</label>
        <select id="employee_status" class="main-input" name="employee_status">
            <option value="active" default>Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <label for="employee_birthday" class="main-label">Birthday</label>
        <input type="date" id="employee_birthday" class="main-input" name="employee_birthday">

        <label for="employee_address" class="main-label">Address</label>
        <textarea id="employee_address" class="main-input" name="employee_address" rows="3"></textarea>

        <div class="w-full flex justify-center my-2">
            <button type="submit" class="main-btn w-1/2 md:w-2/6 right">Submit</button>
        </div>

    </form>
</div>

<script>
    // Check local data a fill the form
    function setFormDetails() {
        const employeeData = JSON.parse(sessionStorage.getItem('tempTableData'));
        if (employeeData) {
            document.getElementById('employee_id').value = employeeData.employee_id;
            document.getElementById('employee_name').value = employeeData.employee_name;
            document.getElementById('employee_email').value = employeeData.employee_email;
            document.getElementById('employee_phone').value = employeeData.employee_phone;
            document.getElementById('employee_role').value = employeeData.employee_role;
            document.getElementById('employee_status').value = employeeData.employee_status;

            // Assuming employeeData.employee_birthday is in the "dd-mm-yyyy" format
            const [day, month, year] = employeeData.employee_birthday.split('-');
            const formattedInputDate = `${year}-${month}-${day}`;

            const date = new Date(formattedInputDate);
            const formattedDate = date.toISOString().substring(0, 10); // Format as "yyyy-mm-dd" to match input[type="date"] requirements
            document.getElementById('employee_birthday').value = formattedDate;

            document.getElementById('employee_address').value = employeeData.employee_address;

        }
    }
</script>