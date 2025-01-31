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
                <li>
                    <a href="/listings" class="h-full rounded font-bold  hover:text-red-800 outline-none ">
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
                    <svg width="100%" height="100%" viewBox="0 0 24 24" fit=""
                        preserveAspectRatio="xMidYMid meet"
                        focusable="false" class="size-6 fill-white  rounded-full">
                        <path d="M18 17v-6c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v6H4v2h16v-2h-2zm-2 0H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zm-4 5c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z"></path>
                    </svg>
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
                    <li><a href="/notifications">
                            <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <svg class="size-6 viewBox=" 0 0 24 24" fit=""
                                    preserveAspectRatio="xMidYMid meet"
                                    focusable="false" class="size-6 fill-gray-900  rounded-full">
                                    <path d="M18 17v-6c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v6H4v2h16v-2h-2zm-2 0H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zm-4 5c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z"></path>
                                </svg>
                                <p>Notifications</p>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/settings">
                            <div class="flex items-center
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <svg class="size-6 stroke-gray-900" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="3" stroke-width="1.5" />
                                    <path d="M13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74457 2.35523 9.35522 2.74458 9.15223 3.23463C9.05957 3.45834 9.0233 3.7185 9.00911 4.09799C8.98826 4.65568 8.70226 5.17189 8.21894 5.45093C7.73564 5.72996 7.14559 5.71954 6.65219 5.45876C6.31645 5.2813 6.07301 5.18262 5.83294 5.15102C5.30704 5.08178 4.77518 5.22429 4.35436 5.5472C4.03874 5.78938 3.80577 6.1929 3.33983 6.99993C2.87389 7.80697 2.64092 8.21048 2.58899 8.60491C2.51976 9.1308 2.66227 9.66266 2.98518 10.0835C3.13256 10.2756 3.3397 10.437 3.66119 10.639C4.1338 10.936 4.43789 11.4419 4.43786 12C4.43783 12.5581 4.13375 13.0639 3.66118 13.3608C3.33965 13.5629 3.13248 13.7244 2.98508 13.9165C2.66217 14.3373 2.51966 14.8691 2.5889 15.395C2.64082 15.7894 2.87379 16.193 3.33973 17C3.80568 17.807 4.03865 18.2106 4.35426 18.4527C4.77508 18.7756 5.30694 18.9181 5.83284 18.8489C6.07289 18.8173 6.31632 18.7186 6.65204 18.5412C7.14547 18.2804 7.73556 18.27 8.2189 18.549C8.70224 18.8281 8.98826 19.3443 9.00911 19.9021C9.02331 20.2815 9.05957 20.5417 9.15223 20.7654C9.35522 21.2554 9.74457 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8477 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.902C15.0117 19.3443 15.2977 18.8281 15.781 18.549C16.2643 18.2699 16.8544 18.2804 17.3479 18.5412C17.6836 18.7186 17.927 18.8172 18.167 18.8488C18.6929 18.9181 19.2248 18.7756 19.6456 18.4527C19.9612 18.2105 20.1942 17.807 20.6601 16.9999C21.1261 16.1929 21.3591 15.7894 21.411 15.395C21.4802 14.8691 21.3377 14.3372 21.0148 13.9164C20.8674 13.7243 20.6602 13.5628 20.3387 13.3608C19.8662 13.0639 19.5621 12.558 19.5621 11.9999C19.5621 11.4418 19.8662 10.9361 20.3387 10.6392C20.6603 10.4371 20.8675 10.2757 21.0149 10.0835C21.3378 9.66273 21.4803 9.13087 21.4111 8.60497C21.3592 8.21055 21.1262 7.80703 20.6602 7C20.1943 6.19297 19.9613 5.78945 19.6457 5.54727C19.2249 5.22436 18.693 5.08185 18.1671 5.15109C17.9271 5.18269 17.6837 5.28136 17.3479 5.4588C16.8545 5.71959 16.2644 5.73002 15.7811 5.45096C15.2977 5.17191 15.0117 4.65566 14.9909 4.09794C14.9767 3.71848 14.9404 3.45833 14.8477 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224Z"
                                        stroke-width="1.5" />
                                </svg>
                                <p>Settings</p>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/logout">
                            <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                <svg class="size-6 stroke-gray-900" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                        stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
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
                                    <svg class="size-6 fill-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M80.844,0c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,0,80.844,0z M80.844,90.667
                                                    c-19.116,0-34.667-15.551-34.667-34.667s15.551-34.667,34.667-34.667S115.51,36.884,115.51,56S99.959,90.667,80.844,90.667z" />
                                                    <path d="M476.49,13.333H177.823c-5.89,0-10.667,4.777-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                                                    c5.89,0,10.667-4.777,10.667-10.667V24C487.156,18.11,482.38,13.333,476.49,13.333z M465.823,77.333H188.49h0V34.667h277.333
                                                    V77.333z" />
                                                    <path d="M80.844,133.333c-30.878,0-56,25.122-56,56c0,30.878,25.122,56,56,56s56-25.122,56-56
                                                    C136.844,158.456,111.722,133.333,80.844,133.333z M80.844,224c-19.116,0-34.667-15.551-34.667-34.667
                                                    c0-19.116,15.551-34.667,34.667-34.667s34.667,15.551,34.667,34.667C115.51,208.449,99.959,224,80.844,224z" />
                                                    <path d="M476.49,146.667H177.823c-5.89,0-10.667,4.776-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                                                    c5.89,0,10.667-4.776,10.667-10.667v-64C487.156,151.443,482.38,146.667,476.49,146.667z M465.823,210.667H188.49h0V168h277.333
                                                    V210.667z" />
                                                    <path d="M80.844,266.667c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,266.667,80.844,266.667z
                                                    M80.844,357.333c-19.116,0-34.667-15.551-34.667-34.667S61.728,288,80.844,288s34.667,15.551,34.667,34.667
                                                    S99.959,357.333,80.844,357.333z" />
                                                    <path d="M476.49,280H177.823c-5.89,0-10.667,4.777-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                                                    c5.89,0,10.667-4.777,10.667-10.667v-64C487.156,284.777,482.38,280,476.49,280z M465.823,344H188.49h0v-42.667h277.333V344z" />
                                                    <path d="M80.844,400c-30.878,0-56,25.122-56,56s25.122,56,56,56s56-25.122,56-56S111.722,400,80.844,400z M80.844,490.667
                                                    c-19.116,0-34.667-15.551-34.667-34.667s15.551-34.667,34.667-34.667S115.51,436.884,115.51,456S99.959,490.667,80.844,490.667z" />
                                                    <path d="M80.844,445.333c-5.884,0-10.667,4.783-10.667,10.667s4.783,10.667,10.667,10.667S91.51,461.884,91.51,456
                                                    S86.727,445.333,80.844,445.333z" />
                                                    <path d="M476.49,413.333H177.823c-5.89,0-10.667,4.776-10.667,10.667v64c0,5.89,4.776,10.667,10.667,10.667H476.49
                                                    c5.89,0,10.667-4.777,10.667-10.667v-64C487.156,418.11,482.38,413.333,476.49,413.333z M465.823,477.333H188.49h0v-42.667
                                                    h277.333V477.333z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <p>Listings</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/requests">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <svg class="size-6 fill-white" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                }
                                            </style>
                                        </defs>
                                        <path d="M22,22v6H6V4H16V2H6A2,2,0,0,0,4,4V28a2,2,0,0,0,2,2H22a2,2,0,0,0,2-2V22Z" transform="translate(0)" />
                                        <path d="M29.54,5.76l-3.3-3.3a1.6,1.6,0,0,0-2.24,0l-14,14V22h5.53l14-14a1.6,1.6,0,0,0,0-2.24ZM14.7,20H12V17.3l9.44-9.45,2.71,2.71ZM25.56,9.15,22.85,6.44l2.27-2.27,2.71,2.71Z" transform="translate(0)" />
                                        <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32" />
                                    </svg>
                                    <p>Requests</p>
                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/notifications">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <svg class="size-6 fill-white  rounded-full" viewBox="0 0 24 24" fit=""
                                        preserveAspectRatio="xMidYMid meet"
                                        focusable="false">
                                        <path d="M18 17v-6c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v6H4v2h16v-2h-2zm-2 0H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6zm-4 5c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z"></path>
                                    </svg>
                                    <p>Notifications</p>

                                </div>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="/settings">
                                <div class="flex items-center
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <svg class="size-6 stroke-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="3" stroke-width="1.5" />
                                        <path d="M13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74457 2.35523 9.35522 2.74458 9.15223 3.23463C9.05957 3.45834 9.0233 3.7185 9.00911 4.09799C8.98826 4.65568 8.70226 5.17189 8.21894 5.45093C7.73564 5.72996 7.14559 5.71954 6.65219 5.45876C6.31645 5.2813 6.07301 5.18262 5.83294 5.15102C5.30704 5.08178 4.77518 5.22429 4.35436 5.5472C4.03874 5.78938 3.80577 6.1929 3.33983 6.99993C2.87389 7.80697 2.64092 8.21048 2.58899 8.60491C2.51976 9.1308 2.66227 9.66266 2.98518 10.0835C3.13256 10.2756 3.3397 10.437 3.66119 10.639C4.1338 10.936 4.43789 11.4419 4.43786 12C4.43783 12.5581 4.13375 13.0639 3.66118 13.3608C3.33965 13.5629 3.13248 13.7244 2.98508 13.9165C2.66217 14.3373 2.51966 14.8691 2.5889 15.395C2.64082 15.7894 2.87379 16.193 3.33973 17C3.80568 17.807 4.03865 18.2106 4.35426 18.4527C4.77508 18.7756 5.30694 18.9181 5.83284 18.8489C6.07289 18.8173 6.31632 18.7186 6.65204 18.5412C7.14547 18.2804 7.73556 18.27 8.2189 18.549C8.70224 18.8281 8.98826 19.3443 9.00911 19.9021C9.02331 20.2815 9.05957 20.5417 9.15223 20.7654C9.35522 21.2554 9.74457 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8477 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.902C15.0117 19.3443 15.2977 18.8281 15.781 18.549C16.2643 18.2699 16.8544 18.2804 17.3479 18.5412C17.6836 18.7186 17.927 18.8172 18.167 18.8488C18.6929 18.9181 19.2248 18.7756 19.6456 18.4527C19.9612 18.2105 20.1942 17.807 20.6601 16.9999C21.1261 16.1929 21.3591 15.7894 21.411 15.395C21.4802 14.8691 21.3377 14.3372 21.0148 13.9164C20.8674 13.7243 20.6602 13.5628 20.3387 13.3608C19.8662 13.0639 19.5621 12.558 19.5621 11.9999C19.5621 11.4418 19.8662 10.9361 20.3387 10.6392C20.6603 10.4371 20.8675 10.2757 21.0149 10.0835C21.3378 9.66273 21.4803 9.13087 21.4111 8.60497C21.3592 8.21055 21.1262 7.80703 20.6602 7C20.1943 6.19297 19.9613 5.78945 19.6457 5.54727C19.2249 5.22436 18.693 5.08185 18.1671 5.15109C17.9271 5.18269 17.6837 5.28136 17.3479 5.4588C16.8545 5.71959 16.2644 5.73002 15.7811 5.45096C15.2977 5.17191 15.0117 4.65566 14.9909 4.09794C14.9767 3.71848 14.9404 3.45833 14.8477 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224Z"
                                            stroke-width="1.5" />
                                    </svg>
                                    <p>Settings</p>

                                </div>
                            </a>
                        </li>
                        <li class="mb-4 ">
                            <a href="/logout">
                                <div class="flex items-center 
                                    p-4 font-bold rounded hover:bg-red-800
                                    outline-none focus:outline-red-800 space-x-4">
                                    <svg class="size-6 stroke-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                            stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p>Logout</p>

                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>