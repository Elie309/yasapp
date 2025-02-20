<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">

    <?php if (isset($title) && $title === 'Uploads') : ?>
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    <?php endif; ?>

</head>

<body class=" bg-gray-100 flex flex-col min-h-screen max-w-screen overflow-x-auto overflow-y-auto">
    <!-- Top Navigation Bar -->
    <nav class="bg-gray-900 px-4 py-2 flex justify-between items-center drop-shadow-2xl no-print text-lg">
        <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-36">
        <button id="sidebar-toggle" class="lg:hidden text-3xl text-white focus:outline-none mr-4" onclick="toggleSidebar()">
            &#9776;
        </button>

        <div class="hidden lg:flex flex-1 justify-between items-center">
            <ul class="flex justify-center flex-grow space-x-8 text-center items-center ">
                <li>
                    <a href="/listings" class="h-full rounded font-bold text-white  hover:text-red-800 outline-none ">
                        Listings
                    </a>
                </li>
                <li>
                    <a href="/requests" class="h-full  rounded font-bold text-white hover:text-red-800 outline-none ">
                        Requests
                    </a>
                </li>
            </ul>

            <div id="notifications" class="relative flex-grow-0">
                <button class="block p-2 text-white font-bold 
                         outline-none hover:bg-gray-600 hover:bg-opacity-70 rounded-full focus:outline-none relative"
                    onclick="toggleDropdown('notifications-dropdown')">
                    <span class="hidden absolute scale-75 right-0 top-0 w-6 h-6 rounded-full bg-red-800  items-center justify-center">
                        <span id="notification-count" class=" text-sm text-white">0</span>
                    </span>
                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 fill-white rounded-full']) ?>
                </button>
                <div id="notifications-dropdown" class="hidden">
                    <div class="w-full border-b text-center border-gray-200">
                        <div class="flex justify-between items-center my-2 p-2">
                            <a href="/notifications"><span class=" font-bold text-base text-center text-gray-900">Notifications</span></a>
                        </div>
                    </div>
                    <!-- No notification element -->
                    <p id="no-notifications" class="hidden p-4 text-center text-gray-900 hover:bg-white">No new notifications</p>
                    <!-- Error notification element -->
                    <p id="error-notifications" class="hidden p-4 text-center text-red-800">Error loading notifications</p>

                    <ul id="notifications-list">

                    </ul>

                </div>
            </div>
            <div id="profile" class="relative flex-grow-0 ">
                <button class="block p-2 rounded-full hover:bg-gray-600 hover:bg-opacity-70 text-white font-bold 
                outline-none focus:outline-none" onclick="toggleDropdown('profile-dropdown')">
                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'profile', 'viewBox' => '0 0 45.532 45.532', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                </button>

                <ul id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded shadow-lg ">
                    <li><a href="/notifications">
                            <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 fill-gray-900 rounded-full']) ?>
                                <p >Notifications</p>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/settings">
                            <div class="flex items-center
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'settings', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-gray-900']) ?>
                                <p>Settings</p>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/logout">
                            <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'logout', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-gray-900']) ?>
                                <p>Logout</p>

                            </div>
                        </a>
                    </li>
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
                        <li class="mb-4">
                            <a href="/listings">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'listings', 'viewBox' => '0 0 512 512', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                                    <p>Listings</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/requests">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'requests', 'viewBox' => '0 0 32 32', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                                    <p>Requests</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/notifications">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 fill-white rounded-full']) ?>
                                    <p>Notifications</p>

                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/settings">
                                <div class="flex items-center
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'settings', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-white']) ?>
                                    <p>Settings</p>

                                </div>
                            </a>
                        </li>
                        <li class="mb-4 ">
                            <a href="/logout">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'logout', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-white']) ?>
                                    <p>Logout</p>

                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>