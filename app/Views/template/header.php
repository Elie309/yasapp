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
    <nav class="bg-gray-900 px-4 py-2 flex justify-between items-center drop-shadow-2xl no-print text-lg">
        <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-36">
        <button id="sidebar-toggle" class="lg:hidden text-3xl text-white focus:outline-none mr-4" onclick="toggleSidebar()">
            &#9776;
        </button>
        <div class="hidden lg:flex flex-1 justify-between items-center">
            <ul class="flex justify-center flex-grow space-x-8 text-center items-center text-white">
                <li><a href="/listings" class="h-full rounded  hover:text-red-800 outline-none ">Listings</a></li>
                <li><a href="/requests" class="h-full  rounded text-white hover:text-red-800 outline-none ">Requests</a></li>
            </ul>
            <div id="profile" class="relative flex-grow-0">
                <button class="block p-4 rounded text-white hover:text-red-800 outline-none focus:outline-none" onclick="toggleDropdown()">Profile</button>
                <ul id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded shadow-lg">
                    <li><a href="/settings" class="block p-4 text-gray-900 outline-none rounded-t  hover:bg-gray-300 focus:outline-none">Settings</a></li>
                    <li><a href="/logout" class="block p-4 text-gray-900 outline-none rounded-b  hover:bg-gray-300 focus:outline-none">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="w-full h-full block lg:flex lg:flex-1 ">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50
                            transform -translate-x-full transition-transform duration-300 ease-in-out no-print
                            min-w-full bg-gray-900 lg:hidden text-white p-4 shadow-lg
                           ">

            <div class="flex flex-col space-y-4 justify-between items-center mb-8">
                <div class="flex justify-between items-center w-full">
                    <div class="flex-grow flex flex-row justify-center">
                        <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-36  ">
                    </div>
                    <button class="text-3xl flex-grow-0 text-white focus:outline-none" onclick="toggleSidebar()">
                        &times;
                    </button>
                </div>
                <nav class="w-full">
                    <ul class="font-bold text-center lg:text-start">
                        <!-- Removed Clients Link -->
                        <li class="mb-4"><a href="/listings" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Listings</a></li>
                        <li class="mb-4"><a href="/requests" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Requests</a></li>
                        <li class="mb-4"><a href="/settings" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Settings</a></li>
                        <li class="mb-4"><a href="/logout" class="block p-4 rounded hover:bg-red-800 outline-none focus:outline-red-800">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>