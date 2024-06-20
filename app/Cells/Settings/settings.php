<div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
    <?php foreach ($settings as $setting) : ?>
        <a href="<?= $setting['url'] ?>" class="block bg-white rounded-lg r shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
            <img src="<?= $setting['img'] ?>" alt="<?= $setting['title'] ?> Settings" 
                class="w-full h-32 object-contain shadow-sm ">
            <div class="p-4 pt-2">
                <h2 class="text-2xl font-bold mb-2"><?= $setting['title'] ?></h2>
                <p class="text-gray-700"><?= $setting['description'] ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>