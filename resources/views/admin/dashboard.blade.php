@extends('admin.base')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500">Total Nasabah</div>
        <div class="text-2xl font-bold">{{ $nasabahCount ?? '-' }}</div>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500">Total Sampah</div>
        <div class="text-2xl font-bold">{{ $sampahCount ?? '-' }}</div>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500">Total Transaksi</div>
        <div class="text-2xl font-bold">{{ $transaksiCount ?? '-' }}</div>
    </div>
</div>
<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi Terbaru</h2>
    <div class="bg-white rounded shadow overflow-x-auto">
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
            {{-- <tbody>
                @forelse($recentTransaksi ?? [] as $trx)
                <tr>
                    <td class="border px-4 py-2">{{ $trx->tgl_setor }}</td>
                    <td class="border px-4 py-2">{{ $trx->nasabah->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $trx->sampah->jenis_sampah ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $trx->berat }} {{ $trx->sampah->satuan ?? '' }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4">Tidak ada data</td></tr>
                @endforelse
            </tbody> --}}
        </table>
    </div>
</div>
@endsection
