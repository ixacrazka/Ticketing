<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Admin-Dashboard') }}</title>

    <!-- Script Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Script untuk Data Table search dan Pagination     -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>



    <!-- Scripts untuk Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    /* Styling the DataTable container */
            #pelaporTable {
                border-radius: 2.5rem; /* 3xl equivalent */
                overflow: hidden;
                margin: 30px 0;
            }

            /* Style the search input field */
            .dataTables_filter input {
                width: 250px;
                padding: 10px 20px; /* Adjust padding to fit the label and input */
                border-radius: 40px;
                border: 3px solid #ccc;
                background-color: #C5D3E8;
                padding-left: 50px; /* Extra padding for space for icon */
                position: relative;
            }

            /* Position and style the search label to be inside the input */
            .dataTables_filter label {
                position: relative;
                font-size: 20px;
                font-weight: bold;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            /* Custom icon styling */
            .dataTables_filter label:before {
                content: "🔍"; /* Unicode character for search icon */
                position: absolute;
                left: 10px;
                font-size: 18px;
                color: #333;
            }

            /* Pagination button styling */
            .dataTables_paginate .paginate_button {
                background-color: #007bff;
                color: #fff;
                border-radius: 30px;
                padding: 5px 10px;
                font-size: 14px;
                margin: 0 3px;
                border: none; /* Remove default border */
            }

            /* Styling for the active pagination button */
            .dataTables_paginate .paginate_button.current {
                background-color: #fff;
                color: #007bff; /* Change font color to match primary color */
                font-weight: bold;
            }

            /* Previous and Next button styling */
            .dataTables_paginate .previous, .dataTables_paginate .next {
                font-weight: bold;
                background-color: #007bff;
                color: #fff;
                border-radius: 30px;
                padding: 5px 10px;
            }


    </style>
</head>
<body class="font-[Outfit] bg-gray-100">
    <div class="min-h-screen flex">
<!-- Sidebar -->
<div class="w-64 min-h-screen  bg-blue-800 text-white rounded-xl ml-2 hidden md:block font-[Outfit]">
    <div class="p-4 mt-8 ml-9">
        <span class="text-4xl text-yellow-400 font-bold">Ticket</span><span class="text-3xl text-white font-bold">Ing</span>
    </div>
    <ul class="mt-20 text-lg mx-5 sticky top-10">
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 rounded-2xl {{ request()->is('count') ? 'bg-neon text-black' : '' }}">
        <a href="/count" class="flex items-center space-x-4">
            <i class="fas fa-chart-line"></i> <!-- Dashboard Icon -->
            <span>Dashboard</span>
        </a>
    </li>
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 rounded-2xl {{ request()->is('dashboard') ? 'bg-neon text-black' : '' }}">
        <a href="/dashboard" class="flex items-center space-x-4">
            <i class="fas fa-file-alt"></i> <!-- Laporan Icon -->
            <span>Laporan</span>
        </a>
    </li>
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('jenis') ? 'bg-neon text-black' : '' }} rounded-2xl">
        <a href="/jenis" class="flex items-center space-x-4">
            <i class="fas fa-list-alt"></i> <!-- Jenis Pengaduan Icon -->
            <span>Jenis Pengaduan</span>
        </a>
    </li>
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('status') ? 'bg-neon text-black' : '' }} rounded-2xl">
        <a href="/status" class="flex items-center space-x-4">
            <i class="fas fa-info-circle"></i> <!-- Status Icon -->
            <span>Status</span>
        </a>
    </li>
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('pelapor') ? 'bg-neon text-black' : '' }} rounded-2xl">
        <a href="/pelapor" class="flex items-center space-x-4">
            <i class="fas fa-id-card"></i> <!-- Identitas Pelapor Icon -->
            <span>Identitas Pelapor</span>
        </a>
    </li>
    <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('aduan') ? 'bg-neon text-black' : '' }} rounded-2xl">
        <a href="/aduan" class="flex items-center space-x-4">
            <i class="fas fa-bug"></i> <!-- Aduan Error Icon -->
            <span>Aduan Error</span>
        </a>
    </li>
     <!-- Dropdown Menu for Rekap Laporan and Rekap Harian -->
     <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 rounded-2xl relative">
        <button onclick="toggleDropdown()" class="flex items-center space-x-4 w-full focus:outline-none">
            <i class="fas fa-folder-open"></i> <!-- Rekap Icon -->
            <span>Rekap</span>
            <i class="fas fa-chevron-down ml-auto"></i> <!-- Dropdown Icon -->
        </button>
        <ul id="rekapDropdown" class="absolute left-0 mt-2 bg-indigo-950 rounded-2xl hidden">
            <li class="px-6 py-2 hover:bg-yellow-400 hover:text-black rounded-2xl {{ request()->is('rekaplaporan') ? 'bg-neon text-black' : '' }}">
                <a href="/rekaplaporan" class="flex items-center space-x-4">
                    <i class="fas fa-folder-open"></i> <!-- Rekap Laporan Icon -->
                    <span>Rekap Laporan</span>
                </a>
            </li>
            <li class="px-6 py-2 hover:bg-yellow-400 hover:text-black rounded-2xl {{ request()->is('rekapday') ? 'bg-neon text-black' : '' }}">
                <a href="/rekapday" class="flex items-center space-x-4">
                    <i class="fas fa-calendar-day"></i> <!-- Rekap Harian Icon -->
                    <span>Rekap Harian</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
</div>

<!-- End Sidebar -->


        <!--  Konten -->
        <div class="flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8 text-black">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <!-- untuk memasukan main conten -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function toggleDropdown() {
        const dropdown = document.getElementById("rekapDropdown");
        dropdown.classList.toggle("hidden"); // Toggle class "hidden" to show/hide
    }

    // Optional: Close dropdown if clicking outside of it
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById("rekapDropdown");
        const button = dropdown.previousElementSibling;
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add("hidden");
        }
    });
</script>

</body>
</html>
