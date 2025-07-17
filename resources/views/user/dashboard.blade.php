@extends('user.base')

@section('title', 'Dashboard Nasabah')
@section('header', 'Dashboard')

@section('content')

{{-- Header Sambutan --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-500 mt-1">Ini adalah ringkasan aktivitas dan data Anda di Bank Sampah.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Kolom Kiri: Kartu Finansial --}}
    <div class="lg:col-span-1 space-y-6">
        {{-- Saldo Saat Ini --}}
        <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center gap-4">
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 3a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 3V9" /></svg>
                </div>
                <div>
                    <div class="text-sm font-medium opacity-80">Saldo Tersedia</div>
                    <div class="text-3xl font-bold">Rp{{ number_format($saldo, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Total Setor --}}
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Total Setor</div>
                    <div class="text-xl font-bold text-gray-800">Rp{{ number_format($totalSetor, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Total Tarik --}}
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center gap-4">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m-7.5-7.5h15" /></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Total Tarik</div>
                    <div class="text-xl font-bold text-gray-800">Rp{{ number_format($totalTarik, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Profil Nasabah --}}
    <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-4 mb-6">Profil Saya</h3>
        <div class="space-y-4">
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">No. Registrasi</div>
                <div class="w-2/3 text-sm text-gray-800 font-semibold">{{ $user->no_reg }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">Nama Lengkap</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->name }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">Alamat</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->alamat }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">No. HP</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->no_hp }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">Jenis Kelamin</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">Tanggal Lahir</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y') : '-' }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-sm font-medium text-gray-500">Tanggal Registrasi</div>
                <div class="w-2/3 text-sm text-gray-800">{{ $user->tgl_registrasi ? \Carbon\Carbon::parse($user->tgl_registrasi)->translatedFormat('d F Y') : '-' }}</div>
            </div>
        </div>
    </div>

</div>
@endsection