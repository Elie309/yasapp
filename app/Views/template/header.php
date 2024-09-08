<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>

<body class=" bg-gray-100 flex flex-col min-h-screen max-w-screen overflow-x-auto overflow-y-auto">
    <!-- Top Navigation Bar -->
    <nav class="lg:hidden bg-gray-900 text-white px-4 py-2 flex justify-between drop-shadow-2xl">
        <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-36">
        <button id="sidebar-toggle" class="lg:hidden text-3xl text-white focus:outline-none mr-4">
            &#9776;
        </button>
    </nav>

    <div class="w-full h-full inline-block lg:flex lg:flex-1">

        <!-- Sidebar -->
        <div id="sidebar" class="hidden
                            w-full min-h-full bg-[#292f3d]
                            lg:relative lg:block lg:max-w-80 lg:bg-gray-900 
                            text-white p-4 shadow-lg
                           ">


            <div class="hidden lg:block mb-8">
                <a href="/" class="outline-none focus:outline-red-800">
                    <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-full max-w-60 max-h-32 mx-auto lg:mx-0">
                </a>
            </div>
            <nav>
                <ul class="font-bold text-center lg:text-start">
                    <li class="mb-4"><a href="/clients" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Clients</a></li>
                    <li class="mb-4"><a href="/listings" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Listings</a></li>
                    <li class="mb-4"><a href="/requests" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Requests</a></li>
                    <li class="mb-4"><a href="/settings" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Settings</a></li>
                    <li class="mb-4"><a href="/logout" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Logout</a></li>
                </ul>
            </nav>
        </div>