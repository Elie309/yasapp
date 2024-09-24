<div class="mx-auto w-full sm:w-3/4 md:w-1/2">
    <?= view_cell(
        '\App\Cells\Clients\ClientForm\ClientFormCell::render',
        ['client' => $client, 'phones' => $phones, 'employee_id' => $employee_id, 'countries' => $countries, 'clientFromRequest' => 'edit']
    ) ?>
</div>