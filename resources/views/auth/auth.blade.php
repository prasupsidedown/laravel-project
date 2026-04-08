<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobiTravel — Masuk / Daftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* ============================================================
           DESIGN TOKENS — identik dengan landing page MobiTravel
        ============================================================ */
        :root {
            --forest:    #1a3328;
            --moss:      #2d5a3d;
            --sage:      #4e8060;
            --mist:      #a8c5b0;
            --cream:     #f5f0e8;
            --ivory:     #faf8f3;
            --sand:      #e8dfc8;
            --terra:     #c17f3b;
            --gold:      #e8a83e;
            --charcoal:  #1c1c1c;
            --ink:       #2e2e2e;
            --muted:     #7a7a6e;
            --error:     #c0392b;

            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --font-mono:    'DM Mono', monospace;

            --ease-smooth: cubic-bezier(.25,.46,.45,.94);
            --ease-bounce: cubic-bezier(.34,1.56,.64,1);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; overflow: hidden; }

        body {
            font-family: var(--font-body);
            background: var(--forest);
            color: var(--ink);
            display: flex;
        }

        /* noise overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.045'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
        }

        /* ============================================================
           LAYOUT — split screen
        ============================================================ */
        .auth-wrap {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* ---------- LEFT PANEL — form ---------- */
        .panel-form {
            width: 480px;
            flex-shrink: 0;
            background: var(--ivory);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            position: relative;
            z-index: 2;
        }

        /* diagonal clip on right edge */
        .panel-form::after {
            content: '';
            position: absolute;
            top: 0; right: -40px; bottom: 0;
            width: 80px;
            background: var(--ivory);
            clip-path: polygon(0 0, 100% 8%, 100% 92%, 0 100%);
            z-index: 1;
        }

        .panel-form__inner {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 3rem 3rem 3rem 3.5rem;
            position: relative;
            z-index: 2;
        }

        /* ---- logo ---- */
        .auth-logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--forest);
            letter-spacing: -.02em;
            margin-bottom: 3rem;
            text-decoration: none;
            display: inline-block;
        }
        .auth-logo span { color: var(--gold); }

        /* ---- tab toggle ---- */
        .tab-toggle {
            display: flex;
            gap: 0;
            margin-bottom: 2.25rem;
            background: var(--sand);
            border-radius: .75rem;
            padding: .25rem;
            position: relative;
        }

        .tab-btn {
            flex: 1;
            padding: .625rem 1rem;
            border: none;
            background: transparent;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            border-radius: .55rem;
            transition: color .25s;
            position: relative;
            z-index: 1;
            letter-spacing: .01em;
        }
        .tab-btn.active { color: var(--forest); }

        .tab-slider {
            position: absolute;
            top: .25rem;
            left: .25rem;
            width: calc(50% - .25rem);
            height: calc(100% - .5rem);
            background: var(--ivory);
            border-radius: .55rem;
            box-shadow: 0 2px 8px rgba(26,51,40,.12);
            transition: transform .3s var(--ease-bounce);
        }
        .tab-slider.right { transform: translateX(calc(100% + .0rem)); }

        /* ---- form heading ---- */
        .form-heading {
            font-family: var(--font-display);
            font-size: 1.875rem;
            font-weight: 900;
            color: var(--forest);
            line-height: 1.15;
            letter-spacing: -.02em;
            margin-bottom: .5rem;
        }
        .form-heading em { font-style: italic; color: var(--terra); }

        .form-sub {
            font-size: .875rem;
            color: var(--muted);
            margin-bottom: 1.75rem;
            line-height: 1.6;
        }

        /* ---- form panels (login / register) ---- */
        .form-panel { display: none; flex-direction: column; gap: 0; }
        .form-panel.active { display: flex; animation: slideIn .35s var(--ease-smooth) both; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(18px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ---- field ---- */
        .field {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.0625rem;
        }

        .field__row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
        }

        .field label {
            font-family: var(--font-mono);
            font-size: .7rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .4rem;
        }

        .field__wrap {
            position: relative;
        }

        .field__wrap .field-toggle {
            position: absolute;
            right: .875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: .85rem;
            color: var(--muted);
            padding: 0;
            line-height: 1;
            transition: color .2s;
        }
        .field__wrap .field-toggle:hover { color: var(--sage); }

        .field input,
        .field select {
            width: 100%;
            border: 1.5px solid var(--sand);
            border-radius: .65rem;
            padding: .75rem .9rem ;
            font-family: var(--font-body);
            font-size: .9375rem;
            color: var(--ink);
            background: var(--ivory);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none;
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(78,128,96,.14);
            background: #fff;
        }

        .field input.has-error { border-color: var(--error); }

        .field__error {
            font-size: .75rem;
            color: var(--error);
            margin-top: .3rem;
            display: none;
        }
        .field input.has-error + .field__error,
        .field input.has-error ~ .field__error { display: block; }

        /* strength bar */
        .strength-wrap { margin-top: .35rem; }
        .strength-bar {
            height: 3px;
            background: var(--sand);
            border-radius: 2px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            border-radius: 2px;
            width: 0;
            transition: width .35s var(--ease-smooth), background .35s;
        }
        .strength-label {
            font-size: .7rem;
            font-family: var(--font-mono);
            color: var(--muted);
            margin-top: .2rem;
        }

        /* ---- role selector ---- */
        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .65rem;
            margin-bottom: 1.0625rem;
        }

        .role-btn {
            border: 1.5px solid var(--sand);
            border-radius: .65rem;
            padding: .75rem;
            background: var(--ivory);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .6rem;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            color: var(--muted);
            transition: border-color .2s, background .2s, color .2s;
        }
        .role-btn:hover { border-color: var(--mist); }
        .role-btn.selected {
            border-color: var(--sage);
            background: rgba(78,128,96,.08);
            color: var(--forest);
        }
        
        /* ---- checkbox ---- */
        .checkbox-wrap {
            display: flex;
            align-items: flex-start;
            gap: .6rem;
            margin-bottom: 1.25rem;
        }

        .checkbox-wrap input[type="checkbox"] {
            width: 1.1rem;
            height: 1.1rem;
            accent-color: var(--sage);
            margin-top: .15rem;
            flex-shrink: 0;
            cursor: pointer;
        }

        .checkbox-wrap label {
            font-size: .8125rem;
            color: var(--muted);
            line-height: 1.55;
            cursor: pointer;
        }
        .checkbox-wrap label a { color: var(--sage); border-bottom: 1px solid var(--sage); }

        /* ---- forgot link ---- */
        .forgot {
            font-size: .8125rem;
            color: var(--sage);
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: border-color .2s;
            align-self: flex-end;
            margin-top: -.5rem;
            margin-bottom: 1.25rem;
        }
        .forgot:hover { border-color: var(--sage); }

        /* ---- submit button ---- */
        .btn-submit {
            width: 100%;
            background: var(--forest);
            color: var(--cream);
            border: none;
            border-radius: .75rem;
            padding: .9rem;
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .01em;
            position: relative;
            overflow: hidden;
            transition: background .2s, transform .2s var(--ease-bounce), box-shadow .2s;
        }
        .btn-submit:hover {
            background: var(--moss);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(26,51,40,.25);
        }
        .btn-submit:active { transform: translateY(0); }

        /* shimmer on hover */
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; bottom: 0;
            width: 60%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.12), transparent);
            transform: skewX(-15deg);
            transition: left .5s var(--ease-smooth);
        }
        .btn-submit:hover::after { left: 150%; }

        /* ---- divider ---- */
        .divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1.125rem 0;
            color: var(--muted);
            font-size: .8125rem;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sand);
        }

        /* ---- social login ---- */
        .social-logins {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            border: 1.5px solid var(--sand);
            border-radius: .65rem;
            padding: .65rem;
            background: var(--ivory);
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            color: var(--ink);
            cursor: pointer;
            transition: border-color .2s, background .2s, transform .2s var(--ease-bounce);
        }
        .btn-social:hover {
            border-color: var(--mist);
            background: var(--cream);
            transform: translateY(-2px);
        }
        .btn-social .s-icon { font-size: 1.1rem; }

        /* ---- bottom text ---- */
        .form-switch {
            margin-top: 1.5rem;
            text-align: center;
            font-size: .8125rem;
            color: var(--muted);
        }
        .form-switch a {
            color: var(--terra);
            font-weight: 600;
            border-bottom: 1px solid transparent;
            transition: border-color .2s;
            cursor: pointer;
        }
        .form-switch a:hover { border-color: var(--terra); }

        /* ---------- RIGHT PANEL — visual ---------- */
        .panel-visual {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .panel-visual__bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(160deg, rgba(26,51,40,.7) 0%, rgba(45,90,61,.4) 50%, rgba(26,51,40,.75) 100%),
                url('images/hero.jpg') center/cover no-repeat;
            animation: bgZoom 18s ease-in-out infinite alternate;
        }

        @keyframes bgZoom {
            from { transform: scale(1); }
            to   { transform: scale(1.07); }
        }

        /* floating label overlay */
        .panel-visual__content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 4rem;
            z-index: 2;
        }

        .visual-tag {
            font-family: var(--font-mono);
            font-size: .75rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--gold);
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: 1rem;
            animation: fadeUp .8s .2s both;
        }
        .visual-tag::before {
            content: '';
            display: inline-block;
            width: 2rem; height: 1px;
            background: var(--gold);
        }

        .visual-quote {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 3vw, 2.75rem);
            font-weight: 900;
            color: var(--cream);
            line-height: 1.1;
            letter-spacing: -.02em;
            margin-bottom: 1rem;
            animation: fadeUp .8s .35s both;
        }
        .visual-quote em { font-style: italic; color: var(--gold); }

        .visual-sub {
            font-size: .9375rem;
            color: rgba(245,240,232,.7);
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 2.5rem;
            animation: fadeUp .8s .45s both;
        }

        /* stat pills */
        .visual-stats {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeUp .8s .55s both;
        }

        .stat-pill {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(168,197,176,.25);
            border-radius: 2rem;
            padding: .5rem 1.1rem;
            display: flex;
            flex-direction: column;
        }

        .stat-pill__num {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--cream);
            line-height: 1;
        }
        .stat-pill__lbl {
            font-size: .7rem;
            font-family: var(--font-mono);
            letter-spacing: .06em;
            color: var(--mist);
            text-transform: uppercase;
        }

        @keyframes fadeLeft {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ============================================================
           ANIMATIONS
        ============================================================ */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 900px) {
            html, body { overflow: auto; height: auto; }
            .auth-wrap { flex-direction: column; }
            .panel-form { width: 100%; }
            .panel-form::after { display: none; }
            .panel-visual {
                height: 280px;
                order: -1;
            }
            .float-cards { display: none; }
            .visual-stats { display: none; }
            .panel-visual__content { padding: 2rem; }
            .visual-quote { font-size: 1.5rem; }
            .visual-sub { display: none; }
        }

        @media (max-width: 480px) {
            .panel-form__inner { padding: 2rem 1.5rem; }
            .field__row { grid-template-columns: 1fr; }
            .role-selector { grid-template-columns: 1fr; }
            .social-logins { grid-template-columns: 1fr; }
        }

        /* ============================================================
           LARAVEL VALIDATION ERRORS
        ============================================================ */
        .alert-error {
            background: rgba(192,57,43,.08);
            border: 1.5px solid rgba(192,57,43,.25);
            border-radius: .65rem;
            padding: .75rem 1rem;
            font-size: .85rem;
            color: var(--error);
            margin-bottom: 1.25rem;
            line-height: 1.55;
        }
        .alert-success {
            background: rgba(78,128,96,.1);
            border: 1.5px solid rgba(78,128,96,.3);
            border-radius: .65rem;
            padding: .75rem 1rem;
            font-size: .85rem;
            color: var(--moss);
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body>

<div class="auth-wrap">

    <!-- ============================================================
         LEFT — FORM PANEL
    ============================================================ -->
    <div class="panel-form">
        <div class="panel-form__inner">

            <!-- logo -->
            <a href="/" class="auth-logo">Mobi<span>Travel</span></a>

            <!-- Laravel flash messages -->
            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <strong>Periksa kembali:</strong><br>
                    @foreach($errors->all() as $error)
                        • {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <!-- tab toggle -->
            <div class="tab-toggle" id="tabToggle">
                <div class="tab-slider" id="tabSlider"></div>
                <button class="tab-btn active" id="btnLogin" onclick="switchTab('login')">Masuk</button>
                <button class="tab-btn"        id="btnRegister" onclick="switchTab('register')">Daftar</button>
            </div>

            <!-- ====== LOGIN PANEL ====== -->
            <div class="form-panel active" id="panelLogin">

                <div class="form-heading">Selamat <em>kembali,</em></div>
                <p class="form-sub">Masuk untuk melanjutkan perjalananmu bersama agen travel lokal terbaik.</p>

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="field">
                        <label for="email_login">Alamat Email</label>
                        <div class="field__wrap">
                            <input
                                type="email"
                                id="email_login"
                                name="email"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                            >
                        </div>
                    </div>

                    <div class="field">
                        <label for="password_login">Kata Sandi</label>
                        <div class="field__wrap">
                            <input
                                type="password"
                                id="password_login"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                autocomplete="current-password"
                                required
                            >
                            <button type="button" class="field-toggle" onclick="togglePwd('password_login', this)">👁</button>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
                        <div class="checkbox-wrap" style="margin-bottom:0">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </div>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">Lupa kata sandi?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">Masuk ke MobiTravel →</button>
                </form>

                <div class="divider">atau masuk dengan</div>

                <p class="form-switch">
                    Belum punya akun? <a onclick="switchTab('register')">Daftar sekarang</a>
                </p>
            </div><!-- /panelLogin -->


            <!-- ====== REGISTER PANEL ====== -->
            <div class="form-panel" id="panelRegister">

                <div class="form-heading">Bergabung <em>bersama</em><br>MobiTravel</div>
                <p class="form-sub">Buat akun gratis dan mulai perjalananmu atau daftarkan agen travelmu hari ini.</p>

                <!-- daftar sebagai -->
                <div style="margin-bottom:.75rem">
                    <label style="font-family:var(--font-mono);font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:.5rem">Daftar sebagai</label>
                    <div class="role-selector" id="roleSelector">
                        <button type="button" class="role-btn selected" data-role="wisatawan" onclick="selectRole(this)">
                            <div>
                                <div style="font-size:.875rem;font-weight:600;color:var(--forest)">Wisatawan</div>
                                <div style="font-size:.7rem;color:var(--muted)">Cari & pesan travel</div>
                            </div>
                        </button>
                        <button type="button" class="role-btn" data-role="agen" onclick="selectRole(this)">
                            <div>
                                <div style="font-size:.875rem;font-weight:600;color:var(--forest)">Agen Travel</div>
                                <div style="font-size:.7rem;color:var(--muted)">Kelola & tawarkan jasa</div>
                            </div>
                        </button>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" novalidate id="formRegister">
                    @csrf
                    <input type="hidden" name="role" id="inputRole" value="wisatawan">

                    <div class="field__row">
                        <div class="field">
                            <label for="nama_depan">Nama Depan</label>
                            <div class="field__wrap">
                                <input type="text" id="nama_depan" name="first_name" placeholder="Budi" value="{{ old('first_name') }}" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="nama_belakang">Nama Belakang</label>
                            <div class="field__wrap">
                                <input type="text" id="nama_belakang" name="last_name" placeholder="Hernawan" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="email_reg">Alamat Email</label>
                        <div class="field__wrap">
                            <input type="email" id="email_reg" name="email" placeholder="nama@email.com" value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="phone_reg">Nomor WhatsApp</label>
                        <div class="field__wrap">
                            <input type="tel" id="phone_reg" name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password_reg">Kata Sandi</label>
                        <div class="field__wrap">
                            <input type="password" id="password_reg" name="password" placeholder="Min. 8 karakter" autocomplete="new-password" required oninput="checkStrength(this.value)">
                            <button type="button" class="field-toggle" onclick="togglePwd('password_reg', this)">👁</button>
                        </div>
                        <div class="strength-wrap">
                            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                            <div class="strength-label" id="strengthLabel">—</div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password_confirm">Konfirmasi Kata Sandi</label>
                        <div class="field__wrap">
                            <input type="password" id="password_confirm" name="password_confirmation" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                            <button type="button" class="field-toggle" onclick="togglePwd('password_confirm', this)">👁</button>
                        </div>
                    </div>

                    <div class="checkbox-wrap">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            Saya menyetujui <a href="/syarat-ketentuan">Syarat & Ketentuan</a>
                            dan <a href="/kebijakan-privasi">Kebijakan Privasi</a> MobiTravel.
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">Buat Akun Gratis →</button>
                </form>

                <p class="form-switch" style="margin-top:1.25rem">
                    Sudah punya akun? <a onclick="switchTab('login')">Masuk di sini</a>
                </p>
            </div><!-- /panelRegister -->

        </div><!-- /panel-form__inner -->
    </div><!-- /panel-form -->


    <!-- ============================================================
         RIGHT — VISUAL PANEL
    ============================================================ -->
    <div class="panel-visual">
        <div class="panel-visual__bg"></div>

        <!-- bottom quote & stats -->
        <div class="panel-visual__content">
            <div class="visual-tag">Platform Travel Lokal Indonesia</div>
            <h2 class="visual-quote">
                Ribuan perjalanan<br>dimulai dari <em>satu langkah.</em>
            </h2>
            <p class="visual-sub">
                Bergabunglah dengan komunitas wisatawan dan agen lokal yang saling terhubung di seluruh Nusantara.
            </p>
            <div class="visual-stats">
                <div class="stat-pill">
                    <div class="stat-pill__num">2.4rb+</div>
                    <div class="stat-pill__lbl">Agen Lokal</div>
                </div>
                <div class="stat-pill">
                    <div class="stat-pill__num">48rb+</div>
                    <div class="stat-pill__lbl">Perjalanan</div>
                </div>
                <div class="stat-pill">
                    <div class="stat-pill__num">4.8</div>
                    <div class="stat-pill__lbl">Rating Rata-rata</div>
                </div>
            </div>
        </div>
    </div><!-- /panel-visual -->

</div><!-- /auth-wrap -->

<script>
    /* ---------- TAB SWITCH ---------- */
    function switchTab(tab) {
        const slider  = document.getElementById('tabSlider');
        const btnL    = document.getElementById('btnLogin');
        const btnR    = document.getElementById('btnRegister');
        const pLogin  = document.getElementById('panelLogin');
        const pReg    = document.getElementById('panelRegister');

        if (tab === 'login') {
            slider.classList.remove('right');
            btnL.classList.add('active');
            btnR.classList.remove('active');
            pLogin.classList.add('active');
            pReg.classList.remove('active');
        } else {
            slider.classList.add('right');
            btnR.classList.add('active');
            btnL.classList.remove('active');
            pReg.classList.add('active');
            pLogin.classList.remove('active');
        }
    }

    /* ---------- PASSWORD TOGGLE ---------- */
    function togglePwd(id, btn) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Hide';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }

    /* ---------- ROLE SELECTOR ---------- */
    function selectRole(btn) {
        document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        document.getElementById('inputRole').value = btn.dataset.role;
    }

    /* ---------- PASSWORD STRENGTH ---------- */
    function checkStrength(val) {
        const fill  = document.getElementById('strengthFill');
        const label = document.getElementById('strengthLabel');
        let score = 0;
        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const map = [
            { w: '0%',   bg: 'transparent', lbl: '—' },
            { w: '30%',  bg: '#e74c3c',     lbl: 'Lemah' },
            { w: '55%',  bg: var_terra(),   lbl: 'Cukup' },
            { w: '80%',  bg: '#f0b429',     lbl: 'Kuat' },
            { w: '100%', bg: '#27ae60',     lbl: 'Sangat Kuat' },
        ];

        const s = map[score] || map[0];
        fill.style.width      = s.w;
        fill.style.background = s.bg;
        label.textContent     = s.lbl;
    }

    function var_terra() {
        return getComputedStyle(document.documentElement).getPropertyValue('--terra').trim() || '#c17f3b';
    }

    /* ---------- Switch ke register jika URL param ?tab=register ---------- */
    if (new URLSearchParams(location.search).get('tab') === 'register') {
        switchTab('register');
    }

    /* ---------- Laravel: buka tab yang relevan jika ada old input ---------- */
    @if(old('email') && !old('first_name'))
        // email di-submit dari form login, tetap di login tab
    @elseif(old('first_name'))
        switchTab('register');
    @endif
</script>
</body>
</html>