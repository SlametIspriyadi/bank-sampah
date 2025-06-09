<!-- resources/views/user/partials/sidebar.blade.php -->
<aside class="w-64 h-screen bg-green-500 text-white flex flex-col fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">USER</div>
    <!-- Menambahkan flex-grow agar navigasi memenuhi sisa ruang, mendorong logout ke bawah -->
    <nav class="mt-6 flex-grow">
        <ul>
            <li class="mb-2">
                <a href="{{ route('user.dashboard') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.dashboard') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('user.transaksi.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.transaksi.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    Riwayat Transaksi
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('user.setor.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.setor.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    Setor Sampah
                </a>
            </li>
            <li class="mb-2">
                <a href="#" class="block px-6 py-2 rounded {{ request()->routeIs('user.laporan.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    Laporan
                </a>
            </li>
        </ul>
    </nav>
    <!-- Menambahkan div tambahan untuk memastikan tombol logout menempel di bawah -->
    <div class="px-6 py-4 border-t border-green-700">
        <form method="POST" action="{{ route('logout') }}" id="user-logout-form">
            @csrf
            <!-- Mengubah type menjadi "button" agar tidak langsung submit form saat diklik -->
            <!-- Mengubah warna tombol menjadi merah dengan teks putih -->
            <button type="button" id="user-logout-button" class="w-full text-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- Modal Konfirmasi Logout Kustom untuk User -->
<!-- Modal ini awalnya tersembunyi dan akan ditampilkan/disembunyikan oleh JavaScript -->
<div id="user-logout-modal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-96 max-w-sm">
        <div class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi Logout</div>
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-end space-x-3">
            <button id="user-cancel-logout" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                Batal
            </button>
            <button id="user-confirm-logout" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
                Ya, Logout
            </button>
        </div>
    </div>
</div>

<style>
    /* Styling khusus untuk tabel header dan tombol hijau sidebar */
    .table-header-custom {
        background: #22b14c !important;
        color: #fff !important;
    }
    .btn-green {
        background: #22b14c !important;
        color: #fff !important;
    }
    .btn-green:hover {
        background: #1a8c3a !important;
        color: #fff !important;
    }
    /* Untuk border dan highlight baris aktif tabel */
    .table-row-active {
        background: #e6f9ee !important;
    }
</style>

<script>
    // Memastikan DOM sepenuhnya dimuat sebelum mencoba mengakses elemen
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan referensi ke elemen DOM yang diperlukan untuk sidebar user
        const userLogoutButton = document.getElementById('user-logout-button');
        const userLogoutModal = document.getElementById('user-logout-modal');
        const userConfirmLogoutButton = document.getElementById('user-confirm-logout');
        const userCancelLogoutButton = document.getElementById('user-cancel-logout');
        const userLogoutForm = document.getElementById('user-logout-form');

        // Menambahkan event listener ke tombol "Logout" di sidebar user
        userLogoutButton.addEventListener('click', function () {
            userLogoutModal.classList.remove('hidden'); // Menampilkan modal
        });

        // Menambahkan event listener ke tombol "Batal" di dalam modal user
        userCancelLogoutButton.addEventListener('click', function () {
            userLogoutModal.classList.add('hidden'); // Menyembunyikan modal
        });

        // Menambahkan event listener ke overlay modal user itu sendiri
        userLogoutModal.addEventListener('click', function (event) {
            if (event.target === userLogoutModal) {
                userLogoutModal.classList.add('hidden');
            }
        });

        // Menambahkan event listener ke tombol "Ya, Logout" di dalam modal user
        userConfirmLogoutButton.addEventListener('click', function () {
            userLogoutForm.submit(); // Mengirimkan form logout
        });
    });
</script>
