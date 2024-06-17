<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Top Navigation Bar -->
    <nav class="md:hidden bg-gray-800 text-white p-4 flex justify-between">
        <img src="logo.png" alt="Logo" class="w-24">
        <button id="sidebar-toggle" class="md:hidden text-white focus:outline-none mr-4">
            &#9776;
        </button>
    </nav>

    <div class="inline-block md:flex md:flex-1">

        <!-- Sidebar -->
        <div id="sidebar" class="hidden bg-gray-700 md:bg-gray-800 text-white p-4 transition-width delay-150 md:w-1/4 md:max-w-60 md:block">
            <div class="hidden md:block mb-8">
                <img src="logo.png" alt="Logo" class="w-full max-w-60 max-h-32 mx-auto md:mx-0">
            </div>
            <nav>
                <ul class="font-bold">
                    <li class="mb-4"><a href="" class="block p-4 rounded hover:bg-red-800">Listings</a></li>
                    <li class="mb-4"><a href="" class="block p-4 rounded hover:bg-red-800">Requests</a></li>
                    <li class="mb-4"><a href="" class="block p-4 rounded hover:bg-red-800">Profile</a></li>
                    <li class="mb-4"><a href="/logout" class="block p-4 rounded hover:bg-red-800">Logout</a></li>
                </ul>
            </nav>
        </div>
