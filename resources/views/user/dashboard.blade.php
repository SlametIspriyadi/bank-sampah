@extends('user.base')
@section('title', 'Dashboard Nasabah')
@section('content')
<div class="border-b border-gray-200 mb-6 pb-2 flex items-center">
    <h1 class="text-2xl font-bold tracking-wide text-gray-800">Bank Sampah Tanjung Lestari</h1>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
        <div class="bg-green-100 text-green-700 rounded-full p-4 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20H4v-2a4 4 0 014-4h1" />
            </svg>
        </div>
        <div>
            <div class="text-gray-500 text-sm">No. Registrasi</div>
            <div class="font-bold text-xl">{{ auth()->user()->no_reg }}</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
        <div class="bg-blue-100 text-blue-700 rounded-full p-4 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" fill="none" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20h12" />
            </svg>
        </div>
        <div>
            <div class="text-gray-500 text-sm">Saldo</div>
            <div class="font-bold text-xl">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
        <div class="bg-yellow-100 text-yellow-700 rounded-full p-4 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3m-8 4h16" />
            </svg>
        </div>
        <div>
            <div class="text-gray-500 text-sm">Total Setor</div>
            <div class="font-bold text-xl">{{ $transaksi->count() }} Transaksi</div>
        </div>
    </div>
</div>
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="font-semibold text-lg mb-4 text-gray-700">Riwayat Transaksi Setor</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $trx)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $trx->tgl_setor }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection