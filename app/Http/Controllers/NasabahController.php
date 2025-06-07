<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = User::where('role', 'nasabah')->get();
        return view('admin.nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_reg' => 'required|string|max:30|unique:users,no_reg',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:6',
            'tgl_registrasi' => 'required|date',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'nasabah';
        User::create($validated);
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }
}
