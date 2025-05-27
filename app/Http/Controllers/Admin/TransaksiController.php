<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sampah;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = DB::table('transaksi_setor')
            ->join('users', 'transaksi_setor.nasabah_id', '=', 'users.id')
            ->select('transaksi_setor.*', 'users.name as nasabah_name')
            ->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }
    public function create()
    {
        $nasabah = User::where('role', 'nasabah')->get();
        $sampah = Sampah::all();
        return view('admin.transaksi.create', compact('nasabah', 'sampah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_setor' => 'required|date',
            'nasabah_id' => 'required|exists:users,id',
            'sampah_id' => 'required|array|min:1',
            'sampah_id.*' => 'required|exists:sampahs,sampah_id',
            'berat' => 'required|array|min:1',
            'berat.*' => 'required|numeric|min:0',
        ]);
        $jenis_sampah_arr = [];
        $total_pendapatan = 0;
        $total_berat = 0;
        foreach ($validated['sampah_id'] as $i => $sampah_id) {
            $sampah = \App\Models\Sampah::where('sampah_id', $sampah_id)->first();
            $harga = $sampah ? $sampah->harga : 0;
            $berat = $validated['berat'][$i];
            $total = $berat * $harga;
            $total_pendapatan += $total;
            $total_berat += $berat;
            if ($sampah) {
                $jenis_sampah_arr[] = $sampah->jenis_sampah;
            }
        }
        $first_sampah_id = $validated['sampah_id'][0];
        DB::table('transaksi_setor')->insert([
            'tgl_setor' => $validated['tgl_setor'],
            'nasabah_id' => $validated['nasabah_id'],
            'sampah_id' => $first_sampah_id,
            'berat' => $total_berat,
            'total_pendapatan' => $total_pendapatan,
            'jenis_sampah' => implode(', ', $jenis_sampah_arr),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
