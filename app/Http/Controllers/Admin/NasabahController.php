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
    // Validasi data dengan menambahkan 'no_reg'
    $request->validate([
        // Pastikan 'no_reg' unik di tabel users (atau nasabahs), kolom 'no_reg'
        'no_reg' => 'required|string|max:255|unique:users,no_reg',
        'name' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'required|string|max:255',
        'tgl_lahir' => 'required|date',
        'no_hp' => 'nullable|string|max:15',
        'alamat' => 'nullable|string',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Menyiapkan data untuk disimpan dari request
    $data = $request->except('password_confirmation');
    
    // LOGIKA OTOMATIS DIHAPUS. no_reg sekarang datang dari form.
    
    // Set tanggal registrasi otomatis
    $data['tgl_registrasi'] = now();

    // Enkripsi password sebelum disimpan
    $data['password'] = Hash::make($request->password);
    
    // Simpan ke database
    \App\Models\User::create($data); 

    return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah baru dengan No. Reg ' . $request->no_reg . ' berhasil ditambahkan.');
}
   public function update(Request $request, $id)
{
    // Validasi data yang masuk
    $request->validate([
        'no_reg' => 'required|string|max:255|unique:users,no_reg,' . $id,
        'name' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        // Tambahkan validasi lain jika perlu
    ]);

    // 1. Cari nasabah berdasarkan ID
    $nasabah = User::findOrFail($id);

    // 2. Update setiap kolom satu per satu secara manual
    // Metode ini tidak terpengaruh oleh masalah Mass Assignment ($fillable)
    $nasabah->no_reg = $request->no_reg;
    $nasabah->name = $request->name;
    $nasabah->jenis_kelamin = $request->jenis_kelamin;
    $nasabah->tempat_lahir = $request->tempat_lahir;
    $nasabah->tgl_lahir = $request->tgl_lahir;
    $nasabah->no_hp = $request->no_hp;
    $nasabah->alamat = $request->alamat;
    $nasabah->tgl_registrasi = $request->tgl_registrasi;

    // 3. Simpan perubahan ke database
    $nasabah->save();

    // 4. Redirect kembali dengan pesan sukses
    return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil diperbarui.');
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
