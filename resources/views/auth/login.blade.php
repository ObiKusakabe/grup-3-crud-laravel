<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitStock</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="auth-page">

<div class="auth-shell">

    {{-- ══ LEFT PANEL ══ --}}
    <div class="auth-panel-left">
        <div class="auth-panel-brand">
            <div class="auth-panel-brand-mark">FS</div>
            <span class="auth-panel-brand-name">FitStock</span>
        </div>

        <div class="auth-panel-headline">
            <h2>Selamat datang<br>kembali!</h2>
            <p>Kelola stok, transaksi, dan cabang toko fashion kamu dari satu dashboard terpadu.</p>
        </div>

        {{-- Illustration: fills all remaining space --}}
        <div class="auth-panel-illustration">
            <svg viewBox="0 0 320 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Store building -->
                <rect x="60" y="110" width="200" height="120" rx="8" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
                <rect x="50" y="96" width="220" height="22" rx="6" fill="rgba(37,99,235,0.35)" stroke="rgba(190,198,224,0.25)" stroke-width="1.5"/>
                <rect x="110" y="101" width="100" height="12" rx="3" fill="rgba(255,255,255,0.15)"/>
                <rect x="138" y="178" width="44" height="52" rx="4" fill="rgba(37,99,235,0.25)" stroke="rgba(190,198,224,0.20)" stroke-width="1.5"/>
                <circle cx="176" cy="206" r="2.5" fill="rgba(190,198,224,0.6)"/>
                <rect x="74" y="128" width="42" height="36" rx="4" fill="rgba(37,99,235,0.18)" stroke="rgba(190,198,224,0.18)" stroke-width="1.5"/>
                <rect x="204" y="128" width="42" height="36" rx="4" fill="rgba(37,99,235,0.18)" stroke="rgba(190,198,224,0.18)" stroke-width="1.5"/>
                <line x1="95" y1="128" x2="95" y2="164" stroke="rgba(190,198,224,0.2)" stroke-width="1"/>
                <line x1="74" y1="146" x2="116" y2="146" stroke="rgba(190,198,224,0.2)" stroke-width="1"/>
                <line x1="225" y1="128" x2="225" y2="164" stroke="rgba(190,198,224,0.2)" stroke-width="1"/>
                <line x1="204" y1="146" x2="246" y2="146" stroke="rgba(190,198,224,0.2)" stroke-width="1"/>
                <line x1="40" y1="230" x2="280" y2="230" stroke="rgba(190,198,224,0.15)" stroke-width="1.5"/>
                <!-- Floating badge top-right -->
                <rect x="218" y="58" width="72" height="32" rx="8" fill="rgba(37,99,235,0.22)" stroke="rgba(190,198,224,0.22)" stroke-width="1.5"/>
                <circle cx="232" cy="74" r="5" fill="rgba(190,198,224,0.5)"/>
                <rect x="242" y="68" width="36" height="5" rx="2" fill="rgba(255,255,255,0.25)"/>
                <rect x="242" y="76" width="24" height="4" rx="2" fill="rgba(255,255,255,0.15)"/>
                <!-- Chart card bottom-left -->
                <rect x="30" y="62" width="80" height="50" rx="8" fill="rgba(255,255,255,0.05)" stroke="rgba(190,198,224,0.18)" stroke-width="1.5"/>
                <rect x="40" y="74" width="12" height="24" rx="2" fill="rgba(37,99,235,0.5)"/>
                <rect x="56" y="82" width="12" height="16" rx="2" fill="rgba(190,198,224,0.35)"/>
                <rect x="72" y="70" width="12" height="20" rx="2" fill="rgba(37,99,235,0.35)"/>
                <rect x="88" y="78" width="12" height="12" rx="2" fill="rgba(190,198,224,0.25)"/>
                <!-- Floating package icon right -->
                <rect x="244" y="156" width="44" height="44" rx="10" fill="rgba(255,255,255,0.06)" stroke="rgba(190,198,224,0.15)" stroke-width="1.5"/>
                <rect x="254" y="166" width="24" height="24" rx="4" fill="rgba(37,99,235,0.3)" stroke="rgba(190,198,224,0.25)" stroke-width="1"/>
                <line x1="266" y1="166" x2="266" y2="190" stroke="rgba(190,198,224,0.4)" stroke-width="1"/>
                <line x1="258" y1="172" x2="274" y2="172" stroke="rgba(190,198,224,0.3)" stroke-width="1"/>
                <!-- Stars -->
                <circle cx="170" cy="52" r="2" fill="rgba(190,198,224,0.4)"/>
                <circle cx="50" cy="140" r="1.5" fill="rgba(190,198,224,0.3)"/>
                <circle cx="290" cy="120" r="2" fill="rgba(37,99,235,0.5)"/>
                <circle cx="30" cy="200" r="1.5" fill="rgba(190,198,224,0.25)"/>
            </svg>
        </div>{{-- /illustration --}}

    </div>{{-- /auth-panel-left --}}

    {{-- ══ RIGHT PANEL ══ --}}
    <div class="auth-panel-right">
        <div class="phone-frame">
            <div class="phone-frame-notch"></div>

            <div class="phone-screen">
                <div class="phone-status-bar">
                    <span class="phone-status-time">9:41</span>
                    <div class="phone-status-icons">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3a4.237 4.237 0 0 0-6 0zm-4-4 2 2a7.074 7.074 0 0 1 10 0l2-2C15.14 9.14 8.87 9.14 5 13z"/></svg>
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/></svg>
                    </div>
                </div>

                {{-- Mobile-only brand header — same position as signup --}}
                <div class="auth-mobile-brand">
                    <div class="auth-mobile-brand-mark">FS</div>
                    <span class="auth-mobile-brand-name">FitStock</span>
                </div>

                {{-- Form content: starts from top, button+switch pinned to bottom --}}
                <div style="flex:1;display:flex;flex-direction:column;padding:16px 16px 0;gap:0;overflow:hidden;">

                    <div class="auth-header">
                        <h1>Masuk akun</h1>
                        <p>Masukkan email &amp; password untuk melanjutkan.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger auth-alert" style="font-size:11px;padding:7px 10px;border-radius:8px;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}" class="auth-form" style="flex:1;">
                        @csrf
                        <div class="auth-field">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                        </div>
                        <div class="auth-field">
                            <label class="form-label">Password</label>
                            <div class="password-field">
                                <input type="password" name="password" class="form-control" required data-password-input placeholder="Masukkan password">
                                <button type="button" class="password-toggle" data-password-toggle aria-label="Tampilkan password">
                                    <i data-lucide="eye" class="icon-eye"></i>
                                    <i data-lucide="eye-off" class="icon-eye-off"></i>
                                </button>
                            </div>
                        </div>
                        <label class="auth-check">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>

                        {{-- Spacer pushes button to bottom --}}
                        <div style="flex:1;"></div>

                        <button type="submit" class="btn btn-dark auth-submit">
                            Masuk
                        </button>
                    </form>

                    <div class="auth-switch">
                        Belum punya akun? <a href="{{ route('signup') }}">Daftar di sini</a>
                    </div>

                </div>
            </div>{{-- /phone-screen --}}

            <div class="phone-home-bar"></div>
        </div>{{-- /phone-frame --}}
    </div>

</div>{{-- /auth-shell --}}

<script>
    document.querySelectorAll('[data-password-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const inp  = btn.closest('.password-field').querySelector('[data-password-input]');
            const show = inp.type === 'password';
            inp.type   = show ? 'text' : 'password';
            btn.querySelector('.icon-eye').style.display     = show ? 'none' : '';
            btn.querySelector('.icon-eye-off').style.display = show ? '' : 'none';
        });
    });
    lucide.createIcons();

    // ── Toast notifications ───────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('logout_success'))
            window.showToast && window.showToast(@json(session('logout_success')), 'success');
        @endif
        @if(session('login_error') || $errors->has('email'))
            window.showToast && window.showToast(@json($errors->first('email') ?? session('login_error') ?? 'Email atau password salah.'), 'error');
        @endif
    });
</script>
</body>
</html>
