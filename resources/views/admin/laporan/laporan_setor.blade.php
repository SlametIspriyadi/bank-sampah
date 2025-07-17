@extends('admin.base')

@section('title', 'Laporan Transaksi Setor')
@section('header', 'Laporan Transaksi Setor')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">

    {{-- Header dan Filter --}}
    <div class="mb-6 pb-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Laporan Transaksi Setor</h2>
                <p class="text-sm text-gray-500 mt-1">Filter dan lihat semua riwayat transaksi setor.</p>
            </div>
            <a href="{{ route('admin.laporan.laporan_setor.pdf') }}?{{ http_build_query(request()->query()) }}" target="_blank" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-semibold transition-colors">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Export PDF</span>
            </a>
        </div>
        <form method="GET" action="" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Cari No. Reg..." class="w-full px-4 py-2.5 text-base bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" />
            <select name="bulan" class="w-full px-4 py-2.5 text-base bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">Semua Bulan</option>
                @for($m=1;$m<=12;$m++)
                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                        {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
            <select name="tahun" class="w-full px-4 py-2.5 text-base bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">Semua Tahun</option>
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <button type="submit" class="w-full px-4 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold">Filter</button>
        </form>
    </div>

    {{-- Tabel Laporan --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Nasabah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Sampah</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($setor as $i => $trx)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $setor->firstItem() + $i }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($trx->tgl_setor)->translatedFormat('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="font-semibold text-gray-900">{{ $trx->nasabah->name ?? '-' }}</div>
                        <div class="text-gray-500">{{ $trx->nasabah->no_reg ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <ul class="list-disc pl-5 space-y-1">
                            {{-- Memanggil accessor dari model, membuat view lebih bersih --}}
                            @foreach($trx->detail_sampah_formatted as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-semibold">
                        Rp{{ number_format($trx->total_pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        <p class="font-semibold">Tidak ada data transaksi yang cocok dengan filter Anda.</p>
                        <p class="text-sm">Coba hapus atau ubah filter untuk melihat hasil.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $setor->appends(request()->query())->links() }}
    </div>
</div>
@endsection