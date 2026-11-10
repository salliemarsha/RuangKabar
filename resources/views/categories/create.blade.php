<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Kategori - RuangKabar</title>

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
    --danger: #A3392C;
    --danger-soft: rgba(163, 57, 44, 0.08);
    --on-dark: rgba(250, 248, 243, 0.8);
    --rule: rgba(24, 60, 54, 0.14);
    --sans: 'Plus Jakarta Sans', Arial, sans-serif;
    --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;
    --sidebar-w: 272px;
    --r-md: 16px;
    --r-lg: 28px;
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
    --t-fast: 200ms;
    --t-ui: 300ms;
}

*, *::before, *::after { box-sizing: border-box; }

[hidden] { display: none !important; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    font-family: var(--sans);
    background: var(--ivory);
    color: var(--text);
    overflow-x: clip;
    overflow-wrap: break-word;
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
}

body.menu-open { overflow: hidden; }

a { color: inherit; }

a:focus-visible,
button:focus-visible,
input:focus-visible,
summary:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 3px;
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.skip-link {
    position: absolute;
    left: 16px;
    top: -64px;
    z-index: 100;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 600;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 8px;
    text-decoration: none;
    transition: top var(--t-fast) var(--ease);
}

.skip-link:focus { top: 12px; }

.admin {
    display: grid;
    grid-template-columns: var(--sidebar-w) minmax(0, 1fr);
    min-height: 100vh;
    min-height: 100dvh;
}

.sidebar {
    position: sticky;
    top: 0;
    height: 100vh;
    height: 100dvh;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    color: var(--on-dark);
    background: var(--emerald);
}

.sidebar-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-height: 88px;
    padding: 20px 24px 12px;
}

.brand {
    display: inline-block;
    font-family: var(--sans);
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--ivory);
    text-decoration: none;
}

.brand span { color: var(--gold); }

.brand .brand-sub {
    display: block;
    margin-top: 4px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--gold);
}

.sidebar-close {
    display: none;
    width: 40px;
    height: 40px;
    margin-right: -8px;
    font-size: 22px;
    line-height: 1;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.1);
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    transition: background var(--t-fast) ease-out;
}

.sidebar-close:hover { background: rgba(250, 248, 243, 0.2); }

.side-nav { flex: 1; padding: 8px 14px; }

.nav-label {
    margin: 22px 12px 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(250, 248, 243, 0.45);
}

.nav-label:first-child { margin-top: 8px; }

.nav-group { margin: 0; padding: 0; list-style: none; }

.nav-link {
    display: flex;
    align-items: center;
    min-height: 44px;
    margin-bottom: 2px;
    padding: 0 14px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 12px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.nav-link:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.08); }

.nav-link.is-active {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.14);
    box-shadow: inset 3px 0 0 var(--gold);
}

.sidebar-foot { padding: 14px; border-top: 1px solid rgba(250, 248, 243, 0.12); }
.sidebar-foot .nav-link { font-size: 13px; margin-bottom: 0; color: rgba(250, 248, 243, 0.62); }

.main { min-width: 0; display: flex; flex-direction: column; }

.topbar {
    position: sticky;
    top: 0;
    z-index: 20;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    min-height: 72px;
    padding: 12px 40px;
    background: rgba(250, 248, 243, 0.92);
    border-bottom: 1px solid var(--rule);
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
}

.topbar-left { display: flex; align-items: center; gap: 14px; min-width: 0; }

.menu-toggle {
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 12px;
    cursor: pointer;
    transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.menu-toggle:hover { border-color: var(--forest); }
.menu-toggle:active { transform: scale(0.96); }
.menu-toggle span { display: block; width: 18px; height: 2px; background: var(--emerald); border-radius: 2px; }

.crumbs {
    display: flex;
    flex-wrap: wrap;
    gap: 0 8px;
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-soft);
}

.crumbs li + li::before { content: "/"; margin-right: 8px; color: var(--gold); }
.crumbs li:last-child { color: var(--emerald); }

.topbar-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }

.user-chip {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 5px 14px 5px 5px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
}

.user-chip-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    font-size: 12px;
    font-weight: 800;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
}

.user-chip-text { display: flex; flex-direction: column; line-height: 1.25; min-width: 0; }

.user-name {
    max-width: 160px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
}

.user-role {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-soft);
}

.logout-form { margin: 0; }

.logout-btn {
    height: 40px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    background: transparent;
    border: 1px solid var(--rule);
    border-radius: 999px;
    cursor: pointer;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.logout-btn:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }
.logout-btn:active { transform: scale(0.97); }

.content { flex: 1; padding: 32px 40px 72px; }
.content-inner { max-width: 1040px; margin: 0 auto; }

.hero {
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
    padding: 44px 48px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: var(--r-lg);
}

.hero::before {
    content: "";
    position: absolute;
    top: -140px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.hero::after {
    content: "";
    position: absolute;
    right: 72px;
    bottom: -64px;
    width: 140px;
    height: 140px;
    border: 1px solid rgba(185, 154, 100, 0.5);
    border-radius: 50%;
}

.hero-inner { position: relative; z-index: 1; animation: rise 560ms var(--ease) both; }

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    padding: 8px 16px 8px 12px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.14);
    border: 1px solid rgba(250, 248, 243, 0.25);
    border-radius: 999px;
}

.hero-label::before { content: ""; width: 8px; height: 8px; background: var(--gold); border-radius: 50%; }

.hero-title {
    max-width: 720px;
    margin: 0 0 12px;
    font-family: var(--serif);
    font-size: clamp(30px, 4vw, 46px);
    font-weight: 600;
    line-height: 1.12;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.hero-lead {
    max-width: 540px;
    margin: 0;
    font-family: var(--body);
    font-size: 16px;
    line-height: 1.7;
    color: var(--on-dark);
}

.hero-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 20px; margin-top: 26px; }

.hero-stat { font-family: var(--body); font-size: 14px; color: var(--on-dark); }
.hero-stat strong { margin-right: 4px; font-family: var(--serif); font-size: 26px; font-weight: 600; color: var(--gold); }

.back-link {
    display: flex;
    width: fit-content;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    padding: 6px 0;
    font-size: 13px;
    font-weight: 700;
    color: var(--on-dark);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.back-link svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }
.back-link:hover { color: var(--gold); }
.back-link:hover svg { transform: translateX(-3px); }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 46px;
    padding: 0 24px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--white);
    background: var(--forest);
    border: 1px solid transparent;
    border-radius: 999px;
    text-decoration: none;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.btn:hover { background: var(--emerald); }
.btn:active { transform: scale(0.97); }
.btn svg { width: 16px; height: 16px; flex: none; }

.btn--gold { color: var(--emerald); background: var(--gold); }
.btn--gold:hover { color: var(--emerald); background: #CBAE7C; }

.btn--ghost { color: var(--emerald); background: transparent; border-color: var(--rule); }
.btn--ghost:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }

.btn--danger { background: var(--danger); }
.btn--danger:hover { background: #8A2E23; }

.flash {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin: 0 0 24px;
    padding: 14px 16px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.6;
    color: var(--emerald);
    background: var(--white);
    border: 1px solid var(--rule);
    border-left: 4px solid var(--forest);
    border-radius: 14px;
    animation: rise 400ms var(--ease) both;
}

.flash svg { flex: none; width: 20px; height: 20px; margin-top: 2px; color: var(--forest); }
.flash p { flex: 1; margin: 0; }
.flash strong { display: block; margin-bottom: 4px; font-family: var(--sans); font-size: 14px; }
.flash ul { margin: 0; padding-left: 18px; }

.flash--error { color: var(--danger); background: #FFFAF8; border-left-color: var(--danger); }
.flash--error svg { color: var(--danger); }

.flash-close {
    flex: none;
    width: 32px;
    height: 32px;
    margin: -4px -6px 0 0;
    font-size: 20px;
    line-height: 1;
    color: var(--text-soft);
    background: none;
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out;
}

.flash-close:hover { color: var(--emerald); background: var(--sand); }

.toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px 20px;
    margin-bottom: 18px;
}

.search {
    position: relative;
    flex: 1 1 280px;
    max-width: 420px;
}

.search svg {
    position: absolute;
    left: 18px;
    top: 50%;
    width: 18px;
    height: 18px;
    color: var(--forest);
    transform: translateY(-50%);
    pointer-events: none;
}

.search input {
    display: block;
    width: 100%;
    height: 48px;
    padding: 0 18px 0 46px;
    font-family: var(--body);
    font-size: 15px;
    color: var(--emerald);
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
}

.search input::placeholder { color: var(--text-soft); }

.search input:focus {
    outline: none;
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4);
}

.result-info { margin: 0; font-family: var(--body); font-size: 14px; color: var(--text-soft); }
.result-info strong { font-weight: 600; color: var(--text); }

.slug {
    display: inline-block;
    max-width: 100%;
    padding: 4px 10px;
    font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    font-size: 12.5px;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 8px;
    overflow-wrap: anywhere;
}

.act-row { display: flex; align-items: center; gap: 8px; }

.inline-form { margin: 0; }

.act {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 38px;
    padding: 0 14px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    cursor: pointer;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.act svg { width: 15px; height: 15px; }
.act:active { transform: scale(0.96); }
.act--edit:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }
.act--delete { color: var(--danger); }
.act--delete:hover { color: var(--white); background: var(--danger); border-color: var(--danger); }

.no-results,
.empty {
    padding: 64px 28px;
    text-align: center;
    background: var(--sand);
    border-radius: var(--r-lg);
}

.no-results strong,
.empty strong {
    display: block;
    margin-bottom: 8px;
    font-family: var(--serif);
    font-size: 26px;
    font-weight: 600;
    color: var(--emerald);
}

.no-results p,
.empty p {
    max-width: 440px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.7;
    color: var(--text-soft);
}

.empty .btn { margin-top: 22px; }

.dialog {
    width: min(440px, calc(100vw - 32px));
    padding: 32px 28px 24px;
    color: var(--text);
    background: var(--white);
    border: 0;
    border-radius: var(--r-lg);
    box-shadow: 0 30px 70px -20px rgba(24, 60, 54, 0.55);
}

.dialog[open] { animation: pop 300ms var(--ease) both; }

.dialog::backdrop {
    background: rgba(24, 60, 54, 0.55);
    -webkit-backdrop-filter: blur(3px);
    backdrop-filter: blur(3px);
}

.dialog-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    margin-bottom: 18px;
    color: var(--danger);
    background: var(--danger-soft);
    border-radius: 50%;
}

.dialog-icon svg { width: 24px; height: 24px; }

.dialog h2 {
    margin: 0 0 8px;
    font-family: var(--serif);
    font-size: 26px;
    font-weight: 600;
    line-height: 1.2;
    color: var(--emerald);
}

.dialog p { margin: 0; font-family: var(--body); font-size: 15px; line-height: 1.7; color: var(--text-soft); }
.dialog p strong { font-weight: 600; color: var(--text); overflow-wrap: anywhere; }

.dialog-actions { display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px; margin-top: 26px; }

.form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 24px;
    align-items: start;
}

.card {
    padding: 32px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.field label {
    display: block;
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: 700;
    color: var(--emerald);
}

.field input {
    display: block;
    width: 100%;
    height: 52px;
    padding: 0 18px;
    font-family: var(--body);
    font-size: 16px;
    color: var(--emerald);
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 14px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.field input:hover { border-color: rgba(24, 60, 54, 0.3); }

.field input:focus {
    outline: none;
    background: var(--white);
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4);
}

.field input.is-invalid { border-color: var(--danger); background: #FFFAF8; }
.field input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(163, 57, 44, 0.2); }

.hint { margin: 10px 0 0; font-family: var(--body); font-size: 13.5px; line-height: 1.6; color: var(--text-soft); }
.field-error { margin: 10px 0 0; font-family: var(--body); font-size: 13.5px; font-weight: 500; color: var(--danger); }

.form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px 12px;
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid var(--rule);
}

.aside-card {
    position: relative;
    overflow: hidden;
    padding: 28px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 22px;
}

.aside-card::before {
    content: "";
    position: absolute;
    top: -70px;
    right: -70px;
    width: 180px;
    height: 180px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.aside-card > * { position: relative; }

.aside-title {
    margin: 0 0 14px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
}

.preview {
    margin: 0 0 6px;
    font-family: var(--serif);
    font-size: 24px;
    font-weight: 600;
    line-height: 1.25;
    overflow-wrap: anywhere;
}

.preview-slug {
    display: block;
    margin-bottom: 20px;
    font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    font-size: 13px;
    color: var(--on-dark);
    overflow-wrap: anywhere;
}

.aside-note {
    margin: 0;
    padding-top: 16px;
    font-family: var(--body);
    font-size: 13.5px;
    line-height: 1.7;
    color: var(--on-dark);
    border-top: 1px solid rgba(250, 248, 243, 0.14);
}

.aside-note + .aside-note { padding-top: 10px; border-top: 0; }
.aside-note strong { color: var(--ivory); font-weight: 600; overflow-wrap: anywhere; }

.scrim { display: none; }

@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: none; }
}

@keyframes pop {
    from { opacity: 0; transform: translateY(12px) scale(0.97); }
    to   { opacity: 1; transform: none; }
}

@media (max-width: 1023px) {
    .admin { grid-template-columns: minmax(0, 1fr); }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 40;
        width: min(300px, 86vw);
        height: auto;
        visibility: hidden;
        transform: translateX(-100%);
        transition: transform 280ms var(--ease), visibility 0s linear 280ms;
    }

    .sidebar.is-open { visibility: visible; transform: none; transition: transform 280ms var(--ease); }
    .sidebar-close { display: inline-flex; align-items: center; justify-content: center; }

    .scrim {
        display: block;
        position: fixed;
        inset: 0;
        z-index: 30;
        background: rgba(24, 60, 54, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: opacity 250ms ease, visibility 0s linear 250ms;
    }

    .scrim.is-visible { opacity: 1; visibility: visible; transition: opacity 250ms ease; }

    .menu-toggle { display: flex; }
    .topbar { padding: 12px 24px; }
    .content { padding: 24px 24px 56px; }
    .hero { padding: 36px 32px; }
    .form-layout { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 719px) {
    .topbar { padding: 10px 16px; gap: 10px; }
    .user-chip-text { display: none; }
    .user-chip { padding: 5px; }
    .logout-btn { padding: 0 14px; }
    .content { padding: 16px 16px 48px; }
    .hero { padding: 28px 22px; border-radius: 22px; }
    .hero::after { display: none; }
    .hero-actions .btn { width: 100%; }
    .toolbar { flex-direction: column; align-items: stretch; }
    .search { max-width: none; flex-basis: auto; }
    .card { padding: 22px 18px; border-radius: 18px; }
    .form-actions { flex-direction: column; align-items: stretch; }
    .form-actions .btn { width: 100%; }
    .dialog-actions .btn { flex: 1 1 100%; }
}

@media (max-width: 359px) {
    .content { padding: 12px 12px 40px; }
    .hero { padding: 24px 16px; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }
}


    </style>
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <div class="admin">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi admin">
            <div class="sidebar-top">
                <a class="brand" href="/">
                    Ruang<span>Kabar</span>
                    <span class="brand-sub">Panel Admin</span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">&times;</button>
            </div>

            <nav class="side-nav" aria-label="Menu admin">
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'is-active' : '' }}" href="/admin/dashboard" {!! request()->is('admin/dashboard') ? 'aria-current="page"' : '' !!}>Dashboard</a>
                    </li>
                </ul>

                <p class="nav-label">Konten</p>
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('articles*') ? 'is-active' : '' }}" href="{{ route('articles.index') }}" {!! request()->is('articles*') ? 'aria-current="page"' : '' !!}>Artikel</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('categories*') ? 'is-active' : '' }}" href="{{ route('categories.index') }}" {!! request()->is('categories*') ? 'aria-current="page"' : '' !!}>Kategori</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('tags*') ? 'is-active' : '' }}" href="{{ route('tags.index') }}" {!! request()->is('tags*') ? 'aria-current="page"' : '' !!}>Tag</a>
                    </li>
                </ul>

                <p class="nav-label">Pengelolaan</p>
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('comments*') ? 'is-active' : '' }}" href="{{ route('comments.index') }}" {!! request()->is('comments*') ? 'aria-current="page"' : '' !!}>Komentar</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('reports/*') ? 'is-active' : '' }}" href="{{ route('reports.articles') }}" {!! request()->is('reports/*') ? 'aria-current="page"' : '' !!}>Laporan</a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-foot">
                <a class="nav-link" href="/">&larr;&nbsp;Lihat beranda</a>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        <div class="main">

            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                        <span></span><span></span><span></span>
                    </button>

                    <ol class="crumbs">
                        <li>Admin</li>
                        <li>Kategori</li>
                        <li>Tambah</li>
                    </ol>
                </div>

                <div class="topbar-right">
                    <div class="user-chip">
                        <span class="user-chip-avatar" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="user-chip-text">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">{{ auth()->user()->role }}</span>
                        </span>
                    </div>

                    <form class="logout-form" action="/logout" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit">Logout</button>
                    </form>
                </div>
            </header>

            <main class="content" id="konten">
                <div class="content-inner">

                    <section class="hero" aria-labelledby="page-title">
                        <div class="hero-inner">
                            <a class="back-link" href="/categories"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 8H3M7 4L3 8l4 4"/></svg> Kembali ke daftar kategori</a>
                            <span class="hero-label">KATEGORI</span>
                            <h1 class="hero-title" id="page-title">Tambah Kategori</h1>
                            <p class="hero-lead">Berikan nama yang singkat dan jelas agar mudah dikenali pembaca.</p>
                        </div>
                    </section>

                    @if ($errors->any())
                        <div class="flash flash--error" role="alert">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
                            <div>
                                <strong>Terjadi kesalahan</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="form-layout">
                        <form class="card" action="/categories" method="POST">
                                @csrf

                            <div class="field">
                                <label for="name">Nama Kategori</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    maxlength="100"
                                    required
                                    data-empty="Nama Kategori"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    aria-describedby="name-hint{{ $errors->has('name') ? ' name-error' : '' }}"
                                    autofocus
                                    {!! $errors->has('name') ? 'aria-invalid="true"' : '' !!}
                                >
                                @error('name')
                                    <p class="field-error" id="name-error">{{ $message }}</p>
                                @enderror
                                <p class="hint" id="name-hint">Slug dibuat otomatis dari nama kategori.</p>
                            </div>

                            <div class="form-actions">
                                <button class="btn" type="submit">Simpan Kategori</button>
                                <a class="btn btn--ghost" href="/categories">Batal</a>
                            </div>
                        </form>

                        <aside class="aside-card" aria-label="Pratinjau">
                            <p class="aside-title">Pratinjau</p>
                            <p class="preview" id="preview-name">Nama Kategori</p>
                            <span class="preview-slug" id="preview-slug">-</span>
                            <p class="aside-note">Nama kategori harus unik, maksimal 100 karakter.</p>
                        </aside>
                    </div>

                </div>
            </main>

        </div>

    </div>

    <script>
        (function () {
            var sidebar = document.getElementById('sidebar');
            var scrim = document.getElementById('scrim');
            var toggle = document.getElementById('menuToggle');
            var closeBtn = document.getElementById('sidebarClose');

            if (sidebar && scrim && toggle && closeBtn) {
                var openMenu = function () {
                    sidebar.classList.add('is-open');
                    scrim.classList.add('is-visible');
                    document.body.classList.add('menu-open');
                    toggle.setAttribute('aria-expanded', 'true');
                    closeBtn.focus();
                };

                var closeMenu = function (returnFocus) {
                    sidebar.classList.remove('is-open');
                    scrim.classList.remove('is-visible');
                    document.body.classList.remove('menu-open');
                    toggle.setAttribute('aria-expanded', 'false');
                    if (returnFocus) { toggle.focus(); }
                };

                toggle.addEventListener('click', openMenu);
                closeBtn.addEventListener('click', function () { closeMenu(true); });
                scrim.addEventListener('click', function () { closeMenu(true); });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape' && sidebar.classList.contains('is-open')) { closeMenu(true); }
                });

                window.addEventListener('resize', function () {
                    if (window.innerWidth >= 1024 && sidebar.classList.contains('is-open')) { closeMenu(false); }
                });
            }

            var flashClose = document.querySelectorAll('[data-flash-close]');
            flashClose.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var box = btn.closest('.flash');
                    if (box) { box.hidden = true; }
                });
            });

            var nameInput = document.getElementById('name');
            var preview = document.getElementById('preview-name');
            var previewSlug = document.getElementById('preview-slug');

            if (nameInput && preview && previewSlug) {
                var empty = nameInput.getAttribute('data-empty');

                var slugify = function (value) {
                    return value
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                };

                var update = function () {
                    var value = nameInput.value.trim();
                    preview.textContent = value || empty;
                    previewSlug.textContent = slugify(value) || '-';
                };

                nameInput.addEventListener('input', update);
                update();
            }

        })();
    </script>

</body>
</html>