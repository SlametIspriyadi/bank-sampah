@extends('admin.base')

@section('title', 'Laporan Transaksi Setor')
@section('header', 'Laporan Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-end mb-4">
        <h2 class="text-xl font-semibold">Laporan Transaksi Setor</h2>
        <div class="flex flex-col items-end gap-2">
            <div class="flex gap-2">
                <a href="{{ route('admin.laporan.laporan_setor.pdf', array_filter(request()->only(['no_reg','bulan','tahun']))) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-blue-700">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
            </div>
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Cari No Reg" class="border px-3 py-2 rounded" />
                <select name="bulan" class="border px-3 py-2 rounded">
                    <option value="">Bulan</option>
                    @for($m=1;$m<=12;$m++)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endfor
                </select>
                <select name="tahun" class="border px-3 py-2 rounded">
                    <option value="">Tahun</option>
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Filter</button>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-green-600 text-white">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">No Reg</th>
                    <th class="px-4 py-2">Nama Nasabah</th>
                    <th class="px-4 py-2">Detil Sampah</th>
                    <th class="px-4 py-2">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($setor as $i => $trx)
                <tr>
                    <td class="border px-4 py-2">{{ $i+1 }}</td>
                    <td class="border px-4 py-2">{{ $trx->tgl_setor }}</td>
                    <td class="border px-4 py-2">{{ $trx->nasabah->no_reg ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $trx->nasabah->name ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        @if($trx->detil_sampah)
                            @php
                                $items = array_filter(array_map('trim', explode(';', $trx->detil_sampah)));
                            @endphp
                            <ul class="list-disc pl-5 mb-0 text-left">
                                @foreach($items as $item)
                                    @foreach(explode(',', $item) as $subitem)
                                        @if(trim($subitem) !== '')
                                            <li>{{ trim($subitem) }}</li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border px-4 py-2">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data transaksi setor.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
