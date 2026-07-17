<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - FitStock</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* ── Step dots bar — fixed, no slide ── */
        .signup-dots-bar {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 16px 4px;
            flex-shrink: 0;
        }
        .signup-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--outline-variant);
            transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
            flex-shrink: 0;
        }
        .signup-dot.active {
            background: var(--primary-container);
            width: 20px;
            border-radius: 3px;
        }
        .signup-dot.done {
            background: var(--primary-container);
            opacity: 0.4;
        }
        .signup-step-label {
            font-size: 9px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .07em;
            color: var(--on-surface-variant);
            margin-left: 5px;
            transition: opacity 0.18s ease;
        }

        /* ── Slide viewport: only header+fields slide ── */
        .signup-slide-viewport {
            overflow: hidden;
            width: 100%;
            flex: 1;
            min-height: 0;
        }
        .signup-slide-track {
            display: flex;
            width: 300%;
            height: 100%;
            transition: transform 0.48s cubic-bezier(0.4,0,0.2,1);
            will-change: transform;
        }
        .signup-slide-panel {
            width: calc(100% / 3);
            padding: 6px 16px 10px;
            display: flex;
            flex-direction: column;
            gap: 9px;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* ── Nav row — fixed, back slides in ── */
        .signup-nav-row {
            display: flex;
            align-items: center;
            gap: 0;                /* no gap — back btn handles its own spacing */
            padding: 4px 16px 10px;
            flex-shrink: 0;
        }
        .signup-back-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            width: 0;
            max-width: 0;
            overflow: hidden;
            padding: 0;
            margin: 0;              /* no margin when hidden */
            border: none;
            border-radius: 10px;
            background: none;
            color: var(--on-surface-variant);
            cursor: pointer;
            font-size: 12px;
            flex-shrink: 0;
            opacity: 0;
            pointer-events: none;
            transition:
                width     0.36s cubic-bezier(0.4,0,0.2,1),
                max-width 0.36s cubic-bezier(0.4,0,0.2,1),
                padding   0.36s cubic-bezier(0.4,0,0.2,1),
                margin    0.36s cubic-bezier(0.4,0,0.2,1),
                border    0.36s cubic-bezier(0.4,0,0.2,1),
                opacity   0.26s ease;
        }
        .signup-back-btn.visible {
            width: 44px;
            max-width: 44px;
            padding: 6px;
            margin-right: 8px;      /* gap appears only when back is visible */
            border: 1.5px solid var(--outline-variant);
            opacity: 1;
            pointer-events: auto;
        }
        .signup-next-btn {
            flex: 1;
            height: 44px;
            min-height: 44px;
            justify-content: center;
            font-size: 13px;
            border-radius: 10px;
            padding: 0 16px;
        }

        /* ── Switch link ── */
        .signup-switch {
            text-align: center;
            font-size: 11px;
            color: var(--on-surface-variant);
            padding: 8px 16px 12px;
            border-top: 1px solid var(--outline-variant);
            flex-shrink: 0;
        }
        .signup-switch a {
            color: var(--primary-container);
            font-weight: 700;
            text-decoration: none;
        }
    </style>
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
            <h2>Mulai kelola toko<br>kamu hari ini.</h2>
            <p>Daftarkan toko, buat cabang pertama, dan kelola stok &amp; penjualan dari satu platform.</p>
        </div>

        {{-- Illustration fills all space between headline and pills --}}
        <div class="auth-panel-illustration">
            <svg viewBox="0 0 320 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="100" y="50" width="120" height="160" rx="10" fill="rgba(255,255,255,0.05)" stroke="rgba(190,198,224,0.18)" stroke-width="1.5"/>
                <rect x="128" y="42" width="64" height="18" rx="6" fill="rgba(37,99,235,0.35)" stroke="rgba(190,198,224,0.22)" stroke-width="1.5"/>
                <rect x="116" y="86" width="88" height="8" rx="3" fill="rgba(190,198,224,0.25)"/>
                <rect x="116" y="102" width="68" height="8" rx="3" fill="rgba(190,198,224,0.18)"/>
                <rect x="116" y="122" width="88" height="8" rx="3" fill="rgba(190,198,224,0.25)"/>
                <rect x="116" y="138" width="50" height="8" rx="3" fill="rgba(190,198,224,0.18)"/>
                <rect x="116" y="158" width="88" height="8" rx="3" fill="rgba(190,198,224,0.25)"/>
                <rect x="116" y="174" width="72" height="8" rx="3" fill="rgba(190,198,224,0.18)"/>
                <circle cx="210" cy="200" r="16" fill="rgba(37,99,235,0.4)" stroke="rgba(190,198,224,0.3)" stroke-width="1.5"/>
                <polyline points="202,200 207,206 218,194" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <rect x="228" y="56" width="68" height="52" rx="8" fill="rgba(255,255,255,0.05)" stroke="rgba(190,198,224,0.16)" stroke-width="1.5"/>
                <circle cx="244" cy="74" r="5" fill="rgba(37,99,235,0.7)"/>
                <line x1="249" y1="74" x2="260" y2="74" stroke="rgba(190,198,224,0.3)" stroke-width="1.5"/>
                <circle cx="265" cy="74" r="5" fill="rgba(37,99,235,0.4)"/>
                <line x1="270" y1="74" x2="281" y2="74" stroke="rgba(190,198,224,0.2)" stroke-width="1.5"/>
                <circle cx="286" cy="74" r="5" fill="rgba(190,198,224,0.2)" stroke="rgba(190,198,224,0.3)" stroke-width="1"/>
                <rect x="238" y="84" width="50" height="5" rx="2" fill="rgba(190,198,224,0.2)"/>
                <rect x="238" y="93" width="34" height="5" rx="2" fill="rgba(190,198,224,0.13)"/>
                <rect x="24" y="148" width="56" height="56" rx="10" fill="rgba(255,255,255,0.05)" stroke="rgba(190,198,224,0.16)" stroke-width="1.5"/>
                <circle cx="52" cy="166" r="10" fill="rgba(37,99,235,0.3)" stroke="rgba(190,198,224,0.25)" stroke-width="1"/>
                <path d="M34 196 Q52 182 70 196" stroke="rgba(190,198,224,0.35)" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                <rect x="28" y="70" width="56" height="28" rx="7" fill="rgba(37,99,235,0.18)" stroke="rgba(190,198,224,0.18)" stroke-width="1.5"/>
                <rect x="36" y="78" width="30" height="5" rx="2" fill="rgba(255,255,255,0.22)"/>
                <rect x="36" y="87" width="20" height="4" rx="2" fill="rgba(255,255,255,0.13)"/>
                <circle cx="165" cy="34" r="2.5" fill="rgba(190,198,224,0.35)"/>
                <circle cx="58" cy="126" r="2" fill="rgba(37,99,235,0.4)"/>
                <circle cx="296" cy="166" r="2" fill="rgba(190,198,224,0.3)"/>
            </svg>
        </div>{{-- /illustration --}}

    </div>{{-- /auth-panel-left --}}

    {{-- ══ RIGHT PANEL ══ --}}
    <div class="auth-panel-right">
        <div class="phone-frame">
            <div class="phone-frame-notch"></div>

            <div class="phone-screen">
                {{-- Status bar (fixed) --}}
                <div class="phone-status-bar">
                    <span class="phone-status-time">9:41</span>
                    <div class="phone-status-icons">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3a4.237 4.237 0 0 0-6 0zm-4-4 2 2a7.074 7.074 0 0 1 10 0l2-2C15.14 9.14 8.87 9.14 5 13z"/></svg>
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/></svg>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger auth-alert" style="margin:0 24px 8px;font-size:12px;border-radius:8px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Mobile-only brand header --}}
                <div class="auth-mobile-brand">
                    <div class="auth-mobile-brand-mark">FS</div>
                    <span class="auth-mobile-brand-name">FitStock</span>
                </div>

                {{-- Step dots (fixed, animate in-place) --}}
                <div class="signup-dots-bar">                    <div class="signup-dot active" id="sdot-1"></div>
                    <div class="signup-dot" id="sdot-2"></div>
                    <div class="signup-dot" id="sdot-3"></div>
                    <span class="signup-step-label" id="slabel">Data Akun</span>
                </div>

                {{-- Slide viewport: ONLY header + fields --}}
                <div class="signup-slide-viewport">
                    <div class="signup-slide-track" id="signupTrack">

                        {{-- PANEL 1 --}}
                        <div class="signup-slide-panel">
                            <div class="auth-header" style="margin-bottom:4px;">
                                <h1>Buat akun baru</h1>
                                <p>Langkah 1 — isi data akun kamu.</p>
                            </div>
                            <div class="auth-field">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="f_name" class="form-control" value="{{ old('name') }}" placeholder="Nama lengkap kamu" autocomplete="name">
                            </div>
                            <div class="auth-field">
                                <label class="form-label">Email</label>
                                <input type="email" id="f_email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email">
                            </div>
                        </div>

                        {{-- PANEL 2 --}}
                        <div class="signup-slide-panel">
                            <div class="auth-header" style="margin-bottom:4px;">
                                <h1>Keamanan</h1>
                                <p>Langkah 2 — buat password akun.</p>
                            </div>
                            <div class="auth-field">
                                <label class="form-label">Password</label>
                                <div class="password-field">
                                    <input type="password" id="f_password" class="form-control" data-password-input placeholder="Min. 8 karakter" autocomplete="new-password">
                                    <button type="button" class="password-toggle" data-password-toggle aria-label="Tampilkan">
                                        <i data-lucide="eye" class="icon-eye"></i>
                                        <i data-lucide="eye-off" class="icon-eye-off"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="auth-field">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="password-field">
                                    <input type="password" id="f_pass_confirm" class="form-control" data-password-input placeholder="Ulangi password" autocomplete="new-password">
                                    <button type="button" class="password-toggle" data-password-toggle aria-label="Tampilkan">
                                        <i data-lucide="eye" class="icon-eye"></i>
                                        <i data-lucide="eye-off" class="icon-eye-off"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- PANEL 3 --}}
                        <div class="signup-slide-panel">
                            <div class="auth-header" style="margin-bottom:4px;">
                                <h1>Data Toko</h1>
                                <p>Langkah 3 — data perusahaan kamu.</p>
                            </div>
                            <form method="POST" action="{{ url('/signup') }}" id="signupForm" style="display:flex;flex-direction:column;gap:9px;">
                                @csrf
                                <input type="hidden" name="name"                  id="h_name">
                                <input type="hidden" name="email"                 id="h_email">
                                <input type="hidden" name="password"              id="h_password">
                                <input type="hidden" name="password_confirmation" id="h_pass_confirm">
                                <div class="auth-field">
                                    <label class="form-label">Nama Perusahaan / Toko</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" placeholder="Nama toko kamu" autocomplete="organization">
                                </div>
                                <div class="auth-field">
                                    <label class="form-label">Email Perusahaan</label>
                                    <input type="email" name="company_email" class="form-control" value="{{ old('company_email') }}" placeholder="email@perusahaan.com">
                                </div>
                                <div class="auth-field">
                                    <label class="form-label">Alamat <span style="font-weight:400;color:var(--on-surface-variant);">(Opsional)</span></label>
                                    <input type="text" name="company_address" class="form-control" value="{{ old('company_address') }}" placeholder="Alamat toko utama">
                                </div>
                                <div class="auth-field">
                                    <label class="form-label">No. Telepon <span style="font-weight:400;color:var(--on-surface-variant);">(Opsional)</span></label>
                                    <input type="text" name="company_phone" class="form-control" value="{{ old('company_phone') }}" placeholder="08xxxxxxxxxx">
                                </div>
                            </form>
                        </div>

                    </div>{{-- /slide-track --}}
                </div>{{-- /slide-viewport --}}

                {{-- Nav row (fixed) --}}
                <div class="signup-nav-row">
                    <button type="button" class="signup-back-btn" id="backBtn" onclick="goToSlide(currentSlide - 1)">
                        <i data-lucide="arrow-left" style="width:14px;"></i>
                    </button>
                    <button type="button" class="btn btn-dark signup-next-btn" id="nextBtn" onclick="handleNext()">
                        Lanjut <i data-lucide="arrow-right" style=""></i>
                    </button>
                </div>

                {{-- Switch link (fixed) --}}
                <div class="signup-switch">
                    Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a>
                </div>

            </div>{{-- /phone-screen --}}
            <div class="phone-home-bar"></div>
        </div>{{-- /phone-frame --}}
    </div>

</div>{{-- /auth-shell --}}

<script>
    let currentSlide = 1;
    const totalSlides = 3;
    const stepLabels  = { 1: 'Data Akun', 2: 'Keamanan', 3: 'Perusahaan' };

    @if ($errors->has('name') || $errors->has('email'))
        currentSlide = 1;
    @elseif ($errors->has('password'))
        currentSlide = 2;
    @elseif ($errors->has('company_name') || $errors->has('company_email'))
        currentSlide = 3;
    @endif

    function goToSlide(slide) {
        if (slide < 1 || slide > totalSlides) return;
        if (slide > currentSlide && !validateSlide(currentSlide)) return;
        currentSlide = slide;
        updateUI();
    }

    function handleNext() {
        if (currentSlide < totalSlides) {
            goToSlide(currentSlide + 1);
        } else {
            document.getElementById('h_name').value         = document.getElementById('f_name').value;
            document.getElementById('h_email').value        = document.getElementById('f_email').value;
            document.getElementById('h_password').value     = document.getElementById('f_password').value;
            document.getElementById('h_pass_confirm').value = document.getElementById('f_pass_confirm').value;
            document.getElementById('signupForm').submit();
        }
    }

    function updateUI() {
        // Slide only the form track
        const pct = (currentSlide - 1) * (100 / totalSlides);
        document.getElementById('signupTrack').style.transform = `translateX(-${pct}%)`;

        // Dots
        for (let i = 1; i <= totalSlides; i++) {
            const d = document.getElementById(`sdot-${i}`);
            d.classList.remove('active','done');
            if (i < currentSlide)        d.classList.add('done');
            else if (i === currentSlide) d.classList.add('active');
        }

        // Label fade
        const lbl = document.getElementById('slabel');
        lbl.style.opacity = '0';
        setTimeout(() => { lbl.textContent = stepLabels[currentSlide]; lbl.style.opacity = '1'; }, 160);

        // Back button: width-based slide-in (takes zero space when hidden)
        const back = document.getElementById('backBtn');
        back.classList.toggle('visible', currentSlide > 1);

        // Next button label
        const next = document.getElementById('nextBtn');
        if (currentSlide === totalSlides) {
            next.innerHTML = 'Daftar <i data-lucide="check" style="width:13px;"></i>';
        } else {
            next.innerHTML = 'Lanjut <i data-lucide="arrow-right" style="width:13px;"></i>';
        }

        lucide.createIcons();
    }

    function validateSlide(slide) {
        let ok = true, first = null;
        if (slide === 1) {
            const name  = document.getElementById('f_name');
            const email = document.getElementById('f_email');
            if (!name.value.trim())         { markInvalid(name,  'Nama wajib diisi');    ok = false; first = first || name;  } else markValid(name);
            if (!email.value.includes('@')) { markInvalid(email, 'Email tidak valid');   ok = false; first = first || email; } else markValid(email);
        }
        if (slide === 2) {
            const pass = document.getElementById('f_password');
            const conf = document.getElementById('f_pass_confirm');
            if (pass.value.length < 8)     { markInvalid(pass, 'Min. 8 karakter');       ok = false; first = first || pass; } else markValid(pass);
            if (conf.value !== pass.value) { markInvalid(conf, 'Password tidak sama');   ok = false; first = first || conf; } else markValid(conf);
        }
        if (first) first.focus();
        return ok;
    }

    function markInvalid(el, msg) {
        el.style.borderColor = '#ef4444';
        el.style.boxShadow   = '0 0 0 2px rgba(239,68,68,0.15)';
        let h = el.closest('.auth-field')?.querySelector('.s-hint');
        if (!h) { h = document.createElement('p'); h.className = 's-hint'; h.style.cssText = 'margin:2px 0 0;font-size:10px;color:#ef4444;'; el.closest('.auth-field').appendChild(h); }
        h.textContent = msg;
    }
    function markValid(el) {
        el.style.borderColor = ''; el.style.boxShadow = '';
        el.closest('.auth-field')?.querySelector('.s-hint')?.remove();
    }

    document.querySelectorAll('[data-password-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const inp  = btn.closest('.password-field').querySelector('[data-password-input]');
            const show = inp.type === 'password';
            inp.type   = show ? 'text' : 'password';
            btn.querySelector('.icon-eye').style.display     = show ? 'none' : '';
            btn.querySelector('.icon-eye-off').style.display = show ? '' : 'none';
        });
    });

    // Add label transition
    document.getElementById('slabel').style.transition = 'opacity 0.16s ease';

    lucide.createIcons();
    if (currentSlide > 1) updateUI();

    // ── Toast notifications ───────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        @if($errors->any())
            window.showToast && window.showToast(@json($errors->first()), 'error');
        @endif
    });
</script>
</body>
</html>
