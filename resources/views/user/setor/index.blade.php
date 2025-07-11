@extends('user.base')
@section('title', 'Riwayat Tarik Saldo')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Riwayat Tarik Saldo</h2>
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
                <a href="{{ route('user.setor.index') }}" class="ml-2 text-sm text-red-600 underline">Reset</a>
            @endif
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full mt-4">
            <thead>
                <tr class="bg-green-600 text-white">
                    <th class="px-2 py-1">Tanggal</th>
                    <th class="px-2 py-1">Jumlah Tarik</th>
                    <th class="px-2 py-1">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $trx)
                <tr>
                    <td class="border px-2 py-1 text-center">{{ $trx->tgl_tarik }}</td>
                    <td class="border px-2 py-1 text-center">Rp {{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
                    <td class="border px-2 py-1 text-center">{{ $trx->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Tidak ada data transaksi tarik.</td>
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
