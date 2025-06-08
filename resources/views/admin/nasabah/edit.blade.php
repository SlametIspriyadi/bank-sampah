@extends('admin.base')

@section('title', 'Edit Data Nasabah')
@section('header', 'Edit Data Nasabah')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="mb-0 pl-4 list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">No Registrasi</label>
            <input type="text" name="no_reg" class="w-full border px-3 py-2 rounded" value="{{ old('no_reg', $nasabah->no_reg) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $nasabah->name) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded" required>
                <option value="L" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="w-full border px-3 py-2 rounded" value="{{ old('tempat_lahir', $nasabah->tempat_lahir) }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="w-full border px-3 py-2 rounded" value="{{ old('tgl_lahir', $nasabah->tgl_lahir ? date('Y-m-d', strtotime($nasabah->tgl_lahir)) : '') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">No HP</label>
            <input type="text" name="no_hp" class="w-full border px-3 py-2 rounded" value="{{ old('no_hp', $nasabah->no_hp) }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border px-3 py-2 rounded">{{ old('alamat', $nasabah->alamat) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Registrasi</label>
            <input type="date" name="tgl_registrasi" class="w-full border px-3 py-2 rounded" value="{{ old('tgl_registrasi', $nasabah->tgl_registrasi ? date('Y-m-d', strtotime($nasabah->tgl_registrasi)) : '') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection
