<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Nasabah</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 4px 8px; text-align: left; }
        th { background: #e5e5e5; }
    </style>
</head>
<body>
    <h2>Data Nasabah</h2>
    @if($search)
        <p><strong>Filter No Reg:</strong> {{ $search }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Reg</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Tempat, Tgl Lahir</th>
                <th>No HP</th>
                <th>Tgl Registrasi</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabahs as $i => $n)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $n->no_reg }}</td>
                <td>{{ $n->name }}</td>
                <td>{{ $n->jenis_kelamin }}</td>
                <td>{{ $n->tempat_lahir }}, {{ $n->tgl_lahir ? date('d-m-Y', strtotime($n->tgl_lahir)) : '' }}</td>
                <td>{{ $n->no_hp }}</td>
                <td>{{ $n->tgl_registrasi ? date('d-m-Y', strtotime($n->tgl_registrasi)) : '' }}</td>
                <td>Rp {{ number_format($n->saldo ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
