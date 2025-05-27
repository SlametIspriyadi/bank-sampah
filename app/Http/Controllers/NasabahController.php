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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'saldo' => 'nullable|numeric|min:0',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'nasabah';
        User::create($validated);
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }
}
