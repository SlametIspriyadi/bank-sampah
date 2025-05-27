@extends('admin.base')

@section('title', 'Transaksi Setor')
@section('header', 'Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Transaksi Setor</h2>
    <a href="{{ route('admin.transaksi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Transaksi</a>
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
            @forelse($transaksi as $trx)
            <tr>
                <td class="border px-4 py-2">{{ $trx->tgl_setor }}</td>
                <td class="border px-4 py-2">{{ $trx->nasabah_name ?? '-' }}</td>
                <td class="border px-4 py-2">
                    @if($trx->jenis_sampah)
                        {{ collect(explode(',', $trx->jenis_sampah))->map(fn($j) => trim($j))->join(', ') }}
                    @else
                        -
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $trx->berat }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
