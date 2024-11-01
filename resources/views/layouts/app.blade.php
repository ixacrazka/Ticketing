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


    <!-- Scripts untuk Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-[Outfit] bg-gray-100">
    <div class="min-h-screen flex">
<!-- Sidebar -->
<div class="w-64 min-h-screen m-4 bg-blue-600 text-white rounded-3xl hidden md:block font-[Outfit]">
    <div class="p-4 mt-8 ml-9 ">
        <span class="text-4xl text-yellow-400 font-bold">Ticket</span><span class="text-3xl text-white font-bold">Ing</span>
    </div>
    <ul class="mt-20 text-lg mx-5 sticky top-10">
        <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 rounded-full {{ request()->is('dashboard') ? 'bg-white text-black' : '' }}">
            <a href="/dashboard" class="flex items-center space-x-4">
                <i class="fas fa-chart-line"></i> <!-- Icon -->
                <span>Laporan</span>
            </a>
        </li>
        <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('jenis') ? 'bg-white text-black' : '' }} rounded-full">
            <a href="/jenis" class="flex items-center space-x-4">
                <i class="fas fa-list"></i> <!-- Icon -->
                <span>Jenis Pengaduan</span>
            </a>
        </li>
        <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('status') ? 'bg-white text-black' : '' }} rounded-full">
            <a href="/status" class="flex items-center space-x-4">
                <i class="fas fa-info-circle"></i> <!-- Icon -->
                <span>Status</span>
            </a>
        </li>
        <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('pelapor') ? 'bg-white text-black' : '' }} rounded-full">
            <a href="/pelapor" class="flex items-center space-x-4">
                <i class="fas fa-user"></i> <!-- Icon -->
                <span>Identitas Pelapor</span>
            </a>
        </li>
        <li class="px-6 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('aduan') ? 'bg-white text-black' : '' }} rounded-full">
            <a href="/aduan" class="flex items-center space-x-4">
                <i class="fas fa-exclamation-circle"></i> <!-- Icon -->
                <span>Aduan Error</span>
            </a>
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
</body>
</html>
