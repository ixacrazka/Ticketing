@extends('layouts.app')

@section('content')

<!-- Alert -->
<div class="flex">
    <div class="py-1">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 rounded">
                    {{ session('success') }}
                </div>
            @endif

                <div class="grid grid-cols-1 px-10 sm:grid-cols-2 lg:grid-cols-3 gap-6 mx-4 my-4 shadow-xl rounded-3xl bg-gray-200">
                <!-- Card for Total Pelapor -->
                <div class="h-fit bg-neon text-slate-700 p-6 sm:p-10 rounded-3xl shadow-md text-center border-2 border-gray-300 my-6">
                    <h2 class="text-xl sm:text-4xl font-semibold">Total Pelapor</h2>
                    <p class="text-xl sm:text-5xl font-bold mt-6">{{ $totalPelapor }}</p>
                </div>

                <!-- Card for Total Status Counts -->
                <div class="h-fit w-[600px] py-10 bg-white sm:p-10 rounded-3xl shadow-md mx-4 sm:mx-0 border-2 border-gray-300 my-6">
                    <h2 class="text-4xl sm:text-3xl font-semibold">Total Status</h2>

                    <!-- Flex Layout for Total Status with horizontal items -->
                    <div class="grid grid-cols-4 gap-4 mt-6 justify-start">
                        <div class="grid items-center">
                            <p class="font-semibold">Ditolak</p>
                            <p class="font-bold rounded-xl p-5 bg-neon">{{ $totalStatusDitolak }}</p>
                        </div>
                        <div class="grid items-center">
                            <p class="font-semibold">Dikonfirmasi</p>
                            <p class="font-bold rounded-xl p-5 bg-neon">{{ $totalStatusDikonfirmasi }}</p>
                        </div>
                        <div class="grid items-center">
                            <p class="font-semibold">Diproses</p>
                            <p class="font-bold rounded-xl p-5 bg-neon">{{ $totalStatusDiproses }}</p>
                        </div>
                        <div class="grid items-center">
                            <p class="font-semibold">Selesai</p>
                            <p class="font-bold rounded-xl p-5 bg-neon">{{ $totalStatusSelesai }}</p>
                        </div>
                        <div class="grid items-center">
                            <p class="font-semibold">Menunggu Konfirmasi</p>
                            <p class="font-bold rounded-xl p-5 bg-neon">{{ $totalStatusMenungguKonfirmasi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABEL PELAPORAN -->
            <div class="overflow-x-auto bg-gray-200 py-5 rounded-3xl shadow-xl mt-8">
                <div class=" text-black">
                    <table id="pelaporTable" class="min-w-full">
                        <thead class="bg-gray-200 rounded-3xl text- s font-semibold text-gray-700 uppercase">
                            <tr>
                                <th class="px-3 py-2">Email</th>
                                <th class="px-3 py-2">No. HP</th>
                                <th class="px-3 py-2">Nama Pelapor</th>
                                <th class="px-3 py-2">Nama Aplikasi</th>
                                <th class="px-3 py-2">Laporan Error</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Keterangan</th>
                                <th class="px-3 py-2">Foto Error</th>
                                <th class="px-3 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-sm">
                            @foreach($pelapors as $pelapor)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-3 py-2">{{ $pelapor->email }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->nohp }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->npelapor }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->pengaduan->naplikasi ?? 'data-tidak-ditemukan' }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->pengaduan->laporan ?? 'data-tidak-ditemukan' }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->pengaduan->status->name ?? 'Menunggu Admin Mengubah Status' }}</td>
                                    <td class="px-3 py-2">{{ $pelapor->pengaduan->keterangan ?? 'data-tidak-ditemukan' }}</td>
                                    <td class="px-3 py-2">
                                        @if ($pelapor->pengaduan && $pelapor->pengaduan->file_foto)
                                            <img src="{{ asset('uploads/file_foto/' . $pelapor->pengaduan->file_foto) }}" alt="Foto Pelapor" class="w-16 h-16 cursor-pointer" onclick="document.getElementById('modal-{{ $pelapor->id }}').showModal()">
                                            <dialog id="modal-{{ $pelapor->id }}" class="modal">
                                                <div class="flex justify-center items-center">
                                                    <button class="absolute top-0 right-0 m-4 text-2xl bg-gray-700 text-white px-2 py-1 rounded-full" onclick="document.getElementById('modal-{{ $pelapor->id }}').close()">×</button>
                                                    <img src="{{ asset('uploads/file_foto/' . $pelapor->pengaduan->file_foto) }}" alt="Foto Pelapor Full" class="w-1/2 h-auto">
                                                </div>
                                            </dialog>
                                        @else
                                            <span>data-tidak-ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="inline-flex space-x-2">
                                            <button onclick="openStatusModal('{{ $pelapor->id }}')" class="flex items-center px-3 py-1 text-black bg-neon rounded-lg hover:text-black hover:scale-105 transition-transform duration-300">
                                                <i class="fas fa-edit mr-1"></i> Ubah Status
                                            </button>
                                            <form id="delete-form-{{ $pelapor->id }}" action="{{ route('tambah.destroy', $pelapor->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="flex items-center px-3 py-4 text-black text-white bg-[#FF0000] rounded-xl hover:scale-105 transition-transform duration-300" onclick="confirmDelete('{{ $pelapor->id }}')">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END TABEL PELAPORAN -->
        </div>
    </div>
</div>

<script>
    // DataTables integration
    $(document).ready(function() {
        $('#pelaporTable').DataTable({
            paging: true,
            pageLength: 5,
            lengthMenu: [5, 25, 50, 100]
        });
    });

    // Function to display delete confirmation modal
    function confirmDelete(pelaporId) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('confirmDeleteBtn').onclick = function() {
            document.getElementById('delete-form-' + pelaporId).submit();
        };
    }

    // Function to cancel delete
    function cancelDelete() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Function to show status modal
    function openStatusModal(pelaporId) {
        document.getElementById('statusModal-' + pelaporId).classList.remove('hidden');
    }

    // Function to close status modal
    function closeStatusModal(pelaporId) {
        document.getElementById('statusModal-' + pelaporId).classList.add('hidden');
    }
</script>

@endsection
