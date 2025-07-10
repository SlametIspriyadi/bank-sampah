<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Transaksi::with(['nasabah', 'sampah'])->orderBy('tgl_setor', 'desc')->get();
        return view('admin.laporan.index', compact('laporan'));
    }

    public function laporanSetor(Request $request)
    {
        $query = \App\Models\Transaksi::with('nasabah');
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function($q) use ($request) {
                $q->where('no_reg', 'like', '%'.$request->no_reg.'%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_setor', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_setor', $request->tahun);
        }
        $setor = $query->orderByDesc('tgl_setor')->paginate(10);
        return view('admin.laporan.laporan_setor', compact('setor'));
    }

    public function laporanSetorPdf(Request $request)
    {
        $query = \App\Models\Transaksi::with('nasabah');
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function($q) use ($request) {
                $q->where('no_reg', 'like', '%'.$request->no_reg.'%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_setor', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_setor', $request->tahun);
        }
        $setor = $query->orderByDesc('tgl_setor')->get();
        $pdf = \PDF::loadView('admin.laporan.laporan_setor_pdf', compact('setor'));
        return $pdf->download('laporan_setor.pdf');
    }

    public function laporanTarik(Request $request)
    {
        $query = \App\Models\TransaksiTarik::with('nasabah');
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function($q) use ($request) {
                $q->where('no_reg', 'like', '%'.$request->no_reg.'%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_tarik', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_tarik', $request->tahun);
        }
        $tarik = $query->orderByDesc('tgl_tarik')->paginate(10);
        return view('admin.laporan.laporan_tarik', compact('tarik'));
    }

    public function laporanTarikPdf(Request $request)
    {
        $query = \App\Models\TransaksiTarik::with('nasabah');
        if ($request->filled('no_reg')) {
            $query->whereHas('nasabah', function($q) use ($request) {
                $q->where('no_reg', 'like', '%'.$request->no_reg.'%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_tarik', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_tarik', $request->tahun);
        }
        $tarik = $query->orderByDesc('tgl_tarik')->get();
        $pdf = \PDF::loadView('admin.laporan.laporan_tarik_pdf', compact('tarik'));
        return $pdf->download('laporan_tarik.pdf');
    }
}
