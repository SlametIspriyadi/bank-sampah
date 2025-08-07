@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Transaksi Setor</title>
    <style>
        body { 
            font-family: 'Helvetica', DejaVu Sans, sans-serif; 
            font-size: 12px; 
            color: #333;
        }
        .header {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
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
        .filter-info { 
            font-size: 12px; 
            margin-top: 25px; 
            margin-bottom: 15px; 
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
            border: 1px solid #eee;
        }
        .content-table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        .content-table th, .content-table td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: left; 
        }
        .content-table thead { 
            background-color: #e9e9e9; 
            font-weight: bold;
        }
        .content-table tbody tr:nth-of-type(even) { 
            background-color: #f9f9f9;
        }
        .text-right { 
            text-align: right; 
        }
        .text-center { 
            text-align: center; 
        }
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
        
        /* ----- CSS BARU UNTUK TANDA TANGAN ----- */
        .signature-section {
            margin-top: 50px;
            width: 280px;
            float: right;
            text-align: center;
        }
        .signature-section p {
            margin: 0;
            line-height: 1.6;
        }
        .signature-space {
            height: 70px; /* Jarak untuk tanda tangan */
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        /* -------------------------------------- */
    </style>
</head>
<body>

    <div class="header clearfix">
        <img class="logo" src="{{ public_path('img/logo.png') }}" alt="Logo">
        <div class="title-container">
            <h1>Bank Sampah Ngalam Waste Bank</h1>
            <h2>Laporan Transaksi Setor</h2>
            <p>Cabang Tanjung Lestari</p>
            <p>Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }}</p>
        </div>
    </div>

    @if(!empty(array_filter(request()->only(['no_reg', 'bulan', 'tahun']))))
        <div class="filter-info">
            <strong>Filter Laporan:</strong>
            @if(request('no_reg')) No. Reg: {{ request('no_reg') }}; @endif
            @if(request('bulan')) Bulan: {{ Carbon::create()->month(request('bulan'))->translatedFormat('F') }}; @endif
            @if(request('tahun')) Tahun: {{ request('tahun') }} @endif
        </div>
    @endif

    <table class="content-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tanggal</th>
                <th>Nama Nasabah</th>
                <th>Detail Sampah</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($setor as $i => $trx)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td style="width: 15%;">{{ Carbon::parse($trx->tgl_setor)->format('d-m-Y') }}</td>
                <td style="width: 20%;">
                    <div>{{ $trx->nasabah->name ?? '-' }}</div>
                    <div style="font-size: 10px; color: #666;">No. Reg: {{ $trx->nasabah->no_reg ?? '-' }}</div>
                </td>
                <td>
                    @if(count($trx->detail_sampah_formatted) > 0)
                        <ul style="margin:0; padding-left:15px; list-style-type: disc;">
                            @foreach($trx->detail_sampah_formatted as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td class="text-right" style="width: 20%;">Rp{{ number_format($trx->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data transaksi yang cocok dengan filter yang diterapkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ----- BLOK HTML BARU UNTUK TANDA TANGAN ----- --}}
    <div class="signature-section">
        <p>Malang, {{ now()->translatedFormat('d F Y') }}</p>
        <p>Pengelola Bank Sampah,</p>
        <div class="signature-space"></div>
        <p class="signature-name">(Sri Bidayati)</p>
    </div>
    <div style="clear: both;"></div>
    {{-- ------------------------------------------- --}}

    <div class="footer">
        <p class="page-number"></p>
    </div>

</body>
</html>