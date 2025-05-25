@extends('admin.base')

@section('title', 'Laporan')
@section('header', 'Laporan')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Laporan Transaksi</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Nasabah</th>
                <th class="px-4 py-2">Jenis Sampah</th>
                <th class="px-4 py-2">Berat</th>
                <th class="px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($laporan as $lap)
            <tr>
                <td class="border px-4 py-2">{{ $lap->tgl_setor }}</td>
                <td class="border px-4 py-2">{{ $lap->nasabah->name ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $lap->sampah->jenis_sampah ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $lap->berat }} {{ $lap->sampah->satuan ?? '' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($lap->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
@endsection
