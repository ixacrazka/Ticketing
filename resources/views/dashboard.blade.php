@extends('layouts.app')  <!-- Menggunakan layout utama aplikasi -->
@section('content')  <!-- Menentukan bagian konten yang akan ditampilkan -->

<div class="flex">
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="p-4 mb-4 text-white bg-green-500 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-scroll">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full overflow-hidden border border-black rounded-3xl shadow-lg">
                                <thead class="bg-gray-200 text-black">
                                    <tr>
                                        <th class="px-4 py-2 border">Email</th>
                                        <th class="px-4 py-2 border">No. HP</th>
                                        <th class="px-4 py-2 border">Nama Pelapor</th>
                                        <th class="px-4 py-2 border">Nama Aplikasi</th>
                                        <th class="px-4 py-2 border">Laporan Error</th>
                                        <th class="px-4 py-2 border">Status</th>
                                        <th class="px-4 py-2 border">Foto Error</th>
                                        <th class="px-4 py-2 border">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelapors as $pelapor)
                                        <tr>
                                            <td class="px-4 py-2 border">{{ $pelapor->email }}</td>
                                            <td class="px-4 py-2 border">{{ $pelapor->nohp }}</td>
                                            <td class="px-4 py-2 border">{{ $pelapor->npelapor }}</td>
                                            <td class="px-4 py-2 border">{{ $pelapor->pengaduan->naplikasi ?? 'data-tidak-ditemukan' }}</td>
                                            <td class="px-4 py-2 border">{{ $pelapor->pengaduan->laporan ?? 'data-tidak-ditemukan' }}</td>
                                            <td class="px-4 py-2 border">{{ $pelapor->pengaduan->status->name ?? 'data-tidak-ditemukan' }}</td>
                                            <td class="px-4 py-2 border">
                                                @if ($pelapor->pengaduan && $pelapor->pengaduan->file_foto)
                                                    <img src="{{ asset('uploads/file_foto/' . $pelapor->pengaduan->file_foto) }}" alt="Foto Pelapor" class="w-20 h-20 cursor-pointer" onclick="document.getElementById('myModal').showModal()">
                                                    <dialog id="myModal" class="modal">
                                                        <div class="modal-box">
                                                            <div class="modal-action float-end">
                                                                <button class="btn text-3xl" onclick="document.getElementById('myModal').close()">X</button>
                                                            </div>
                                                            <img src="{{ asset('uploads/file_foto/' . $pelapor->pengaduan->file_foto) }}" alt="Foto Pelapor Full" class="w-full h-auto">
                                                        </div>
                                                    </dialog>
                                                @else
                                                    <span>data-tidak-ditemukan</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <div class="inline-flex space-x-2">
                                                    <!-- Ubah Status Button -->

                                                        <button onclick="openStatusModal('{{ $pelapor->id }}')" class="px-4 py-2 text-white bg-purpneo rounded-3xl hover:text-neon font-bold hover:scale-105 transition-transform duration-300">Ubah Status</button>
                                                    <!-- End Ubah Status -->

                                                    <!-- Button Delete -->
                                                    <form id="delete-form-{{ $pelapor->id }}" action="{{ route('tambah.destroy', $pelapor->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="px-6 py-2 text-white bg-redneo rounded-3xl shadow-lg hover:text-neon font-bold hover:scale-105 transition-transform duration-300" onclick="confirmDelete('{{ $pelapor->id }}')">Hapus</button>
                                                    </form>
                                                    <!-- End Button Delete -->
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
                                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- End MODAL UBAH STATUS -->

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

    <!-- Function Click Delete Modals -->
    <script>
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
        //END Function Click Delete Modals

        // Functions for Status Modal
        function openStatusModal(pelaporId) {
            document.getElementById('statusModal-' + pelaporId).classList.remove('hidden');
        }

        function closeStatusModal(pelaporId) {
            document.getElementById('statusModal-' + pelaporId).classList.add('hidden');
        }
    </script>
@endsection
