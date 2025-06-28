<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sampah;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('DEBUG session nota_setor: ' . session('nota_setor'));
        $nasabah = null;
        if ($request->filled('no_reg')) {
            $nasabah = \App\Models\User::where('no_reg', $request->no_reg)->where('role', 'nasabah')->first();
        }
        $query = DB::table('transaksi_setor')
            ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->leftJoin('sampahs', 'transaksi_setor.sampah_id', '=', 'sampahs.sampah_id')
            ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name', 'sampahs.jenis_sampah', 'sampahs.satuan');

        if ($request->filled('no_reg')) {
            $query->where('nasabah.no_reg', 'like', '%' . $request->no_reg . '%');
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('transaksi_setor.tgl_setor', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('transaksi_setor.tgl_setor', $request->tahun);
        }
        $transaksi = $query->get();
        return view('admin.transaksi.index', compact('transaksi', 'nasabah'));
    }

    public function create(Request $request)
    {
        // Ambil nasabah dari parameter jika ada
        $nasabah = null;
        if ($request->filled('nasabah_id')) {
            $nasabah = User::where('id', $request->nasabah_id)->where('role', 'nasabah')->first();
        }
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
        $insertedId = \DB::table('transaksi_setor')->insertGetId([
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
        // Generate nota setor PDF
        $transaksi = null;
        $columns = \Schema::getColumnListing('transaksi_setor');
        // Cek id_transaksi dulu, baru id
        if (in_array('id_transaksi', $columns)) {
            $transaksi = \DB::table('transaksi_setor')
                ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
                ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name')
                ->where('transaksi_setor.id_transaksi', $insertedId)
                ->first();
        } elseif (in_array('id', $columns)) {
            $transaksi = \DB::table('transaksi_setor')
                ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
                ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name')
                ->where('transaksi_setor.id', $insertedId)
                ->first();
        }
        if ($transaksi) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.transaksi.nota', compact('transaksi'));
            $filename = 'nota_setor_' . $insertedId . '.pdf';
            $path = 'nota_setor/' . $filename;
            \Storage::disk('public')->put($path, $pdf->output());
            // FIX: redirect ke /admin/transaksi TANPA query string apapun agar session flash muncul
            return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil ditambahkan.')->with('nota_setor', route('transaksi.downloadNota', ['filename' => $filename]));
        } else {
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.')->with('error', 'Nota setor gagal dibuat.');
        }
    }

    public function exportPdf(Request $request)
    {
        $query = DB::table('transaksi_setor')
            ->leftJoin('users as nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->leftJoin('sampahs', 'transaksi_setor.sampah_id', '=', 'sampahs.sampah_id')
            ->select('transaksi_setor.*', 'nasabah.no_reg as nasabah_no_reg', 'nasabah.name as nasabah_name', 'sampahs.jenis_sampah', 'sampahs.satuan');

        if ($request->filled('no_reg')) {
            $query->where('nasabah.no_reg', 'like', '%' . $request->no_reg . '%');
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('transaksi_setor.tgl_setor', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('transaksi_setor.tgl_setor', $request->tahun);
        }
        $transaksi = $query->get();
        $pdf = Pdf::loadView('admin.transaksi.pdf', compact('transaksi'));
        return $pdf->download('data_transaksi_setor.pdf');
    }

    public function downloadNota($filename)
    {
        $path = storage_path('app/public/nota_setor/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
