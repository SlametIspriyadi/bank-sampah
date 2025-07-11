<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\User::where('role', 'nasabah');
        $search = $request->input('search');
        if ($search) {
            $query->where('no_reg', 'like', '%' . $search . '%');
        }
        // Gunakan paginate, lalu hitung saldo pada setiap item
        $nasabahs = $query->paginate(10);
        $nasabahs->getCollection()->transform(function($n) {
            $totalSetor = \DB::table('transaksi_setor')
                ->where('nasabah_id', $n->id)
                ->sum('total_pendapatan');
            $totalTarik = \DB::table('transaksi_tarik')
                ->where('nasabah_id', $n->id)
                ->sum('jumlah_tarik');
            $n->saldo = ($totalSetor * 0.98) - $totalTarik;
            return $n;
        });
        return view('admin.nasabah.index', compact('nasabahs', 'search'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function edit($id)
    {
        $nasabah = \App\Models\User::findOrFail($id);
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_reg' => 'required|string|max:30|unique:users,no_reg',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'no_reg' => $validated['no_reg'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'password' => Hash::make($validated['password']),
            'saldo' => 0, // saldo awal selalu 0, dihitung dari transaksi setor
            'role' => 'nasabah',
            'tgl_registrasi' => now(),
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $nasabah = \App\Models\User::findOrFail($id);
        $validated = $request->validate([
            'no_reg' => 'required|string|max:30|unique:users,no_reg,' . $nasabah->id,
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tgl_registrasi' => 'required|date',
        ]);
        $nasabah->update($validated);
        return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil diupdate!');
    }
    public function destroy($id)
    {
        $nasabah = \App\Models\User::find($id);
        if (!$nasabah) {
            return redirect()->route('admin.nasabah.index')->with('error', 'Data nasabah tidak ditemukan!');
        }
        try {
            $nasabah->delete();
            return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.nasabah.index')->with('error', 'Gagal menghapus data nasabah!');
        }
    }
    public function exportPdf(Request $request)
    {
        $query = \App\Models\User::where('role', 'nasabah');
        $search = $request->input('search');
        if ($search) {
            $query->where('no_reg', 'like', '%' . $search . '%');
        }
        $nasabahs = $query->get()->map(function($n) {
            $totalSetor = \DB::table('transaksi_setor')
                ->where('nasabah_id', $n->id)
                ->sum('total_pendapatan');
            $totalTarik = \DB::table('transaksi_tarik')
                ->where('nasabah_id', $n->id)
                ->sum('jumlah_tarik');
            $n->saldo = ($totalSetor * 0.98) - $totalTarik;
            return $n;
        });
        $pdf = Pdf::loadView('admin.nasabah.pdf', compact('nasabahs', 'search'));
        return $pdf->download('data_nasabah.pdf');
    }
}
