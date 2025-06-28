@extends('admin.base')

@section('title', 'Transaksi Tarik')
@section('header', 'Transaksi Tarik')

@section('content')
<div class="bg-white p-6 rounded shadow">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="mb-0 pl-4 list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(isset($notifikasi) && $notifikasi)
        <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">{{ $notifikasi }}</div>
    @endif
    @if(session('nota_pdf'))
        <script>
            window.onload = function() {
                var url = @json(session('nota_pdf'));
                var a = document.createElement('a');
                a.href = url;
                a.download = '';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            };
        </script>
    @endif
    <div class="flex justify-between items-end mb-4">
        <h2 class="text-xl font-semibold">Transaksi Tarik Saldo</h2>
        <div class="flex flex-col items-end gap-2">
            <form method="GET" action="" class="flex items-center gap-2 mb-2">
                <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Cari No Reg" class="border px-3 py-2 rounded" />
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Cari</button>
            </form>
            <!-- <div class="flex gap-2">
                <a href="{{ route('admin.transaksi_tarik.create') }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Tambah Transaksi Tarik</a>
                <a href="{{ route('admin.transaksi_tarik.exportPdf', array_filter(request()->only(['no_reg']))) }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-red-700">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
            </div> -->
        </div>
    </div>
    <div class="overflow-x-auto">
        @if(request('no_reg') && isset($nasabah) && $saldoAkhir > 0)
            <table class="min-w-full mb-6">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="px-4 py-2">No Reg</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Saldo</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">{{ $nasabah->no_reg }}</td>
                        <td class="border px-4 py-2">{{ $nasabah->name }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.transaksi_tarik.create', ['nasabah_id' => $nasabah->id]) }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Tarik Saldo</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @elseif(request('no_reg') && isset($nasabah) && $saldoAkhir <= 0)
            <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">Saldo kosong, tidak bisa melakukan penarikan.</div>
        @endif
        <!-- @if(!request('no_reg') || !isset($nasabah))
        {{--
        <table class="min-w-full">
            <thead>
                <tr class="bg-green-600 text-white">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Nasabah</th>
                    <th class="px-4 py-2">Jumlah Tarik</th>
                    <th class="px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarik as $i => $trx)
                <tr>
                    <td class="border px-4 py-2">{{ $i+1 }}</td>
                    <td class="border px-4 py-2">{{ $trx->tgl_tarik }}</td>
                    <td class="border px-4 py-2">{{ $trx->nasabah->name ?? '-' }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $trx->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data transaksi tarik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        --}}
        @endif -->
    </div>
</div>
@endsection
