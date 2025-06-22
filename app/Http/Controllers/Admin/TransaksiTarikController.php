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
        return view('admin.transaksi_tarik.index', compact('tarik'));
    }

    public function create()
    {
        // Ambil data saldo per nasabah
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

        // Kurangi saldo nasabah
        $nasabah = User::findOrFail($request->nasabah_id);
        $saldo = DB::table('transaksi_setor')->where('nasabah_id', $nasabah->id)->sum('total_pendapatan') * 0.98;
        $totalTarik = TransaksiTarik::where('nasabah_id', $nasabah->id)->sum('jumlah_tarik');
        $saldoAkhir = $saldo - $totalTarik;
        if ($request->jumlah_tarik > $saldoAkhir) {
            return back()->withErrors(['jumlah_tarik' => 'Saldo tidak mencukupi untuk penarikan ini.'])->withInput();
        }

        TransaksiTarik::create($request->all());
        return redirect()->route('admin.transaksi_tarik.index')->with('success', 'Transaksi tarik berhasil ditambahkan.');
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
}
