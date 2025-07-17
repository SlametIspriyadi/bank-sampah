@extends('admin.base')

@section('title', 'Manajemen Data Sampah')
@section('header', 'Manajemen Sampah')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div id="notification" class="transition-opacity duration-300 ease-out mb-4 p-4 flex items-center gap-3 bg-green-100 text-green-800 rounded-lg shadow">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div id="notification" class="transition-opacity duration-300 ease-out mb-4 p-4 flex items-start gap-3 bg-red-100 text-red-800 rounded-lg shadow">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Header Halaman dan Tombol Aksi --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Jenis Sampah</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola jenis, satuan, dan harga sampah yang diterima.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.sampah.exportPdf') }}" target="_blank" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 font-semibold transition-colors">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Export PDF</span>
            </a>
            <a href="{{ route('admin.sampah.create') }}" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold transition-colors shadow-sm">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                <span>Tambah Sampah</span>
            </a>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Sampah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($sampahs as $i => $s)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sampahs->firstItem() + $i }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $s->jenis_sampah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s->satuan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-semibold">Rp{{ number_format($s->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.sampah.edit', $s->sampah_id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                            </a>
                            <button type="button" class="text-red-600 hover:text-red-800 delete-button" title="Hapus" data-name="{{ $s->jenis_sampah }}" data-action="{{ route('admin.sampah.destroy', $s->sampah_id) }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                            <p class="font-semibold">Belum ada data sampah</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $sampahs->appends(request()->query())->links() }}
    </div>
</div>

{{-- Modal Hapus --}}
<div id="delete-modal" role="dialog" aria-modal="true" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div class="ml-4 text-left">
                <h3 class="text-lg font-bold text-gray-900">Hapus Data Sampah</h3>
                <p class="text-sm text-gray-600 mt-2">Anda yakin ingin menghapus data <strong id="delete-item-name"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <div class="mt-6 sm:flex sm:flex-row-reverse">
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya, Hapus</button>
                <button id="cancel-delete" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- LOGIKA UNTUK NOTIFIKASI HILANG OTOMATIS ---
    const notification = document.getElementById('notification');
    if (notification) {
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500); // Hapus elemen setelah transisi selesai
        }, 3000);
    }
    
    // --- LOGIKA UNTUK MODAL KONFIRMASI HAPUS ---
    const deleteModal = document.getElementById('delete-modal');
    if (deleteModal) {
        const deleteForm = document.getElementById('delete-form');
        const itemNameSpan = document.getElementById('delete-item-name');
        const confirmDeleteButton = deleteForm.querySelector('button[type="submit"]');
        const cancelDeleteButton = document.getElementById('cancel-delete');

        // Buka modal saat tombol hapus di tabel diklik
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const action = this.getAttribute('data-action');
                const name = this.getAttribute('data-name');
                
                deleteForm.action = action;
                itemNameSpan.textContent = `"${name}"`;
                deleteModal.classList.remove('hidden');
            });
        });

        // Fungsi untuk menutup modal
        const closeModal = () => {
            deleteModal.classList.add('hidden');
        };

        // Event listener untuk tombol batal dan klik di luar modal
        cancelDeleteButton.addEventListener('click', closeModal);
        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                closeModal();
            }
        });

        // Tampilkan loading saat form disubmit
        deleteForm.addEventListener('submit', () => {
            confirmDeleteButton.disabled = true;
            confirmDeleteButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Menghapus...</span>
            `;
        });
    }
});
</script>
@endpush