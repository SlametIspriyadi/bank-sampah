@extends('admin.base')

@section('title', 'Tambah Data Sampah')
@section('header', 'Tambah Data Sampah')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.sampah.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jenis Sampah</label>
            <input type="text" name="jenis_sampah" class="w-full border px-3 py-2 rounded" maxlength="100" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Satuan</label>
            <select name="satuan" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="Kg">Kg</option>
                <option value="Satu">Satu</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Harga</label>
            <input type="number" name="harga" class="w-full border px-3 py-2 rounded" min="0" step="0.01" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
