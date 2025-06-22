@extends('admin.base')

@section('title', 'Tambah Transaksi Tarik')
@section('header', 'Tambah Transaksi Tarik')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <form action="{{ route('admin.transaksi_tarik.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Tarik</label>
            <input type="date" name="tgl_tarik" class="w-full border px-3 py-2 rounded" value="{{ old('tgl_tarik', date('Y-m-d')) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach($nasabah as $n)
                    <option value="{{ $n->id }}" data-saldo="{{ ($n->transaksi_setor_sum ?? 0) * 0.98 - ($n->transaksi_tarik_sum ?? 0) }}" {{ old('nasabah_id') == $n->id ? 'selected' : '' }}>{{ $n->no_reg }} - {{ $n->name }}</option>
                @endforeach
            </select>
            <div id="saldo-info" class="mt-2 text-sm text-gray-700"></div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jumlah Tarik</label>
            <input type="number" name="jumlah_tarik" id="jumlah_tarik" class="w-full border px-3 py-2 rounded" min="1" value="{{ old('jumlah_tarik') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Keterangan</label>
            <input type="text" name="keterangan" class="w-full border px-3 py-2 rounded" value="{{ old('keterangan') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
<script>
    // Ambil elemen
    const nasabahSelect = document.getElementById('nasabah_id');
    const saldoInfo = document.getElementById('saldo-info');
    const jumlahTarikInput = document.getElementById('jumlah_tarik');

    function updateSaldoInfo() {
        const selected = nasabahSelect.options[nasabahSelect.selectedIndex];
        const saldo = parseFloat(selected.getAttribute('data-saldo')) || 0;
        if (nasabahSelect.value === "") {
            saldoInfo.textContent = '';
            jumlahTarikInput.value = '';
            jumlahTarikInput.disabled = true;
            return;
        }
        saldoInfo.textContent = 'Saldo: Rp ' + saldo.toLocaleString('id-ID');
        if (saldo <= 0) {
            jumlahTarikInput.value = '';
            jumlahTarikInput.disabled = true;
            saldoInfo.textContent += ' (Saldo kosong, tidak bisa tarik)';
        } else {
            jumlahTarikInput.disabled = false;
            jumlahTarikInput.max = saldo;
        }
    }
    nasabahSelect.addEventListener('change', updateSaldoInfo);
    window.addEventListener('DOMContentLoaded', updateSaldoInfo);
</script>
@endsection
