<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Nasabah</title>
    <style>
        /* CSS untuk keseluruhan dokumen */
        body { 
            font-family: 'Helvetica', DejaVu Sans, sans-serif; 
            font-size: 12px; 
            color: #333;
        }

        /* Header (Kop Surat) */
        .header {
            width: 100%;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }
        .header .logo {
            float: left;
            width: 80px;
            height: 80px;
        }
        .header .title-container {
            margin-left: 90px;
            text-align: left;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #1a8c3a; /* Warna hijau tema */
        }
        .header h2 {
            margin: 5px 0 0;
            font-size: 16px;
        }
        .header p {
            margin: 2px 0 0;
            font-size: 12px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Tabel */
        .content-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            font-size: 11px;
        }
        .content-table th, 
        .content-table td { 
            padding: 8px 10px; 
            text-align: left; 
        }
        .content-table thead th { 
            background: #1a8c3a; /* Header hijau tua */
            color: #fff;
            border: 1px solid #1a8c3a;
            font-weight: bold;
            text-transform: uppercase;
        }
        .content-table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        .content-table tbody tr:nth-of-type(even) { 
            background-color: #f9f9f9; /* Zebra-striping */
        }
        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #1a8c3a;
        }
        .text-right {
            text-align: right;
        }

        /* ----- CSS BARU UNTUK TANDA TANGAN ----- */
        .signature-container {
            width: 300px;
            margin-top: 40px;
            float: right;
            text-align: center;
        }
        .signature-container p {
            margin: 0;
            line-height: 1.5;
        }
        .signature-space {
            height: 60px; /* Memberi ruang untuk tanda tangan basah */
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        /* -------------------------------------- */

        /* Footer (Nomor Halaman) */
        .footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
        .footer .page-number:before {
            content: "Halaman " counter(page);
        }
    </style>
</head>
<body>

    <div class="header clearfix">
        {{-- Ganti src dengan path logo Anda --}}
        <img class="logo" src="{{ public_path('img/logo.png') }}" alt="Logo">
        <div class="title-container">
            <h1>Bank Sampah Ngalam Waste Bank</h1>
            <h2>Laporan Data Nasabah</h2>
            <p>Cabang Tanjung Lestari</p>
            <p>Dicetak pada: {{ now()->translatedFormat('l, j F Y H:i') }}</p>
        </div>
    </div>

    @if($search)
        <p style="margin-top: 20px;"><strong>Filter Pencarian:</strong> "{{ $search }}"</p>
    @endif

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Reg</th>
                <th>Nama</th>
                <th>JK</th>
                <th style="width: 18%;">Tempat, Tgl Lahir</th>
                <th>No HP</th>
                <th>Tgl Registrasi</th>
                <th class="text-right">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nasabahs as $i => $n)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $n->no_reg }}</td>
                <td>{{ $n->name }}</td>
                <td>{{ $n->jenis_kelamin }}</td>
                <td>{{ $n->tempat_lahir }}, {{ \Carbon\Carbon::parse($n->tgl_lahir)->format('d-m-Y') }}</td>
                <td>{{ $n->no_hp }}</td>
                <td>{{ \Carbon\Carbon::parse($n->tgl_registrasi)->format('d-m-Y') }}</td>
                <td class="text-right">Rp{{ number_format($n->saldo ?? 0, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 20px;">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-container">
        <p>Malang, {{ now()->translatedFormat('j F Y') }}</p>
        <p>Pengelola Bank Sampah,</p>
        <div class="signature-space">
            {{-- Ruang kosong untuk tanda tangan --}}
        </div>
        <p class="signature-name">Sri Bidayati</p>
    </div>
    <div style="clear: both;"></div> <div class="footer">
        <p class="page-number"></p>
    </div>

</body>
</html>