<aside class="w-64 h-screen bg-green-700 text-white flex flex-col fixed shadow-lg">
    <div class="p-4 border-b border-green-800 flex items-center gap-3">
        <div class="bg-white p-2 rounded-lg">
            <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.182-3.182m0-4.991v4.99" />
            </svg>
        </div>
        <span class="font-bold text-lg">Bank Sampah</span>
    </div>

    <nav class="mt-4 flex-grow overflow-y-auto">
        <ul class="px-4 space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l3.75-3.75m0 0l3.75 3.75M7.5 9.75v10.5a2.25 2.25 0 002.25 2.25h3.75a2.25 2.25 0 002.25-2.25V9.75M9 19.5h6" /></svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.nasabah.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.nasabah.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003c0 1.113.285 2.16.786 3.07M15 19.128c-1.113 0-2.16-.285-3.07-.786M7.5 14.25c0-1.113-.285-2.16-.786-3.07M7.5 14.25v.003c0 1.113.285 2.16.786 3.07M7.5 14.25c-1.113 0-2.16-.285-3.07-.786M7.5 14.25c1.113 0 2.16.285 3.07.786m0 0v.003c0 1.113-.285-2.16-.786-3.07M3.75 9.75c0-1.113.285-2.16.786-3.07M3.75 9.75v.003c0 1.113.285 2.16-.786 3.07M3.75 9.75c1.113 0 2.16.285 3.07.786m0 0v.003c0 1.113.285 2.16.786 3.07m0 0c1.113 0 2.16-.285 3.07-.786m0 0c-1.113 0-2.16-.285-3.07.786" /></svg>
                    <span>Data Nasabah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.sampah.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.sampah.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.134-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.067-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                    <span>Data Sampah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transaksi.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.transaksi.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                    <span>Setor Sampah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transaksi_tarik.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.transaksi_tarik.*') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-15c-.621 0-1.125-.504-1.125-1.125v-9.75c0-.621.504-1.125 1.125-1.125h1.5" /></svg>
                    <span>Tarik Saldo</span>
                </a>
            </li>
            
            <li>
                <button id="laporan-menu-toggle" class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg hover:bg-green-600 transition-colors">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6A2.25 2.25 0 0112.75 8.25v1.5a2.25 2.25 0 01-4.5 0v-1.5A2.25 2.25 0 0110.5 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75V15.75m0-15A7.5 7.5 0 004.5 8.25v4.5a7.5 7.5 0 0015 0v-4.5A7.5 7.5 0 0012 2.25z" /></svg>
                        <span>Laporan</span>
                    </span>
                    <svg id="laporan-menu-chevron" class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </button>
                <ul id="laporan-submenu" class="mt-2 space-y-2 pl-8 hidden">
                    <li><a href="{{ route('admin.laporan.laporan_setor') }}" class="block p-2 rounded-lg text-sm {{ request()->routeIs('admin.laporan.laporan_setor') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">Laporan Setor</a></li>
                    <li><a href="{{ route('admin.laporan.laporan_tarik') }}" class="block p-2 rounded-lg text-sm {{ request()->routeIs('admin.laporan.laporan_tarik') ? 'bg-green-600 font-semibold' : 'hover:bg-green-600' }}">Laporan Tarik</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-green-800">
        <form method="POST" action="{{ route('logout', [], false) }}" id="logout-form">
            @csrf
        </form>
        <button id="logout-button" class="w-full flex items-center justify-center gap-3 text-center px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
            <span>Logout</span>
        </button>
    </div>
</aside>

<div id="logout-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div class="ml-4 text-left">
                <h3 class="text-lg font-bold text-gray-900" id="modal-title">Konfirmasi Logout</h3>
                <p class="text-sm text-gray-600 mt-2">Apakah Anda yakin ingin mengakhiri sesi Anda?</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button id="cancel-logout" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</button>
            <button id="confirm-logout" type="button" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Ya, Logout</button>
        </div>
    </div>
</div>

{{-- Memindahkan semua script ke dalam @push untuk best practice --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- LOGOUT MODAL LOGIC ---
        const logoutButton = document.getElementById('logout-button');
        const logoutModal = document.getElementById('logout-modal');
        const confirmLogoutButton = document.getElementById('confirm-logout');
        const cancelLogoutButton = document.getElementById('cancel-logout');
        const logoutForm = document.getElementById('logout-form');

        if (logoutButton) {
            logoutButton.addEventListener('click', () => logoutModal.classList.remove('hidden'));
        }
        if (cancelLogoutButton) {
            cancelLogoutButton.addEventListener('click', () => logoutModal.classList.add('hidden'));
        }
        if (confirmLogoutButton) {
            confirmLogoutButton.addEventListener('click', () => logoutForm.submit());
        }
        // Klik di luar modal untuk menutup
        if (logoutModal) {
            logoutModal.addEventListener('click', (event) => {
                if (event.target === logoutModal) {
                    logoutModal.classList.add('hidden');
                }
            });
        }

        // --- LAPORAN SUBMENU TOGGLE LOGIC ---
        const laporanMenuToggle = document.getElementById('laporan-menu-toggle');
        const laporanSubmenu = document.getElementById('laporan-submenu');
        const laporanChevron = document.getElementById('laporan-menu-chevron');

        // Fungsi untuk memeriksa apakah ada link submenu yang aktif
        const isSubmenuActive = () => {
            return laporanSubmenu.querySelector('[class*="bg-green-600"]') !== null;
        };
        
        // Jika ada submenu yang aktif, buka dropdown saat halaman dimuat
        if (isSubmenuActive()) {
            laporanSubmenu.classList.remove('hidden');
            laporanChevron.classList.add('rotate-180');
        }
        
        if (laporanMenuToggle) {
            laporanMenuToggle.addEventListener('click', () => {
                laporanSubmenu.classList.toggle('hidden');
                laporanChevron.classList.toggle('rotate-180');
            });
        }
    });
</script>
@endpush