@extends('admin.base')

@section('title', 'Tambah Transaksi Tarik')
@section('header', 'Tambah Transaksi Tarik')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.transaksi_tarik.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Tarik</label>
            <input type="date" name="tgl_tarik" class="w-full border px-3 py-2 rounded" value="{{ old('tgl_tarik', date('Y-m-d')) }}" required>
        </div>
        @if(isset($nasabah) && isset($saldoAkhir))
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nasabah</label>
            <input type="text" class="w-full border px-3 py-2 rounded bg-gray-100" value="{{ $nasabah->no_reg }} - {{ $nasabah->name }}" readonly>
            <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Saldo Saat Ini</label>
            <input type="text" class="w-full border px-3 py-2 rounded bg-gray-100" value="Rp {{ number_format($saldoAkhir, 0, ',', '.') }}" readonly>
        </div>
        @endif
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jumlah Tarik</label>
            <input type="number" name="jumlah_tarik" id="jumlah_tarik" class="w-full border px-3 py-2 rounded" min="1" value="{{ old('jumlah_tarik') }}" required @if(isset($saldoAkhir)) max="{{ $saldoAkhir }}" @endif>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Keterangan</label>
            <input type="text" name="keterangan" class="w-full border px-3 py-2 rounded" value="{{ old('keterangan') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
