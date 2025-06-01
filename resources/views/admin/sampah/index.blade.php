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
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sampahs as $s)
            <tr>
                <td class="border px-4 py-2">{{ $s->jenis_sampah }}</td>
                <td class="border px-4 py-2">{{ $s->satuan }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.sampah.edit', $s->sampah_id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded mr-2">Edit</a>
                    <form action="{{ route('admin.sampah.destroy', $s->sampah_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
