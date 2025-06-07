<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="w-64 h-screen sidebar-custom fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">ADMIN</div>
    <nav class="mt-6">
        <ul>
            <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li class="mb-2"><a href="{{ route('admin.nasabah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.nasabah.*') ? 'active' : '' }}">Data Nasabah</a></li>
            <li class="mb-2"><a href="{{ route('admin.sampah.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.sampah.*') ? 'active' : '' }}">Data Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.transaksi.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">Setor Sampah</a></li>
            <li class="mb-2"><a href="{{ route('admin.laporan.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">Laporan</a></li>
        </ul>
    </nav>
</aside>
