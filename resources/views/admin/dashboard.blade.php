@extends('admin.base')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500">Total Nasabah</div>
        <div class="text-2xl font-bold">{{ $nasabahCount ?? '-' }}</div>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <div class="text-gray-500">Total Transaksi</div>
        <div class="text-2xl font-bold">{{ $transaksiCount ?? '-' }}</div>
    </div>
</div>
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Grafik Transaksi Bulanan (Tahun Ini)</h2>
        <canvas id="chartBulanan" height="120"></canvas>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Grafik Transaksi Tahunan</h2>
        <canvas id="chartTahunan" height="120"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulanLabels = @json($bulanLabels ?? []);
    const bulanData = @json($bulanData ?? []);
    const tahunLabels = @json($tahunLabels ?? []);
    const tahunData = @json($tahunData ?? []);
    // Bulanan
    new Chart(document.getElementById('chartBulanan').getContext('2d'), {
        type: 'bar',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: bulanData,
                backgroundColor: 'rgba(34,197,94,0.7)',
                borderColor: 'rgba(34,197,94,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        callback: function(value) { return Number.isInteger(value) ? value : null; }
                    }
                }
            }
        }
    });
    // Tahunan
    new Chart(document.getElementById('chartTahunan').getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunLabels,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: tahunData,
                backgroundColor: 'rgba(16,185,129,0.3)',
                borderColor: 'rgba(16,185,129,1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        callback: function(value) { return Number.isInteger(value) ? value : null; }
                    }
                }
            }
        }
    });
</script>
@endsection
