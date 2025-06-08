<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;

Route::prefix('admin')->name('admin.')->group(function () {
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

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

Route::post('/logout', function () {
    // Auth::logout();
    // return redirect('/');
})->name('logout');
    // Route::resource('/sampah', SampahController::class);
    // Route::get('/sampah', [SampahController::class, 'index'])->name('admin.sampah.index');
    // Route::get('/sampah/create', [SampahController::class, 'create'])->name('admin.sampah.create');
    // Route::post('/sampah/store', [SampahController::class, 'store'])->name('admin.sampah.store');

    // Route::resource('/transaksi', TransaksiController::class);
    // Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    // Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    // Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    //  // CRUD Transaksi Setor
    // //  Route::resource('/transaksi', TransaksiController::class);
    //  Route::get('/transaksi/index', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    // Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    // Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('admin.transaksi.store');