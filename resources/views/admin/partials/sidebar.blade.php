<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="w-64 h-screen bg-green-500 text-white flex flex-col fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">ADMIN</div>
    <!-- Menambahkan flex-grow agar navigasi memenuhi sisa ruang, mendorong logout ke bawah -->
    <nav class="mt-6 flex-grow">
        <ul>
            <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-green-600' : 'hover:bg-green-600' }}">Dashboard</a></li>
            <li class="mb-2"><a href="{{ route('admin.nasabah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.nasabah.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Data Nasabah</a></li>
            <li class="mb-2"><a href="{{ route('admin.sampah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.sampah.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Data Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.transaksi.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.transaksi.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Setor Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.transaksi_tarik.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.transaksi_tarik.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Tarik Saldo</a></li>
            <li class="mb-2"><a href="{{ route('admin.laporan.laporan_setor') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.laporan.laporan_setor') ? 'bg-green-600' : 'hover:bg-green-600' }}">Laporan Setor</a></li>
            <li class="mb-2"><a href="{{ route('admin.laporan.laporan_tarik') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.laporan.laporan_tarik') ? 'bg-green-600' : 'hover:bg-green-600' }}">Laporan Tarik</a></li>
        </ul>
    </nav>
    <!-- Menambahkan div tambahan untuk memastikan tombol logout menempel di bawah -->
    <div class="px-6 py-4 border-t border-green-700">
        <form method="POST" action="{{ route('logout', [], false) }}" id="logout-form">
            @csrf
            <!-- Mengubah type menjadi "button" agar tidak langsung submit form saat diklik -->
            <!-- Mengubah warna tombol menjadi merah dengan teks putih -->
            <button type="button" id="logout-button" class="w-full text-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- Modal Konfirmasi Logout Kustom -->
<!-- Modal ini awalnya tersembunyi dan akan ditampilkan/disembunyikan oleh JavaScript -->
<div id="logout-modal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-96 max-w-sm">
        <div class="text-lg font-semibold mb-4 text-gray-800">Konfirmasi Logout</div>
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin keluar?</p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-logout" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                Batal
            </button>
            <button id="confirm-logout" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
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
        // Mendapatkan referensi ke elemen DOM yang diperlukan
        const logoutButton = document.getElementById('logout-button');
        const logoutModal = document.getElementById('logout-modal');
        const confirmLogoutButton = document.getElementById('confirm-logout');
        const cancelLogoutButton = document.getElementById('cancel-logout');
        const logoutForm = document.getElementById('logout-form');

        // Menambahkan event listener ke tombol "Logout" di sidebar
        // Saat diklik, ini akan menampilkan modal kustom
        logoutButton.addEventListener('click', function () {
            logoutModal.classList.remove('hidden'); // Menghapus kelas 'hidden' untuk membuat modal terlihat
        });

        // Menambahkan event listener ke tombol "Batal" di dalam modal
        // Saat diklik, ini akan menyembunyikan modal
        cancelLogoutButton.addEventListener('click', function () {
            logoutModal.classList.add('hidden'); // Menambahkan kelas 'hidden' untuk menyembunyikan modal
        });

        // Menambahkan event listener ke overlay modal itu sendiri
        // Jika pengguna mengklik di luar konten modal (pada overlay gelap), sembunyikan modal
        logoutModal.addEventListener('click', function (event) {
            // Memeriksa apakah target klik event adalah overlay modal itu sendiri, bukan konten anaknya
            if (event.target === logoutModal) {
                logoutModal.classList.add('hidden');
            }
        });

        // Menambahkan event listener ke tombol "Ya, Logout" di dalam modal
        // Saat diklik, ini akan mensubmit form logout
        confirmLogoutButton.addEventListener('click', function () {
            logoutForm.submit(); // Mengirimkan form secara terprogram
        });
    });
</script>
