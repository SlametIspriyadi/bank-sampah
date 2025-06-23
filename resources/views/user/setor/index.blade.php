@extends('user.base')
@section('title', 'Riwayat Tarik Saldo')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Riwayat Tarik Saldo</h2>
    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Jumlah Tarik</th>
                <th class="px-2 py-1">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $trx)
            <tr>
                <td class="border px-2 py-1">{{ $trx->tgl_tarik }}</td>
                <td class="border px-2 py-1">Rp {{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
                <td class="border px-2 py-1">{{ $trx->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">Tidak ada data transaksi tarik.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
