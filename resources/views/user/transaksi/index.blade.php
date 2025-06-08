@extends('user.base')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi Setor</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $trx)
            <tr>
                <td class="border px-2 py-1">{{ $trx->tgl_setor }}</td>
                <td class="border px-2 py-1">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center py-4">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
