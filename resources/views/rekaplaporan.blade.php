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

            <!-- Date Filter and Export Button -->
            <div class="flex justify-between mb-4">
                <form action="{{ route('filter') }}" method="GET" class="flex space-x-4">
                    <input type="date" name="start_date" class="px-4 py-2 border rounded" placeholder="Start Date">
                    <input type="date" name="end_date" class="px-4 py-2 border rounded" placeholder="End Date">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Filter
                    </button>
                </form>

                <!-- Export Button -->
                <form action="{{ route('export.pdf') }}" method="GET">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Export to PDF
                    </button>
                </form>
            </div>

            <!-- TABEL PELAPORAN -->
            <div class="overflow-scroll">
                <div class="p-6 text-black">
                <table id="pelaporTable" class="min-w-full rounded-3xl shadow-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Nama Petugas</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Email</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">No. HP</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Nama Pelapor</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Nama Aplikasi</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Laporan Error</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Status</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Keterangan</th>
                            <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pelapors as $pelapor)
                            <tr>
                                <td class="px-2 py-1 text-sm">{{ Auth::user()->name }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->email }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->nohp }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->npelapor }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->pengaduan->naplikasi ?? 'data-tidak-ditemukan' }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->pengaduan->laporan ?? 'data-tidak-ditemukan' }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->pengaduan->status->name ?? 'data-tidak-ditemukan' }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->pengaduan->keterangan ?? 'data-tidak-ditemukan' }}</td>
                                <td class="px-2 py-1 text-sm">{{ $pelapor->pengaduan->created_at ?? 'data-tidak-ditemukan' }}</td>
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
