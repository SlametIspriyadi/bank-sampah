@extends('user.base')
@section('title', 'Dashboard Nasabah')
@section('content')
<div class="border-b border-gray-200 mb-6 pb-2 flex items-center">
    <h1 class="text-2xl font-bold tracking-wide text-gray-800">Bank Sampah Tanjung Lestari</h1>
</div>
<div class="bg-white rounded-lg shadow-md p-8 max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-6 text-center">Data Nasabah</h2>
    <table class="w-full mb-6">
        <tr>
            <td class="py-2 font-semibold w-1/3">Nama</td>
            <td class="py-2">{{ $user->name }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">No. Registrasi</td>
            <td class="py-2">{{ $user->no_reg }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">Alamat</td>
            <td class="py-2">{{ $user->alamat }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">No. HP</td>
            <td class="py-2">{{ $user->no_hp }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">Jenis Kelamin</td>
            <td class="py-2">{{ $user->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">Tanggal Lahir</td>
            <td class="py-2">{{ $user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('Y-m-d') : '-' }}</td>
        </tr>
        <tr>
            <td class="py-2 font-semibold">Tanggal Registrasi</td>
            <td class="py-2">{{ $user->tgl_registrasi ? \Carbon\Carbon::parse($user->tgl_registrasi)->format('Y-m-d') : '-' }}</td>
        </tr>
    </table>
    <div class="bg-blue-100 text-blue-700 rounded p-4 mb-2">
        <div class="text-gray-500 text-sm">Saldo Saat Ini</div>
        <div class="font-bold text-2xl">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
    </div>
    <div class="flex gap-4 mt-4">
        <div class="bg-green-100 text-green-700 rounded p-4 flex-1 text-center">
            <div class="text-sm">Total Setor</div>
            <div class="font-bold text-lg">Rp {{ number_format($totalSetor, 0, ',', '.') }}</div>
        </div>
        <div class="bg-yellow-100 text-yellow-700 rounded p-4 flex-1 text-center">
            <div class="text-sm">Total Tarik</div>
            <div class="font-bold text-lg">Rp {{ number_format($totalTarik, 0, ',', '.') }}</div>
        </div>
    </div>
</div>
@endsection