@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="flex-1 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden">
                <div class="p-8 overflow-x-auto text-black">
                    <table id="idaduanTable" class="min-w-full overflow-hidden bg-white rounded-3xl shadow-lg">
                        <thead class="bg-gray-200 text-black">
                            <tr>
                                <th class="px-8 py-4 text-lg font-semibold text-left border">Nama Aplikasi</th>
                                <th class="px-8 py-4 text-lg font-semibold text-left border">Laporan</th>
                                <th class="px-8 py-4 text-lg font-semibold text-left border">Jenis</th>
                                <th class="px-8 py-4 text-lg font-semibold text-left border">Kode Antrian</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pelapors as $aduan)
                                <tr>
                                    <td class="px-8 py-6 text-base text-gray-900 whitespace-nowrap border">{{ $aduan->pengaduan->naplikasi }}</td>
                                    <td class="px-8 py-6 text-base text-gray-900 whitespace-nowrap border">{{ $aduan->pengaduan->laporan }}</td>
                                    <td class="px-8 py-6 text-base text-gray-900 whitespace-nowrap border">{{ $aduan->pengaduan->jenis->jenis_pengaduan }}</td>
                                    <td class="px-8 py-6 text-base text-gray-900 whitespace-nowrap border">{{ $aduan->pengaduan->kode }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#idaduanTable').DataTable({
            paging: true,
            pageLength: 5,
            lengthMenu: [5, 25, 50, 100]
        });
    });
</script>
@endsection
