<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="<?= base_url('/css/output.css') ?>" rel="stylesheet">
</head>

<body class="bg-gray-100 sm:flex sm:items-center sm:justify-center min-h-screen main-bg-image">


    <div class="w-full max-w-full sm:max-w-3xl min-h-screen sm:min-h-fit sm:h-fit
            bg-white p-8 sm:shadow-md sm:rounded-lg">


        <div class=" 
            flex flex-col sm:flex-row justify-start align-middle ">


            <div class="w-full sm:h-1/2 sm:w-1/2
                flex items-center justify-center
                ">
                <img src="<?= base_url('logo.webp') ?>" alt="Logo" class="w-2/3 sm:w-full drop-shadow-md min-h-fit">
            </div>


            <div class="w-full sm:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Login to your account</h2>

                <form action="<?= base_url('login/acceptdata') ?>" method="POST">
                    <div class="mb-4">

                        <label for="name" class="main-label">Employee Name</label>

                        <input type="text" id="name" name="name" autocomplete="name" class="main-input" required>

                    </div>
                    <div class="mb-6">

                        <label for="password" class="main-label">Password</label>

                        <input type="password" id="password" name="password" autocomplete="current-password" class="main-input" required>
                    </div>

                    <button type="submit" class="w-full main-btn">
                        Login
                    </button>

                </form>




            </div>


        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="my-2 bg-red-100 border border-red-800 text-red-800 text-center px-4 py-3 rounded relative" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>


    </div>
</body>

</html>