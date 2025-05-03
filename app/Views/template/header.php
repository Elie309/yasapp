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
    
    <style>
        .nav-link {
            position: relative;
            transition: all 0.3s;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #e53e3e;
            transition: width 0.3s;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .dropdown-animation {
            animation: fadeIn 0.2s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen max-w-screen overflow-x-auto overflow-y-auto">
    <!-- Top Navigation Bar -->
    <nav class="bg-gray-900 px-4 py-3 flex justify-between items-center drop-shadow-2xl no-print text-lg sticky top-0 z-40">
        <div class="flex items-center">
            <a href="/"><img src="<?= base_url('logo.webp') ?>" alt="Logo" class="h-14 ml-8"></a>
        </div>
        
        <button id="sidebar-toggle" class="lg:hidden text-3xl text-white focus:outline-none mr-4 hover:text-red-500 transition-colors" onclick="toggleSidebar()">
            &#9776;
        </button>

        <div class="hidden lg:flex flex-1 justify-between items-center">
            <ul class="flex justify-center flex-grow space-x-12 text-center items-center">
                <li>
                    <a href="/listings" class="nav-link px-2 py-1 font-bold text-white hover:text-red-500 transition-colors <?= current_url(true)->getPath() == '/listings' ? 'active' : '' ?>">
                        Listings
                    </a>
                </li>
                <li>
                    <a href="/requests" class="nav-link px-2 py-1 font-bold text-white hover:text-red-500 transition-colors <?= current_url(true)->getPath() == '/requests' ? 'active' : '' ?>">
                        Requests
                    </a>
                </li>
            </ul>

            <div class="flex items-center space-x-4">
                <div id="notifications" class="relative">
                    <button class="block p-2 text-white font-bold rounded-full hover:bg-gray-700 transition-colors focus:outline-none relative"
                        onclick="toggleDropdown('notifications-dropdown')">
                        <span class="hidden absolute scale-75 right-0 top-0 w-6 h-6 rounded-full bg-red-800 items-center justify-center">
                            <span id="notification-count" class="text-sm text-white">0</span>
                        </span>
                        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 fill-white rounded-full']) ?>
                    </button>
                    <div id="notifications-dropdown" class="hidden dropdown-animation absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="w-full border-b text-center border-gray-200 bg-gray-50">
                            <div class="flex justify-between items-center p-3">
                                <a href="/notifications" class="font-bold text-base text-gray-900 hover:text-red-800">Notifications</a>
                                <span class="text-xs text-gray-500">View all</span>
                            </div>
                        </div>
                        <!-- No notification element -->
                        <p id="no-notifications" class="hidden p-4 text-center text-gray-600">No new notifications</p>
                        <!-- Error notification element -->
                        <p id="error-notifications" class="hidden p-4 text-center text-red-800">Error loading notifications</p>

                        <ul id="notifications-list" class="max-h-96 overflow-y-auto"></ul>
                    </div>
                </div>
                
                <div id="profile" class="relative">
                    <button class="block p-2 rounded-full hover:bg-gray-700 transition-colors text-white font-bold focus:outline-none" 
                        onclick="toggleDropdown('profile-dropdown')">
                        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'profile', 'viewBox' => '0 0 45.532 45.532', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                    </button>

                    <ul id="profile-dropdown" class="hidden dropdown-animation absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg overflow-hidden">
                        <li><a href="/notifications">
                                <div class="flex items-center p-3 font-bold hover:bg-gray-100 transition-colors space-x-3">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-5 fill-gray-900']) ?>
                                    <p>Notifications</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/settings">
                                <div class="flex items-center p-3 font-bold hover:bg-gray-100 transition-colors space-x-3">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'settings', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-5 stroke-gray-900']) ?>
                                    <p>Settings</p>
                                </div>
                            </a>
                        </li>
                        <li class="border-t border-gray-200">
                            <a href="/logout">
                                <div class="flex items-center p-3 font-bold hover:bg-red-50 text-red-800 transition-colors space-x-3">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'logout', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-5 stroke-red-800']) ?>
                                    <p>Logout</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="w-full h-full block lg:flex lg:flex-1">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50
                            transform -translate-x-full transition-transform duration-300 ease-in-out no-print
                            min-w-full bg-gray-900 lg:hidden text-white p-4 shadow-lg">

            <div class="flex flex-col space-y-4 justify-between items-center mb-8">
                <div class="flex justify-between items-center w-full">
                    <div class="flex-grow flex flex-row justify-center">
                       <a href="/"> <img src="<?= base_url('logo.webp') ?>" alt="Logo" class="w-36"></a>
                    </div>
                    <button class="text-3xl flex-grow-0 text-white hover:text-red-500 transition-colors focus:outline-none" onclick="toggleSidebar()">
                        &times;
                    </button>
                </div>
                <nav class="w-full pt-6">
                    <ul class="font-bold space-y-1">
                        <li>
                            <a href="/listings">
                                <div class="flex items-center p-4 font-bold rounded-lg hover:bg-gray-800 <?= str_contains(current_url(true)->getPath(), '/listings') ? 'bg-gray-800 border-l-4 border-red-800' : '' ?> transition-colors space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'listings', 'viewBox' => '0 0 512 512', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                                    <p>Listings</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/requests">
                                <div class="flex items-center p-4 font-bold rounded-lg hover:bg-gray-800 <?= str_contains(current_url(true)->getPath(), '/requests') ? 'bg-gray-800 border-l-4 border-red-800' : '' ?> transition-colors space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'requests', 'viewBox' => '0 0 32 32', 'fill' => 'currentColor', 'class' => 'size-6 fill-white']) ?>
                                    <p>Requests</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/notifications">
                                <div class="flex items-center p-4 font-bold rounded-lg hover:bg-gray-800 transition-colors space-x-4  <?= str_contains(current_url(true)->getPath(), '/notifications') ? 'bg-gray-800 border-l-4 border-red-800' : '' ?>">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'bell', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 fill-white rounded-full']) ?>
                                    <p>Notifications</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/settings">
                                <div class="flex items-center p-4 font-bold rounded-lg hover:bg-gray-800 transition-colors space-x-4  <?= str_contains(current_url(true)->getPath(),'/settings') ? 'bg-gray-800 border-l-4 border-red-800' : '' ?>">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'settings', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-white']) ?>
                                    <p>Settings</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/logout">
                                <div class="flex items-center p-4 font-bold rounded-lg hover:bg-gray-800 transition-colors space-x-4">
                                    <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'logout', 'viewBox' => '0 0 24 24', 'fill' => 'currentColor', 'class' => 'size-6 stroke-white']) ?>
                                    <p>Logout</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>