@extends('user.base')

@section('title', 'Riwayat Tarik Saldo')
@section('header', 'Riwayat Tarik Saldo')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">

    {{-- Header dan Filter --}}
    <div class="mb-6 pb-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Riwayat Penarikan Saldo Anda</h2>
                <p class="text-sm text-gray-500 mt-1">Lihat semua riwayat transaksi penarikan saldo Anda di sini.</p>
            </div>
        </div>
        <form method="GET" action="" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <select name="bulan" class="w-full px-4 py-2.5 text-base bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">Semua Bulan</option>
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>
            <select name="tahun" class="w-full px-4 py-2.5 text-base bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">Semua Tahun</option>
                @foreach($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
            <div class="flex items-center gap-2 col-span-2 sm:col-span-1 md:col-span-2">
                <button type="submit" class="w-full px-4 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold">Filter</button>
                @if(request('bulan') || request('tahun'))
                    <a href="{{ route('user.setor.index') }}" class="w-full px-4 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-center">Reset</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Tabel Laporan --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tarik</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transaksi as $trx)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($trx->tgl_tarik)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-semibold">
                        Rp{{ number_format($trx->jumlah_tarik, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $trx->keterangan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-16 text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                            <p class="font-semibold">Tidak Ada Riwayat Penarikan</p>
                            <p class="text-sm mt-1">Anda belum pernah melakukan transaksi tarik saldo.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $transaksi->appends(request()->query())->links() }}
    </div>
</div>
@endsection