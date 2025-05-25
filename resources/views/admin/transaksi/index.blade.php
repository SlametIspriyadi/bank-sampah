@extends('admin.base')

@section('title', 'Transaksi Setor')
@section('header', 'Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Transaksi Setor</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Nasabah</th>
                <th class="px-4 py-2">Jenis Sampah</th>
                <th class="px-4 py-2">Berat</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($transaksi as $trx)
            <tr>
                <td class="border px-4 py-2">{{ $trx->tgl_setor }}</td>
                <td class="border px-4 py-2">{{ $trx->nasabah->name ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $trx->sampah->jenis_sampah ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $trx->berat }} {{ $trx->sampah->satuan ?? '' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $trx->status }}</td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
@endsection
