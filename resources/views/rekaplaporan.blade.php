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

            <!-- Export Button -->
            <div class="flex justify-end mb-4">
                <form action="" method="GET">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Export to PDF
                    </button>
                </form>
            </div>

            <!-- TABEL PELAPORAN -->
            <div class="overflow-hidden">
                <div class="p-6 text-black">
                    <table id="pelaporTable" class="min-w-full rounded-3xl shadow-lg overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Email</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">No. HP</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Nama Pelapor</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Nama Aplikasi</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Laporan Error</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pelapors as $pelapor)
                                <tr>
                                    <td class="px-4 py-2">{{ $pelapor->email }}</td>
                                    <td class="px-4 py-2">{{ $pelapor->nohp }}</td>
                                    <td class="px-4 py-2">{{ $pelapor->npelapor }}</td>
                                    <td class="px-4 py-2">{{ $pelapor->pengaduan->naplikasi ?? 'data-tidak-ditemukan' }}</td>
                                    <td class="px-4 py-2">{{ $pelapor->pengaduan->laporan ?? 'data-tidak-ditemukan' }}</td>
                                    <td class="px-4 py-2">{{ $pelapor->pengaduan->status->name ?? 'data-tidak-ditemukan' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
