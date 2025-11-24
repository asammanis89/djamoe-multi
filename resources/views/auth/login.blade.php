<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin — D'jamoe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(160deg, #1a3a24 0%, #0a1c11 74%);
            color: #FBF8ED;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: rgba(10, 28, 17, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(230, 215, 147, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #E6D793, #d4c07a);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 6px;
            color: #E6D793;
            text-align: center;
        }

        .subtitle {
            color: rgba(251, 248, 237, 0.8);
            font-size: 14px;
            margin-bottom: 28px;
            text-align: center;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #FBF8ED;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(26, 58, 36, 0.6);
            border: 1px solid rgba(230, 215, 147, 0.3);
            border-radius: 10px;
            color: #FBF8ED;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-group input::placeholder {
            color: rgba(251, 248, 237, 0.5);
        }

        .form-group input:focus {
            outline: none;
            border-color: #E6D793;
            box-shadow: 0 0 0 3px rgba(230, 215, 147, 0.2);
        }

        .remember {
            display: flex;
            align-items: center;
            font-size: 13px;
            margin-bottom: 24px;
            color: rgba(251, 248, 237, 0.85);
        }

        .remember input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #E6D793;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #E6D793, #d4c07a);
            color: #1a3a24;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
        }

        .btn-login:hover {
            opacity: 0.95;
            transform: translateY(-2px);
        }

        .error-message {
            background: rgba(180, 30, 30, 0.2);
            color: #ff9999;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid rgba(230, 215, 147, 0.2);
            text-align: center;
        }

        /* Scrollbar halus */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #E6D793;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-text">D'jamoe</div>
        <p class="subtitle">Masuk ke panel admin</p>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first('login') ?? $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="login">Username atau Email</label>
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="{{ old('login') }}" 
                    required 
                    autofocus 
                    placeholder="admin atau admin@djamoe.com"
                >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                >
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat sesi saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk ke Admin</button>
        </form>
    </div>
</body>
</html>