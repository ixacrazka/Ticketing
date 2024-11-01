@extends('layouts.app')

@section('content')

 <!-- Aleert -->
<div class="flex">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-white bg-green-500 rounded">
                    {{ session('success') }}
                </div>
            @endif
 <!-- Aleert -->

            <!--TABEL PELAPORAN  -->
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
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Foto Error</th>
                                <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Actions</th>
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
                                    <td class="px-4 py-2">
                                        @if ($pelapor->pengaduan && $pelapor->pengaduan->file_foto)
                                            <img src="{{ asset('uploads/file_foto/' . $pelapor->pengaduan->file_foto) }}" alt="Foto Pelapor" class="w-20 h-20 cursor-pointer" onclick="document.getElementById('modal-{{ $pelapor->id }}').showModal()">

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
                                    <td class="px-4 py-2">
                                        <div class="inline-flex space-x-2">
                                            <button onclick="openStatusModal('{{ $pelapor->id }}')" class="px-4 py-2 text-white bg-purpneo rounded-3xl hover:text-neon font-bold hover:scale-105 transition-transform duration-300 w-32">Ubah Status</button>
                                            <form id="delete-form-{{ $pelapor->id }}" action="{{ route('tambah.destroy', $pelapor->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="px-4 py-2 text-white bg-redneo rounded-3xl shadow-lg hover:text-neon font-bold hover:scale-105 transition-transform duration-300 w-32" onclick="confirmDelete('{{ $pelapor->id }}')">Hapus</button>
                                            </form>
                                        </div>


                                        <!-- MODAL DELETE -->
                                        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                                <h2 class="text-lg font-bold">Konfirmasi Penghapusan</h2>
                                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                <div class="mt-4 flex justify-end space-x-4">
                                                    <button type="button" onclick="cancelDelete()" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">Batal</button>
                                                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END MODAL DELETE -->


                                        <!-- MODAL UBAH STATUS -->
                                        <div id="statusModal-{{ $pelapor->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                                <h2 class="text-lg font-bold">Ubah Status untuk {{ $pelapor->npelapor }}</h2>
                                                <form action="{{ route('pelapor.updateStatus', $pelapor->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mt-4">
                                                        <label for="status" class="block text-sm font-medium">Pilih Status:</label>
                                                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-[Outfit]">
                                                        @foreach($statues as $sts)
                                                            <option value="{{ $sts->id }}" {{ $pelapor->pengaduan && $pelapor->pengaduan->status_id == $sts->id ? 'selected' : '' }}>
                                                                {{ $sts->name }}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mt-4 flex justify-end space-x-4">
                                                        <button type="button" onclick="closeStatusModal('{{ $pelapor->id }}')" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">Batal</button>
                                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Untuk Modal Update -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TABEL PELAPORAN  -->
    </div>

    <script>
    //Code untuk Data Tables
    $(document).ready(function() {
        $('#pelaporTable').DataTable({
            paging: true,
            pageLength: 5, // Menentukan jumlah baris per halaman
            lengthMenu: [5, 25, 50, 100] // Opsi jumlah baris per halaman
        });
    });
    //End code untuk Data Tables

    //Funnction untuk menampilakan mdoals hapus
    function confirmDelete(pelaporId) {
        event.preventDefault();  // Mencegah form submit langsung
        document.getElementById('deleteModal').classList.remove('hidden');

        document.getElementById('confirmDeleteBtn').onclick = function () {
            document.getElementById('delete-form-' + pelaporId).submit();
        };
    }

    function cancelDelete() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    //End Funnction untuk menampilakan mdoals hapus

    // Functions Untuk Menampilkan Modal Status
    function openStatusModal(pelaporId) {
        document.getElementById('statusModal-' + pelaporId).classList.remove('hidden');
    }

    function closeStatusModal(pelaporId) {
        document.getElementById('statusModal-' + pelaporId).classList.add('hidden');
    }
    // End Functions Untuk Status Modal
</script>
@endsection
