@extends('admin.base')

@section('title', 'Tambah Data Sampah')
@section('header', 'Tambah Data Sampah')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Formulir Jenis Sampah Baru</h2>
    <p class="text-gray-500 mb-8">Isi detail di bawah ini untuk menambahkan jenis sampah baru yang diterima.</p>

    {{-- Notifikasi Error Validasi --}}
    @if($errors->any())
        <div class="mb-6 p-4 flex items-start gap-3 bg-red-100 text-red-800 rounded-lg shadow">
             <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            <div>
                <span class="font-semibold">Terjadi kesalahan validasi</span>
                <ul class="list-disc pl-5 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.sampah.store') }}" method="POST" id="sampah-form">
        @csrf
        <div class="space-y-6">
            {{-- Jenis Sampah --}}
            <div>
                <label for="jenis_sampah" class="block mb-2 text-sm font-medium text-gray-700">Jenis Sampah</label>
                <input type="text" name="jenis_sampah" id="jenis_sampah" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('jenis_sampah') border-red-500 focus:ring-red-500 @enderror" value="{{ old('jenis_sampah') }}" maxlength="100" required>
                @error('jenis_sampah')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Satuan --}}
            <div>
                <label for="satuan" class="block mb-2 text-sm font-medium text-gray-700">Satuan</label>
                <select name="satuan" id="satuan" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('satuan') border-red-500 focus:ring-red-500 @enderror" required>
                    <option value="" disabled {{ old('satuan') ? '' : 'selected' }}>-- Pilih Satuan --</option>
                    <option value="Kg" {{ old('satuan') == 'Kg' ? 'selected' : '' }}>Kg (Kilogram)</option>
                    <option value="Pcs" {{ old('satuan') == 'Pcs' ? 'selected' : '' }}>Pcs (Pieces/Buah)</option>
                </select>
                @error('satuan')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-700">Harga per Satuan (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-base text-gray-500">Rp</span>
                    <input type="number" name="harga" id="harga" class="w-full pl-10 pr-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('harga') border-red-500 focus:ring-red-500 @enderror" value="{{ old('harga') }}" min="0" required>
                </div>
                @error('harga')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-8 flex justify-end gap-4 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.sampah.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-base">Batal</a>
            <button type="submit" id="submit-button" class="px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold flex items-center gap-2 text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Menambahkan loading state pada tombol submit untuk mencegah klik ganda
    const form = document.getElementById('sampah-form');
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

    // Script notifikasi auto-hide bisa ditambahkan di sini jika diperlukan
});
</script>
@endpush