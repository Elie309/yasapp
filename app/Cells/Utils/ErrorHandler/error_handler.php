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