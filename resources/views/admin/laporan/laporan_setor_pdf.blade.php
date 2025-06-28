<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Setor</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Setor</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Reg</th>
                <th>Nama Nasabah</th>
                <th>Detil Sampah</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setor as $i => $trx)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $trx->tgl_setor }}</td>
                <td>{{ $trx->nasabah->no_reg ?? '-' }}</td>
                <td>{{ $trx->nasabah->name ?? '-' }}</td>
                <td>
                    @if($trx->detil_sampah)
                        @php
                            $items = array_filter(array_map('trim', explode(';', $trx->detil_sampah)));
                        @endphp
                        <ul style="margin:0; padding-left:15px;">
                            @foreach($items as $item)
                                @foreach(explode(',', $item) as $subitem)
                                    @if(trim($subitem) !== '')
                                        <li>{{ trim($subitem) }}</li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td>Rp {{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
