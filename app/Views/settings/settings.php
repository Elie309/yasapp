<div class="bg-gray-100 min-h-screen flex items-start justify-center">
    <div class="container mx-auto p-4 w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Settings</h1>
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?= view_cell('\App\Cells\SettingsCell::render') ?>
        </div>
    </div>
</div>