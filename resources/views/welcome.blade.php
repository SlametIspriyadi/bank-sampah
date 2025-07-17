<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Sampah | Selamat Datang</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary-color-user: #22C55E;
            --primary-color-user-hover: #16a34a;
            --primary-color-admin: #EF4444;
            --primary-color-admin-hover: #DC2626;
            --light-gray: #f3f4f6;
            --medium-gray: #6b7280;
            --dark-gray: #1f2937;
            --white: #ffffff;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e5e7eb 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .welcome-card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.1);
            max-width: 950px;
            width: 100%;
            display: flex;
            overflow: hidden; /* Penting untuk border-radius pada gambar */
            flex-direction: row;
        }

        .welcome-image-container {
            flex-basis: 40%;
            background: url("{{ asset('img/logo.png') }}") no-repeat center center;
            background-size: 250px 250px;
        }

        .welcome-content {
            flex-basis: 60%;
            padding: 3rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-title {
            font-size: 2.25rem; /* 36px */
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .welcome-subtitle {
            font-size: 1.125rem; /* 18px */
            color: var(--medium-gray);
            margin-bottom: 2.5rem;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem;
            font-size: 1.125rem; /* 18px */
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
            text-decoration: none;
            text-align: center;
        }
        
        .btn-login svg {
            width: 24px;
            height: 24px;
        }

        .btn-admin {
            background-color: var(--primary-color-admin);
            color: var(--white);
        }
        .btn-admin:hover {
            background-color: var(--primary-color-admin-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -5px rgba(239, 68, 68, 0.4);
        }

        .btn-nasabah {
            background-color: var(--primary-color-user);
            color: var(--white);
        }
        .btn-nasabah:hover {
            background-color: var(--primary-color-user-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -5px rgba(34, 197, 94, 0.4);
        }

        .welcome-footer {
            margin-top: 3rem;
            color: #9ca3af;
            font-size: 0.875rem; /* 14px */
            text-align: center;
        }
        
        /* Responsive Design */
        @media (max-width: 900px) {
            .welcome-card {
                flex-direction: column;
            }
            .welcome-image-container {
                flex-basis: auto;
                height: 250px;
            }
            .welcome-content {
                padding: 2rem;
            }
            .welcome-title {
                font-size: 1.875rem; /* 30px */
                text-align: center;
            }
            .welcome-subtitle {
                text-align: center;
            }
        }

        @media (max-width: 500px) {
             .welcome-content {
                padding: 1.5rem;
            }
            .welcome-title {
                font-size: 1.5rem; /* 24px */
            }
            .welcome-subtitle {
                font-size: 1rem; /* 16px */
            }
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <div class="welcome-image-container" role="img" aria-label="Foto Kegiatan Bank Sampah"></div>
        
        <div class="welcome-content">
            <h1 class="welcome-title">Selamat Datang Website di Bank Sampah NWB Cabang Tanjung Lestari.</h1>
            <p class="welcome-subtitle">Silakan masuk sesuai peran Anda.</p>
            
            <div class="button-group">
                <a href="{{ route('login', ['role' => 'admin']) }}" class="btn-login btn-admin">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                    Login sebagai Admin
                </a>

                <a href="{{ route('login', ['role' => 'nasabah']) }}" class="btn-login btn-nasabah">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Login sebagai Nasabah
                </a>
            </div>

            <div class="welcome-footer">
                &copy; {{ date('Y') }} Ngalam Waste Bank
            </div>
        </div>
    </div>
</body>
</html>