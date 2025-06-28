@extends('admin.base')

@section('title', 'Transaksi Setor')
@section('header', 'Transaksi Setor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    {{-- Bagian notifikasi yang dihapus --}}
    {{--
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
    --}}
    <div class="flex justify-between items-end mb-4">
        <h2 class="text-xl font-semibold">Transaksi Setor</h2>
        <div class="flex flex-col items-end gap-2">
            <form method="GET" action="" class="flex items-center gap-2 mb-2">
                <input type="text" name="no_reg" value="{{ request('no_reg') }}" placeholder="Cari No Reg" class="border px-3 py-2 rounded" />
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Cari</button>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        @if(request('no_reg') && isset($nasabah))
            <table class="min-w-full mb-6">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="px-4 py-2">No Reg</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">{{ $nasabah->no_reg }}</td>
                        <td class="border px-4 py-2">{{ $nasabah->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.transaksi.create', ['nasabah_id' => $nasabah->id]) }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Setor Sampah</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @elseif(request('no_reg') && !isset($nasabah))
            <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">Nasabah tidak ditemukan.</div>
        @endif
    </div>
    @if(session('success'))
        <div id="notif-success" class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('nota_setor'))
        <div style="color:red">DEBUG: {{ session('nota_setor') }}</div>
        <script>
            setTimeout(function() {
                var url = @json(session('nota_setor'));
                if (url) {
                    var a = document.createElement('a');
                    a.href = url;
                    a.target = '_blank';
                    a.download = '';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            }, 500);
        </script>
    @endif
    {{-- Hapus debug session dan SESSION: {{ json_encode(session()->all()) }} --}}
</div>
@endsection
