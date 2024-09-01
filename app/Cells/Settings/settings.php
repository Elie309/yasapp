<div class="w-full flex flex-row flex-wrap justify-center">
    <?php foreach ($settings as $setting) : ?>

        <?php if (isset($setting['role']) && !in_array($this->getRole(), $setting['role'])) {
            continue;
        } ?>
        <a href="<?= $setting['url'] ?>" class="block mx-4 my-2 min-w-80 max-w-80 bg-white rounded-lg r shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
            <img src="<?= $setting['img'] ?>" alt="<?= $setting['title'] ?> Settings" 
                class="w-full h-32 object-contain shadow-sm ">
            <div class="p-4 pt-2">
                <h2 class="text-2xl font-bold mb-2"><?= $setting['title'] ?></h2>
                <p class="text-gray-700"><?= $setting['description'] ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>