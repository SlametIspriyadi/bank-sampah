<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Sampah;
use App\Models\Transaksi;
use App\Models\DetailTransaksi; // Pastikan model baru ini di-import
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Menampilkan halaman utama transaksi dengan riwayat.
     */
    public function index(Request $request)
{
    $nasabah = null;
    if ($request->filled('no_reg')) {
        $nasabah = User::where('no_reg', $request->no_reg)->where('role', 'nasabah')->first();
    }

    // Memulai query dasar menggunakan Eloquent
    $query = Transaksi::with('nasabah');

    // Cek apakah ada parameter 'last_trx_id' dari URL
    if ($request->filled('last_trx_id')) {
        // Jika ADA, filter query untuk HANYA mencari ID tersebut
        $query->where('id_transaksi', $request->last_trx_id); // Ganti 'id_transaksi' jika nama primary key Anda berbeda
    }

    // Selalu urutkan dari yang terbaru dan gunakan paginasi
    // Jika difilter, paginasi ini hanya akan berisi 1 data
    $transaksis = $query->latest('tgl_setor')->paginate(10);

    return view('admin.transaksi.index', compact('transaksis', 'nasabah'));
}

    /**
     * Menampilkan form untuk membuat transaksi baru untuk nasabah SPESIFIK.
     */
    public function create(Request $request)
    {
        $request->validate(['nasabah_id' => 'required|exists:users,id']);
        $nasabah = User::findOrFail($request->nasabah_id);
        $sampah = Sampah::orderBy('jenis_sampah', 'asc')->get();
        return view('admin.transaksi.create', compact('nasabah', 'sampah'));
    }

    /**
     * Menyimpan transaksi baru, detailnya, mengupdate saldo, dan membuat nota PDF.
     */
    // app/Http/Controllers/TransaksiController.php

public function store(Request $request)
{
    $validated = $request->validate([
        'tgl_setor' => 'required|date',
        'nasabah_id' => 'required|exists:users,id',
        'sampah_id' => 'required|array|min:1',
        'sampah_id.*' => 'required|exists:sampahs,sampah_id',
        'berat' => 'required|array|min:1',
        'berat.*' => 'required|numeric|min:0.01',
    ]);

    DB::beginTransaction();
    try {
        $nasabah = User::findOrFail($validated['nasabah_id']);
        
        // Array sementara untuk menampung detail dan kalkulasi
        $detailItemsForPdf = []; // Untuk nota PDF
        $detailSampahForDb = []; // Untuk disimpan ke kolom 'detil_sampah'
        $jenisSampahForDb = [];  // Untuk disimpan ke kolom 'jenis_sampah'
        $totalPendapatan = 0;
        $totalBerat = 0;

        // 1. Proses setiap item sampah dari form
        foreach ($validated['sampah_id'] as $i => $sampah_id) {
            $sampah = Sampah::find($sampah_id);
            $berat = (float) $validated['berat'][$i];
            $harga = $sampah->harga;
            $subtotal = $berat * $harga;
            
            $totalPendapatan += $subtotal;
            $totalBerat += $berat;

            // Kumpulkan data untuk nota PDF (lengkap)
            $detailItemsForPdf[] = [
                'jenis_sampah' => $sampah->jenis_sampah,
                'satuan' => $sampah->satuan,
                'berat' => $berat,
                'harga' => $harga,
                'subtotal' => $subtotal,
            ];
            // Kumpulkan data untuk disimpan ke DB (ringkasan teks)
            $jenisSampahForDb[] = $sampah->jenis_sampah;
            $detailSampahForDb[] = "{$sampah->jenis_sampah} {$berat} {$sampah->satuan}";
        }

        // 2. Simpan RINGKASAN transaksi ke tabel 'transaksi_setor'
        $transaksi = new Transaksi();
        $transaksi->tgl_setor = $validated['tgl_setor'];
        $transaksi->nasabah_id = $validated['nasabah_id'];
        $transaksi->berat = $totalBerat;
        $transaksi->total_pendapatan = $totalPendapatan;
        $transaksi->jenis_sampah = implode(', ', $jenisSampahForDb);
        $transaksi->detil_sampah = implode('; ', $detailSampahForDb);
        $transaksi->admin_id = auth()->id(); // Contoh
        $transaksi->sampah_id = $validated['sampah_id'][0]; // Simpan ID sampah pertama
        $transaksi->save();

        // 3. Update saldo nasabah
        $nasabah->increment('saldo', $totalPendapatan);
        
        // 4. Siapkan data lengkap untuk dikirim ke view PDF
        $pdfData = [
            'transaksi' => $transaksi,
            'nasabah' => $nasabah,
            'detailItems' => $detailItemsForPdf, // Gunakan data detail dari memori
            'totalPendapatan' => $totalPendapatan,
        ];
        
        // 5. Buat dan simpan PDF
        $pdf = Pdf::loadView('admin.transaksi.nota', $pdfData);
        $filename = 'nota_setor_' . $transaksi->id_transaksi . '.pdf';
        $path = 'nota_setor/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());
        $url = Storage::disk('public')->url($path);

        // 6. Commit transaksi jika semua berhasil
        DB::commit();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan.')
            ->with('nota_setor', $url);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('GAGAL MEMBUAT TRANSAKSI SETOR: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan. Transaksi dibatalkan.')
            ->withInput();
    }
}

    /**
     * Mengunduh file nota yang sudah dibuat.
     */
    public function downloadNota($filename)
    {
        // Membersihkan nama file untuk keamanan
        $safeFilename = basename($filename);
        $path = storage_path('app/public/nota_setor/' . $safeFilename);

        if (!file_exists($path)) {
            abort(404, 'File nota tidak ditemukan.');
        }
        return response()->download($path);
    }

    // Anda bisa menambahkan method exportPdf di sini dengan query Eloquent yang lebih bersih
}