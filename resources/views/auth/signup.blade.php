<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - POS Fashion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="width: 100%; max-width: 500px; padding: 20px;">

        <div style="text-align: center; margin-bottom: 25px;">
            <div style="color: white; font-size: 1.5rem; font-weight: 700; letter-spacing: 2px;">
                POS <span style="color: #e94560;">FASHION</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="display:block; text-align:center;">
                <p class="card-title" style="margin-bottom:4px;">Daftar Akun</p>
                <p style="font-size: 13px; color: #888; margin:0;">Buat akun admin baru untuk perusahaan Anda</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin: 20px 25px 0;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('/signup') }}">
                @csrf

                <div style="padding: 0 25px; padding-top: 20px;">
                    <h5 style="margin: 15px 0 10px; font-size: 13px; color: #666; text-transform: uppercase; font-weight: 600;">Data Admin</h5>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div style="padding: 0 25px; padding-top: 10px;">
                    <h5 style="margin: 15px 0 10px; font-size: 13px; color: #666; text-transform: uppercase; font-weight: 600;">Data Perusahaan</h5>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="company_name" class="form-control"
                           value="{{ old('company_name') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Perusahaan</label>
                    <input type="email" name="company_email" class="form-control"
                           value="{{ old('company_email') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat (Opsional)</label>
                    <textarea name="company_address" class="form-control" rows="2">{{ old('company_address') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon (Opsional)</label>
                    <input type="text" name="company_phone" class="form-control"
                           value="{{ old('company_phone') }}">
                </div>

                <div style="padding: 0 25px; padding-bottom: 20px;">
                    <button type="submit" class="btn btn-success" style="width: 100%; justify-content:center;">
                        Daftar
                    </button>
                </div>

                <div style="text-align: center; padding-bottom: 20px; border-top: 1px solid #eee; padding-top: 15px;">
                    <span style="font-size: 13px; color: #666;">Sudah punya akun? 
                        <a href="{{ url('/login') }}" style="color: #e94560; text-decoration: none; font-weight: 600;">Login di sini</a>
                    </span>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
