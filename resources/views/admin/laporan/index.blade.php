@extends('admin.base')

@section('title', 'Laporan')
@section('header', 'Laporan')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Laporan Transaksi</h2>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="table-header-custom">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Nasabah</th>
                <th class="px-4 py-2">Detil Sampah</th>
                <th class="px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $lap)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $lap->tgl_setor }}</td>
                <td class="border px-4 py-2">{{ $lap->nasabah->name ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $lap->detil_sampah ?? '-' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($lap->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
