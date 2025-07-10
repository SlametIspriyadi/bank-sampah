<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Sampah | Selamat Datang</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
            background: #f9fafb;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            padding: 2.5rem 2.5rem 2.5rem 2.5rem;
            max-width: 950px;
            min-width: 350px;
            width: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 3.5rem;
            justify-content: center;
            flex-direction: row;
        }
        .welcome-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 1.1rem;
            line-height: 1.15;
        }
        .welcome-desc {
            color: #666;
            margin-bottom: 2.2rem;
            font-size: 1.25rem;
            line-height: 1.5;
        }
        .btn-login {
            display: block;
            width: 260px;
            padding: 1.05rem 0;
            margin-bottom: 1.2rem;
            font-size: 1.25rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
        }
        .btn-admin {
            background: #FF2D20;
            color: #fff;
        }
        .btn-admin:hover {
            background: #d7261a;
        }
        .btn-user {
            background: #22C55E;
            color: #fff;
        }
        .btn-user:hover {
            background: #16a34a;
        }
        @media (max-width: 900px) {
            .welcome-container { flex-direction: column; gap: 2rem; max-width: 98vw; }
            .btn-login { width: 100%; }
            .welcome-title, .welcome-desc { text-align: center !important; }
        }
        @media (max-width: 500px) {
            .welcome-container { padding: 1.5rem 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <img src="{{ asset('img/nwb.jpg') }}" alt="Foto Kegiatan Bank Sampah" style="width: 320px; max-width: 38vw; height: auto; object-fit: cover; border-radius: 14px; box-shadow: 0 2px 16px rgba(0,0,0,0.10);" />
        <div style="flex:1; min-width:0; display:flex; flex-direction:column; justify-content:center; align-items:flex-start;">
            <div class="welcome-title" style="text-align:left; width:100%;">Selamat Datang di Website Bank Sampah NWB cabang Tanjung Lestari</div>
            <div class="welcome-desc" style="text-align:left; width:100%;">Silakan pilih jenis login sesuai peran Anda untuk melanjutkan ke aplikasi.</div>
            <a href="{{ route('login', ['role' => 'admin']) }}" class="btn-login btn-admin">Login sebagai Admin</a>
            <a href="{{ route('login', ['role' => 'nasabah']) }}" class="btn-login btn-user">Login sebagai User</a>
            <div style="margin-top:2rem;color:#aaa;font-size:0.95rem;">&copy; {{ date('Y') }} Ngalam Waste Bank cabang Tanjung Lestari</div>
        </div>
    </div>
</body>
</html>
