<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Admin-Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Data Table search dan Pagination     -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Outfit] bg-gray-100">
    <div class="min-h-screen flex">
<!-- Sidebar -->
<div class="w-64 min-h-screen m-4 bg-indigo-950 text-white rounded-3xl hidden md:block font-[Outfit]">
    <div class="p-4 mt-8 ml-9">
        <span class="text-4xl text-yellow-400 font-bold">Ticket</span><span class="text-3xl text-white font-bold">Ing</span>
    </div>
    <ul class="mt-20 text-lg mx-5 sticky top-10">
    <li class="px-4 py-2 hover:scale-105 transition-transform duration-300 rounded-full {{ request()->is('dashboard') ? 'bg-neon text-black' : '' }}">
        <a href="/dashboard" class="flex items-center space-x-4">
            <span>Laporan Error</span>
        </a>
    </li>
    <li class="px-4 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('jenis') ? 'bg-neon text-black' : '' }} rounded-full">
        <a href="/jenis" class="flex items-center space-x-4">
            <span>Jenis Pengaduan</span>
        </a>
    </li>
    <li class="px-4 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('status') ? 'bg-neon text-black' : '' }} rounded-full">
        <a href="/status" class="flex items-center space-x-4">
            <span>Status</span>
        </a>
    </li>
    <li class="px-4 py-2 hover:scale-105 transition-transform duration-300 {{ request()->is('pelapor') ? 'bg-neon text-black' : '' }} rounded-full">
        <a href="/pelapor" class="flex items-center space-x-4">
            <span>Identitas Pelapor</span>
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

            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
