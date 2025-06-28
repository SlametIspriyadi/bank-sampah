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
        $detil_sampah_arr = [];
        foreach ($validated['sampah_id'] as $i => $sampah_id) {
            $sampah = \App\Models\Sampah::where('sampah_id', $sampah_id)->first();
            $harga = $sampah ? $sampah->harga : 0;
            $berat = $validated['berat'][$i];
            $total = $berat * $harga;
            $total_pendapatan += $total;
            $total_berat += $berat;
            if ($sampah) {
                $jenis_sampah_arr[] = $sampah->jenis_sampah;
                $detil_sampah_arr[] = $sampah->jenis_sampah . ' ' . $berat . ' ' . $sampah->satuan;
            }
        }
        $first_sampah_id = $validated['sampah_id'][0];
        $insertedId = DB::table('transaksi_setor')->insertGetId([
            'tgl_setor' => $validated['tgl_setor'],
            'nasabah_id' => $validated['nasabah_id'],
            'sampah_id' => $first_sampah_id,
            'berat' => $total_berat,
            'total_pendapatan' => $total_pendapatan,
            'jenis_sampah' => implode(', ', $jenis_sampah_arr),
            'detil_sampah' => implode(', ', $detil_sampah_arr),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Generate nota setor PDF
        $transaksi = DB::table('transaksi_setor')
            ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name')
            ->where('transaksi_setor.id', $insertedId)
            ->first();
        if ($transaksi) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.transaksi.nota', compact('transaksi'));
            $filename = 'nota_setor_' . $insertedId . '.pdf';
            $path = 'nota_setor/' . $filename;
            \Storage::disk('public')->put($path, $pdf->output());
            $url = asset('storage/' . $path);
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.')->with('nota_setor', $url);
        } else {
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.')->with('error', 'Nota setor gagal dibuat.');
        }
    }
}
