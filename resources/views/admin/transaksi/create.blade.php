@extends('admin.base')

@section('title', 'Tambah Transaksi Setor')
@section('header', 'Tambah Transaksi Setor')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.transaksi.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Setor</label>
            <input type="date" name="tgl_setor" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nasabah</label>
            <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">
            <input type="text" class="w-full border px-3 py-2 rounded bg-gray-100" value="{{ $nasabah->no_reg }} - {{ $nasabah->name }}" readonly>
        </div>
        <div id="sampah-group-list">
            <div class="sampah-group mb-4 border-b pb-4">
                <label class="block mb-1 font-semibold">Jenis Sampah</label>
                <select name="sampah_id[]" class="w-full border px-3 py-2 rounded mb-2" required>
                    <option value="">-- Pilih Jenis Sampah --</option>
                    @foreach($sampah as $s)
                        <option value="{{ $s->sampah_id }}">{{ $s->jenis_sampah }} - {{ $s->satuan }}</option>
                    @endforeach
                </select>
                <label class="block mb-1 font-semibold">Berat</label>
                <input type="number" step="0.01" name="berat[]" class="w-full border px-3 py-2 rounded mb-2 berat-input" required>
                <label class="block mb-1 font-semibold">Total Pendapatan</label>
                <input type="text" name="total_pendapatan_view[]" class="w-full border px-3 py-2 rounded bg-gray-100 total-pendapatan-input" readonly>
                <input type="hidden" name="total_pendapatan[]" class="total-pendapatan-hidden">
                <button type="button" class="remove-sampah-group text-red-500 mt-2">Hapus</button>
            </div>
        </div>
        <button type="button" id="add-sampah-group" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Tambah Jenis Sampah</button>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
    @if(session('nota_setor'))
        <script>
            window.onload = function() {
                var url = @json(session('nota_setor'));
                var a = document.createElement('a');
                a.href = url;
                a.download = '';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            };
        </script>
    @endif
</div>
<script>
    const sampahData = @json($sampah);
    function hitungTotalPendapatan(group) {
        const beratInput = group.querySelector('.berat-input');
        const sampahSelect = group.querySelector('select[name="sampah_id[]"]');
        const totalPendapatanInput = group.querySelector('.total-pendapatan-input');
        const totalPendapatanHidden = group.querySelector('.total-pendapatan-hidden');
        const berat = parseFloat(beratInput.value) || 0;
        const selectedSampah = sampahData.find(s => s.sampah_id == sampahSelect.value);
        const harga = selectedSampah ? parseFloat(selectedSampah.harga) : 0;
        const total = berat * harga;
        totalPendapatanInput.value = total.toLocaleString('id-ID');
        totalPendapatanHidden.value = total;
    }
    function addSampahGroup() {
        const groupList = document.getElementById('sampah-group-list');
        const firstGroup = groupList.querySelector('.sampah-group');
        const newGroup = firstGroup.cloneNode(true);
        newGroup.querySelector('select').selectedIndex = 0;
        newGroup.querySelector('.berat-input').value = '';
        newGroup.querySelector('.total-pendapatan-input').value = '';
        newGroup.querySelector('.total-pendapatan-hidden').value = '';
        groupList.appendChild(newGroup);
        attachEvents(newGroup);
    }
    function attachEvents(group) {
        group.querySelector('.berat-input').addEventListener('input', () => hitungTotalPendapatan(group));
        group.querySelector('select[name="sampah_id[]"]').addEventListener('change', () => hitungTotalPendapatan(group));
        group.querySelector('.remove-sampah-group').addEventListener('click', function() {
            if(document.querySelectorAll('.sampah-group').length > 1) {
                group.remove();
            }
        });
    }
    document.getElementById('add-sampah-group').addEventListener('click', addSampahGroup);
    document.querySelectorAll('.sampah-group').forEach(attachEvents);
</script>
@endsection
