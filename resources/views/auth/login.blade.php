<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Fashion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="width: 100%; max-width: 400px; padding: 20px;">

        <div style="text-align: center; margin-bottom: 25px;">
            <div style="color: white; font-size: 1.5rem; font-weight: 700; letter-spacing: 2px;">
                POS <span style="color: #e94560;">FASHION</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="display:block; text-align:center;">
                <p class="card-title" style="margin-bottom:4px;">Login</p>
                <p style="font-size: 13px; color: #888; margin:0;">Masuk ke akun Anda</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin: 20px 25px 0;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group" style="display:flex; align-items:center; gap:6px;">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="font-size:13px; color:#666; margin:0; text-transform:none; font-weight:400;">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-success" style="width: calc(100% - 50px); justify-content:center;">
                    Login
                </button>
            </form>
        </div>

    </div>

</body>
</html>