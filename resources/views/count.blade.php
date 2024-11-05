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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">Total Reports</h2>
                    <p class="text-3xl font-bold"></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">Total Users</h2>
                    <p class="text-3xl font-bold"></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">Total Statuses</h2>
                    <p class="text-3xl font-bold"></p>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>
</div>

@endsection
