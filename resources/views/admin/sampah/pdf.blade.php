<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Sampah</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Data Sampah</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Sampah</th>
                <th>Satuan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sampahs as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s->jenis_sampah }}</td>
                <td>{{ $s->satuan }}</td>
                <td>Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
