@extends('admin.base')

@section('title', 'Laporan')
@section('header', 'Laporan')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Laporan Transaksi Setor</h2>
    </div>
    <div class="overflow-x-auto mb-8">
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

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Laporan Transaksi Tarik</h2>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="table-header-custom">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Nasabah</th>
                <th class="px-4 py-2">Jumlah Tarik</th>
                <th class="px-4 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($laporanTarik))
            @foreach($laporanTarik as $j => $tarik)
            <tr>
                <td class="border px-4 py-2">{{ $j+1 }}</td>
                <td class="border px-4 py-2">{{ $tarik->tgl_tarik }}</td>
                <td class="border px-4 py-2">{{ $tarik->nasabah->name ?? '-' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($tarik->jumlah_tarik, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $tarik->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="5" class="text-center">Tidak ada data transaksi tarik</td></tr>
            @endif
        </tbody>
    </table>
    </div>
</div>
@endsection
