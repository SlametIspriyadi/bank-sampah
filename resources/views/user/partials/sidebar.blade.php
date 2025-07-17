{{-- Menggunakan data user yang sedang login --}}
@php
    $user = auth()->user();
@endphp

<aside class="w-64 h-screen bg-green-700 text-white flex flex-col fixed shadow-lg">
    <div class="p-4 font-bold text-lg border-b border-green-800 flex items-center gap-3">
         <div class="bg-white p-2 rounded-lg">
            <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <span>Dasbor Nasabah</span>
    </div>

    <nav class="mt-4 flex-grow overflow-y-auto">
        <ul class="px-4 space-y-2">
            <li>
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l3.75-3.75m0 0l3.75 3.75M7.5 9.75v10.5a2.25 2.25 0 002.25 2.25h3.75a2.25 2.25 0 002.25-2.25V9.75M9 19.5h6" /></svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.transaksi.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('user.transaksi.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                    <span>Riwayat Setor</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.setor.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('user.setor.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                     <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" /></svg>
                    <span>Riwayat Tarik</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-green-800">
        <div class="mb-4 p-3 bg-green-800 rounded-lg">
            <div class="text-sm font-medium text-white">{{ $user->name ?? 'Nama Nasabah' }}</div>
            <div class="text-xs text-green-200">No. Reg: {{ $user->no_reg ?? '-' }}</div>
            <div class="mt-2 text-lg font-bold text-white">
                Saldo: Rp{{ number_format($user->saldo_tersedia ?? 0, 0, ',', '.') }}
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" id="user-logout-form"></form>
        @csrf
        <button id="user-logout-button" class="w-full flex items-center justify-center gap-3 text-center px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
            <span>Logout</span>
        </button>
    </div>
</aside>

<div id="user-logout-modal" role="dialog" aria-modal="true" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div class="ml-4 text-left">
                <h3 class="text-lg font-bold text-gray-900">Konfirmasi Logout</h3>
                <p class="text-sm text-gray-600 mt-2">Apakah Anda yakin ingin mengakhiri sesi Anda?</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button id="user-cancel-logout" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</button>
            <button id="user-confirm-logout" type="button" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Ya, Logout</button>
        </div>
    </div>
</div>

{{-- Memindahkan script ke dalam @push untuk best practice --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('user-logout-button');
    const logoutModal = document.getElementById('user-logout-modal');
    const confirmLogoutButton = document.getElementById('user-confirm-logout');
    const cancelLogoutButton = document.getElementById('user-cancel-logout');
    const logoutForm = document.getElementById('user-logout-form');

    if (logoutButton && logoutModal && confirmLogoutButton && cancelLogoutButton && logoutForm) {
        logoutButton.addEventListener('click', () => logoutModal.classList.remove('hidden'));
        cancelLogoutButton.addEventListener('click', () => logoutModal.classList.add('hidden'));
        confirmLogoutButton.addEventListener('click', () => logoutForm.submit());
        logoutModal.addEventListener('click', (event) => {
            if (event.target === logoutModal) {
                logoutModal.classList.add('hidden');
            }
        });
    }
});
</script>
@endpush