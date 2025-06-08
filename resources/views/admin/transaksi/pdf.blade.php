<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Transaksi Setor</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Data Transaksi Setor</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Detil Sampah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $i => $trx)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $trx->tgl_setor }}</td>
                <td>
                    @if(isset($trx->nasabah_no_reg) && isset($trx->nasabah_name))
                        {{ $trx->nasabah_no_reg }} - {{ $trx->nasabah_name }}
                    @elseif(isset($trx->nasabah_no_reg))
                        {{ $trx->nasabah_no_reg }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $trx->detil_sampah ?? '-' }}</td>
                <td>Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
