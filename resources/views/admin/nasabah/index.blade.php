@extends('admin.base')

@section('title', 'Manajemen Data Nasabah')
@section('header', 'Manajemen Nasabah')

@section('content')
<div class="p-6 sm:p-8 bg-white rounded-2xl shadow-lg">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div id="notification" class="transition-opacity duration-300 ease-out mb-4 p-4 flex items-center gap-3 bg-green-100 text-green-800 rounded-lg shadow">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div id="notification" class="transition-opacity duration-300 ease-out mb-4 p-4 flex items-start gap-3 bg-red-100 text-red-800 rounded-lg shadow">
            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            <div><span class="font-semibold">Terjadi kesalahan validasi</span><ul class="list-disc pl-5 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        </div>
    @endif

    {{-- Header Halaman dan Tombol Aksi --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Nasabah</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola, edit, dan hapus data nasabah terdaftar.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.nasabah.exportPdf', request()->all()) }}" target="_blank" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 font-semibold transition-colors">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Export PDF</span>
            </a>
            <a href="{{ route('admin.nasabah.create') }}" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold transition-colors shadow-sm">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                <span>Tambah Nasabah</span>
            </a>
        </div>
    </div>
    
    {{-- Form Pencarian --}}
    <div class="mb-4">
        <form method="GET" action="" class="flex items-center gap-2">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berdasarkan No. Registrasi atau Nama Nasabah..." class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2.5 pl-10 text-base focus:ring-2 focus:ring-green-500" />
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            </div>
            <button type="submit" class="px-5 py-2.5 rounded-lg bg-gray-700 text-white hover:bg-gray-800 font-semibold">Cari</button>
        </form>
    </div>

    {{-- Tabel dengan Semua Kolom Asli --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Reg</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JK</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Reg</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo</th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($nasabahs as $i => $n)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $nasabahs->firstItem() + $i }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $n->no_reg }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $n->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $n->jenis_kelamin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $n->tempat_lahir }}, {{ $n->tgl_lahir ? \Carbon\Carbon::parse($n->tgl_lahir)->translatedFormat('d M Y') : '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $n->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $n->no_hp }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $n->tgl_registrasi ? \Carbon\Carbon::parse($n->tgl_registrasi)->translatedFormat('d M Y') : '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-semibold">
                        Rp{{ number_format($n->saldo_tersedia ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.nasabah.edit', $n->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit Data">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                            </a>
                            <button type="button" class="text-red-600 hover:text-red-800 delete-button" title="Hapus Data" data-name="{{ $n->name }}" data-action="{{ route('admin.nasabah.destroy', $n->id) }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center py-10 text-gray-500">Tidak ada data nasabah yang cocok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $nasabahs->appends(request()->query())->links() }}
    </div>
</div>

{{-- Modal Hapus --}}
<div id="delete-modal" role="dialog" aria-modal="true" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div class="ml-4 text-left flex-grow">
                <h3 class="text-lg font-bold text-gray-900">Hapus Data Nasabah</h3>
                <p class="text-sm text-gray-600 mt-2">Tindakan ini bersifat permanen. Untuk konfirmasi, ketik nama nasabah: <strong id="delete-nasabah-name" class="text-red-700"></strong></p>
                <input type="text" id="delete-confirmation-input" class="mt-4 w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-red-500" placeholder="Ketik nama di sini...">
            </div>
        </div>
        <div class="mt-6 sm:flex sm:flex-row-reverse">
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button id="confirm-delete-button" type="submit" disabled class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-300 text-white text-base font-medium sm:ml-3 sm:w-auto sm:text-sm cursor-not-allowed">Ya, Hapus</button>
                <button id="cancel-delete" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const notification = document.getElementById('notification');
    if (notification) {
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
    
    const deleteModal = document.getElementById('delete-modal');
    if (deleteModal) {
        const deleteForm = document.getElementById('delete-form');
        const nasabahNameSpan = document.getElementById('delete-nasabah-name');
        const confirmationInput = document.getElementById('delete-confirmation-input');
        const confirmDeleteButton = document.getElementById('confirm-delete-button');
        const cancelDeleteButton = document.getElementById('cancel-delete');
        let nasabahNameToDelete = '';

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const action = this.getAttribute('data-action');
                nasabahNameToDelete = this.getAttribute('data-name');
                deleteForm.action = action;
                nasabahNameSpan.textContent = nasabahNameToDelete;
                deleteModal.classList.remove('hidden');
                confirmationInput.focus();
            });
        });

        confirmationInput.addEventListener('input', () => {
            if (confirmationInput.value === nasabahNameToDelete) {
                confirmDeleteButton.disabled = false;
                confirmDeleteButton.classList.remove('bg-red-300', 'cursor-not-allowed');
                confirmDeleteButton.classList.add('bg-red-600', 'hover:bg-red-700');
            } else {
                confirmDeleteButton.disabled = true;
                confirmDeleteButton.classList.add('bg-red-300', 'cursor-not-allowed');
                confirmDeleteButton.classList.remove('bg-red-600', 'hover:bg-red-700');
            }
        });

        deleteForm.addEventListener('submit', () => {
            confirmDeleteButton.disabled = true;
            confirmDeleteButton.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" ...>...</svg> Menghapus...`;
        });

        const closeModal = () => {
            deleteModal.classList.add('hidden');
            confirmationInput.value = '';
            confirmDeleteButton.disabled = true;
            confirmDeleteButton.classList.add('bg-red-300', 'cursor-not-allowed');
            confirmDeleteButton.classList.remove('bg-red-600', 'hover:bg-red-700');
        };

        cancelDeleteButton.addEventListener('click', closeModal);
        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                closeModal();
            }
        });
    }
});
</script>
@endpush