<?php

namespace App\Http\Controllers\Admin; // Pastikan namespace Anda benar

use App\Http\Controllers\Controller; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Penting untuk mencatat error
use App\Models\User;
use App\Models\Sampah;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
     private function buildTransaksiQuery(Request $request)
    {
        // Memulai query dengan eager loading relasi nasabah
        $query = Transaksi::with('nasabah');

        // Filter berdasarkan Nomor Registrasi Nasabah
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function ($q) use ($request) {
                $q->where('no_reg', 'like', '%' . $request->no_reg . '%');
            });
        }

        // Filter berdasarkan Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_setor', $request->bulan);
        }

        // Filter berdasarkan Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_setor', $request->tahun);
        }

        return $query;
    }

    

    /**
     * Menampilkan halaman utama transaksi dengan data yang dipaginasi.
     */
    public function index(Request $request)
    {
        
    $nasabah = null;
    if ($request->filled('no_reg')) {
        $nasabah = User::where('no_reg', $request->no_reg)
                     ->where('role', 'nasabah')
                     ->first();
    }
    
    // Kita tidak lagi mengirim data transaksi ke view ini
    return view('admin.transaksi.index', compact('nasabah'));
    }

    /**
     * Method baru untuk menangani export ke PDF.
     */
    public function exportPdf(Request $request)
    {
        // Memanggil query dasar yang sama dari method privat
        $query = $this->buildTransaksiQuery($request);

        // Mengambil SEMUA data yang cocok (tanpa paginasi) untuk PDF
        $transaksis = $query->latest('tgl_setor')->get();
        
        // Mengirim data ke view PDF
        $pdf = Pdf::loadView('admin.transaksi.pdf', [
            'transaksis' => $transaksis,
            'filters' => $request->only(['no_reg', 'bulan', 'tahun'])
        ]);
        
        // Memberi nama file dan mengunduh PDF
        return $pdf->download('laporan-transaksi-setor-' . date('Y-m-d') . '.pdf');
    }
    /**
     * Menampilkan form untuk membuat transaksi baru untuk nasabah SPESIFIK.
     */
    public function create(Request $request)
    {
        $request->validate(['nasabah_id' => 'required|exists:users,id']);
        $nasabah = User::findOrFail($request->nasabah_id);
        $sampah = Sampah::all();
        return view('admin.transaksi.create', compact('nasabah', 'sampah'));
    }

    /**
     * Menyimpan transaksi baru, mengupdate saldo, dan membuat nota PDF.
     */
   // app/Http/Controllers/Admin/TransaksiController.php

// app/Http/Controllers/Admin/TransaksiController.php

public function store(Request $request)
{
    $validated = $request->validate([
        'tgl_setor' => 'required|date',
        'nasabah_id' => 'required|exists:users,id',
        'sampah_id' => 'required|array|min:1',
        'sampah_id.*' => 'required|exists:sampahs,id',
        'berat' => 'required|array|min:1',
        'berat.*' => 'required|numeric|min:0.01',
    ]);

    DB::beginTransaction();
    try {
        $nasabah = User::findOrFail($validated['nasabah_id']);
        $totalPendapatan = 0;
        $totalKas = 0;

        $transaksi = Transaksi::create([
            'tgl_setor' => $validated['tgl_setor'],
            'nasabah_id' => $validated['nasabah_id'],
            'total_pendapatan' => 0,
            'admin_id' => auth()->id(),
        ]);

        foreach ($validated['sampah_id'] as $i => $sampah_id) {
            $sampah = Sampah::findOrFail($sampah_id);
            $berat = $validated['berat'][$i];
            $harga = $sampah->harga;
            $subtotal = $berat * $harga;
            $potongan = $subtotal * 0.02;
            $subtotalSetelahPotongan = $subtotal - $potongan;
            $totalPendapatan += $subtotalSetelahPotongan;
            $totalKas += $potongan;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id_transaksi,
                'sampah_id' => $sampah_id,
                'berat' => $berat,
                'harga_saat_transaksi' => $harga,
                'subtotal' => $subtotalSetelahPotongan,
                'potongan' => $potongan,
            ]);
        }

        $transaksi->total_pendapatan = $totalPendapatan;
        $transaksi->save();
        $nasabah->increment('saldo', $totalPendapatan);

        $pdf = Pdf::loadView('admin.transaksi.nota', [
            'transaksi' => $transaksi->load('details.sampah', 'nasabah'),
            'nasabah' => $nasabah,
            'totalPendapatan' => $totalPendapatan,
            'totalKas' => $totalKas,
        ]);

        $filename = 'nota_setor_' . $transaksi->id_transaksi . '.pdf';
        $path = 'nota_setor/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        DB::commit();

        // Mengirim 'nota_filename' ke session
        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi setor berhasil disimpan.')
            ->with('nota_filename', $filename);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('GAGAL MEMBUAT TRANSAKSI SETOR: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan fatal. Transaksi dibatalkan.');
    }
}
    public function downloadNota($filename)
{
    // Membersihkan input untuk keamanan
    $safeFilename = basename($filename);

    $path = 'nota_setor/' . $safeFilename;

    
}
}