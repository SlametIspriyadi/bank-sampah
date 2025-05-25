@extends('admin.base')

@section('title', 'Tambah Nasabah')
@section('header', 'Tambah Nasabah')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.nasabah.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>
        {{-- <div class="mb-4">
            <label class="block mb-1 font-semibold">Username</label>
            <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
        </div> --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
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
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Saldo Awal</label>
            <input type="number" name="saldo" class="w-full border px-3 py-2 rounded" min="0" value="0">
        </div>
        <input type="hidden" name="role" value="nasabah">
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
