<?php

use App\Http\Controllers\PelaporController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // View  Routes
    Route::get('/rekaplaporan', [PelaporController::class, 'rekaplaporan'])->middleware(['verified'])->name('rekaplaporan');
    Route::get('/dashboard', [PelaporController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/count', [PelaporController::class, 'count'])->middleware(['verified'])->name('count');
    Route::get('/pelapor', [PelaporController::class, 'pelapor'])->middleware(['verified'])->name('pelapor');
    Route::get('/aduan', [PelaporController::class, 'aduan'])->middleware(['verified'])->name('aduan');
    Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.index');
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');


    // Jenis routes Crud
    Route::get('/jenis/create', [JenisController::class, 'create'])->name('jenis.create');
    Route::post('/jenis', [JenisController::class, 'store'])->name('jenis.store');
    Route::get('/jenis/{id}/edit', [JenisController::class, 'edit'])->name('jenis.edit');
    Route::put('/jenis/{id}', [JenisController::class, 'update'])->name('jenis.update');
    Route::delete('/jenis/{id}', [JenisController::class, 'destroy'])->name('jenis.destroy');


    // Status routes Crud
    Route::post('/pelapor/{id}/update-status-keterangan', [PelaporController::class, 'updateStatusAndKeterangan'])->name('pelapor.updateStatusAndKeterangan');
    Route::get('/status/{id}/editsts', [StatusController::class, 'edit'])->name('status.edit');
    Route::put('/status/{id}', [StatusController::class, 'update'])->name('status.update');

    Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');
    Route::post('/status', [StatusController::class, 'store'])->name('status.store');
    Route::delete('/status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');


    Route::get('/filter', [PelaporController::class, 'filter'])->name('filter');
    Route::get('/export-pdf', [PelaporController::class, 'exportPdf'])->name('export.pdf');


});


    // Routes untuk Form Layanan Pemerintahan
    Route::get('/', [PelaporController::class, 'create'])->name('tambah.create');
    Route::post('/tambah/data', [PelaporController::class, 'store'])->name('tambah.store');
    Route::delete('/tambah/{id}', [PelaporController::class, 'destroy'])->name('tambah.destroy');


    // Route untuk kode antrian
    Route::get('/kodeantrian/{kode}', function ($kode) {
        return view('kodeantrian', ['kode' => $kode]);
    })->name('kodeantrian');
    //Route Cek Status

    // Route::get('/count', function()
    // {
    //     return view('count');
    // });

    //Cek Status Kode Antrian
    Route::get('/ceksts', [PelaporController::class, 'halamanStatusAntrian'])->name('cekstsget');
    Route::post('/ceksts', [PelaporController::class, 'cekStatus'])->name('ceksts');



require __DIR__ . '/auth.php';
