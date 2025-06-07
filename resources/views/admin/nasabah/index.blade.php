@extends('admin.base')

@section('title', 'Data Nasabah')
@section('header', 'Data nasabah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Data nasabah</h2>
        <a href="{{ route('admin.nasabah.create') }}" class="btn-green px-4 py-2 rounded">Tambah</a>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="table-header-custom">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Nama Iten</th>
                <th class="px-4 py-2">Alamat</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">No tlp</th>
                <th class="px-4 py-2">Saldo</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabahs as $i => $n)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $n->name }}</td>
                <td class="border px-4 py-2">{{ $n->alamat }}</td>
                <td class="border px-4 py-2">{{ $n->email }}</td>
                <td class="border px-4 py-2">{{ $n->no_hp }}</td>
                <td class="border px-4 py-2">Rp.{{ number_format($n->total_pendapatan ?? 0, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="inline-block mr-2"><i class="fa fa-eye"></i></a>
                    <a href="#" class="inline-block mr-2"><i class="fa fa-edit"></i></a>
                    <a href="#" class="inline-block"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
