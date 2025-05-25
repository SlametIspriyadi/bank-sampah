<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="w-64 h-screen bg-gray-800 text-white fixed">
    <div class="p-6 font-bold text-lg border-b border-gray-700">Bank Sampah</div>
    <nav class="mt-6">
        <ul>
            <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Dashboard</a></li>
            <li class="mb-2"><a href="{{ route('admin.nasabah.index') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Data Nasabah</a></li>
            <li class="mb-2"><a href="{{ route('admin.sampah.index') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Data Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.transaksi.index') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Transaksi Setor</a></li>
            <li class="mb-2"><a href="{{ route('admin.laporan.index') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Laporan</a></li>
            <li class="mb-2"><a href="{{ route('logout') }}" class="block px-6 py-2 hover:bg-gray-700 rounded">Logout</a></li>
        </ul>
    </nav>
</aside>
