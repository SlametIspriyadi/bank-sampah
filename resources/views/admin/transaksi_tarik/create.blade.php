@extends('admin.base')

@section('title', 'Buat Transaksi Tarik Saldo')
@section('header', 'Buat Transaksi Tarik Saldo')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg max-w-2xl mx-auto">
    <div class="pb-6 mb-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Tarik Saldo</h2>
        <p class="text-gray-500 mt-1">Isi detail penarikan untuk nasabah di bawah ini.</p>
    </div>

    {{-- Notifikasi Error Validasi --}}
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
            <p class="font-bold">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Informasi Nasabah & Saldo --}}
    @if(isset($nasabah))
        <div class="mb-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Nasabah</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $nasabah->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Saldo Tersedia</label>
                    <p class="text-lg font-semibold text-green-600">Rp{{ number_format($saldoAkhir ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    <form action="{{ route('admin.transaksi_tarik.store') }}" method="POST" id="tarik-form">
        @csrf
        {{-- Kirim nasabah_id secara tersembunyi --}}
        @if(isset($nasabah))
            <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">
        @endif
        
        <div class="space-y-6">
            {{-- Tanggal Tarik --}}
            <div>
                <label for="tgl_tarik" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Tarik</label>
                <input type="date" name="tgl_tarik" id="tgl_tarik" class="w-full px-4 py-2.5 text-base bg-gray-50 border @error('tgl_tarik') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500" value="{{ old('tgl_tarik', date('Y-m-d')) }}" required min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                @error('tgl_tarik')<p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>@enderror
            </div>
            
            {{-- Jumlah Tarik --}}
            <div>
                <label for="jumlah_tarik" class="block mb-2 text-sm font-medium text-gray-700">Jumlah Penarikan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-base text-gray-500">Rp</span>
                    <input type="number" name="jumlah_tarik" id="jumlah_tarik" class="w-full pl-10 pr-4 py-2.5 text-base bg-gray-50 border @error('jumlah_tarik') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500" min="1" value="{{ old('jumlah_tarik') }}" placeholder="Contoh: 50000" required @if(isset($saldoAkhir)) max="{{ $saldoAkhir }}" @endif>
                </div>
                @error('jumlah_tarik')<p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>@enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
                <input type="text" name="keterangan" id="keterangan" class="w-full px-4 py-2.5 text-base bg-gray-50 border @error('keterangan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500" value="{{ old('keterangan') }}" placeholder="Contoh: Penarikan tunai">
                @error('keterangan')<p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.transaksi_tarik.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-base">Batal</a>
            <button type="submit" id="submit-button" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-semibold flex items-center gap-2 text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                <span>Simpan Penarikan</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Menambahkan loading state pada tombol submit untuk mencegah klik ganda
    const form = document.getElementById('tarik-form');
    const submitButton = document.getElementById('submit-button');
    if(form && submitButton) {
        form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span>Menyimpan...</span>
            `;
        });
    }
});
</script>
@endpush