<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sampah;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $nasabahCount = User::where('role', 'nasabah')->count();
        $sampahCount = Sampah::count();
        $transaksiCount = Transaksi::count();
        $recentTransaksi = Transaksi::with(['nasabah', 'sampah'])
            ->orderBy('tgl_setor', 'desc')
            ->limit(5)
            ->get();
        return view('admin.dashboard', compact('nasabahCount', 'sampahCount', 'transaksiCount', 'recentTransaksi'));
    }
}
