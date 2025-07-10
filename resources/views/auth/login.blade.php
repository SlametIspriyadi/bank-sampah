<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah Tanjung Lestari</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #fff !important; /* Force background to white, ensuring it overrides other styles */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container-center {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a8c3a;
            margin-bottom: 2rem;
            text-align: center;
            line-height: 1.2;
        }
        .login-card {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-form-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }
        .input-field {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            max-width: 300px;
        }
        .input-field:focus {
            outline: none;
            border-color: #1a8c3a;
            box-shadow: 0 0 0 3px rgba(26, 140, 58, 0.2);
        }
        .btn-custom-green {
            width: 100%;
            background: #1a8c3a;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 0;
            margin-top: 0.5rem;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s ease-in-out;
            max-width: 300px;
        }
        .btn-custom-green:hover {
            background: #146b2e;
        }
        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
            border: 1px solid #fca5a5;
            width: 100%;
            max-width: 300px;
            box-sizing: border-box;
        }
        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container-center">

        <div class="login-card">
            <div class="login-form-title">Login</div>

            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}" class="login-form">
                @csrf
                @if(isset($role))
                    <input type="hidden" name="role" value="{{ $role }}">
                @endif
                <input type="text" name="username" class="input-field" placeholder="No Registrasi" required autofocus>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <button type="submit" class="btn-custom-green">Login</button>
            </form>
        </div>
    </div>
</body>
</html>