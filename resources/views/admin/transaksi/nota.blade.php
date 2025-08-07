<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Nota Setor Sampah - {{ $transaksi->id_transaksi ?? $transaksi->id }}</title>
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

        /* Header */
        .header {
            width: 100%;
            margin-bottom: 25px; 
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        .header .logo {
            float: left;
            width: 80px; /* Sesuaikan ukuran logo */
            height: 80px;
        }
        .header .title-container {
            margin-left: 95px; /* Memberi ruang untuk logo */
            text-align: left;
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
            color: #1a8c3a; 
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
        }
        .info-table td { 
            padding: 3px 0; 
        }
        .details-table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        .details-table th, .details-table td { 
            border-bottom: 1px solid #ddd;
            padding: 10px; 
        }
        .details-table thead { 
            background-color: #f5f5f5; 
        }
        .details-table th { 
            font-weight: bold; 
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
            color: #555;
        }
        .text-right { 
            text-align: right; 
        }

        /* ----- PERBAIKAN PADA BAGIAN TOTAL ----- */
        .total-section { 
            margin-top: 20px; 
            padding-top: 15px;
            border-top: 2px solid #333;
            text-align: right; 
        }
        .total-section span {
            display: inline-block; /* Memastikan margin bisa diterapkan */
            width: 100%;
            margin-bottom: 4px;
        }
        .sub-total-line {
            font-size: 15px;
            color: #444;
            font-weight: 600;
        }
        .deduction-line {
            font-size: 15px;
            font-weight: 600;
            color: #d9534f; /* Warna merah untuk potongan */
        }
        .total-section .grand-total { 
            font-size: 19px; 
            color: #1a8c3a;
            font-weight: bold;
            margin-top: 5px; /* Memberi sedikit jarak */
        }
        /* ----- AKHIR DARI PERBAIKAN ----- */

        .signatures-section {
            margin-top: 60px;
            width: 100%;
        }
        .signature-box {
            width: 40%;
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
            height: 60px;
        }
        .signature-name {
            font-weight: bold;
        }

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
                <h1>NOTA SETOR SAMPAH</h1>
                <p><strong>Bank Sampah Ngalam Waste Bank</strong></p>
                <p>Cabang Tanjung Lestari</p>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td style="width: 130px;"><strong>No. Nota</strong></td>
                <td>: {{ $transaksi->id_transaksi ?? $transaksi->id }}</td>
                <td style="width: 130px;"><strong>Nama Nasabah</strong></td>
                <td>: {{ $nasabah->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Transaksi</strong></td>
                <td>: {{ \Carbon\Carbon::parse($transaksi->tgl_setor ?? $transaksi->tgl_transaksi)->translatedFormat('d F Y') }}</td>
                <td><strong>No. Registrasi</strong></td>
                <td>: {{ $nasabah->no_reg ?? 'N/A' }}</td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Rincian Sampah</th>
                    <th class="text-right">Berat / Jumlah</th>
                    <th class="text-right">Harga Satuan</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detailItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['jenis_sampah'] ?? 'N/A' }}</td>
                    <td class="text-right">{{ $item['berat'] ?? 0 }} {{ $item['satuan'] ?? '' }}</td>
                    <td class="text-right">Rp{{ number_format($item['harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">Tidak ada detail item transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- ----- BAGIAN HTML YANG DIPERBAIKI ----- --}}
        <div class="total-section">
            <span class="sub-total-line">Total Pendapatan: Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</span>
            <span class="deduction-line">Potongan Kas (2%): - Rp{{ number_format(($totalPendapatan ?? 0) * 0.02, 0, ',', '.') }}</span>
            <span class="grand-total">Total Masuk Saldo: Rp{{ number_format(($totalPendapatan ?? 0) * 0.98, 0, ',', '.') }}</span>
        </div>
        {{-- ------------------------------------ --}}

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
            <p>Terima kasih atas partisipasi Anda dalam menjaga kebersihan lingkungan.</p>
            <p>Simpan nota ini sebagai bukti transaksi yang sah.</p>
        </div>
    </div>
</body>
</html>