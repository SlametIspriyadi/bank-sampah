<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiTarik;

class TarikController extends Controller
{
    public function index()
    {
        // Ambil data berdasarkan nasabah_id, bukan user_id
        $transaksi = TransaksiTarik::where('nasabah_id', auth()->id())->orderByDesc('tgl_tarik')->get();
        return view('user.setor.index', [
            'transaksi' => $transaksi
        ]);
    }
}
