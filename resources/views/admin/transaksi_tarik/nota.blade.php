@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Nota Tarik Saldo - {{ $trx->id_tarik }}</title>
    <style>
        body { 
            font-family: 'Helvetica', DejaVu Sans, sans-serif; 
            font-size: 14px; 
            color: #333;
            margin: 0;
        }
        .container { 
            width: 100%; 
            margin: 0 auto; 
            padding: 20px;
        }
        .header {
            width: 100%;
            margin-bottom: 25px; 
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        .header .logo {
            float: left;
            width: 80px;
            height: 80px;
        }
        .header .title-container {
            margin-left: 95px;
            text-align: left;
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
            color: #2563eb; /* Biru untuk membedakan dengan nota setor */
        }
        .header p { 
            margin: 5px 0 0; 
            font-size: 12px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .info-table { 
            width: 100%; 
            margin-bottom: 30px;
            font-size: 13px;
            border-collapse: collapse;
        }
        .info-table td { 
            padding: 5px 0; 
        }
        .details-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        .details-box h3 {
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            font-size: 16px;
        }
        .details-table-summary {
            width: 100%;
        }
        .details-table-summary td {
            padding: 6px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
        }

        /* ----- CSS BARU UNTUK TANDA TANGAN ----- */
        .signatures-section {
            margin-top: 60px;
            width: 100%;
        }
        .signature-box {
            width: 40%; /* Lebar setiap kolom tanda tangan */
            float: left;
            text-align: center;
        }
        .signature-box.right {
            float: right;
        }
        .signature-box p {
            margin: 0;
            line-height: 1.5;
        }
        .signature-space {
            height: 60px; /* Ruang untuk tanda tangan */
        }
        .signature-name {
            font-weight: bold;
        }
        /* -------------------------------------- */

        .footer { 
            margin-top: 40px; 
            text-align: center; 
            font-size: 12px; 
            color: #777; 
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header clearfix">
            <img class="logo" src="{{ public_path('img/logo.png') }}" alt="Logo">
            <div class="title-container">
                <h1>NOTA TARIK SALDO</h1>
                <p><strong>Bank Sampah Ngalam Waste Bank</strong></p>
                <p>Cabang Tanjung Lestari</p>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td style="width: 130px;"><strong>No. Nota</strong></td>
                <td>: {{ $trx->id_tarik }}</td>
                <td style="width: 130px;"><strong>Nama Nasabah</strong></td>
                <td>: {{ $nasabah->name ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Transaksi</strong></td>
                <td>: {{ Carbon::parse($trx->tgl_tarik)->translatedFormat('d F Y') }}</td>
                <td><strong>No. Registrasi</strong></td>
                <td>: {{ $nasabah->no_reg ?? '-' }}</td>
            </tr>
        </table>

        <div class="details-box">
            <h3>Rincian Penarikan</h3>
            <table class="details-table-summary">
                <tr>
                    <td class="label" style="width: 50%;">Jumlah Penarikan</td>
                    <td class="text-right" style="font-size: 16px; font-weight: bold;">Rp{{ number_format($trx->jumlah_tarik, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Keterangan</td>
                    <td class="text-right">{{ $trx->keterangan ?? '-' }}</td>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td class="label" style="padding-top: 15px;">Sisa Saldo</td>
                    <td class="text-right grand-total" style="padding-top: 15px;">Rp{{ number_format($saldoAkhir, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="signatures-section clearfix">
            <div class="signature-box left">
                <p>Nasabah,</p>
                <div class="signature-space"></div>
                <p class="signature-name">({{ $nasabah->name ?? '....................' }})</p>
            </div>
            <div class="signature-box right">
                <p>Petugas Bank Sampah,</p>
                <div class="signature-space"></div>
                <p class="signature-name">(Sri Bidayati)</p>
            </div>
        </div>
        <div class="footer">
            <p>Penarikan saldo telah berhasil diproses.</p>
            <p>Simpan nota ini sebagai bukti transaksi yang sah.</p>
        </div>
    </div>
</body>
</html>