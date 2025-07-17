<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiTarik;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;

class TransaksiTarikController extends Controller
{
    /**
     * Menampilkan halaman utama dengan riwayat dan form pencarian.
     */
    public function index(Request $request)
    {
        $nasabah = null;
        $saldoAkhir = 0; // Tetap kirim variabel ini agar view tidak error

        if ($request->filled('no_reg')) {
            $nasabah = User::where('no_reg', $request->no_reg)->where('role', 'nasabah')->first();
            if ($nasabah) {
                // Panggil accessor saldo yang sudah kita buat di Model User
                $saldoAkhir = $nasabah->saldo_tersedia;
            }
        }
        
        // Ambil data riwayat penarikan dengan paginasi
        $tarik = TransaksiTarik::with('nasabah')->latest('tgl_tarik')->paginate(10);
        
        return view('admin.transaksi_tarik.index', compact('nasabah', 'saldoAkhir', 'tarik'));
    }

    /**
     * Menampilkan form untuk melakukan penarikan.
     */
    public function create(Request $request)
    {
        $request->validate(['nasabah_id' => 'required|exists:users,id']);
        $nasabah = User::findOrFail($request->nasabah_id);
        
        // Panggil accessor saldo dari Model User
        $saldoAkhir = $nasabah->saldo_tersedia;

        return view('admin.transaksi_tarik.create', compact('nasabah', 'saldoAkhir'));
    }

    /**
     * Menyimpan transaksi tarik baru dan membuat nota.
     */
    public function store(Request $request)
    {
       // 1. Validasi input dari form
    $validated = $request->validate([
        'nasabah_id' => 'required|exists:users,id',
        'tgl_tarik' => 'required|date',
        'jumlah_tarik' => 'required|numeric|min:1',
        'keterangan' => 'nullable|string',
    ]);

    $nasabah = User::findOrFail($validated['nasabah_id']);
    
    // 2. Cek apakah saldo mencukupi
    $saldoTersedia = $nasabah->saldo_tersedia;
    if ($validated['jumlah_tarik'] > $saldoTersedia) {
        // Jika tidak cukup, kembalikan dengan pesan error
        return back()->withErrors(['jumlah_tarik' => 'Saldo tidak mencukupi. Saldo tersedia: Rp' . number_format($saldoTersedia, 0, ',', '.')])->withInput();
    }

    // 3. Simpan transaksi tarik ke database
    $trx = TransaksiTarik::create($validated);

    // 4. Siapkan data yang akan dicetak di nota
    $trx->load('nasabah'); // Memuat relasi nasabah untuk data yang update
    $pdfData = [
        'trx' => $trx,
        'nasabah' => $nasabah,
        'saldoAkhir' => $saldoTersedia - $trx->jumlah_tarik // Hitung sisa saldo
    ];

    // 5. Buat objek PDF dari view
    $pdf = Pdf::loadView('admin.transaksi_tarik.nota', $pdfData);

    // 6. Buat nama file yang konsisten dan simpan PDF ke storage
    $filename = 'nota_tarik_' . $trx->id_tarik . '.pdf';
    $path = 'nota/' . $filename;
    Storage::disk('public')->put($path, $pdf->output());

    // 7. Redirect kembali ke halaman index dengan pesan sukses dan nama file nota
    return redirect()->route('admin.transaksi_tarik.index')
        ->with('success', 'Penarikan saldo berhasil.')
        ->with('nota_filename', $filename); // Kirim nama file, bukan URL
    }

    /**
     * Mengunduh file nota yang sudah dibuat.
     */
    public function downloadNota($filename)
    {
        $safeFilename = basename($filename);
        $path = storage_path('app/public/nota/' . $safeFilename);

        if (!file_exists($path)) {
            abort(404, 'File nota tidak ditemukan.');
        }
        return response()->download($path);
    }

    // ... (method exportPdf Anda bisa disederhanakan dengan Eloquent juga) ...
}