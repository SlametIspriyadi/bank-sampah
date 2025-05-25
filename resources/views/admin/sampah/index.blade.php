@extends('admin.base')

@section('title', 'Data Sampah')
@section('header', 'Data Sampah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Sampah</h2>
    <div class="mb-4">
        <a href="{{ route('admin.sampah.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Data Sampah</a>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Jenis Sampah</th>
                <th class="px-4 py-2">Satuan</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sampahs as $s)
            <tr>
                <td class="border px-4 py-2">{{ $s->jenis_sampah }}</td>
                <td class="border px-4 py-2">{{ $s->satuan }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $s->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
