<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request()->routeIs('register') ? 'Daftar' : 'Login' }} &mdash; RuangKabar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <style>
:root {
    --emerald: #183C36;
    --deep: #102B26;
    --forest: #376B5C;
    --gold: #B99A64;
    --sand: #E7E0D2;
    --ivory: #FAF8F3;
    --white: #FFFFFF;
    --text: #26332F;
    --muted: #68736E;
    --on-dark: rgba(250, 248, 243, 0.68);
    --line-dark: rgba(250, 248, 243, 0.12);
    --sans: 'Plus Jakarta Sans', Arial, sans-serif;
    --serif: 'Playfair Display', Georgia, serif;
    --body: 'Inter', Arial, sans-serif;
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
    --slide: cubic-bezier(0.65, 0, 0.35, 1);
    --t-fast: 180ms;
    --t-slide: 720ms;
    --t-fade-out: 240ms;
    --t-fade-in: 360ms;
    --t-fade-delay: 400ms;
}

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    min-height: 100vh;
    min-height: 100dvh;
    font-family: var(--sans);
    color: var(--text);
    background: var(--deep);
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
}

a { color: inherit; text-decoration: none; }

a:focus-visible,
button:focus-visible,
input:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 3px;
}

.auth-page {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    min-height: 100dvh;
    padding: 32px 24px;
    overflow: hidden;
}

.orbs {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.orb {
    position: absolute;
    border-radius: 50%;
    background: rgba(55, 107, 92, 0.32);
}

.orb-1 { top: 9%; left: 6%; width: 54px; height: 54px; }
.orb-2 { top: 62%; left: -70px; width: 240px; height: 240px; background: rgba(55, 107, 92, 0.22); }
.orb-3 { top: -90px; right: 14%; width: 220px; height: 220px; background: rgba(55, 107, 92, 0.2); }
.orb-4 { bottom: 8%; right: 5%; width: 96px; height: 96px; }
.orb-5 { top: 44%; right: -110px; width: 300px; height: 300px; background: rgba(55, 107, 92, 0.18); }
.orb-6 { bottom: -60px; left: 38%; width: 160px; height: 160px; background: rgba(185, 154, 100, 0.1); }

.auth-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1040px;
    height: clamp(600px, 80vh, 680px);
    overflow: hidden;
    background: var(--emerald);
    border: 1px solid rgba(250, 248, 243, 0.08);
    border-radius: 32px;
    box-shadow: 0 40px 90px -30px rgba(0, 0, 0, 0.55), 0 12px 30px -12px rgba(0, 0, 0, 0.35);
}

.panel-visual {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 3;
    width: 60%;
    transition: transform var(--t-slide) var(--slide);
    will-change: transform;
}

.auth-card.is-register .panel-visual { transform: translateX(66.6667%); }

.panel-form {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 56%;
    z-index: 2;
    display: flex;
    align-items: center;
    width: 44%;
    padding: 0 44px;
    overflow-y: auto;
    transition: transform var(--t-slide) var(--slide);
    will-change: transform;
}

.auth-card.is-register .panel-form { transform: translateX(-127.2727%); }

.visual-bg {
    position: absolute;
    inset: 0;
    filter: drop-shadow(0 10px 26px rgba(0, 0, 0, 0.3));
}

.edge {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    transition: opacity var(--t-slide) var(--slide);
}

.edge-l { opacity: 0; }
.auth-card.is-register .edge-r { opacity: 0; }
.auth-card.is-register .edge-l { opacity: 1; }

.visual-illus {
    position: absolute;
    top: 104px;
    bottom: 250px;
    left: 30px;
    width: 66%;
    transition: transform var(--t-slide) var(--slide);
    pointer-events: none;
}

.auth-card.is-register .visual-illus { transform: translateX(37%); }

.visual-illus svg {
    display: block;
    width: 100%;
    height: 100%;
}

.copy {
    position: absolute;
    top: 44px;
    bottom: 44px;
    display: flex;
    flex-direction: column;
    width: 56%;
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: opacity var(--t-fade-out) ease, transform var(--t-fade-out) ease, visibility 0s linear var(--t-fade-out);
}

.copy-login { left: 44px; }
.copy-register { right: 44px; }

.auth-card:not(.is-register) .copy-login,
.auth-card.is-register .copy-register {
    opacity: 1;
    visibility: visible;
    transform: none;
    transition: opacity var(--t-fade-in) ease var(--t-fade-delay), transform var(--t-fade-in) var(--ease) var(--t-fade-delay), visibility 0s;
}

.copy-brand {
    display: inline-flex;
    align-items: baseline;
    align-self: flex-start;
    font-family: var(--sans);
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--emerald);
}

.copy-brand span { color: var(--gold); }

.copy-body { margin-top: auto; }

.copy-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 14px;
    padding: 5px 14px 5px 10px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border: 1px solid rgba(55, 107, 92, 0.2);
    border-radius: 999px;
}

.copy-badge::before {
    content: "";
    width: 6px;
    height: 6px;
    background: var(--gold);
    border-radius: 50%;
    flex-shrink: 0;
}

.copy-title {
    margin: 0 0 10px;
    font-family: var(--serif);
    font-size: clamp(22px, 2.4vw, 28px);
    font-weight: 600;
    line-height: 1.22;
    letter-spacing: -0.01em;
    color: var(--emerald);
}

.copy-sub {
    max-width: 300px;
    margin: 0 0 22px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.65;
    color: var(--muted);
}

.copy-ask {
    display: block;
    margin-bottom: 10px;
    font-family: var(--body);
    font-size: 13px;
    color: var(--muted);
}

.ghost-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 44px;
    padding: 0 30px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.02em;
    color: var(--emerald);
    background: transparent;
    border: 1.5px solid var(--emerald);
    border-radius: 999px;
    cursor: pointer;
    transition: color var(--t-fast) ease, background var(--t-fast) ease, transform 120ms ease;
}

.ghost-btn:hover { color: var(--ivory); background: var(--emerald); }
.ghost-btn:active { transform: scale(0.97); }

.panes {
    display: grid;
    width: 100%;
    margin: auto 0;
    padding: 28px 0;
}

.pane {
    grid-area: 1 / 1;
    min-width: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: opacity var(--t-fade-out) ease, transform var(--t-fade-out) ease, visibility 0s linear var(--t-fade-out);
}

.auth-card:not(.is-register) .pane-login,
.auth-card.is-register .pane-register {
    opacity: 1;
    visibility: visible;
    transform: none;
    transition: opacity var(--t-fade-in) ease var(--t-fade-delay), transform var(--t-fade-in) var(--ease) var(--t-fade-delay), visibility 0s;
}

.pane-title {
    margin: 0 0 6px;
    font-family: var(--serif);
    font-size: 32px;
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: -0.01em;
    color: var(--ivory);
}

.pane-lead {
    margin: 0 0 24px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.6;
    color: var(--on-dark);
}

.alert {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin: 0 0 18px;
    padding: 11px 13px;
    font-family: var(--body);
    font-size: 13px;
    line-height: 1.55;
    color: var(--ivory);
    background: rgba(185, 154, 100, 0.14);
    border: 1px solid rgba(185, 154, 100, 0.34);
    border-left: 3px solid var(--gold);
    border-radius: 10px;
}

.alert-ico { flex: none; width: 14px; height: 14px; margin-top: 2px; color: var(--gold); }
.alert-title { display: block; margin-bottom: 3px; font-size: 12.5px; }
.alert ul { margin: 3px 0 0; padding-left: 16px; }
.alert li { margin-bottom: 2px; }

.fields-row {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 0 12px;
}

.field { margin-bottom: 14px; }

.field-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}

.field-label label {
    font-size: 12.5px;
    font-weight: 600;
    letter-spacing: 0.01em;
    color: rgba(250, 248, 243, 0.88);
}

.field-hint { font-family: var(--body); font-size: 11px; color: rgba(250, 248, 243, 0.5); }

.field-wrap { position: relative; }

.field-input {
    display: block;
    width: 100%;
    height: 46px;
    padding: 0 14px;
    font-family: var(--body);
    font-size: 14.5px;
    color: var(--ivory);
    background: rgba(8, 26, 22, 0.45);
    border: 1.5px solid rgba(250, 248, 243, 0.1);
    border-radius: 12px;
    transition: border-color var(--t-fast) ease, box-shadow var(--t-fast) ease, background var(--t-fast) ease;
    -webkit-appearance: none;
}

.field-input::placeholder { color: rgba(250, 248, 243, 0.38); }

.field-input:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.22);
    background: rgba(8, 26, 22, 0.62);
    outline: none;
}

.field-input:-webkit-autofill {
    -webkit-text-fill-color: var(--ivory);
    caret-color: var(--ivory);
    box-shadow: 0 0 0 40px #14322C inset;
}

.field-input.is-err { border-color: #E39A82; box-shadow: 0 0 0 3px rgba(227, 154, 130, 0.14); }
.field-input.has-btn { padding-right: 44px; }

.eye-btn {
    position: absolute;
    top: 50%;
    right: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    padding: 0;
    color: rgba(250, 248, 243, 0.55);
    background: none;
    border: 0;
    border-radius: 6px;
    cursor: pointer;
    transform: translateY(-50%);
    transition: color var(--t-fast) ease;
}

.eye-btn:hover { color: var(--ivory); }
.eye-btn svg { width: 16px; height: 16px; pointer-events: none; }
.eye-btn .i-off { display: none; }
.eye-btn.revealed .i-on { display: none; }
.eye-btn.revealed .i-off { display: block; }

.field-error { display: block; margin-top: 4px; font-family: var(--body); font-size: 11.5px; color: #EBAE9A; }

.divider-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 2px 0 14px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(250, 248, 243, 0.5);
}

.divider-label::before,
.divider-label::after { content: ""; flex: 1; height: 1px; background: var(--line-dark); }

.submit-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    height: 48px;
    margin-top: 6px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--gold);
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease, transform 120ms ease;
}

.submit-btn:hover { background: #CBAF7C; }
.submit-btn:active { transform: scale(0.98); }
.submit-btn svg { width: 15px; height: 15px; }

.pane-footer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
    padding-top: 18px;
    border-top: 1px solid var(--line-dark);
    font-family: var(--body);
    font-size: 13px;
    color: rgba(250, 248, 243, 0.6);
}

.pane-footer p { margin: 0; }

.switch-note { display: none; }

.switch-btn {
    padding: 0;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--gold);
    background: none;
    border: 0;
    cursor: pointer;
    transition: color var(--t-fast) ease;
}

.switch-btn:hover { color: #CBAF7C; text-decoration: underline; text-underline-offset: 3px; }

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12.5px;
    font-weight: 500;
    color: rgba(250, 248, 243, 0.6);
    transition: color var(--t-fast) ease;
}

.back-link:hover { color: var(--ivory); }
.back-link svg { width: 12px; height: 12px; }

@media (max-width: 900px) {
    .auth-page { align-items: flex-start; padding: 20px 14px 28px; }

    .auth-card {
        display: flex;
        flex-direction: column;
        max-width: 520px;
        height: auto;
        border-radius: 26px;
    }

    .panel-visual,
    .auth-card.is-register .panel-visual {
        position: relative;
        width: 100%;
        height: 190px;
        background: var(--ivory);
        border-radius: 0 0 44px 44px;
        transform: none;
        transition: none;
    }

    .visual-bg,
    .visual-illus { display: none; }

    .copy,
    .copy-login,
    .copy-register {
        top: 26px;
        right: 28px;
        bottom: 30px;
        left: 28px;
        width: auto;
    }

    .copy-sub,
    .copy-badge,
    .copy-ask,
    .ghost-btn { display: none; }

    .copy-title { margin: 0; font-size: 21px; }

    .panel-form,
    .auth-card.is-register .panel-form {
        position: relative;
        left: auto;
        width: 100%;
        padding: 0 28px;
        overflow: visible;
        transform: none;
        transition: none;
    }

    .panes { padding: 28px 0 30px; }

    .switch-note { display: block; }
}

@media (max-width: 480px) {
    .panel-form,
    .auth-card.is-register .panel-form { padding: 0 22px; }
    .pane-title { font-size: 27px; }
    .fields-row { grid-template-columns: minmax(0, 1fr); gap: 0; }
    .panel-visual,
    .auth-card.is-register .panel-visual { height: 170px; border-radius: 0 0 36px 36px; }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        transition-duration: 0.01ms !important;
        transition-delay: 0s !important;
    }

    html { scroll-behavior: auto; }
}
    </style>
</head>
<body>

<div class="auth-page">

    <div class="orbs" aria-hidden="true">
        <span class="orb orb-1"></span>
        <span class="orb orb-2"></span>
        <span class="orb orb-3"></span>
        <span class="orb orb-4"></span>
        <span class="orb orb-5"></span>
        <span class="orb orb-6"></span>
    </div>

    <main class="auth-card {{ request()->routeIs('register') ? 'is-register' : '' }}" id="auth-card" data-login-url="{{ route('login') }}" data-register-url="{{ route('register') }}">

        <section class="panel-visual" aria-label="RuangKabar">

            <div class="visual-bg" aria-hidden="true">
                <svg class="edge edge-r" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L86,0 C96,13 100,31 92,46 C84,59 70,63 74,79 C76,90 71,96 63,100 L0,100 Z" fill="#FAF8F3"/></svg>
                <svg class="edge edge-l" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M100,0 L14,0 C4,13 0,31 8,46 C16,59 30,63 26,79 C24,90 29,96 37,100 L100,100 Z" fill="#FAF8F3"/></svg>
            </div>

            <div class="visual-illus" aria-hidden="true">
                <svg viewBox="0 0 420 270" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
                    <circle cx="300" cy="96" r="112" fill="rgba(55,107,92,0.09)"/>
                    <circle cx="96" cy="196" r="88" fill="rgba(185,154,100,0.13)"/>
                    <circle cx="352" cy="46" r="58" fill="none" stroke="rgba(24,60,54,0.12)" stroke-width="1.5"/>
                    <circle cx="352" cy="46" r="38" fill="none" stroke="rgba(24,60,54,0.08)" stroke-width="1"/>
                    <circle cx="44" cy="238" r="44" fill="none" stroke="rgba(185,154,100,0.34)" stroke-width="1.5"/>
                    <circle cx="44" cy="238" r="28" fill="none" stroke="rgba(185,154,100,0.22)" stroke-width="1"/>

                    <g transform="translate(76,34)">
                        <rect width="250" height="172" rx="14" fill="#FFFFFF" stroke="rgba(24,60,54,0.12)" stroke-width="1"/>
                        <rect x="14" y="14" width="222" height="26" rx="6" fill="rgba(24,60,54,0.07)"/>
                        <circle cx="222" cy="27" r="7" fill="rgba(185,154,100,0.55)"/>
                        <circle cx="204" cy="27" r="7" fill="rgba(55,107,92,0.28)"/>
                        <circle cx="186" cy="27" r="7" fill="rgba(24,60,54,0.12)"/>
                        <rect x="14" y="54" width="160" height="10" rx="4" fill="rgba(24,60,54,0.2)"/>
                        <rect x="14" y="72" width="214" height="7" rx="3.5" fill="rgba(24,60,54,0.1)"/>
                        <rect x="14" y="87" width="190" height="7" rx="3.5" fill="rgba(24,60,54,0.08)"/>
                        <rect x="14" y="102" width="150" height="7" rx="3.5" fill="rgba(24,60,54,0.1)"/>
                        <rect x="14" y="126" width="104" height="7" rx="3.5" fill="rgba(24,60,54,0.08)"/>
                        <rect x="14" y="141" width="170" height="7" rx="3.5" fill="rgba(24,60,54,0.1)"/>
                        <rect x="178" y="120" width="58" height="28" rx="14" fill="rgba(185,154,100,0.78)"/>
                        <rect x="188" y="130" width="38" height="7" rx="3.5" fill="rgba(255,255,255,0.8)"/>
                    </g>

                    <g transform="translate(18,150)">
                        <rect width="66" height="84" rx="8" fill="#FFFFFF" stroke="rgba(24,60,54,0.12)" stroke-width="1"/>
                        <rect x="7" y="7" width="52" height="36" rx="5" fill="rgba(55,107,92,0.28)"/>
                        <rect x="7" y="52" width="38" height="6" rx="3" fill="rgba(24,60,54,0.2)"/>
                        <rect x="7" y="64" width="52" height="4" rx="2" fill="rgba(24,60,54,0.1)"/>
                        <rect x="7" y="73" width="34" height="4" rx="2" fill="rgba(24,60,54,0.08)"/>
                    </g>

                    <g transform="translate(338,148)">
                        <rect width="62" height="78" rx="8" fill="#FFFFFF" stroke="rgba(185,154,100,0.35)" stroke-width="1"/>
                        <rect x="7" y="7" width="48" height="32" rx="5" fill="rgba(185,154,100,0.3)"/>
                        <rect x="7" y="47" width="34" height="6" rx="3" fill="rgba(24,60,54,0.2)"/>
                        <rect x="7" y="59" width="48" height="4" rx="2" fill="rgba(24,60,54,0.1)"/>
                        <rect x="7" y="68" width="30" height="4" rx="2" fill="rgba(24,60,54,0.08)"/>
                    </g>

                    <circle cx="30" cy="70" r="5" fill="rgba(185,154,100,0.55)"/>
                    <circle cx="398" cy="130" r="4" fill="rgba(185,154,100,0.45)"/>
                    <circle cx="300" cy="248" r="6" fill="rgba(55,107,92,0.22)"/>
                    <circle cx="150" cy="14" r="4" fill="rgba(55,107,92,0.3)"/>
                </svg>
            </div>

            <div class="copy copy-login" id="copy-login">
                <a class="copy-brand" href="/">Ruang<span>Kabar</span></a>
                <div class="copy-body">
                    <span class="copy-badge">Portal Berita</span>
                    <h2 class="copy-title">Kabar terkini, tepercaya, selalu hadir.</h2>
                    <p class="copy-sub">Ikuti perkembangan berita dan informasi terpercaya bersama RuangKabar.</p>
                    <span class="copy-ask">Belum punya akun?</span>
                    <button class="ghost-btn" type="button" data-switch="register">Daftar</button>
                </div>
            </div>

            <div class="copy copy-register" id="copy-register">
                <a class="copy-brand" href="/">Ruang<span>Kabar</span></a>
                <div class="copy-body">
                    <span class="copy-badge">Bergabung</span>
                    <h2 class="copy-title">Mulai ikuti berita terkini bersama kami.</h2>
                    <p class="copy-sub">Daftar gratis untuk ikut berkomentar dan mengikuti perkembangan berita.</p>
                    <span class="copy-ask">Sudah punya akun?</span>
                    <button class="ghost-btn" type="button" data-switch="login">Masuk</button>
                </div>
            </div>
        </section>

        <section class="panel-form" aria-label="Autentikasi">
            <div class="panes">

                <div class="pane pane-login" id="pane-login" role="region" aria-label="Form Login">
                    <h1 class="pane-title">Masuk</h1>
                    <p class="pane-lead">Selamat datang kembali di RuangKabar.</p>

                    @if ($errors->any() && !request()->routeIs('register'))
                        <div class="alert" role="alert">
                            <svg class="alert-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M10 6.5v3.5M10 13.5h.01"/></svg>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="/login" method="POST" novalidate>
                        @csrf
                        <div class="field">
                            <div class="field-label"><label for="username">Username</label></div>
                            <div class="field-wrap">
                                <input class="field-input" type="text" id="username" name="username"
                                    value="{{ old('username') }}" autocomplete="username"
                                    placeholder="Masukkan username Anda" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="field-label"><label for="password">Password</label></div>
                            <div class="field-wrap">
                                <input class="field-input has-btn" type="password" id="password" name="password"
                                    autocomplete="current-password" placeholder="Masukkan password" required>
                                <button class="eye-btn" type="button" aria-label="Tampilkan password" data-for="password">
                                    <svg class="i-on" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                    <svg class="i-off" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M2 2l16 16M7.5 7.6a4 4 0 005.9 5.4M6 5A9 9 0 001 10s3.5 6 9 6a9 9 0 004-1"/></svg>
                                </button>
                            </div>
                        </div>
                        <button class="submit-btn" type="submit">
                            Masuk
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
                        </button>
                    </form>

                    <div class="pane-footer">
                        <p class="switch-note">Belum punya akun? <button class="switch-btn" type="button" data-switch="register">Daftar sekarang</button></p>
                        <a class="back-link" href="/">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 5l-5 5 5 5M3 10h12"/></svg>
                            Beranda
                        </a>
                    </div>
                </div>

                <div class="pane pane-register" id="pane-register" role="region" aria-label="Form Daftar">
                    <h2 class="pane-title">Buat Akun</h2>
                    <p class="pane-lead">Daftar gratis dan mulai ikuti berita terkini.</p>

                    @if ($errors->any() && request()->routeIs('register'))
                        <div class="alert" role="alert">
                            <svg class="alert-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M10 6.5v3.5M10 13.5h.01"/></svg>
                            <div>
                                <strong class="alert-title">Periksa kembali data Anda</strong>
                                <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                            </div>
                        </div>
                    @endif

                    <form action="/register" method="POST" novalidate>
                        @csrf
                        <div class="fields-row">
                            <div class="field">
                                <div class="field-label"><label for="r-name">Nama Lengkap</label></div>
                                <div class="field-wrap">
                                    <input class="field-input {{ $errors->has('name') ? 'is-err' : '' }}"
                                        type="text" id="r-name" name="name" value="{{ old('name') }}"
                                        autocomplete="name" placeholder="Nama Anda" required>
                                </div>
                                @error('name')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <div class="field-label"><label for="r-username">Username</label></div>
                                <div class="field-wrap">
                                    <input class="field-input {{ $errors->has('username') ? 'is-err' : '' }}"
                                        type="text" id="r-username" name="username" value="{{ old('username') }}"
                                        autocomplete="username" placeholder="username_anda" required>
                                </div>
                                @error('username')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="divider-label">Password</div>
                        <div class="field">
                            <div class="field-label">
                                <label for="r-password">Password</label>
                                <span class="field-hint">Min. 8 karakter</span>
                            </div>
                            <div class="field-wrap">
                                <input class="field-input has-btn {{ $errors->has('password') ? 'is-err' : '' }}"
                                    type="password" id="r-password" name="password"
                                    autocomplete="new-password" placeholder="Buat password" required>
                                <button class="eye-btn" type="button" aria-label="Tampilkan password" data-for="r-password">
                                    <svg class="i-on" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                    <svg class="i-off" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M2 2l16 16M7.5 7.6a4 4 0 005.9 5.4M6 5A9 9 0 001 10s3.5 6 9 6a9 9 0 004-1"/></svg>
                                </button>
                            </div>
                            @error('password')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="field">
                            <div class="field-label"><label for="r-confirm">Konfirmasi Password</label></div>
                            <div class="field-wrap">
                                <input class="field-input has-btn" type="password" id="r-confirm"
                                    name="password_confirmation" autocomplete="new-password"
                                    placeholder="Ulangi password" required>
                                <button class="eye-btn" type="button" aria-label="Tampilkan konfirmasi" data-for="r-confirm">
                                    <svg class="i-on" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                    <svg class="i-off" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M2 2l16 16M7.5 7.6a4 4 0 005.9 5.4M6 5A9 9 0 001 10s3.5 6 9 6a9 9 0 004-1"/></svg>
                                </button>
                            </div>
                        </div>
                        <button class="submit-btn" type="submit">
                            Buat Akun
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M12 5l5 5-5 5"/></svg>
                        </button>
                    </form>

                    <div class="pane-footer">
                        <p class="switch-note">Sudah punya akun? <button class="switch-btn" type="button" data-switch="login">Masuk sekarang</button></p>
                        <a class="back-link" href="/">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 5l-5 5 5 5M3 10h12"/></svg>
                            Beranda
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </main>

</div>

<script>
(function () {
    var card = document.getElementById('auth-card');
    var paneLogin = document.getElementById('pane-login');
    var paneRegister = document.getElementById('pane-register');
    var copyLogin = document.getElementById('copy-login');
    var copyRegister = document.getElementById('copy-register');
    var loginUrl = card.getAttribute('data-login-url');
    var registerUrl = card.getAttribute('data-register-url');
    var focusTimer = null;

    function sync(showRegister) {
        paneLogin.setAttribute('aria-hidden', showRegister ? 'true' : 'false');
        paneRegister.setAttribute('aria-hidden', showRegister ? 'false' : 'true');
        copyLogin.setAttribute('aria-hidden', showRegister ? 'true' : 'false');
        copyRegister.setAttribute('aria-hidden', showRegister ? 'false' : 'true');
        paneLogin.inert = showRegister;
        paneRegister.inert = !showRegister;
        copyLogin.inert = showRegister;
        copyRegister.inert = !showRegister;
        document.title = (showRegister ? 'Daftar' : 'Login') + ' \u2014 RuangKabar';
    }

    function focusFirst(showRegister, delay) {
        var pane = showRegister ? paneRegister : paneLogin;
        var input = pane.querySelector('input:not([type="hidden"])');
        clearTimeout(focusTimer);
        if (input) {
            focusTimer = setTimeout(function () { input.focus({ preventScroll: true }); }, delay);
        }
    }

    function setMode(showRegister, push) {
        if (card.classList.contains('is-register') === showRegister) { return; }
        card.classList.toggle('is-register', showRegister);
        sync(showRegister);
        focusFirst(showRegister, 460);
        if (push && window.history && history.pushState) {
            history.pushState({ register: showRegister }, '', showRegister ? registerUrl : loginUrl);
        }
    }

    var startRegister = card.classList.contains('is-register');
    sync(startRegister);
    focusFirst(startRegister, 0);

    document.querySelectorAll('[data-switch]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            setMode(btn.getAttribute('data-switch') === 'register', true);
        });
    });

    window.addEventListener('popstate', function () {
        setMode(location.pathname.replace(/\/+$/, '') === new URL(registerUrl, location.href).pathname.replace(/\/+$/, ''), false);
    });

    document.querySelectorAll('.eye-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.getAttribute('data-for'));
            if (!input) { return; }
            var isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.classList.toggle('revealed', isHidden);
            btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });
})();
</script>

</body>
</html>