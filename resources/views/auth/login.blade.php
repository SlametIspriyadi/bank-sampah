<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah NWB</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #16a34a; /* Green-600 */
            --primary-color-hover: #15803d; /* Green-700 */
            --light-gray: #f3f4f6;
            --medium-gray: #6b7280;
            --dark-gray: #1f2937;
            --white: #ffffff;
            --danger-bg: #fee2e2;
            --danger-text: #dc2626;
            --danger-border: #fca5a5;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 960px;
            margin: 1rem;
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-branding {
            flex-basis: 45%;
            background: linear-gradient(rgba(22, 163, 74, 0.8), rgba(21, 128, 61, 0.9)), url("{{ asset('img/nwb.jpg') }}");
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }
        
        .branding-logo {
             width: 60px;
             height: 60px;
             background-color: var(--white);
             border-radius: 50%;
             display: flex;
             align-items: center;
             justify-content: center;
             margin-bottom: 1.5rem;
             box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .branding-logo svg {
            width: 32px;
            height: 32px;
            color: var(--primary-color);
        }

        .branding-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .branding-subtitle {
            font-size: 1.1rem;
            font-weight: 400;
            opacity: 0.9;
            margin-top: 0.5rem;
            line-height: 1.5;
        }

        .login-form-wrapper {
            flex-basis: 55%;
            padding: 3rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 1rem;
            color: var(--medium-gray);
            margin-bottom: 2rem;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--medium-gray);
            pointer-events: none;
        }
        
        .input-icon svg { width: 20px; height: 20px; }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
        }
        
        .password-toggle {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--medium-gray);
            padding: 0.5rem;
        }
        
        .password-toggle:hover { color: var(--dark-gray); }
        .password-toggle svg { width: 20px; height: 20px; }
        .password-toggle .eye-slash { display: none; }
        
        /* Styling untuk Tombol Login */
        .form-action {
            margin-top: 0.5rem;
        }

        .btn-login {
            width: 100%;
            background: var(--primary-color);
            color: var(--white);
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 0.85rem 0;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
        }

        .btn-login:hover { background: var(--primary-color-hover); }
        .btn-login:active { transform: scale(0.98); }

        .error-message {
            background-color: var(--danger-bg);
            color: var(--danger-text);
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
            border: 1px solid var(--danger-border);
            width: 100%;
            box-sizing: border-box;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        .back-link a:hover { text-decoration: underline; }
        
        @media (max-width: 800px) {
            .login-branding { display: none; }
            .login-form-wrapper {
                flex-basis: 100%;
                padding: 2.5rem 1.5rem;
            }
            .login-container {
                margin: 0.5rem;
                width: calc(100% - 1rem);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-branding">
             <div class="branding-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.182-3.182m0-4.991v4.99" /></svg>
             </div>
            <h1 class="branding-title">Ngalam Waste Bank</h1>
            <p class="branding-subtitle">Manajemen sampah digital untuk lingkungan yang lebih bersih dan ekonomi yang berkelanjutan.</p>
        </div>

        <div class="login-form-wrapper">
            <h2 class="form-title">Login {{ $role === 'admin' ? 'Admin' : 'Nasabah' }}</h2>
            <p class="form-subtitle">Selamat datang kembali! Silakan masukkan data Anda.</p>

            @if(session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">

                <div class="input-group">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.095a1.23 1.23 0 00.41-1.412A9.99 9.99 0 0010 12a9.99 9.99 0 00-6.535 2.493z" /></svg></span>
                    <input type="text" name="username" class="input-field" placeholder="{{ $role === 'admin' ? 'Username' : 'No. Registrasi' }}" required autofocus>
                </div>
                
                <div class="input-group">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg></span>
                    <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                    <button type="button" class="password-toggle" id="password-toggle-btn" aria-label="Toggle password visibility">
                         <svg class="eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l3.75-3.75a1.651 1.651 0 112.333 2.333L4.17 10l2.578 2.578a1.651 1.651 0 01-2.333 2.333l-3.75-3.75zM19.336 10.59a1.651 1.651 0 010-1.18l-3.75-3.75a1.651 1.651 0 11-2.333 2.333L15.83 10l-2.578 2.578a1.651 1.651 0 012.333 2.333l3.75-3.75z" clip-rule="evenodd" /></svg>
                         <svg class="eye-slash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38c-.351-.82-1.074-2.19-2.642-3.875l-1.428-1.428A4.46 4.46 0 0010 5.5a4.46 4.46 0 00-2.433 1.14l-1.286-1.286A9.948 9.948 0 0010 3a9.99 9.99 0 00-6.72 2.22zM15 10a5 5 0 01-5 5c-.947 0-1.826-.266-2.6-.723l-1.92-1.92A5.002 5.002 0 0115 10z" /></svg>
                    </button>
                </div>

                <div class="form-action">
                    <button type="submit" class="btn-login">Login</button>
                </div>
                
            </form>
            
            <div class="back-link">
                <a href="{{ url('/') }}">← Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
    
    <script>
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('password-toggle-btn');
        if (passwordInput && toggleButton) {
            const eyeIcon = toggleButton.querySelector('.eye');
            const eyeSlashIcon = toggleButton.querySelector('.eye-slash');

            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                eyeIcon.style.display = type === 'password' ? 'block' : 'none';
                eyeSlashIcon.style.display = type === 'password' ? 'none' : 'block';
            });
        }
    </script>
</body>
</html>