<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sampah;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi_setor')
            ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->leftJoin('sampahs', 'transaksi_setor.sampah_id', '=', 'sampahs.sampah_id')
            ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name', 'sampahs.jenis_sampah', 'sampahs.satuan')
            ->get();
        return view('admin.transaksi.index', compact('transaksi'));
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
        if (count($validated['sampah_id']) !== count($validated['berat'])) {
            return back()->withErrors(['Jumlah jenis sampah dan berat tidak sama!'])->withInput();
        }
        $beratArr = array_map(function($b) { return trim((string)$b); }, $validated['berat']);
        $jenis_sampah_arr = [];
        $detil_sampah_arr = [];
        $total_pendapatan = 0;
        foreach ($validated['sampah_id'] as $i => $sampah_id) {
            $sampah = \App\Models\Sampah::where('sampah_id', $sampah_id)->first();
            $harga = $sampah ? $sampah->harga : 0;
            $berat = isset($beratArr[$i]) ? (float)$beratArr[$i] : 0;
            $total = $berat * $harga;
            $total_pendapatan += $total;
            if ($sampah) {
                $jenis = trim($sampah->jenis_sampah);
                $satuan = $sampah->satuan;
                $jenis_sampah_arr[] = $jenis;
                $detil_sampah_arr[] = $jenis . ' ' . $berat . ' ' . $satuan;
            }
        }
        $first_sampah_id = $validated['sampah_id'][0];
        \DB::table('transaksi_setor')->insert([
            'tgl_setor' => $validated['tgl_setor'],
            'nasabah_id' => $validated['nasabah_id'],
            'sampah_id' => $first_sampah_id,
            'berat' => implode(',', $beratArr),
            'total_pendapatan' => $total_pendapatan,
            'created_at' => now(),
            'updated_at' => now(),
            'jenis_sampah' => implode(', ', $jenis_sampah_arr),
            'detil_sampah' => implode(', ', $detil_sampah_arr),
        ]);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
