<div>

    <table id="dataGrid" class="">
        <thead>
            <tr>
                <!-- Render the tableHeader -->
                <?php foreach ($tableHeader as $header) : ?>
                    <th><?= $header ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <!-- Data rows will be added here dynamically -->
        </tbody>
    </table>
    <button onclick="addRow()">Add Row</button>

</div>


<script>
// Function to add a new row to the table
function addRow() {
    const table = document.getElementById("dataGrid").getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);
    
    // Assuming 3 columns for demonstration, adjust according to your needs
    for (let i = 0; i < 3; i++) {
        let newCell = newRow.insertCell(i);
        let newText = document.createTextNode(`Data ${i + 1}`);
        newCell.appendChild(newText);
    }
}

// Additional functions to remove or update rows can be added here
</script>