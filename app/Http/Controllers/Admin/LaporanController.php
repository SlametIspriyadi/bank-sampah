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
}
