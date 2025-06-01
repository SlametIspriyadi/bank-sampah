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
            'satuan' => 'required|in:Kg,Satu',
            'harga' => 'required|numeric|min:0',
        ]);

        Sampah::create($validated);

        return redirect()->route('admin.sampah.index')->with('success', 'Data sampah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sampah = Sampah::findOrFail($id);
        return view('admin.sampah.edit', compact('sampah'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_sampah' => 'required|string|max:100',
            'satuan' => 'required|in:Kg,Satu',
            'harga' => 'required|numeric|min:0',
        ]);
        $sampah = Sampah::findOrFail($id);
        $sampah->update($validated);
        return redirect()->route('admin.sampah.index')->with('success', 'Data sampah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $sampah = Sampah::findOrFail($id);
        $sampah->delete();
        return redirect()->route('admin.sampah.index')->with('success', 'Data sampah berhasil dihapus.');
    }
}
