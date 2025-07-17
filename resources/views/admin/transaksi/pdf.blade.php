<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Transaksi Setor</title>
    <style>
        body { font-family: 'Helvetica', DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header h1 { font-size: 20px; text-align: center; margin-bottom: 0; }
        .header p { font-size: 12px; text-align: center; margin-top: 5px; color: #555; }
        .filter-info { font-size: 12px; margin-top: 25px; margin-bottom: 15px; }
        .content-table { width: 100%; border-collapse: collapse; }
        .content-table th, .content-table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .content-table thead { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Transaksi Setor Sampah</h1>
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    @if(!empty(array_filter($filters)))
        <div class="filter-info">
            <strong>Filter yang diterapkan:</strong>
            @if($filters['no_reg']) No. Reg: {{ $filters['no_reg'] }} @endif
            @if($filters['bulan']) Bulan: {{ \Carbon\Carbon::create()->month($filters['bulan'])->translatedFormat('F') }} @endif
            @if($filters['tahun']) Tahun: {{ $filters['tahun'] }} @endif
        </div>
    @endif

    <table class="content-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tanggal</th>
                <th>Nama Nasabah</th>
                <th>No. Reg</th>
                <th class="text-right">Total Setor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $index => $transaksi)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tgl_setor)->format('d-m-Y') }}</td>
                <td>{{ $transaksi->nasabah->name ?? 'N/A' }}</td>
                <td>{{ $transaksi->nasabah->no_reg ?? 'N/A' }}</td>
                <td class="text-right">Rp{{ number_format($transaksi->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data transaksi yang cocok dengan filter yang diterapkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>