<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiTarik;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransaksiTarikController extends Controller
{
    public function index(Request $request)
    {
        $notifikasi = null;
        $nasabah = null;
        $saldoAkhir = 0;
        if ($request->filled('no_reg')) {
            $nasabah = User::where('role', 'nasabah')
                ->where('no_reg', $request->no_reg)
                ->first();
            if ($nasabah) {
                $saldo = DB::table('transaksi_setor')->where('nasabah_id', $nasabah->id)->sum('total_pendapatan') * 0.98;
                $totalTarik = DB::table('transaksi_tarik')->where('nasabah_id', $nasabah->id)->sum('jumlah_tarik');
                $saldoAkhir = $saldo - $totalTarik;
            } else {
                $notifikasi = 'Nasabah tidak ditemukan.';
            }
        }
        return view('admin.transaksi_tarik.index', compact('nasabah', 'saldoAkhir', 'notifikasi'));
    }

    public function create(Request $request)
    {
        // Jika ada nasabah_id di query, ambil data nasabah dan saldo saja
        if ($request->filled('nasabah_id')) {
            $nasabah = \App\Models\User::where('role', 'nasabah')->findOrFail($request->nasabah_id);
            $saldo = DB::table('transaksi_setor')->where('nasabah_id', $nasabah->id)->sum('total_pendapatan') * 0.98;
            $totalTarik = DB::table('transaksi_tarik')->where('nasabah_id', $nasabah->id)->sum('jumlah_tarik');
            $saldoAkhir = $saldo - $totalTarik;
            return view('admin.transaksi_tarik.create', [
                'nasabah' => $nasabah,
                'saldoAkhir' => $saldoAkhir
            ]);
        }
        // Default: tampilkan semua nasabah
        $nasabah = User::where('role', 'nasabah')
            ->withSum(['transaksiSetor as transaksi_setor_sum' => function($q) {
                $q->select(DB::raw('COALESCE(SUM(total_pendapatan),0)'));
            }], 'total_pendapatan')
            ->withSum(['transaksiTarik as transaksi_tarik_sum' => function($q) {
                $q->select(DB::raw('COALESCE(SUM(jumlah_tarik),0)'));
            }], 'jumlah_tarik')
            ->get();
        return view('admin.transaksi_tarik.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:users,id',
            'tgl_tarik' => 'required|date',
            'jumlah_tarik' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $nasabah = User::findOrFail($request->nasabah_id);
        $saldo = DB::table('transaksi_setor')->where('nasabah_id', $nasabah->id)->sum('total_pendapatan') * 0.98;
        $totalTarik = DB::table('transaksi_tarik')->where('nasabah_id', $nasabah->id)->sum('jumlah_tarik');
        $saldoAkhir = $saldo - $totalTarik;
        if ($request->jumlah_tarik > $saldoAkhir) {
            return back()->withErrors(['jumlah_tarik' => 'Saldo tidak mencukupi untuk penarikan ini.'])->withInput();
        }

        $trx = TransaksiTarik::create($request->all());

        // Generate PDF nota setelah simpan
        $trx->load('nasabah');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.transaksi_tarik.nota', compact('trx', 'nasabah', 'saldoAkhir'));
        $filename = 'nota_tarik_saldo_' . $trx->id_tarik . '_' . time() . '.pdf';
        $path = storage_path('app/public/nota/' . $filename);
        // Pastikan folder ada
        if (!file_exists(storage_path('app/public/nota'))) {
            mkdir(storage_path('app/public/nota'), 0777, true);
        }
        $pdf->save($path);
        // Buat url publik (gunakan route download, bukan asset langsung)
        // $publicUrl = asset('storage/nota/' . $filename);
        // Redirect ke index dengan session flash untuk trigger download
        // return redirect()->route('admin.transaksi_tarik.index')->with('nota_pdf', $publicUrl);
        // Ganti dengan route download
        $downloadUrl = route('admin.transaksi_tarik.downloadNota', ['filename' => $filename]);
        return redirect()->route('admin.transaksi_tarik.index')->with('nota_pdf', $downloadUrl);
    }

    public function exportPdf(Request $request)
    {
        $query = TransaksiTarik::with('nasabah')->orderByDesc('tgl_tarik');
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function($q) use ($request) {
                $q->where('no_reg', 'like', '%' . $request->no_reg . '%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_tarik', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_tarik', $request->tahun);
        }
        $tarik = $query->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.transaksi_tarik.pdf', compact('tarik'));
        return $pdf->download('data_transaksi_tarik.pdf');
    }

    public function downloadNota($filename)
    {
        $path = storage_path('app/public/nota/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
