@extends('admin.base')

@section('title', 'Data Sampah')
@section('header', 'Data Sampah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Data Sampah</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.sampah.create') }}" class="btn-green px-4 py-2 rounded">Tambah Data Sampah</a>
            <a href="{{ route('admin.sampah.exportPdf') }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded flex items-center gap-1">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>
        </div>
    </div>
    @if(session('success'))
        <div id="notif-success" class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div id="notif-error" class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif
    <script>
        setTimeout(function() {
            let notif = document.getElementById('notif-success');
            if(notif) notif.style.display = 'none';
            let notifErr = document.getElementById('notif-error');
            if(notifErr) notifErr.style.display = 'none';
        }, 2500);
    </script>
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead>
            <tr class="table-header-custom">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Jenis Sampah</th>
                <th class="px-4 py-2">Satuan</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sampahs as $i => $s)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $s->jenis_sampah }}</td>
                <td class="border px-4 py-2">{{ $s->satuan }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.sampah.edit', $s->sampah_id) }}" class="inline-block mr-2"><i class="fa fa-edit"> edit</i></a>
                    <form action="{{ route('admin.sampah.destroy', $s->sampah_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data?')">
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
