@extends('admin.base')

@section('title', 'Tambah Data Nasabah')
@section('header', 'Tambah Data Nasabah')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Formulir Nasabah Baru</h2>
    <p class="text-gray-500 mb-8">Isi detail di bawah ini untuk mendaftarkan nasabah baru.</p>

    <form action="{{ route('admin.nasabah.store') }}" method="POST" id="nasabah-form">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Kolom No Registrasi --}}
            <div class="md:col-span-2">
                <label for="no_reg" class="block mb-2 text-sm font-medium text-gray-700">No. Registrasi</label>
                <input type="text" name="no_reg" id="no_reg" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('no_reg') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('no_reg') }}" required>
                @error('no_reg')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div class="md:col-span-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('jenis_kelamin') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- No. HP --}}
            <div>
                <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-700">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('no_hp') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('no_hp') }}">
                @error('no_hp')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Tempat & Tanggal Lahir --}}
            <div>
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="tgl_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('tgl_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('tgl_lahir') }}" required>
                @error('tgl_lahir')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white pr-10 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" required>
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 password-toggle" data-target="password">
                        <svg class="w-5 h-5 eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l3.75-3.75a1.651 1.651 0 112.333 2.333L4.17 10l2.578 2.578a1.651 1.651 0 01-2.333 2.333l-3.75-3.75zM19.336 10.59a1.651 1.651 0 010-1.18l-3.75-3.75a1.651 1.651 0 11-2.333 2.333L15.83 10l-2.578 2.578a1.651 1.651 0 012.333 2.333l3.75-3.75z" clip-rule="evenodd" /></svg>
                        <svg class="w-5 h-5 eye-slash hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38c-.351-.82-1.074-2.19-2.642-3.875l-1.428-1.428A4.46 4.46 0 0010 5.5a4.46 4.46 0 00-2.433 1.14l-1.286-1.286A9.948 9.948 0 0010 3a9.99 9.99 0 00-6.72 2.22zM15 10a5 5 0 01-5 5c-.947 0-1.826-.266-2.6-.723l-1.92-1.92A5.002 5.002 0 0115 10z" /></svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white pr-10" required>
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 password-toggle" data-target="password_confirmation">
                        {{-- Ikon mata sama seperti di atas --}}
                        <svg class="w-5 h-5 eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l3.75-3.75a1.651 1.651 0 112.333 2.333L4.17 10l2.578 2.578a1.651 1.651 0 01-2.333 2.333l-3.75-3.75zM19.336 10.59a1.651 1.651 0 010-1.18l-3.75-3.75a1.651 1.651 0 11-2.333 2.333L15.83 10l-2.578 2.578a1.651 1.651 0 012.333 2.333l3.75-3.75z" clip-rule="evenodd" /></svg>
                        <svg class="w-5 h-5 eye-slash hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38c-.351-.82-1.074-2.19-2.642-3.875l-1.428-1.428A4.46 4.46 0 0010 5.5a4.46 4.46 0 00-2.433 1.14l-1.286-1.286A9.948 9.948 0 0010 3a9.99 9.99 0 00-6.72 2.22zM15 10a5 5 0 01-5 5c-.947 0-1.826-.266-2.6-.723l-1.92-1.92A5.002 5.002 0 0115 10z" /></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="role" value="nasabah">
        
        <div class="mt-8 flex justify-end gap-4 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.nasabah.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-base">Batal</a>
            <button type="submit" id="submit-button" class="px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold flex items-center gap-2 text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan Data</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- Blok script tidak perlu diubah, fungsionalitasnya tetap sama --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- PASSWORD TOGGLE LOGIC ---
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            // ... (kode sama)
        });
    });

    // --- FORM SUBMIT LOADING STATE ---
    const form = document.getElementById('nasabah-form');
    const submitButton = document.getElementById('submit-button');
    if(form && submitButton) {
        form.addEventListener('submit', () => {
            // ... (kode sama)
        });
    }
});
</script>
@endpush