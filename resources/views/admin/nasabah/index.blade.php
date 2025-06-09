@extends('admin.base')

@section('title', 'Data Nasabah')
@section('header', 'Data nasabah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    @if(session('success'))
        <div id="notif-success" class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div id="notif-error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div id="notif-error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="mb-0 pl-4 list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        setTimeout(function() {
            let notif = document.getElementById('notif-success');
            if(notif) notif.style.display = 'none';
            let notifErr = document.getElementById('notif-error');
            if(notifErr) notifErr.style.display = 'none';
        }, 2500);
    </script>
    <div class="flex justify-between items-end mb-4">
        <h2 class="text-xl font-semibold">Data nasabah</h2>
        <div class="flex flex-col items-end gap-2">
            <div class="flex gap-2">
                <!-- Tombol Tambah Data Nasabah dengan warna hover sidebar -->
                <a href="{{ route('admin.nasabah.create') }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Tambah Data Nasabah</a>
                <a href="{{ route('admin.nasabah.exportPdf', request('search') ? ['search' => request('search')] : []) }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-red-700">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>
            </div>
            <form method="GET" action="" class="flex items-center gap-2 mt-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari No Reg" class="border px-3 py-2 rounded" />
                <!-- Tombol Cari dengan warna hover sidebar -->
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Cari</button>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <!-- Header tabel dengan warna hover sidebar -->
            <tr class="bg-green-600 text-white">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">No Reg</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">JK</th>
                <th class="px-4 py-2">Tempat, Tgl Lahir</th>
                <th class="px-4 py-2">No HP</th>
                <th class="px-4 py-2">Tgl Registrasi</th>
                <th class="px-4 py-2">Saldo</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabahs as $i => $n)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $n->no_reg }}</td>
                <td class="border px-4 py-2">{{ $n->name }}</td>
                <td class="border px-4 py-2">{{ $n->jenis_kelamin }}</td>
                <td class="border px-4 py-2">{{ $n->tempat_lahir }}, {{ $n->tgl_lahir ? date('d-m-Y', strtotime($n->tgl_lahir)) : '' }}</td>
                <td class="border px-4 py-2">{{ $n->no_hp }}</td>
                <td class="border px-4 py-2">{{ $n->tgl_registrasi ? date('d-m-Y', strtotime($n->tgl_registrasi)) : '' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($n->saldo ?? 0, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="inline-block mr-2"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.nasabah.edit', $n->id) }}" class="inline-block mr-2"><i class="fa fa-edit">edit</i></a>
                    <form action="{{ route('admin.nasabah.destroy', $n->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data {{ $n->no_reg }} - {{ $n->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block"><i class="fa fa-trash">hapus</i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection