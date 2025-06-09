<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\User\TransaksiController as UserTransaksiController;
use App\Http\Controllers\User\SetorController;

// Rute default: Mengarahkan dari URL root '/' ke halaman login
// Ini akan memastikan saat aplikasi diakses, langsung menuju ke form login.
Route::get('/', function () {
    return redirect()->route('login');
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

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
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
    Route::get('/user/setor', [SetorController::class, 'index'])->name('user.setor.index');
    // ...tambahkan route user lain jika perlu
});
