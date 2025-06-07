@extends('admin.base')

@section('title', 'Transaksi Setor')
@section('header', 'Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Transaksi Setor</h2>
        <a href="{{ route('admin.transaksi.create') }}" class="btn-green px-4 py-2 rounded">Tambah Transaksi</a>
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
            @forelse($transaksi as $i => $trx)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $trx->tgl_setor }}</td>
                <td class="border px-4 py-2">
                    @if(isset($trx->nasabah_no_reg) && isset($trx->nasabah_name))
                        {{ $trx->nasabah_no_reg }} - {{ $trx->nasabah_name }}
                    @elseif(isset($trx->nasabah_no_reg))
                        {{ $trx->nasabah_no_reg }}
                    @else
                        -
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $trx->detil_sampah ?? '-' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
