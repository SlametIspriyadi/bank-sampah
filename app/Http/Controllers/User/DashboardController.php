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
        // Saldo = total setor - total tarik
        $totalSetor = DB::table('transaksi_setor')
            ->where('nasabah_id', $user->id)
            ->sum('total_pendapatan');
        $totalTarik = DB::table('transaksi_tarik')
            ->where('nasabah_id', $user->id)
            ->sum('jumlah_tarik');
        $saldo = $totalSetor * 0.98 - $totalTarik;

        return view('user.dashboard', compact('user', 'saldo', 'totalSetor', 'totalTarik'));
    }
}
