<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class NasabahController extends Controller
{
    public function index()
    {
        // Fetch all nasabah users
        $nasabahs = \App\Models\User::where('role', 'nasabah')
            ->get()
            ->map(function($n) {
                $total = DB::table('transaksi_setor')
                    ->where('nasabah_id', $n->id)
                    ->sum(DB::raw('total_pendapatan * 0.98'));
                $n->total_pendapatan = $total;
                return $n;
            });
        return view('admin.nasabah.index', compact('nasabahs'));
   
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function edit($id)
    {
        return view('admin.nasabah.edit', compact('id'));
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
}
