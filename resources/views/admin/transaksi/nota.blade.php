@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Setor Sampah</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .nota-box { border: 1px solid #333; padding: 24px; max-width: 400px; margin: 0 auto; }
        .nota-title { font-size: 18px; font-weight: bold; text-align: center; margin-bottom: 16px; }
        .nota-table { width: 100%; margin-bottom: 12px; }
        .nota-table td { padding: 4px 0; }
        .nota-footer { text-align: center; margin-top: 18px; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="nota-box">
        <div class="nota-title">Nota Setor Sampah</div>
        <table class="nota-table">
            <tr>
                <td>No. Nota</td>
                <td>: {{ $transaksi->id ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ isset($transaksi->tgl_setor) ? Carbon::parse($transaksi->tgl_setor)->format('d-m-Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Nasabah</td>
                <td>: {{ $transaksi->nasabah_no_reg ?? '-' }} - {{ $transaksi->nasabah_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Sampah</td>
                <td>: {{ $transaksi->jenis_sampah ?? '-' }}</td>
            </tr>
            <tr>
                <td>Detil Sampah</td>
                <td>: {{ $transaksi->detil_sampah ?? '-' }}</td>
            </tr>
            <tr>
                <td>Total Pendapatan</td>
                <td>: Rp {{ number_format($transaksi->total_pendapatan ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="nota-footer">
            Dicetak pada: {{ now()->format('d-m-Y H:i') }}<br>
            Bank Sampah Tanjung Lestari
        </div>
    </div>
</body>
</html>
