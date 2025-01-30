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
                <li><a href="/listings" class="h-full rounded font-bold  hover:text-red-800 outline-none ">Listings</a></li>
                <li><a href="/requests" class="h-full  rounded font-bold text-white hover:text-red-800 outline-none ">Requests</a></li>
            </ul>

            <div id="notifications" class="relative flex-grow-0">
                <button class="block p-2 text-white font-bold 
                         outline-none hover:bg-gray-600 hover:bg-opacity-70 rounded-full focus:outline-none relative"
                         onclick="toggleDropdown('notifications-dropdown')"
                         >
                    <span class="hidden absolute scale-75 right-0 top-0 w-6 h-6 rounded-full bg-red-800  items-center justify-center">
                        <span id="notification-count" class=" text-sm text-white">0</span>
                    </span>
                    <svg width="100%" height="100%" viewBox="0 0 24 24" fit=""
                        preserveAspectRatio="xMidYMid meet"
                        focusable="false" class="size-6 fill-white  rounded-full">
                        <path d="M18 17v-6c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v6H4v2h16v-2h-2zm-2 0H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zm-4 5c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z"></path>
                    </svg>
                </button>
                <ul id="notifications-dropdown" class="hidden">
                    <div class="w-full border-b border-gray-200">
                        <div class="flex justify-between items-center my-2 p-2">
                            <a href="/notifications"><span class=" font-bold text-base text-center text-gray-900">Notifications</span></a>
                            <button class="text-xs text-red-800" onclick="markAllAsRead()">Mark all as read</button>
                        </div>
                    </div>

                    <!-- No notification element -->
                    <li id="no-notifications" class="hidden p-4 text-center text-gray-900">No notifications</li>
                    <!-- Error notification element -->
                    <li id="error-notifications" class="hidden p-4 text-center text-red-800">Error loading notifications</li>
                </ul>
            </div>
            <div id="profile" class="relative flex-grow-0 ">
                <button class="block p-2 rounded-full hover:bg-gray-600 hover:bg-opacity-70 text-white font-bold 
                outline-none focus:outline-none" onclick="toggleDropdown('profile-dropdown')">
                    <svg class="size-8 fill-white "
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="800px" height="800px" viewBox="0 0 45.532 45.532"
                        xml:space="preserve">
                        <g>
                            <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z" />
                        </g>
                    </svg>
                </button>

                <ul id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded shadow-lg ">
                    <li><a href="/settings" class="block p-4 font-bold text-gray-900 outline-none rounded-t  hover:bg-gray-300 focus:outline-none">Settings</a></li>
                    <li><a href="/notifications" class="block p-4 font-bold text-gray-900 outline-none rounded-t  hover:bg-gray-300 focus:outline-none">Notifications</a></li>
                    <li><a href="/logout" class="block p-4 font-bold text-gray-900 outline-none rounded-b  hover:bg-gray-300 focus:outline-none">Logout</a></li>
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
                        <li class="mb-4"><a href="/listings" class="block p-4 font-bold rounded hover:bg-red-800 outline-none focus:outline-red-800">Listings</a></li>
                        <li class="mb-4"><a href="/requests" class="block p-4 font-bold rounded hover:bg-red-800 outline-none focus:outline-red-800">Requests</a></li>
                        <li class="mb-4"><a href="/notifications" class="block p-4 font-bold rounded hover:bg-red-800 outline-none focus:outline-red-800">Notifications</a></li>
                        <li class="mb-4"><a href="/settings" class="block p-4 font-bold rounded hover:bg-red-800 outline-none focus:outline-red-800">Settings</a></li>
                        <li class="mb-4"><a href="/logout" class="block p-4 font-bold rounded hover:bg-red-800 outline-none focus:outline-red-800">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>