@extends('admin.base')

@section('title', 'Transaksi Tarik Saldo')
@section('header', 'Transaksi Tarik Saldo')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">

    {{-- Notifikasi Sukses (Hanya menampilkan pesan) --}}
    @if(session('success'))
        <div id="notification" class="transition-opacity duration-300 ease-out mb-6 p-4 flex items-center gap-3 bg-green-100 text-green-800 rounded-lg shadow">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    
    {{-- Notifikasi Error --}}
    @if(session('error') || isset($notifikasi))
        <div id="notification" class="transition-opacity duration-300 ease-out mb-6 p-4 flex items-center gap-3 bg-red-100 text-red-800 rounded-lg shadow">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            <span>{{ session('error') ?? $notifikasi }}</span>
        </div>
    @endif

    {{-- Blok Aksi Setelah Transaksi Berhasil --}}
    @if(session('nota_filename'))
    <div class="mb-8 p-6 bg-blue-50 border-2 border-dashed border-blue-200 rounded-xl text-center">
        <h3 class="font-bold text-lg text-blue-800">Transaksi Sebelumnya Berhasil!</h3>
        <p class="text-gray-600 mt-1">Anda dapat mencetak atau mengunduh nota transaksi terakhir di sini.</p>
        <div class="mt-4">
            <a href="{{ route('admin.transaksi_tarik.downloadNota', ['filename' => session('nota_filename')]) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-lg font-semibold text-base">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231a1.125 1.125 0 01-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5z" /></svg>
                Cetak Nota Terakhir
            </a>
        </div>
    </div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tarik Saldo Nasabah</h2>
        <p class="text-gray-500 mt-1">Cari nasabah berdasarkan Nomor Registrasi untuk memulai transaksi penarikan.</p>
        <form method="GET" action="{{ route('admin.transaksi_tarik.index') }}" class="flex items-center gap-3 mt-4">
            <div class="relative flex-grow">
                <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Masukkan Nomor Registrasi Nasabah..." class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-3 pl-12 text-base focus:ring-2 focus:ring-green-500" autofocus />
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
            </div>
            <button type="submit" class="px-6 py-3 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <span>Cari</span>
            </button>
        </form>
    </div>

    <div class="min-h-[200px] flex items-center justify-center bg-gray-50 rounded-xl p-4">
        @if(request('no_reg') && isset($nasabah))
            <div class="w-full max-w-2xl text-center">
                <h3 class="text-lg font-semibold text-gray-500">Nasabah Ditemukan</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $nasabah->name }}</p>
                <div class="mt-4 flex justify-center divide-x divide-gray-300">
                    <div class="px-4"><div class="text-sm text-gray-500">No. Registrasi</div><div class="text-base font-semibold text-gray-700">{{ $nasabah->no_reg }}</div></div>
                    <div class="px-4"><div class="text-sm text-gray-500">Saldo Tersedia</div><div class="text-base font-semibold text-green-600">Rp{{ number_format($saldoAkhir ?? 0, 0, ',', '.') }}</div></div>
                </div>
                @if(isset($saldoAkhir) && $saldoAkhir > 0)
                    <div class="mt-6">
                        <a href="{{ route('admin.transaksi_tarik.create', ['nasabah_id' => $nasabah->id]) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-lg font-semibold text-lg">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" /></svg>
                            <span>Lanjutkan Tarik Saldo</span>
                        </a>
                    </div>
                @else
                     <p class="mt-4 text-yellow-800 font-semibold">Saldo kosong atau tidak mencukupi untuk penarikan.</p>
                @endif
            </div>
        @elseif(request('no_reg') && !isset($nasabah))
            <div class="text-center text-yellow-700">
                <svg class="w-16 h-16 mx-auto text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                <p class="mt-4 font-semibold text-lg">Nasabah dengan No. Reg '{{ request('no_reg') }}' Tidak Ditemukan</p>
            </div>
        @else
            <div class="text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <p class="mt-4 font-semibold text-lg">Silakan Cari Nasabah</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const notification = document.getElementById('notification');
    if (notification) {
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 5000);
    }
});
</script>
@endpush