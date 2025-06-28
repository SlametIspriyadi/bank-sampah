@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Penarikan Saldo</title>
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
        <div class="nota-title">Nota Penarikan Saldo</div>
        <table class="nota-table">
            <tr>
                <td>No. Nota</td>
                <td>: {{ $trx->id_tarik }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ Carbon::parse($trx->tgl_tarik)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Nasabah</td>
                <td>: {{ $nasabah->no_reg }} - {{ $nasabah->name }}</td>
            </tr>
            <tr>
                <td>Jumlah Tarik</td>
                <td>: Rp {{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>: {{ $trx->keterangan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Saldo Setelah Tarik</td>
                <td>: Rp {{ number_format($saldoAkhir - $trx->jumlah_tarik, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="nota-footer">
            Dicetak pada: {{ now()->format('d-m-Y H:i') }}<br>
            Bank Sampah Tanjung Lestari
        </div>
    </div>
</body>
</html>
