@extends('layouts.app')     <!--MENGGUNAKAN LAYOUT DARI APP DI FOLDER LAYOUT -->
@section('content')         <!-- menentukan bagian konten yang akan ditampilkan -->

<div class="flex items-center justify-center mt-20 bg-gray-100">
    <div class="w-full max-w-2xl p-10 px-10 py-16 bg-indigo-950 rounded-3xl shadow-lg mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center text-white">Edit Status</h1>

        <form action="{{ route('status.update', $status->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-white">Status</label>
                <input type="text" name="status" id="status" value="{{ old('name', $status->name) }}" class="w-full p-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-neon focus:border-neon" required>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="w-full px-4 py-3 text-black transition duration-200 bg-white border border-black rounded-md hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-blackz focus:ring-opacity-50">
                    Edit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
