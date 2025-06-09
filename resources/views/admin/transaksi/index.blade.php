@extends('admin.base')

@section('title', 'Transaksi Setor')
@section('header', 'Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    {{-- Bagian notifikasi yang dihapus --}}
    {{--
    @if(session('success'))
        <div id="notif-success" class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div id="notif-error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div id="notif-error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="mb-0 pl-4 list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        setTimeout(function() {
            let notif = document.getElementById('notif-success');
            if(notif) notif.style.display = 'none';
            let notifErr = document.getElementById('notif-error');
            if(notifErr) notifErr.style.display = 'none';
        }, 2500);
    </script>
    --}}
    <div class="flex justify-between items-end mb-4">
        <h2 class="text-xl font-semibold">Transaksi Setor</h2>
        <div class="flex flex-col items-end gap-2">
            <div class="flex gap-2">
                <!-- Tombol Tambah Transaksi dengan warna hover sidebar -->
                <a href="{{ route('admin.transaksi.create') }}" class="px-4 py-2 rounded mb-1 bg-green-600 text-white hover:bg-green-700">Tambah Transaksi</a>
                <a href="{{ route('admin.transaksi.exportPdf', array_filter(request()->only(['no_reg','bulan','tahun']))) }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-red-700">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
            </div>
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Cari No Reg" class="border px-3 py-2 rounded" />
                <select name="bulan" class="border px-3 py-2 rounded">
                    <option value="">Bulan</option>
                    @for($m=1; $m<=12; $m++)
                        <option value="{{ $m }}" {{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                    @endfor
                </select>
                <select name="tahun" class="border px-3 py-2 rounded">
                    <option value="">Tahun</option>
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <!-- Tombol Filter dengan warna hover sidebar -->
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Filter</button>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <!-- Header tabel dengan warna hover sidebar -->
            <tr class="bg-green-600 text-white">
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
