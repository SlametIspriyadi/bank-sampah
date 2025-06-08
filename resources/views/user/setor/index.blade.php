@extends('user.base')
@section('title', 'Setor Sampah')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Setor Sampah</h2>
    <p>Halaman ini untuk fitur setor sampah oleh user. (Silakan tambahkan form setor atau riwayat setor sesuai kebutuhan.)</p>
    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $trx)
            <tr>
                <td class="border px-2 py-1">{{ $trx->tgl_setor }}</td>
                <td class="border px-2 py-1">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
