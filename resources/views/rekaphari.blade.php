@extends('layouts.app')

@section('content')

<!-- Search Form -->
<div class="flex justify-center mb-4">
    <form method="GET" action="{{ route('rekaphari') }}" class="flex space-x-2">
        <input type="text" name="search" placeholder="Search jenis pengaduan..."
               value="{{ request('search') }}"
               class="p-2 border border-gray-300 rounded">
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Search</button>
    </form>
</div>

<!-- Display Cards -->
<div class="flex justify-center ms-10">
    <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($statuesJenis as $id => $rekaps)
            <div class="flex flex-col p-8 bg-white shadow-md rounded-lg">
                <!-- Display jenis name -->
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

@endsection
