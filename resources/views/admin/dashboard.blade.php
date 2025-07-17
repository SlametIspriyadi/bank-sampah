@extends('admin.base')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Selamat Datang Kembali, Admin!</h1>
        <p class="text-gray-500 mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 flex items-center gap-6">
            <div class="bg-blue-100 p-4 rounded-full">
                <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962a3.75 3.75 0 015.962 0zM16.5 9.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM6.75 21a3 3 0 01-3-3V6.75a3 3 0 013-3h8.25a3 3 0 013 3v8.25a3 3 0 01-3 3H6.75z" />
                </svg>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium">Total Nasabah</div>
                <div class="text-3xl font-bold text-gray-800 mt-1">{{ $nasabahCount ?? '-' }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 flex items-center gap-6">
            <div class="bg-yellow-100 p-4 rounded-full">
                <svg class="w-8 h-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                </svg>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium">Total Transaksi</div>
                <div class="text-3xl font-bold text-gray-800 mt-1">{{ $transaksiCount ?? '-' }}</div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 flex items-center gap-6">
            <div class="bg-green-100 p-4 rounded-full">
                <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-15c-.621 0-1.125-.504-1.125-1.125v-9.75c0-.621.504-1.125 1.125-1.125h1.5" />
                </svg>
            </div>
            <div>
                <div class="text-gray-500 text-sm font-medium">Pendapatan Nasabah</div>
                <div class="text-3xl font-bold text-gray-800 mt-1">Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Transaksi Bulanan (Tahun Ini)</h2>
            <div style="height: 300px;">
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Performa Tahunan</h2>
            <div style="height: 300px;">
                <canvas id="chartTahunan"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createIntegerTicks = {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0,
                    color: '#6b7280'
                },
                grid: {
                    color: '#e5e7eb',
                    drawBorder: false,
                }
            },
            x: {
                ticks: {
                    color: '#6b7280'
                },
                grid: {
                    display: false,
                }
            }
        };
        
        // Data dari Controller
        const bulanLabels = @json($bulanLabels ?? []);
        const bulanData = @json($bulanData ?? []);
        const tahunLabels = @json($tahunLabels ?? []);
        const tahunData = @json($tahunData ?? []);

        // Grafik Bulanan (Bar Chart)
        const ctxBulanan = document.getElementById('chartBulanan');
        if (ctxBulanan) {
            new Chart(ctxBulanan.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: bulanLabels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: bulanData,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 6,
                            displayColors: false,
                        }
                    },
                    scales: createIntegerTicks
                }
            });
        }

        // Grafik Tahunan (Line Chart)
        const ctxTahunan = document.getElementById('chartTahunan');
        if (ctxTahunan) {
            new Chart(ctxTahunan.getContext('2d'), {
                type: 'line',
                data: {
                    labels: tahunLabels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: tahunData,
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 6,
                            displayColors: false
                        }
                    },
                    scales: createIntegerTicks
                }
            });
        }
    });
</script>
@endpush