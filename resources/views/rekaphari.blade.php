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

            <!-- Grid untuk menampilkan kartu berdasarkan jenis -->
            <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($statuesJenis as $id => $rekaps)
                <div class="flex flex-col p-8 bg-white shadow-md rounded-lg">
                    <!-- Menampilkan nama jenis -->
                    <div class="text-xl font-bold text-[#374151] pb-6">{{ $rekaps['jenis_pengaduan'] }}</div>
                    <div class="flex flex-col space-y-2 text-lg text-[#374151]">
                        <div>Dikonfirmasi: {{ $rekaps['Dikonfirmasi'] }}</div>
                        <div>Ditolak: {{ $rekaps['Ditolak'] }}</div>
                        <div>Diproses: {{ $rekaps['Diproses'] }}</div>
                        <div>Menunggu Konfirmasi: {{ $rekaps['Menunggu Konfirmasi'] }}</div>
                        <div>Selesai: {{ $rekaps['Selesai'] }}</div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
