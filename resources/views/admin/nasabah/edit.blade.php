@extends('admin.base')

@section('title', 'Edit Data Nasabah')
@section('header', 'Edit Data Nasabah')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Edit Data: {{ $nasabah->name }}</h2>
    <p class="text-gray-500 mb-8">Perbarui detail nasabah di bawah ini.</p>
    
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

    <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST" id="nasabah-form">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- No Registrasi (Read-only) --}}
            <div>
                <label for="no_reg" class="block mb-2 text-sm font-medium text-gray-700">No. Registrasi</label>
                <input type="text" name="no_reg" id="no_reg" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-200 cursor-not-allowed border border-gray-300 rounded-lg" value="{{ old('no_reg', $nasabah->no_reg) }}" readonly>
                <p class="text-xs text-gray-500 mt-1">No. Registrasi tidak dapat diubah.</p>
            </div>

            {{-- Nama Lengkap --}}
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('name') border-red-500 focus:ring-red-500 @enderror" value="{{ old('name', $nasabah->name) }}" required>
                @error('name') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('jenis_kelamin') border-red-500 @enderror" required>
                    <option value="L" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- No. HP --}}
            <div>
                <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-700">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('no_hp') border-red-500 @enderror" value="{{ old('no_hp', $nasabah->no_hp) }}">
                @error('no_hp') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
            
            {{-- Tempat Lahir --}}
            <div>
                <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('tempat_lahir') border-red-500 @enderror" value="{{ old('tempat_lahir', $nasabah->tempat_lahir) }}">
                @error('tempat_lahir') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label for="tgl_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('tgl_lahir') border-red-500 @enderror" value="{{ old('tgl_lahir', $nasabah->tgl_lahir ? date('Y-m-d', strtotime($nasabah->tgl_lahir)) : '') }}">
                @error('tgl_lahir') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:bg-white @error('alamat') border-red-500 @enderror">{{ old('alamat', $nasabah->alamat) }}</textarea>
                @error('alamat') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal Registrasi (Read-only) --}}
            <div class="md:col-span-2">
                <label for="tgl_registrasi" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Registrasi</label>
                <input type="date" name="tgl_registrasi" class="w-full px-4 py-2.5 text-base text-gray-900 bg-gray-200 cursor-not-allowed border border-gray-300 rounded-lg" value="{{ old('tgl_registrasi', $nasabah->tgl_registrasi ? date('Y-m-d', strtotime($nasabah->tgl_registrasi)) : '') }}" readonly>
            </div>
        </div>
        
        <div class="mt-8 flex justify-end gap-4 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.nasabah.index') }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold text-base">Batal</a>
            <button type="submit" id="submit-button" class="px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold flex items-center gap-2 text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                <span>Update Data</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Menambahkan loading state pada tombol submit untuk mencegah klik ganda
    const form = document.getElementById('nasabah-form');
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