<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { background: #fff !important; }
        .centered-card {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            width: 100%;
            max-width: 350px;
        }
        .login-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #16a34a;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }
        .input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            padding: 0.6rem 0.8rem;
            margin-bottom: 1rem;
        }
        .btn-green {
            width: 100%;
            background: #22c55e;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            padding: 0.6rem 0;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }
        .btn-green:hover {
            background: #16a34a;
        }
    </style>
</head>
<body>
    <div class="centered-card">
        <div class="login-card">
            <div class="subtitle">Bank Sampah Tanjung Lestari</div>
            <div class="login-title">Login</div>
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <input type="text" name="username" class="input" placeholder="No Registrasi" required autofocus>
                <input type="password" name="password" class="input" placeholder="Password" required>
                <button type="submit" class="btn-green">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
