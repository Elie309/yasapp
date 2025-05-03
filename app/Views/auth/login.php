<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="<?= base_url('/css/output.css') ?>" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen main-bg-image flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Logo header -->
        <div class="bg-white p-6 text-center">
            <img src="<?= base_url('logo.webp') ?>" alt="Logo" class=" max-h-64 mx-auto">
        </div>
        
        <!-- Login form section -->
        <div class="p-8 pt-0">
            <h2 class="text-center text-2xl font-bold text-gray-700 mb-8">Login to your account</h2>
            
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mb-4 bg-red-100 border border-red-800 text-red-800 text-center px-4 py-3 rounded" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('login/acceptdata') ?>" method="POST" class="space-y-6">
                <div>
                    <label for="name" class="main-label block text-sm font-medium text-gray-700">Employee Name</label>
                    <div class="mt-1">
                        <input type="text" id="name" name="name" autocomplete="name" placeholder="Enter your name"
                               class="main-input appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-700" required>
                    </div>
                </div>
                
                <div>
                    <label for="password" class="main-label block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input type="password" id="password" name="password" autocomplete="current-password" 
                                placeholder="Enter your password"
                               class="main-input appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-700" required>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="main-btn w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-800 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700">
                        Login
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Please enter your credentials to access the system</p>
            </div>
        </div>
    </div>
</body>

</html>