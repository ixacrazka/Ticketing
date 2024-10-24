@extends('layouts.app')     <!--MENGGUNAKAN LAYOUT DARI APP DI FOLDER LAYOUT-->
@section('content')         <!--Menentukan bagian konten yang akan ditampilkan-->

    <div class="flex">
        <div class="flex-1 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="p-4 mb-4 text-white bg-green-500 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('jenis.create') }}" class="inline-block px-4 py-3 mb-6 font-bold text-white bg-black border border-gray-700 hover:bg-gray-700 focus:outline-none rounded-3xl">Tambah Jenis Pengaduan</a>
                <div class="overflow-hidden">
                    <div class="p-6 text-black">
                        <table class="min-w-full overflow-hidden bg-white rounded-3xl shadow-md">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Jenis Pengaduan</th>
                                    <th class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jenis as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->jenis_pengaduan }}</td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <!-- Tombol Action-->
                                        <!-- Tombol untuk akses halaman edit -->
                                         <form action="{{ route('jenis.edit', $item->id) }}"class="inline-block">
                                         @csrf
                                             <button class="px-4 py-2 text-white bg-purpneo rounded-3xl hover:text-neon font-bold hover:scale-105 transition-transform duration-300">Edit</button>
                                         </form>
                                            <!-- Button Delete -->
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="px-4 py-2 text-white bg-redneo rounded-3xl shadow-lg hover:text-neon font-bold hover:scale-105 transition-transform duration-300" onclick="confirmDelete('{{ $item->id }}')">Hapus</button>
                                            </form>
                                            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                            <h2 class="text-lg font-bold text-red-600">Apakah kamu yakin ingin menghapus data ini?</h2>
                                            <div class="mt-4 flex justify-end space-x-4">
                                                    <button onclick="cancelDelete()" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">Batal</button>
                                                    <button id="confirmDeleteBtn" class="px-4 py-2 bg-redneo text-white rounded-lg hover:bg-red-600">Hapus</button>
                                                </div>
                                            </div>
                                            <!-- End Button Delete -->
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
        <!-- Function Click Delete Modals     -->
    <script>
    function confirmDelete(pelaporId) {
    event.preventDefault();
    document.getElementById('deleteModal').classList.remove('hidden');

    document.getElementById('confirmDeleteBtn').onclick = function () {
        document.getElementById('delete-form-' + pelaporId).submit();
    };
}

function cancelDelete() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection
