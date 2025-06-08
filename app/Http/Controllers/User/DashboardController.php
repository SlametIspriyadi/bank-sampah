<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $saldo = DB::table('transaksi_setor')
            ->where('nasabah_id', $user->id)
            ->sum('total_pendapatan') * 0.98;

        $transaksi = DB::table('transaksi_setor')
            ->where('nasabah_id', $user->id)
            ->orderByDesc('tgl_setor')
            ->get();

        return view('user.dashboard', compact('saldo', 'transaksi'));
    }
}
