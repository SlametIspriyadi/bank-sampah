@extends('user.base')
@section('title', 'Riwayat Transaksi')
@section('content')
<div>
    <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi Setor</h2>
    <div class="mb-4 flex flex-wrap gap-2 items-center">
        <form method="GET" class="flex flex-wrap gap-2 items-center w-full md:w-auto">
            <label for="bulan" class="mr-2">Bulan:</label>
            <select name="bulan" id="bulan" class="border rounded px-2 py-1">
                <option value="">Semua</option>
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" @if(request('bulan') == $b) selected @endif>{{ str_pad($b,2,'0',STR_PAD_LEFT) }}</option>
                @endforeach
            </select>
            <label for="tahun" class="ml-2 mr-2">Tahun:</label>
            <select name="tahun" id="tahun" class="border rounded px-2 py-1">
                <option value="">Semua</option>
                @foreach($tahunList as $tahun)
                    <option value="{{ $tahun }}" @if(request('tahun') == $tahun) selected @endif>{{ $tahun }}</option>
                @endforeach
            </select>
            <button type="submit" class="ml-2 bg-green-600 text-white px-3 py-1 rounded">Filter</button>
            @if(request('bulan') || request('tahun'))
                <a href="{{ route('user.transaksi.index') }}" class="ml-2 text-sm text-red-600 underline">Reset</a>
            @endif
        </form>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="bg-green-600 text-white">
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Detil Sampah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $trx)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $trx->tgl_setor }}</td>
                <td class="border px-4 py-2 text-center">Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    @if(isset($trx->detil_sampah) && is_array($trx->detil_sampah))
                        <ul class="list-disc pl-4">
                        @foreach($trx->detil_sampah as $detil)
                            <li>{{ $detil['jenis_sampah'] ?? '-' }} {{ $detil['jumlah'] ?? '-' }} {{ $detil['satuan'] ?? '' }}</li>
                        @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $transaksi->appends(request()->query())->links() }}
    </div>
    </div>
</div>
@endsection
