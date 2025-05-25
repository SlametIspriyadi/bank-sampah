<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        // Fetch all nasabah users
        $nasabahs = User::where('role', 'nasabah')->get();

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
            //'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:6',
            'saldo' => 'nullable|numeric|min:0',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            //'username' => $validated['username'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'password' => Hash::make($validated['password']),
            'saldo' => $validated['saldo'] ?? 0,
            'role' => 'nasabah',
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil ditambahkan!');
    }
}
