<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiTarik;

class TarikController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiTarik::where('nasabah_id', auth()->id());
        // Filter bulan dan tahun
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_tarik', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_tarik', $request->tahun);
        }
        $transaksi = $query->orderByDesc('tgl_tarik')->paginate(10);
        // Untuk dropdown tahun
        $tahunList = TransaksiTarik::where('nasabah_id', auth()->id())
            ->selectRaw('YEAR(tgl_tarik) as tahun')
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');
        return view('user.setor.index', [
            'transaksi' => $transaksi,
            'tahunList' => $tahunList
        ]);
    }
}
