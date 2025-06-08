<!-- resources/views/user/partials/sidebar.blade.php -->
<aside class="w-64 h-screen bg-green-500 text-white flex flex-col fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">USER</div>
    <nav class="flex-1 mt-6">
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
    <div class="mt-auto px-6 mb-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-0 py-2 text-red-500 hover:bg-red-100 hover:text-red-700 rounded">Logout</button>
        </form>
    </div>
</aside>
