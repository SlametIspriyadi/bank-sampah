<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SampahController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('/nasabah/create', [NasabahController::class, 'create'])->name('admin.nasabah.create');
    Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::get('/nasabah/{id}/edit', [NasabahController::class, 'edit'])->name('admin.nasabah.edit');

    // CRUD Sampah
    Route::get('/sampah', [SampahController::class, 'index'])->name('admin.sampah.index');
    Route::get('/sampah/create', [SampahController::class, 'create'])->name('admin.sampah.create');
    Route::post('/sampah/store', [SampahController::class, 'store'])->name('admin.sampah.store');
    Route::get('/nasabah/{id}/edit', [NasabahController::class, 'edit'])->name('admin.sampah.edit');
    // Tambahkan update & delete jika diperlukan
    // Route::put('/nasabah/{id}', [NasabahController::class, 'update'])->name('admin.nasabah.update');
    // Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('admin.nasabah.destroy');

    Route::get('/sampah', function () {
        return view('admin.sampah.index');
    })->name('admin.sampah.index');
    Route::get('/transaksi', function () {
        return view('admin.transaksi.index');
    })->name('admin.transaksi.index');
    Route::get('/laporan', function () {
        return view('admin.laporan.index');
    })->name('admin.laporan.index');
});

Route::post('/logout', function () {
    // Auth::logout();
    // return redirect('/');
})->name('logout');
Route::resource('/sampah', SampahController::class);
    Route::get('/sampah', [SampahController::class, 'index'])->name('admin.sampah.index');
    Route::get('/sampah/create', [SampahController::class, 'create'])->name('admin.sampah.create');
    Route::post('/sampah/store', [SampahController::class, 'store'])->name('admin.sampah.store');
