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
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table id="idpelaporTable" class="min-w-full overflow-hidden rounded-3xl shadow-lg">
                            <thead class="bg-gray-200 text-black">
                                <tr>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">No. HP</th>
                                    <th class="px-4 py-2 border">Nama Pelapor</th>
                                    <th class="px-4 py-2 border">Instansi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelapors as $pelapor)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $pelapor->email }}</td>
                                        <td class="px-4 py-2 border">{{ $pelapor->nohp }}</td>
                                        <td class="px-4 py-2 border">{{ $pelapor->npelapor }}</td>
                                        <td class="px-4 py-2 border">{{ $pelapor->instansi->nama_instansi}}</td>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#idpelaporTable').DataTable({
            paging: true,
            pageLength: 5, // Menentukan jumlah baris per halaman
            lengthMenu: [5, 25, 50, 100] // Opsi jumlah baris per halaman
        });
    });
</script>
@endsection
