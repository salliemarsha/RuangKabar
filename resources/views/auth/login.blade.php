<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — RuangKabar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <style>
:root {
    --emerald: #183C36;
    --forest: #376B5C;
    --gold: #B99A64;
    --sand: #E7E0D2;
    --ivory: #FAF8F3;
    --white: #FFFFFF;
    --text: #26332F;
    --text-soft: #68736E;
    --rule: rgba(24, 60, 54, 0.14);
    --sans: 'Plus Jakarta Sans', Arial, sans-serif;
    --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
    --t-fast: 180ms;
    --t-ui: 300ms;
}

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    min-height: 100vh;
    min-height: 100dvh;
    font-family: var(--sans);
    background: var(--ivory);
    color: var(--text);
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
}

a { color: inherit; }

a:focus-visible,
button:focus-visible,
input:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 3px;
}

.auth-wrap {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    min-height: 100vh;
    min-height: 100dvh;
}

.auth-panel {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 40px 56px 48px;
    background: var(--emerald);
    overflow: hidden;
}

.auth-panel::before {
    content: "";
    position: absolute;
    top: -140px;
    right: -100px;
    width: 420px;
    height: 420px;
    background: var(--forest);
    opacity: 0.5;
    border-radius: 50%;
    pointer-events: none;
}

.auth-panel::after {
    content: "";
    position: absolute;
    bottom: -180px;
    left: -80px;
    width: 360px;
    height: 360px;
    background: var(--forest);
    opacity: 0.3;
    border-radius: 50%;
    pointer-events: none;
}

.panel-inner {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 0;
}

.brand {
    display: inline-flex;
    align-items: center;
    gap: 2px;
    font-family: var(--sans);
    font-size: 26px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--ivory);
    text-decoration: none;
    margin-bottom: auto;
}

.brand span { color: var(--gold); }

.panel-tagline {
    margin: auto 0 0;
    padding-top: 48px;
}

.panel-tagline-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    padding: 6px 14px 6px 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.12);
    border: 1px solid rgba(250, 248, 243, 0.22);
    border-radius: 999px;
}

.panel-tagline-label::before {
    content: "";
    width: 6px;
    height: 6px;
    background: var(--gold);
    border-radius: 50%;
}

.panel-headline {
    margin: 0 0 16px;
    font-family: var(--serif);
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 600;
    line-height: 1.18;
    letter-spacing: -0.01em;
    color: var(--ivory);
}

.panel-sub {
    margin: 0;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.7;
    color: rgba(250, 248, 243, 0.7);
    max-width: 340px;
}

.panel-dots {
    display: flex;
    gap: 8px;
    margin-top: 36px;
}

.panel-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(250, 248, 243, 0.25);
}

.panel-dot.is-active { background: var(--gold); width: 20px; border-radius: 3px; }

.auth-form-side {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 48px 48px 64px;
    background: var(--white);
}

.auth-card {
    width: 100%;
    max-width: 400px;
}

.auth-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--forest);
    text-transform: uppercase;
}

.auth-eyebrow::before {
    content: "";
    width: 20px;
    height: 2px;
    background: var(--gold);
    border-radius: 1px;
}

.auth-title {
    margin: 0 0 8px;
    font-family: var(--serif);
    font-size: 34px;
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: -0.01em;
    color: var(--text);
}

.auth-lead {
    margin: 0 0 32px;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.6;
    color: var(--text-soft);
}

.alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 0 0 24px;
    padding: 14px 16px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.55;
    color: var(--text);
    background: #FEF7EE;
    border: 1px solid rgba(185, 154, 100, 0.35);
    border-left: 3px solid var(--gold);
    border-radius: 10px;
}

.alert svg {
    flex: none;
    width: 16px;
    height: 16px;
    margin-top: 1px;
    color: var(--gold);
}

.field {
    margin-bottom: 18px;
}

.field-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 7px;
}

.field-label label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
}

.field-input-wrap {
    position: relative;
}

.field input {
    display: block;
    width: 100%;
    height: 48px;
    padding: 0 14px;
    font-family: var(--body);
    font-size: 15px;
    color: var(--text);
    background: var(--ivory);
    border: 1.5px solid var(--sand);
    border-radius: 12px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
    -webkit-appearance: none;
}

.field input:focus {
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.12);
    outline: none;
    background: var(--white);
}

.field input.has-toggle { padding-right: 48px; }

.toggle-btn {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    padding: 0;
    background: none;
    border: 0;
    border-radius: 6px;
    color: var(--text-soft);
    cursor: pointer;
    transition: color var(--t-fast) ease-out;
}

.toggle-btn:hover { color: var(--text); }
.toggle-btn svg { width: 17px; height: 17px; pointer-events: none; }
.toggle-btn .i-eye-off { display: none; }
.toggle-btn.is-shown .i-eye { display: none; }
.toggle-btn.is-shown .i-eye-off { display: block; }

.field-error {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #B55E3A;
}

.auth-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    height: 50px;
    margin-top: 8px;
    font-family: var(--sans);
    font-size: 15px;
    font-weight: 700;
    color: var(--white);
    background: var(--emerald);
    border: 0;
    border-radius: 12px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, transform 120ms ease-out;
}

.auth-submit:hover { background: var(--forest); }
.auth-submit:active { transform: scale(0.98); }

.auth-submit svg { width: 17px; height: 17px; }

.auth-footer {
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--sand);
}

.auth-footer p {
    margin: 0 0 8px;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.auth-footer a {
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.auth-footer a:hover { color: var(--emerald); text-decoration: underline; text-underline-offset: 3px; }

.auth-footer .back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-soft);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.auth-footer .back-link:hover { color: var(--text); text-decoration: none; }
.auth-footer .back-link svg { width: 14px; height: 14px; }

@media (max-width: 900px) {
    .auth-wrap { grid-template-columns: minmax(0, 1fr); }

    .auth-panel {
        padding: 24px 28px 32px;
        min-height: auto;
    }

    .panel-tagline { display: none; }

    .auth-panel::before { width: 260px; height: 260px; top: -100px; right: -60px; }
    .auth-panel::after { display: none; }

    .brand { font-size: 22px; }

    .auth-form-side {
        padding: 36px 24px 48px;
        background: var(--ivory);
    }

    .auth-card { max-width: 480px; }
}

@media (max-width: 480px) {
    .auth-panel { padding: 20px; }
    .auth-form-side { padding: 28px 20px 40px; }
    .auth-title { font-size: 28px; }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after { transition: none !important; }
}
    </style>
</head>
<body>

    <div class="auth-wrap">
        <aside class="auth-panel">
            <div class="panel-inner">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>

                <div class="panel-tagline">
                    <span class="panel-tagline-label">Portal Berita</span>
                    <h2 class="panel-headline">Kabar terkini, tepercaya, selalu hadir.</h2>
                    <p class="panel-sub">Bergabung dengan RuangKabar untuk mengikuti perkembangan berita dan informasi terpercaya.</p>
                    <div class="panel-dots">
                        <span class="panel-dot is-active"></span>
                        <span class="panel-dot"></span>
                        <span class="panel-dot"></span>
                    </div>
                </div>
            </div>
        </aside>

        <main class="auth-form-side">
            <div class="auth-card">
                <span class="auth-eyebrow">Masuk Akun</span>
                <h1 class="auth-title">Selamat datang kembali</h1>
                <p class="auth-lead">Masuk ke akun RuangKabar Anda untuk melanjutkan.</p>

                @if ($errors->any())
                    <div class="alert" role="alert">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14h.01"/></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="/login" method="POST" novalidate>
                    @csrf

                    <div class="field">
                        <div class="field-label">
                            <label for="username">Username</label>
                        </div>
                        <div class="field-input-wrap">
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                autocomplete="username"
                                required
                                placeholder="Masukkan username"
                            >
                        </div>
                    </div>

                    <div class="field">
                        <div class="field-label">
                            <label for="password">Password</label>
                        </div>
                        <div class="field-input-wrap">
                            <input
                                class="has-toggle"
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="current-password"
                                required
                                placeholder="Masukkan password"
                            >
                            <button class="toggle-btn" type="button" aria-label="Tampilkan password" data-for="password">
                                <svg class="i-eye" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                <svg class="i-eye-off" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M2 2l16 16M7.5 7.6A4 4 0 0113.4 13M6.1 6A9 9 0 001 10s3.5 6 9 6a9 9 0 004.3-1.1M14.9 13.9A9 9 0 0019 10s-3.5-6-9-6c-.6 0-1.2.1-1.8.2"/></svg>
                            </button>
                        </div>
                    </div>

                    <button class="auth-submit" type="submit">
                        Masuk
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
                    <a class="back-link" href="/">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 5l-5 5 5 5M3 10h12"/></svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>
(function () {
    document.querySelectorAll('.toggle-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.for);
            if (!input) { return; }
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.classList.toggle('is-shown', show);
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });
})();
    </script>

</body>
</html>
