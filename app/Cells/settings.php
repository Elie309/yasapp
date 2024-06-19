<?php foreach ($settings as $setting): ?>
<a href="<?= $setting['url'] ?>" class="block bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
    <img src="<?= $setting['img'] ?>" alt="<?= $setting['title'] ?> Settings" class="w-full h-32 object-cover">
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-2"><?= $setting['title'] ?></h2>
        <p class="text-gray-700"><?= $setting['description'] ?></p>
    </div>
</a>
<?php endforeach; ?>