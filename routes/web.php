<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\User\TransaksiController as UserTransaksiController;
use App\Http\Controllers\User\TarikController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;

// Rute default: Tampilkan halaman welcome sebelum login
// Jika sudah login, arahkan ke dashboard sesuai role
Route::get('/', function () {
    // Jika sudah login, arahkan ke dashboard sesuai role
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return view('welcome');
});

// Grup Rute Admin
// Semua rute di dalam grup ini akan dilindungi oleh middleware 'auth' dan 'no.cache'
Route::prefix('admin')->name('admin.')->middleware(['auth', 'no.cache'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // CRUD Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::get('/nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::get('/nasabah/{id}/edit', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::put('/nasabah/{id}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
    Route::get('/nasabah/export/pdf', [NasabahController::class, 'exportPdf'])->name('nasabah.exportPdf');

    // CRUD Sampah
    Route::get('/sampah', [SampahController::class, 'index'])->name('sampah.index');
    Route::get('/sampah/create', [SampahController::class, 'create'])->name('sampah.create');
    Route::post('/sampah/store', [SampahController::class, 'store'])->name('sampah.store');
    Route::get('/sampah/{id}/edit', [SampahController::class, 'edit'])->name('sampah.edit');
    Route::put('/sampah/{id}', [SampahController::class, 'update'])->name('sampah.update');
    Route::delete('/sampah/{id}', [SampahController::class, 'destroy'])->name('sampah.destroy');
    Route::get('/sampah/export/pdf', [SampahController::class, 'exportPdf'])->name('sampah.exportPdf');

    // CRUD Transaksi Setor
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/export/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.exportPdf');

    // CRUD Transaksi Tarik
    Route::get('/transaksi-tarik', [\App\Http\Controllers\Admin\TransaksiTarikController::class, 'index'])->name('transaksi_tarik.index');
    Route::get('/transaksi-tarik/create', [\App\Http\Controllers\Admin\TransaksiTarikController::class, 'create'])->name('transaksi_tarik.create');
    Route::post('/transaksi-tarik/store', [\App\Http\Controllers\Admin\TransaksiTarikController::class, 'store'])->name('transaksi_tarik.store');
    Route::get('/transaksi-tarik/export/pdf', [\App\Http\Controllers\Admin\TransaksiTarikController::class, 'exportPdf'])->name('transaksi_tarik.exportPdf');
    // Route download nota PDF
    Route::get('/transaksi-tarik/nota/{filename}', [\App\Http\Controllers\Admin\TransaksiTarikController::class, 'downloadNota'])->name('transaksi_tarik.downloadNota');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/setor', [LaporanController::class, 'laporanSetor'])->name('laporan.laporan_setor');
    Route::get('/laporan/setor/pdf', [LaporanController::class, 'laporanSetorPdf'])->name('laporan.laporan_setor.pdf');
    Route::get('/laporan/tarik', [LaporanController::class, 'laporanTarik'])->name('laporan.laporan_tarik');
    Route::get('/laporan/tarik/pdf', [LaporanController::class, 'laporanTarikPdf'])->name('laporan.laporan_tarik.pdf');

    // Route download nota setor PDF (harus di dalam grup admin, bukan di grup user)
    Route::get('/transaksi/nota/{filename}', [TransaksiController::class, 'downloadNota'])->name('transaksi.downloadNota');
});

// Auth universal (admin & user)
// Tambahkan middleware 'no.cache' ke rute login GET
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('no.cache');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// Route dashboard admin (khusus admin)
// Tambahkan middleware 'no.cache' di sini juga jika rute ini adalah rute utama dashboard admin
Route::middleware(['auth', 'no.cache'])->group(function() {
    Route::get('/admin/dashboard', function() {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return app(\App\Http\Controllers\Admin\DashboardController::class)->index();
    })->name('admin.dashboard');
});


// Route dashboard user (khusus nasabah)
// Tambahkan middleware 'no.cache' di sini juga
Route::middleware(['auth', 'no.cache'])->group(function() {
    Route::get('/user/dashboard', function() {
        if (auth()->user()->role !== 'nasabah') {
            abort(403, 'Unauthorized');
        }
        return app(\App\Http\Controllers\User\DashboardController::class)->index();
    })->name('user.dashboard');
    // Tambahkan route riwayat transaksi user
    Route::get('/user/transaksi', [UserTransaksiController::class, 'index'])->name('user.transaksi.index');
    // Tambahkan route setor sampah user
    Route::get('/user/setor', [TarikController::class, 'index'])->name('user.setor.index');
    // ...tambahkan route user lain jika perlu
});
