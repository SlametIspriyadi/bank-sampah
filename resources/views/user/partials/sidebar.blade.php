<aside class="w-64 h-screen bg-green-500 text-white flex flex-col fixed">
    <div class="p-6 font-bold text-lg border-b border-green-700">Nasabah</div>
    <nav class="mt-6 flex-grow">
        <ul>
            <li class="mb-2">
                <a href="{{ route('user.dashboard') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.dashboard') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                    Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('user.setor.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.setor.*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                    Riwayat Tarik Saldo
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('user.transaksi.index') }}" class="block px-6 py-2 rounded {{ request()->routeIs('user.transaksi.*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                    Riwayat Transaksi Setor
                </a>
            </li>
        </ul>
    </nav>
    <div class="px-6 py-4 border-t border-green-700 mt-auto">
        <form method="POST" action="{{ route('logout') }}" id="user-logout-form">
            @csrf
            <button type="button" id="user-logout-button" class="w-full text-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75">
                Logout
            </button>
        </form>
    </div>
</aside>

<div id="userLogoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden flex items-center justify-center z-50">
    <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Logout</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin keluar dari akun Anda?
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="userCancelLogout" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-75 mr-2">
                    Batal
                </button>
                <button id="userConfirmLogout" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75 ml-2">
                    Logout
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const userLogoutButton = document.getElementById('user-logout-button');
    const userLogoutModal = document.getElementById('userLogoutModal');
    const userCancelLogoutButton = document.getElementById('userCancelLogout');
    const userConfirmLogoutButton = document.getElementById('userConfirmLogout');
    const userLogoutForm = document.getElementById('user-logout-form');

    userLogoutButton.onclick = function(e) {
        e.preventDefault(); // Prevent default form submission
        userLogoutModal.classList.remove('hidden'); // Show the modal
    };

    userCancelLogoutButton.onclick = function() {
        userLogoutModal.classList.add('hidden'); // Hide the modal
    };

    userConfirmLogoutButton.onclick = function() {
        userLogoutForm.submit(); // Submit the form
    };

    // Optional: Close modal if clicking outside of it
    userLogoutModal.onclick = function(event) {
        if (event.target === userLogoutModal) {
            userLogoutModal.classList.add('hidden');
        }
    };
</script>