<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sampah;

class SampahController extends Controller
{

    public function index()
    {
        $sampahs = Sampah::all();
        return view('admin.sampah.index', compact('sampahs'));
    }
    public function create()
    {
        return view('admin.sampah.create');
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_sampah' => 'required|string|max:100',
            'satuan' => 'required|in:Kg,g,L,pcs',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Sampah::create($validated);

        return redirect()->route('admin.sampah.index')->with('success', 'Data sampah berhasil ditambahkan.');
    }
}
