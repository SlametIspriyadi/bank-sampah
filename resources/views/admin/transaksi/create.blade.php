@extends('admin.base')

@section('title', 'Buat Transaksi Setor Baru')
@section('header', 'Buat Transaksi Setor')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg max-w-4xl mx-auto">
    <div class="pb-6 mb-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Setor Sampah</h2>
        <p class="text-gray-500 mt-1">Lengkapi detail transaksi untuk nasabah di bawah ini.</p>
    </div>

    {{-- Menampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
            <p class="font-bold">Terjadi kesalahan, mohon periksa kembali isian Anda.</p>
        </div>
    @endif

    {{-- Informasi Nasabah --}}
    <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Nama Nasabah</label>
                <p class="text-lg font-semibold text-gray-800">{{ $nasabah->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">No. Registrasi</label>
                <p class="text-lg font-semibold text-gray-800">{{ $nasabah->no_reg }}</p>
            </div>
        </div>
    </div>
    
    <form action="{{ route('admin.transaksi.store') }}" method="POST" id="transaksi-form">
        @csrf
        <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">

        <div class="mb-6">
            <label for="tgl_setor" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Setor</label>
            <input type="date" name="tgl_setor" id="tgl_setor" class="w-full md:w-1/2 px-4 py-2.5 text-base text-gray-900 bg-gray-50 border @error('tgl_setor') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('tgl_setor', date('Y-m-d')) }}" required>
            @error('tgl_setor')
                <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Daftar Item Sampah --}}
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Detail Sampah yang Disetor</h3>
            <div id="sampah-group-list" class="space-y-4">
                {{-- Baris item sampah akan ditambahkan oleh JavaScript --}}
            </div>
            @error('sampah_id.*')
                 <p class="text-sm text-red-600 mt-2">Pastikan semua jenis sampah telah dipilih.</p>
            @enderror
            @error('berat.*')
                 <p class="text-sm text-red-600 mt-2">Pastikan semua berat/jumlah telah diisi dengan angka yang valid (contoh: 0.5 atau 1).</p>
            @enderror
        </div>

        {{-- Tombol Tambah Item --}}
        <button type="button" id="add-sampah-group" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 font-semibold transition-colors">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            <span>Tambah Jenis Sampah</span>
        </button>

        {{-- Kalkulasi Total --}}
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
            <div class="w-full md:w-1/2">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">Total Keseluruhan</span>
                    <span id="grand-total" class="text-2xl font-bold text-green-600">Rp0</span>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('admin.transaksi.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-base">Batal</a>
            <button type="submit" id="submit-button" class="px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold flex items-center gap-2 text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan Transaksi</span>
            </button>
        </div>
    </form>
</div>

<template id="sampah-group-template">
    <div class="sampah-group grid grid-cols-1 md:grid-cols-10 gap-4 items-center bg-gray-50 p-4 rounded-lg">
        <div class="md:col-span-4">
            <label class="block mb-1 text-xs font-medium text-gray-600">Jenis Sampah</label>
            <select name="sampah_id[]" class="sampah-select w-full px-4 py-2.5 text-base text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="" disabled selected>-- Pilih Jenis --</option>
                @foreach($sampah as $s)
                    <option value="{{ $s->sampah_id }}" data-harga="{{ $s->harga }}">{{ $s->jenis_sampah }} ({{ $s->satuan }})</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block mb-1 text-xs font-medium text-gray-600">Berat/Jumlah</label>
            <input type="number" step="0.01" min="0.01" name="berat[]" class="berat-input w-full px-4 py-2.5 text-base text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>
        <div class="md:col-span-3">
            <label class="block mb-1 text-xs font-medium text-gray-600">Subtotal</label>
            <input type="text" class="total-pendapatan-view w-full px-4 py-2.5 text-base text-gray-900 bg-gray-200 border border-gray-300 rounded-lg" value="Rp0" readonly>
            <input type="hidden" name="total_pendapatan[]" class="total-pendapatan-hidden">
        </div>
        <div class="md:col-span-1 text-center md:pt-6">
            <button type="button" class="remove-sampah-group text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.134-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.067-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
            </button>
        </div>
    </div>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const groupList = document.getElementById('sampah-group-list');
    const addButton = document.getElementById('add-sampah-group');
    const template = document.getElementById('sampah-group-template');
    const grandTotalElement = document.getElementById('grand-total');

    const updateGrandTotal = () => {
        let grandTotal = 0;
        document.querySelectorAll('.total-pendapatan-hidden').forEach(input => {
            grandTotal += parseFloat(input.value) || 0;
        });
        grandTotalElement.textContent = 'Rp' + grandTotal.toLocaleString('id-ID');
    };

    const calculateRowTotal = (group) => {
        const beratInput = group.querySelector('.berat-input');
        const sampahSelect = group.querySelector('.sampah-select');
        const totalView = group.querySelector('.total-pendapatan-view');
        const totalHidden = group.querySelector('.total-pendapatan-hidden');
        
        const berat = parseFloat(beratInput.value) || 0;
        const selectedOption = sampahSelect.options[sampahSelect.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        
        const total = berat * harga;
        totalView.value = 'Rp' + total.toLocaleString('id-ID');
        totalHidden.value = total;
        updateGrandTotal();
    };

    const attachEvents = (group) => {
        group.querySelector('.berat-input').addEventListener('input', () => calculateRowTotal(group));
        group.querySelector('.sampah-select').addEventListener('change', () => calculateRowTotal(group));
        group.querySelector('.remove-sampah-group').addEventListener('click', () => {
            if (groupList.querySelectorAll('.sampah-group').length > 1) {
                group.remove();
                updateGrandTotal();
            } else {
                alert('Minimal harus ada satu jenis sampah.');
            }
        });
    };
    
    const addSampahGroup = () => {
        const clone = template.content.cloneNode(true);
        groupList.appendChild(clone);
        attachEvents(groupList.lastElementChild);
    };

    addSampahGroup();
    addButton.addEventListener('click', addSampahGroup);

    const form = document.getElementById('transaksi-form');
    const submitButton = document.getElementById('submit-button');
    if(form && submitButton) {
        form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Menyimpan...</span>
            `;
        });
    }
});
</script>
@endpush