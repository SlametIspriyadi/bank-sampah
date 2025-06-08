<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = DB::table('transaksi_setor')
            ->where('nasabah_id', $user->id)
            ->orderByDesc('tgl_setor')
            ->get();
        return view('user.transaksi.index', compact('transaksi'));
    }
}
