@extends('admin.base')

@section('title', 'Data Sampah')
@section('header', 'Data Sampah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Data Sampah</h2>
        <a href="{{ route('admin.sampah.create') }}" class="btn-green px-4 py-2 rounded">Tambah Data Sampah</a>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="table-header-custom">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Jenis Sampah</th>
                <th class="px-4 py-2">Satuan</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sampahs as $i => $s)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $s->jenis_sampah }}</td>
                <td class="border px-4 py-2">{{ $s->satuan }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.sampah.edit', $s->sampah_id) }}" class="inline-block mr-2"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.sampah.destroy', $s->sampah_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
