@extends('layouts.app')

@section('content')
<!-- Alert -->
<div class="flex">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 roun   ded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 ml-8">
                <!-- Card for Total Pelapor -->
                <div class="bg-white p-16 w-96 rounded-3xl shadow-md">
                    <h2 class="text-3xl font-semibold">Total Pelapor</h2>
                    <p class="text-4xl font-bold mt-10 m-4">{{ $totalPelapor }}</p>
                </div>

                <!-- Card for Total Status Counts -->
                <div class="bg-white p-5 w-96 rounded-3xl shadow-md mx-20">
                    <h2 class="text-2xl font-semibold">Total Status</h2>
                    <p class="">Ditolak: {{ $totalStatusDitolak }}</p>
                    <p class="">Dikonfirmasi: {{ $totalStatusDikonfirmasi }}</p>
                    <p class="">Diproses: {{ $totalStatusDiproses }}</p>
                    <p class="">Selesai: {{ $totalStatusSelesai }}</p>
                    <p class="">Menunggu Konfirmasi: {{ $totalStatusMenungguKonfirmasi }}</p>
                </div>

                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>
</div>

@endsection
