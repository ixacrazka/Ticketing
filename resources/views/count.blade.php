@extends('layouts.app')

@section('content')

<!-- Alert -->
<div class="flex">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="bg-white p-16 w-96 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold">Total Pelapor</h2>
                    <p class="text-3xl font-bold mt-10 m-4">5</p>
                </div>
                <div class="bg-white p-16 w-96 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold">Total Status</h2>
                    <p class="">Ditolak:</p>
                    <p class="">Dikonfirmasi:</p>
                    <p class="">Diproses:</p>
                    <p class="">Selesai:</p>
                    <p class="">Menunggu Konfirmasi:</p>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>
</div>

@endsection
