@extends('admin.base')

@section('title', 'Data Nasabah')
@section('header', 'Data Nasabah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Nasabah</h2>
    <div class="mb-4">
        <a href="{{ route('admin.nasabah.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Nasabah</a>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama</th>
                
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">No HP</th>
                <th class="px-4 py-2">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabahs as $n)
            <tr>
                <td class="border px-4 py-2">{{ $n->name }}</td>
                <td class="border px-4 py-2">{{ $n->email }}</td>
                <td class="border px-4 py-2">{{ $n->no_hp }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($n->saldo, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
