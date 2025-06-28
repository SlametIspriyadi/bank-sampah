<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Tarik</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Tarik</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Reg</th>
                <th>Nama Nasabah</th>
                <th>Jumlah Tarik</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarik as $i => $trx)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $trx->tgl_tarik }}</td>
                <td>{{ $trx->nasabah->no_reg ?? '-' }}</td>
                <td>{{ $trx->nasabah->name ?? '-' }}</td>
                <td>Rp {{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
                <td>{{ $trx->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
