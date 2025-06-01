@extends('admin.base')

@section('title', 'Tambah Nasabah')
@section('header', 'Tambah Nasabah')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.nasabah.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">No Registrasi</label>
            <input type="text" name="no_reg" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded" required>
                <option value="">Pilih</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">No HP</label>
            <input type="text" name="no_hp" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border px-3 py-2 rounded"></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>
        <input type="hidden" name="role" value="nasabah">
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
