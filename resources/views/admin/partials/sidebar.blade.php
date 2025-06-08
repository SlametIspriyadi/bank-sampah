<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="w-64 h-screen bg-green-500 text-white flex flex-col fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">ADMIN</div>
    <nav class="mt-6">
        <ul>
            <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-green-600' : 'hover:bg-green-600' }}">Dashboard</a></li>
            <li class="mb-2"><a href="{{ route('admin.nasabah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.nasabah.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Data Nasabah</a></li>
            <li class="mb-2"><a href="{{ route('admin.sampah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.sampah.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Data Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.transaksi.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.transaksi.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Setor Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.laporan.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.laporan.*') ? 'bg-green-600' : 'hover:bg-green-600' }}">Laporan</a></li>
            <li class="mt-6 px-6">
                <form method="POST" action="{{ route('logout', [], false) }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-0 py-2 text-red-600 hover:bg-red-100 rounded">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
<style>
    /* Tabel header dan button warna hijau sidebar */
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
    /* Untuk border dan highlight row aktif */
    .table-row-active {
        background: #e6f9ee !important;
    }
</style>
