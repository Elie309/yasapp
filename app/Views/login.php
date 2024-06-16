<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 sm:flex sm:items-center sm:justify-center min-h-screen">


    <div class="w-full max-w-full sm:max-w-3xl min-h-screen sm:min-h-fit sm:h-fit
            bg-white p-8 sm:shadow-md sm:rounded-lg ">


        <div class=" 
            flex flex-col sm:flex-row justify-start align-middle ">


            <div class="w-full sm:h-1/2 sm:w-1/2
                flex items-center justify-center
                ">
                <img src="logo.webp" alt="Logo" class="w-2/3 sm:w-full drop-shadow-md min-h-fit">
            </div>


            <div class="w-full sm:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Login to your account</h2>

                <form action="<?= base_url('login/acceptdata') ?>" method="POST">
                    <div class="mb-4">

                        <label for="Name" class="block font-bold text-red-800">Email</label>

                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>

                    </div>
                    <div class="mb-6">

                        <label for="password" class="block font-bold text-red-800">Password</label>

                        <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 focus:border-red-800 rounded mt-1 outline-none" required>


                    </div>

                    <button type="submit" class="w-full bg-red-800 text-white
                        py-2 rounded ease-in-out 
                        hover:bg-red-900 focus:outline-none focus:bg-red-900">
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