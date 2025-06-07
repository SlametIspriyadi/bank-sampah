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
                <th class="px-4 py-2">No Reg</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">JK</th>
                <th class="px-4 py-2">Tempat, Tgl Lahir</th>
                <th class="px-4 py-2">No HP</th>
                <th class="px-4 py-2">Tgl Registrasi</th>
                <th class="px-4 py-2">Saldo</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabahs as $i => $n)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $n->no_reg }}</td>
                <td class="border px-4 py-2">{{ $n->name }}</td>
                <td class="border px-4 py-2">{{ $n->jenis_kelamin }}</td>
                <td class="border px-4 py-2">{{ $n->tempat_lahir }}, {{ $n->tgl_lahir ? date('d-m-Y', strtotime($n->tgl_lahir)) : '' }}</td>
                <td class="border px-4 py-2">{{ $n->no_hp }}</td>
                <td class="border px-4 py-2">{{ $n->tgl_registrasi ? date('d-m-Y', strtotime($n->tgl_registrasi)) : '' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($n->saldo ?? 0, 0, ',', '.') }}</td>
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
