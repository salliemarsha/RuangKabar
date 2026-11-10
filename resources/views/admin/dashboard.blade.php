<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - RuangKabar</title>

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
    min-height: 92px;
    padding: 22px 22px 18px;
    border-bottom: 1px solid rgba(250, 248, 243, 0.1);
}

.brand {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: var(--ivory);
    text-decoration: none;
}

.brand-mark {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    font-family: var(--serif);
    font-size: 18px;
    font-weight: 600;
    letter-spacing: -0.02em;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 14px;
    box-shadow: 0 8px 18px -8px rgba(0, 0, 0, 0.5);
    transition: transform var(--t-ui) var(--ease);
}

.brand:hover .brand-mark { transform: rotate(-6deg); }

.brand-text { display: flex; flex-direction: column; line-height: 1.1; }

.brand-word {
    font-family: var(--sans);
    font-size: 21px;
    font-weight: 800;
    letter-spacing: -0.03em;
}

.brand-word span { color: var(--gold); }

.brand-sub {
    margin-top: 5px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: rgba(250, 248, 243, 0.55);
}

.sidebar-close {
    display: none;
    width: 40px;
    height: 40px;
    margin-right: -6px;
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

.side-nav { flex: 1; padding: 10px 14px 12px; }

.nav-label {
    margin: 24px 14px 8px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: rgba(185, 154, 100, 0.85);
}

.nav-label:first-child { margin-top: 14px; }

.nav-group { margin: 0; padding: 0; list-style: none; }

.nav-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 46px;
    margin-bottom: 3px;
    padding: 0 14px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 14px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.nav-icon {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: rgba(250, 248, 243, 0.7);
    background: rgba(250, 248, 243, 0.06);
    border-radius: 10px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, transform var(--t-ui) var(--ease);
}

.nav-icon svg { width: 18px; height: 18px; }

.nav-link:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.07); }
.nav-link:hover .nav-icon { color: var(--ivory); background: rgba(250, 248, 243, 0.12); transform: translateX(2px); }

.nav-link.is-active {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.13);
}

.nav-link.is-active::before {
    content: "";
    position: absolute;
    left: -14px;
    top: 10px;
    bottom: 10px;
    width: 4px;
    background: var(--gold);
    border-radius: 0 4px 4px 0;
}

.nav-link.is-active .nav-icon { color: var(--emerald); background: var(--gold); transform: none; }

.side-account {
    display: none;
    align-items: center;
    gap: 12px;
    margin: 0 14px 12px;
    padding: 12px;
    background: rgba(250, 248, 243, 0.08);
    border: 1px solid rgba(250, 248, 243, 0.12);
    border-radius: 16px;
}

.side-account .user-chip-avatar { width: 38px; height: 38px; font-size: 14px; }
.side-account .user-name { max-width: 150px; color: var(--ivory); }
.side-account .user-role { color: var(--gold); }

.sidebar-foot { padding: 12px 14px 18px; border-top: 1px solid rgba(250, 248, 243, 0.1); }
.sidebar-foot .nav-link { min-height: 42px; font-size: 13px; color: rgba(250, 248, 243, 0.7); }

.main { min-width: 0; display: flex; flex-direction: column; }

.topbar {
    position: sticky;
    top: 0;
    z-index: 20;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    min-height: 76px;
    padding: 12px 40px;
    background: rgba(250, 248, 243, 0.9);
    border-bottom: 1px solid var(--rule);
    -webkit-backdrop-filter: blur(12px);
    backdrop-filter: blur(12px);
}

.topbar::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -1px;
    width: 96px;
    height: 2px;
    background: var(--gold);
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
    background: var(--emerald);
    border: 0;
    border-radius: 14px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, transform 120ms ease-out;
}

.menu-toggle:hover { background: var(--forest); }
.menu-toggle:active { transform: scale(0.95); }
.menu-toggle span { display: block; width: 18px; height: 2px; background: var(--ivory); border-radius: 2px; }
.menu-toggle span:nth-child(2) { width: 12px; align-self: flex-start; margin-left: 13px; background: var(--gold); }

.topbar-brand {
    display: none;
    align-items: center;
    gap: 10px;
    min-width: 0;
    text-decoration: none;
}

.topbar-brand .brand-mark { width: 34px; height: 34px; font-size: 15px; border-radius: 11px; box-shadow: none; }
.topbar-brand .brand-word { font-size: 19px; color: var(--emerald); }
.topbar-brand .brand-word span { color: var(--gold); }

.crumbs {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0 8px;
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-soft);
}

.crumbs li + li::before { content: "/"; margin-right: 8px; color: var(--gold); }
.crumbs li:last-child { color: var(--emerald); font-weight: 700; }

.topbar-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

.site-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 40px;
    padding: 0 16px;
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    border-radius: 999px;
    transition: background var(--t-fast) ease-out;
}

.site-link svg { width: 15px; height: 15px; color: var(--forest); transition: transform var(--t-ui) var(--ease); }
.site-link:hover { background: rgba(55, 107, 92, 0.1); }
.site-link:hover svg { transform: translate(2px, -2px); }

.user-chip {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 5px 16px 5px 5px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
}

.user-chip-avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    font-size: 13px;
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
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--forest);
}

.logout-form { margin: 0; }

.logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 42px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--ivory);
    background: var(--emerald);
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, transform 120ms ease-out;
}

.logout-btn svg { width: 16px; height: 16px; }
.logout-btn:hover { background: var(--forest); }
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
    .crumbs { margin-left: 2px; }
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
    .side-account { display: flex; }
    .site-link { display: none; }
    .topbar { padding: 12px 24px; min-height: 72px; }
    .content { padding: 24px 24px 56px; }
    .hero { padding: 36px 32px; }
    .form-layout { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 719px) {
    .topbar { padding: 10px 16px; gap: 10px; }
    .topbar-brand { display: inline-flex; }
    .crumbs { display: none; }
    .user-chip-text { display: none; }
    .user-chip { padding: 4px; }
    .logout-btn { width: 42px; padding: 0; justify-content: center; }
    .logout-btn span { display: none; }
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
    .topbar-brand .brand-word { display: none; }
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


.content-inner { max-width: 1240px; }

.dash-hero { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
.dash-hero-text { min-width: 0; }

.btn--light { color: var(--ivory); background: rgba(250, 248, 243, 0.1); border-color: rgba(250, 248, 243, 0.28); }
.btn--light:hover { color: var(--emerald); background: var(--ivory); border-color: var(--ivory); }

.hero-date {
    display: flex;
    flex: none;
    flex-direction: column;
    align-items: center;
    min-width: 150px;
    padding: 22px 26px;
    text-align: center;
    background: rgba(250, 248, 243, 0.08);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 22px;
}

.hero-date-day { font-family: var(--serif); font-size: 54px; font-weight: 600; line-height: 1; color: var(--gold); }
.hero-date-month { margin-top: 8px; font-size: 14px; font-weight: 700; color: var(--ivory); }
.hero-date-week { margin-top: 2px; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--on-dark); }

.stats {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    padding: 22px;
    color: inherit;
    text-decoration: none;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out, border-color var(--t-fast) ease-out;
}

@media (hover: hover) {
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(55, 107, 92, 0.3);
        box-shadow: 0 18px 32px -22px rgba(24, 60, 54, 0.5);
    }
}

.stat-card:active { transform: scale(0.985); }

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    margin-bottom: 18px;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.12);
    border-radius: 14px;
}

.stat-icon svg { width: 22px; height: 22px; }

.stat-label { font-size: 13px; font-weight: 600; color: var(--text-soft); }

.stat-value {
    display: block;
    margin: 4px 0 12px;
    font-family: var(--serif);
    font-size: 40px;
    font-weight: 600;
    line-height: 1.1;
    letter-spacing: -0.01em;
    color: var(--emerald);
}

.stat-foot { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 8px; margin-top: auto; }
.stat-note { font-family: var(--body); font-size: 12.5px; line-height: 1.5; color: var(--text-soft); }

.pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 999px;
}

.pill svg { width: 11px; height: 11px; }
.pill--up { color: var(--forest); background: rgba(55, 107, 92, 0.14); }
.pill--down { color: var(--danger); background: var(--danger-soft); }
.pill--flat { color: var(--text-soft); background: var(--sand); }

.stat-card--lead { background: var(--emerald); border-color: var(--emerald); }
.stat-card--lead::after {
    content: "";
    position: absolute;
    top: -50px;
    right: -50px;
    width: 140px;
    height: 140px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
    pointer-events: none;
}
.stat-card--lead > * { position: relative; z-index: 1; }
.stat-card--lead .stat-icon { color: var(--emerald); background: var(--gold); }
.stat-card--lead .stat-label { color: var(--on-dark); }
.stat-card--lead .stat-value { color: var(--ivory); }
.stat-card--lead .stat-note { color: var(--on-dark); }
.stat-card--lead .pill--up { color: var(--emerald); background: var(--gold); }
.stat-card--lead .pill--down { color: var(--ivory); background: var(--danger); }
.stat-card--lead .pill--flat { color: var(--emerald); background: var(--sand); }

.dash-row {
    display: grid;
    grid-template-columns: minmax(0, 1.75fr) minmax(0, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.dpanel {
    min-width: 0;
    padding: 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.dpanel-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px 16px;
    margin-bottom: 20px;
}

.dpanel-title { margin: 0; font-family: var(--serif); font-size: 21px; font-weight: 600; line-height: 1.25; color: var(--emerald); }
.dpanel-sub { margin: 4px 0 0; font-family: var(--body); font-size: 13.5px; color: var(--text-soft); }

.seg { display: inline-flex; padding: 4px; background: var(--ivory); border: 1px solid var(--rule); border-radius: 999px; }

.seg-btn {
    height: 34px;
    padding: 0 16px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--text-soft);
    background: transparent;
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.seg-btn:hover { color: var(--emerald); }
.seg-btn.is-on { color: var(--ivory); background: var(--emerald); }

.chart-host { position: relative; width: 100%; }
#bar-chart { min-height: 280px; }
.chart-host svg { display: block; max-width: 100%; }

.grid-line { stroke: var(--rule); stroke-dasharray: 3 5; }
.axis-text { font-family: var(--body); font-size: 11.5px; fill: var(--text-soft); }
.bar { fill: var(--forest); transition: fill var(--t-fast) ease-out; }
.bar.is-current { fill: var(--gold); }
.bar.is-hover { fill: var(--emerald); }
.bar-zero { fill: var(--sand); }
.hit { fill: transparent; cursor: pointer; }
.hit:focus { outline: none; }
.hit:focus-visible { stroke: var(--gold); stroke-width: 2; }

.tip {
    position: absolute;
    z-index: 5;
    display: flex;
    flex-direction: column;
    gap: 2px;
    padding: 9px 13px;
    font-family: var(--body);
    font-size: 12.5px;
    color: var(--on-dark);
    white-space: nowrap;
    pointer-events: none;
    background: var(--emerald);
    border-radius: 12px;
    box-shadow: 0 12px 24px -10px rgba(24, 60, 54, 0.6);
    transform: translate(-50%, -100%);
}

.tip strong { font-family: var(--sans); font-size: 12px; font-weight: 700; color: var(--gold); }

.donut { display: flex; flex-direction: column; align-items: center; gap: 22px; }
.donut-wrap { max-width: 230px; margin: 0 auto; }
.donut-svg { width: 100%; height: auto; overflow: visible; }

.arc { cursor: pointer; transition: opacity var(--t-fast) ease-out, stroke-width var(--t-fast) ease-out; }
.arc:focus { outline: none; }
.arc:focus-visible { stroke-width: 32; }
.donut[data-active] .arc { opacity: 0.35; }
.donut[data-active] .arc.is-active { opacity: 1; stroke-width: 32; }

.donut-num { font-family: var(--serif); font-size: 34px; font-weight: 600; fill: var(--emerald); }
.donut-cap { font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; fill: var(--text-soft); }

.legend { width: 100%; margin: 0; padding: 0; list-style: none; }

.legend-item {
    display: grid;
    grid-template-columns: auto minmax(0, 1fr) auto auto;
    align-items: center;
    gap: 10px;
    padding: 10px 8px;
    font-size: 14px;
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 10px;
    transition: background var(--t-fast) ease-out;
}

.legend-item:last-child { border-bottom: 0; }
.legend-item.is-active { background: var(--ivory); }
.legend-dot { width: 10px; height: 10px; border-radius: 50%; }
.legend-name { font-weight: 600; color: var(--emerald); overflow-wrap: anywhere; }
.legend-count { font-weight: 700; color: var(--text); }
.legend-pct { min-width: 38px; text-align: right; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

.text-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.text-link svg { width: 15px; height: 15px; transition: transform var(--t-ui) var(--ease); }
.text-link:hover { color: var(--emerald); }
.text-link:hover svg { transform: translateX(3px); }
.text-link--foot { margin-top: 20px; }

.dtable-wrap { margin: 0 -8px; }
.dtable { width: 100%; border-collapse: collapse; }

.dtable th {
    padding: 10px 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-align: left;
    text-transform: uppercase;
    color: var(--text-soft);
    border-bottom: 1px solid var(--rule);
}

.dtable td {
    padding: 14px 8px;
    font-family: var(--body);
    font-size: 14px;
    vertical-align: middle;
    color: var(--text);
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}

.dtable tbody tr:last-child td { border-bottom: 0; }
.dtable tbody tr { transition: background var(--t-fast) ease-out; }
.dtable tbody tr:hover { background: rgba(231, 224, 210, 0.3); }
.col-end { text-align: right; }

.art-title {
    display: block;
    max-width: 340px;
    font-family: var(--sans);
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.4;
    color: var(--emerald);
    text-decoration: none;
    overflow-wrap: anywhere;
    transition: color var(--t-fast) ease-out;
}

.art-title:hover { color: var(--forest); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.art-by { display: block; margin-top: 2px; font-size: 12.5px; color: var(--text-soft); }

.badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 4px 11px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    color: var(--emerald);
    white-space: nowrap;
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 999px;
}

.badge::before { content: ""; width: 7px; height: 7px; background: var(--c, var(--text-soft)); border-radius: 50%; }

.rank { margin: 0; padding: 0; list-style: none; }
.rank-item { padding: 12px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.rank-item:first-child { padding-top: 0; }
.rank-item:last-child { border-bottom: 0; }
.rank-top { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
.rank-name { font-size: 14.5px; font-weight: 700; color: var(--emerald); text-decoration: none; overflow-wrap: anywhere; }
.rank-name:hover { text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.rank-count { flex: none; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.rank-bar { height: 8px; overflow: hidden; background: var(--sand); border-radius: 999px; }
.rank-bar span { display: block; height: 100%; background: linear-gradient(90deg, var(--forest), var(--gold)); border-radius: 999px; }

.dempty { padding: 36px 20px; text-align: center; background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); border-radius: 18px; }
.dempty strong { display: block; margin-bottom: 6px; font-family: var(--serif); font-size: 20px; font-weight: 600; color: var(--emerald); }
.dempty p { max-width: 360px; margin: 0 auto; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); }
.dempty .btn { margin-top: 18px; height: 42px; }

.shorts-block { margin-top: 8px; }
.shorts-block .dpanel-title { margin-bottom: 16px; }
.shorts { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }

.short {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
    padding: 16px 18px;
    color: inherit;
    text-decoration: none;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 18px;
    transition: transform var(--t-ui) var(--ease), border-color var(--t-fast) ease-out, box-shadow var(--t-ui) ease-out;
}

@media (hover: hover) {
    .short:hover { transform: translateY(-2px); border-color: rgba(55, 107, 92, 0.3); box-shadow: 0 14px 26px -20px rgba(24, 60, 54, 0.45); }
}

.short:active { transform: scale(0.985); }

.short-icon {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    color: var(--emerald);
    background: rgba(185, 154, 100, 0.22);
    border-radius: 14px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.short-icon svg { width: 20px; height: 20px; }
.short:hover .short-icon { color: var(--emerald); background: var(--gold); }
.short-text { display: flex; flex: 1; flex-direction: column; min-width: 0; }
.short-text strong { font-size: 14.5px; font-weight: 700; color: var(--emerald); }
.short-text span { font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.short-arrow { flex: none; color: var(--text-soft); }
.short-arrow svg { display: block; width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease), color var(--t-fast) ease-out; }
.short:hover .short-arrow svg { color: var(--forest); transform: translateX(3px); }

@media (max-width: 1279px) {
    .stats { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    .stat-card { grid-column: span 2; }
    .stat-card--lead { grid-column: span 3; }
    .stat-card--lead + .stat-card { grid-column: span 3; }
}

@media (max-width: 1099px) {
    .dash-row { grid-template-columns: minmax(0, 1fr); }
    .donut { flex-direction: row; align-items: center; justify-content: center; gap: 36px; }
    .donut-wrap { flex: 0 0 220px; margin: 0; }
    .legend { flex: 1; max-width: 360px; }
    .shorts { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 1023px) {
    .hero-date { display: none; }
}

@media (max-width: 719px) {
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .stat-card, .stat-card--lead + .stat-card { grid-column: span 1; padding: 18px; }
    .stat-card--lead { grid-column: span 2; }
    .stat-value { font-size: 34px; }
    .dpanel { padding: 20px 16px; border-radius: 18px; }
    .seg { width: 100%; }
    .seg-btn { flex: 1; }
    .donut { flex-direction: column; gap: 22px; }
    .donut-wrap { flex-basis: auto; width: 100%; max-width: 220px; margin: 0 auto; }
    .legend { max-width: none; }
    .shorts { grid-template-columns: minmax(0, 1fr); }

    .dtable-wrap { margin: 0; }
    .dtable thead { display: none; }
    .dtable, .dtable tbody, .dtable tr, .dtable td { display: block; width: 100%; }
    .dtable tbody tr { padding: 14px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
    .dtable tbody tr:last-child { border-bottom: 0; }
    .dtable td { padding: 0; border: 0; }
    .dtable td + td { margin-top: 8px; }
    .dtable td[data-label]:not([data-label="Artikel"]) { display: flex; align-items: center; justify-content: space-between; gap: 12px; }

    .dtable td[data-label]:not([data-label="Artikel"])::before {
        content: attr(data-label);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-soft);
    }

    .art-title { max-width: none; }
    .col-end { text-align: left; }
    .col-end .act { width: 100%; justify-content: center; }
}

    </style>
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <div class="admin">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi admin">
            <div class="sidebar-top">
                <a class="brand" href="/admin/dashboard" aria-label="RuangKabar - Panel Admin">
                    <span class="brand-mark" aria-hidden="true">RK</span>
                    <span class="brand-text">
                        <span class="brand-word">Ruang<span>Kabar</span></span>
                        <span class="brand-sub">Panel Admin</span>
                    </span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">&times;</button>
            </div>

            <nav class="side-nav" aria-label="Menu admin">
                <p class="nav-label">Utama</p>
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'is-active' : '' }}" href="/admin/dashboard" {!! request()->is('admin/dashboard') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="6" height="6" rx="1.5"/><rect x="11" y="3" width="6" height="6" rx="1.5"/><rect x="3" y="11" width="6" height="6" rx="1.5"/><rect x="11" y="11" width="6" height="6" rx="1.5"/></svg></span>Dashboard</a>
                    </li>
                </ul>

                <p class="nav-label">Konten</p>
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('articles*') ? 'is-active' : '' }}" href="{{ route('articles.index') }}" {!! request()->is('articles*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>Artikel</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('categories*') ? 'is-active' : '' }}" href="{{ route('categories.index') }}" {!! request()->is('categories*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 6V5a1 1 0 011-1h4l2 2h7a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1z"/></svg></span>Kategori</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('tags*') ? 'is-active' : '' }}" href="{{ route('tags.index') }}" {!! request()->is('tags*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>Tag</a>
                    </li>
                </ul>

                <p class="nav-label">Pengelolaan</p>
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('comments*') ? 'is-active' : '' }}" href="{{ route('comments.index') }}" {!! request()->is('comments*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>Komentar</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('reports/*') ? 'is-active' : '' }}" href="{{ route('reports.articles') }}" {!! request()->is('reports/*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 16V9M10 16V4M16 16v-5"/></svg></span>Laporan</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('admin/users*') ? 'is-active' : '' }}" href="{{ route('admin.users.index') }}" {!! request()->is('admin/users*') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="7" r="3"/><path d="M2.5 16c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14 4.5a3 3 0 010 5.5M17.5 16c0-2.2-1.2-3.8-3-4.6"/></svg></span>Pengguna</a>
                    </li>
                </ul>
            </nav>

            <div class="side-account">
                <span class="user-chip-avatar" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span>
                <span class="user-chip-text">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <span class="user-role">{{ auth()->user()->role }}</span>
                </span>
            </div>

            <div class="sidebar-foot">
                <a class="nav-link" href="/"><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9.5L10 3l7 6.5V17H3z"/></svg></span>Lihat beranda</a>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        <div class="main">

            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                        <span></span><span></span><span></span>
                    </button>

                    <a class="topbar-brand" href="/admin/dashboard" aria-label="RuangKabar - Dashboard admin">
                        <span class="brand-mark" aria-hidden="true">RK</span>
                        <span class="brand-word">Ruang<span>Kabar</span></span>
                    </a>

                    <ol class="crumbs">
                        <li>Admin</li>
                        <li>Dashboard</li>
                    </ol>
                </div>

                <div class="topbar-right">
                    <a class="site-link" href="/" target="_blank" rel="noopener">Lihat situs <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 4H4v12h12v-3M10 10l7-7M12 3h5v5"/></svg></a>

                    <div class="user-chip">
                        <span class="user-chip-avatar" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="user-chip-text">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">{{ auth()->user()->role }}</span>
                        </span>
                    </div>

                    <form class="logout-form" action="/logout" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit" aria-label="Logout"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 3H4v14h4M12 6l4 4-4 4M16 10H8"/></svg><span>Logout</span></button>
                    </form>
                </div>
            </header>

            <main class="content" id="konten">
                <div class="content-inner">

                                @php
                        $now = \Illuminate\Support\Carbon::now();
                        $startThis = $now->copy()->startOfMonth();
                        $startLast = $startThis->copy()->subMonth();

                        $totalArticles = \App\Models\Article::count();
                        $totalCategories = \App\Models\Category::count();
                        $totalTags = \App\Models\Tag::count();
                        $totalUsers = \App\Models\User::count();
                        $totalComments = \App\Models\Comment::count();

                        $usedCategories = \App\Models\Category::has('articles')->count();
                        $usedTags = \App\Models\Tag::has('articles')->count();
                        $totalWriters = \App\Models\User::where('role', 'penulis')->count();
                        $totalReaders = \App\Models\User::where('role', 'pengguna')->count();

                        $articlesThis = \App\Models\Article::where('created_at', '>=', $startThis)->count();
                        $articlesLast = \App\Models\Article::where('created_at', '>=', $startLast)->where('created_at', '<', $startThis)->count();
                        $usersThis = \App\Models\User::where('created_at', '>=', $startThis)->count();
                        $usersLast = \App\Models\User::where('created_at', '>=', $startLast)->where('created_at', '<', $startThis)->count();

                        $delta = function ($cur, $prev) {
                            if ($prev <= 0) {
                                return null;
                            }

                            $pct = (int) round((($cur - $prev) / $prev) * 100);

                            return ['dir' => $pct > 0 ? 'up' : ($pct < 0 ? 'down' : 'flat'), 'pct' => abs($pct)];
                        };

                        $articleDelta = $delta($articlesThis, $articlesLast);
                        $userDelta = $delta($usersThis, $usersLast);

                        $months = collect(range(11, 0))->map(fn ($i) => $startThis->copy()->subMonths($i));
                        $perMonth = \App\Models\Article::where('status', 'published')
                            ->where('created_at', '>=', $months->first())
                            ->pluck('created_at')
                            ->countBy(fn ($date) => \Illuminate\Support\Carbon::parse($date)->format('Y-m'));

                        $monthSeries = $months->map(fn ($m) => [
                            'label' => $m->copy()->locale('id')->translatedFormat('M'),
                            'full' => $m->copy()->locale('id')->translatedFormat('F Y'),
                            'value' => (int) ($perMonth[$m->format('Y-m')] ?? 0),
                        ])->values()->all();

                        $hasMonthData = collect($monthSeries)->sum('value') > 0;

                        $statusMeta = [
                            'published' => ['Published', '#376B5C'],
                            'draft' => ['Draft', '#B99A64'],
                            'pending' => ['Pending', '#183C36'],
                        ];
                        $fallbackColors = ['#8FB3A5', '#D3C09A', '#68736E'];
                        $fallbackIndex = 0;

                        $statusData = [];
                        $statusRows = \App\Models\Article::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

                        foreach ($statusRows as $status => $count) {
                            $key = strtolower((string) $status);

                            if (isset($statusMeta[$key])) {
                                [$label, $color] = $statusMeta[$key];
                            } else {
                                $label = $key !== '' ? ucfirst($key) : 'Tanpa status';
                                $color = $fallbackColors[$fallbackIndex++ % count($fallbackColors)];
                            }

                            $statusData[] = ['label' => $label, 'color' => $color, 'value' => (int) $count];
                        }

                        usort($statusData, fn ($a, $b) => $b['value'] <=> $a['value']);

                        $statusTotal = array_sum(array_column($statusData, 'value'));
                        $circ = 2 * M_PI * 70;
                        $gap = count($statusData) > 1 ? 3 : 0;
                        $cum = 0;

                        $statusInfo = function ($status) use ($statusMeta) {
                            $key = strtolower((string) $status);

                            return $statusMeta[$key] ?? [$key !== '' ? ucfirst($key) : 'Tanpa status', '#68736E'];
                        };

                        $recentArticles = \App\Models\Article::with(['category', 'user'])->latest()->take(6)->get();

                        $topCategories = \App\Models\Category::withCount('articles')
                            ->orderByDesc('articles_count')
                            ->orderBy('name')
                            ->take(5)
                            ->get();
                        $topMax = max(1, (int) ($topCategories->first()->articles_count ?? 0));

                        $chart = ['months' => $monthSeries];
                    @endphp

                    <section class="hero" aria-labelledby="page-title">
                        <div class="hero-inner dash-hero">
                            <div class="dash-hero-text">
                                <span class="hero-label">DASHBOARD ADMIN</span>
                                <h1 class="hero-title" id="page-title">Selamat datang, {{ auth()->user()->name }}!</h1>
                                <p class="hero-lead">Anda login sebagai {{ auth()->user()->role }}. Pantau publikasi, status artikel, dan aktivitas RuangKabar dalam satu tempat.</p>
                                <div class="hero-actions">
                                    <a class="btn btn--gold" href="{{ route('articles.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tulis Artikel Baru</a>
                                    <a class="btn btn--light" href="{{ route('reports.articles') }}">Lihat Laporan</a>
                                </div>
                            </div>

                            <div class="hero-date" aria-label="Tanggal hari ini">
                                <span class="hero-date-day">{{ $now->copy()->locale('id')->translatedFormat('d') }}</span>
                                <span class="hero-date-month">{{ $now->copy()->locale('id')->translatedFormat('F Y') }}</span>
                                <span class="hero-date-week">{{ $now->copy()->locale('id')->translatedFormat('l') }}</span>
                            </div>
                        </div>
                    </section>

                    <section class="stats" aria-label="Ringkasan statistik">
                        <a class="stat-card stat-card--lead" href="{{ route('articles.index') }}">
                            <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>
                            <span class="stat-label">Total Artikel</span>
                            <span class="stat-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
                            <span class="stat-foot">
                                @if ($articleDelta)
                                    <span class="pill pill--{{ $articleDelta['dir'] }}">@if ($articleDelta['dir'] === 'up')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V2M2.5 5.5L6 2l3.5 3.5"/></svg> @elseif ($articleDelta['dir'] === 'down')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2v8M2.5 6.5L6 10l3.5-3.5"/></svg> @endif{{ $articleDelta['pct'] }}%</span>
                                @endif
                                <span class="stat-note">{{ number_format($articlesThis, 0, ',', '.') }} baru bulan ini
                                @if ($articleDelta), {{ number_format($articlesLast, 0, ',', '.') }} bulan lalu @endif</span>
                            </span>
                        </a>

                        <a class="stat-card" href="{{ route('categories.index') }}">
                            <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 6V5a1 1 0 011-1h4l2 2h7a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1z"/></svg></span>
                            <span class="stat-label">Total Kategori</span>
                            <span class="stat-value">{{ number_format($totalCategories, 0, ',', '.') }}</span>
                            <span class="stat-foot"><span class="stat-note">{{ number_format($usedCategories, 0, ',', '.') }} sudah dipakai artikel</span></span>
                        </a>

                        <a class="stat-card" href="{{ route('tags.index') }}">
                            <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>
                            <span class="stat-label">Total Tag</span>
                            <span class="stat-value">{{ number_format($totalTags, 0, ',', '.') }}</span>
                            <span class="stat-foot"><span class="stat-note">{{ number_format($usedTags, 0, ',', '.') }} sudah dipakai artikel</span></span>
                        </a>

                        <a class="stat-card" href="{{ route('admin.users.index') }}">
                            <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="7" r="3"/><path d="M2.5 16c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14 4.5a3 3 0 010 5.5M17.5 16c0-2.2-1.2-3.8-3-4.6"/></svg></span>
                            <span class="stat-label">Total Pengguna</span>
                            <span class="stat-value">{{ number_format($totalUsers, 0, ',', '.') }}</span>
                            <span class="stat-foot">
                                @if ($userDelta)
                                    <span class="pill pill--{{ $userDelta['dir'] }}">@if ($userDelta['dir'] === 'up')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V2M2.5 5.5L6 2l3.5 3.5"/></svg> @elseif ($userDelta['dir'] === 'down')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2v8M2.5 6.5L6 10l3.5-3.5"/></svg> @endif{{ $userDelta['pct'] }}%</span>
                                @endif
                                <span class="stat-note">{{ number_format($totalWriters, 0, ',', '.') }} penulis, {{ number_format($totalReaders, 0, ',', '.') }} pembaca</span>
                            </span>
                        </a>

                        <a class="stat-card" href="{{ route('comments.index') }}">
                            <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>
                            <span class="stat-label">Total Komentar</span>
                            <span class="stat-value">{{ number_format($totalComments, 0, ',', '.') }}</span>
                            <span class="stat-foot"><span class="stat-note">Perlu ditinjau admin</span></span>
                        </a>
                    </section>

                    <section class="dash-row" aria-label="Grafik">
                        <article class="dpanel" aria-labelledby="bar-title">
                            <header class="dpanel-head">
                                <div>
                                    <h2 class="dpanel-title" id="bar-title">Publikasi Artikel</h2>
                                    <p class="dpanel-sub" id="bar-summary">Artikel dipublikasikan per bulan</p>
                                </div>
                                <div class="seg" role="group" aria-label="Rentang waktu">
                                    <button class="seg-btn is-on" type="button" data-range="6" aria-pressed="true">6 bulan</button>
                                    <button class="seg-btn" type="button" data-range="12" aria-pressed="false">12 bulan</button>
                                </div>
                            </header>

                            @if ($hasMonthData)
                                <div class="chart-host" id="bar-chart"></div>
                            @else
                                <div class="dempty">
                                    <strong>Belum ada artikel terbit</strong>
                                    <p>Grafik muncul setelah ada artikel berstatus published dalam 12 bulan terakhir.</p>
                                </div>
                            @endif
                        </article>

                        <article class="dpanel" aria-labelledby="donut-title">
                            <header class="dpanel-head">
                                <div>
                                    <h2 class="dpanel-title" id="donut-title">Status Artikel</h2>
                                    <p class="dpanel-sub">Distribusi seluruh artikel</p>
                                </div>
                            </header>

                            @if ($statusTotal > 0)
                                <div class="donut" id="donut">
                                    <div class="donut-wrap chart-host" id="donut-host">
                                        <svg class="donut-svg" viewBox="0 0 200 200" role="img" aria-label="Grafik donat status artikel">
                                            <circle cx="100" cy="100" r="70" fill="none" stroke="#E7E0D2" stroke-width="26" opacity="0.55"/>
                                            <g transform="rotate(-90 100 100)">
                                                @foreach ($statusData as $i => $seg)
                                                    @php
                                                        $len = ($seg['value'] / $statusTotal) * $circ;
                                                        $dash = max($len - $gap, 0.01);
                                                    @endphp
                                                    <circle class="arc" tabindex="0" data-index="{{ $i }}" data-label="{{ $seg['label'] }}" data-value="{{ $seg['value'] }}" data-pct="{{ round(($seg['value'] / $statusTotal) * 100) }}" cx="100" cy="100" r="70" fill="none" stroke="{{ $seg['color'] }}" stroke-width="26" stroke-dasharray="{{ round($dash, 3) }} {{ round($circ, 3) }}" stroke-dashoffset="{{ round(-$cum, 3) }}" aria-label="{{ $seg['label'] }}: {{ $seg['value'] }} artikel"/>
                                                    @php $cum += $len; @endphp
                                                @endforeach
                                            </g>
                                            <text class="donut-num" id="donut-value" x="100" y="102" text-anchor="middle">{{ $statusTotal }}</text>
                                            <text class="donut-cap" id="donut-label" x="100" y="122" text-anchor="middle">Artikel</text>
                                        </svg>
                                    </div>

                                    <ul class="legend">
                                        @foreach ($statusData as $i => $seg)
                                            <li class="legend-item" data-index="{{ $i }}">
                                                <span class="legend-dot" style="background: {{ $seg['color'] }}"></span>
                                                <span class="legend-name">{{ $seg['label'] }}</span>
                                                <span class="legend-count">{{ number_format($seg['value'], 0, ',', '.') }}</span>
                                                <span class="legend-pct">{{ round(($seg['value'] / $statusTotal) * 100) }}%</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="dempty">
                                    <strong>Belum ada artikel</strong>
                                    <p>Distribusi status akan tampil setelah artikel pertama dibuat.</p>
                                </div>
                            @endif
                        </article>
                    </section>

                    <section class="dash-row" aria-label="Artikel dan kategori">
                        <article class="dpanel" aria-labelledby="recent-title">
                            <header class="dpanel-head">
                                <div>
                                    <h2 class="dpanel-title" id="recent-title">Artikel Terbaru</h2>
                                    <p class="dpanel-sub">Enam artikel yang terakhir dibuat</p>
                                </div>
                                <a class="text-link" href="{{ route('articles.index') }}">Semua artikel <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
                            </header>

                            @if ($recentArticles->isNotEmpty())
                                <div class="dtable-wrap">
                                    <table class="dtable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Artikel</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col" class="col-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentArticles as $article)
                                                @php [$sLabel, $sColor] = $statusInfo($article->status); @endphp
                                                <tr>
                                                    <td data-label="Artikel">
                                                        <a class="art-title" href="{{ route('articles.show', $article) }}">{{ \Illuminate\Support\Str::limit($article->title, 70) }}</a>
                                                        <span class="art-by">{{ $article->user->name ?? 'Redaksi' }}</span>
                                                    </td>
                                                    <td data-label="Kategori">{{ $article->category->name ?? '-' }}</td>
                                                    <td data-label="Status"><span class="badge" style="--c: {{ $sColor }}">{{ $sLabel }}</span></td>
                                                    <td data-label="Tanggal">{{ $article->created_at ? $article->created_at->locale('id')->translatedFormat('d M Y') : '-' }}</td>
                                                    <td class="col-end"><a class="act act--edit" href="{{ route('articles.show', $article) }}" aria-label="Lihat artikel {{ $article->title }}">Lihat</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="dempty">
                                    <strong>Belum ada artikel</strong>
                                    <p>Artikel terbaru akan tampil di sini setelah dibuat.</p>
                                    <a class="btn" href="{{ route('articles.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tulis Artikel Baru</a>
                                </div>
                            @endif
                        </article>

                        <article class="dpanel" aria-labelledby="topcat-title">
                            <header class="dpanel-head">
                                <div>
                                    <h2 class="dpanel-title" id="topcat-title">Kategori Terpopuler</h2>
                                    <p class="dpanel-sub">Berdasarkan jumlah artikel</p>
                                </div>
                            </header>

                            @if ($topCategories->isNotEmpty() && $totalArticles > 0)
                                <ul class="rank">
                                    @foreach ($topCategories as $cat)
                                        <li class="rank-item">
                                            <div class="rank-top">
                                                <a class="rank-name" href="{{ route('kategori.show', $cat) }}" target="_blank" rel="noopener">{{ $cat->name }}</a>
                                                <span class="rank-count">{{ number_format($cat->articles_count, 0, ',', '.') }} artikel</span>
                                            </div>
                                            <div class="rank-bar"><span style="width: {{ round(($cat->articles_count / $topMax) * 100) }}%"></span></div>
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="text-link text-link--foot" href="{{ route('categories.index') }}">Kelola kategori <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
                            @else
                                <div class="dempty">
                                    <strong>Belum ada data</strong>
                                    <p>Peringkat muncul setelah kategori dipakai oleh artikel.</p>
                                    <a class="btn" href="{{ route('categories.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tambah Kategori</a>
                                </div>
                            @endif
                        </article>
                    </section>

                    <section class="shorts-block" aria-labelledby="short-title">
                        <h2 class="dpanel-title" id="short-title">Pintasan</h2>
                        <div class="shorts">
                            <a class="short" href="{{ route('articles.index') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>
                                <span class="short-text"><strong>Kelola Artikel</strong><span>Lihat dan kelola semua artikel</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                            <a class="short" href="{{ route('categories.index') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 6V5a1 1 0 011-1h4l2 2h7a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1z"/></svg></span>
                                <span class="short-text"><strong>Kelola Kategori</strong><span>Atur kategori berita</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                            <a class="short" href="{{ route('tags.index') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>
                                <span class="short-text"><strong>Kelola Tag</strong><span>Atur tag artikel</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                            <a class="short" href="{{ route('comments.index') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>
                                <span class="short-text"><strong>Moderasi Komentar</strong><span>Tinjau komentar pembaca</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                            <a class="short" href="{{ route('reports.articles') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 16V9M10 16V4M16 16v-5"/></svg></span>
                                <span class="short-text"><strong>Laporan Artikel</strong><span>Lihat laporan seluruh artikel</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                            <a class="short" href="{{ route('admin.users.index') }}">
                                <span class="short-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="7" r="3"/><path d="M2.5 16c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14 4.5a3 3 0 010 5.5M17.5 16c0-2.2-1.2-3.8-3-4.6"/></svg></span>
                                <span class="short-text"><strong>Kelola Pengguna</strong><span>Atur akun penulis dan pembaca</span></span>
                                <span class="short-arrow" aria-hidden="true"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </a>
                        </div>
                    </section>

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

            var dash = {{ \Illuminate\Support\Js::from($chart) }};
            var SVGNS = 'http://www.w3.org/2000/svg';

            function svgNode(name, attrs, parent) {
                var n = document.createElementNS(SVGNS, name);
                for (var k in attrs) { n.setAttribute(k, attrs[k]); }
                if (parent) { parent.appendChild(n); }
                return n;
            }

            function makeTip(host) {
                var tip = document.createElement('div');
                tip.className = 'tip';
                tip.hidden = true;
                host.appendChild(tip);
                return tip;
            }

            function showTip(tip, host, x, y, title, text) {
                tip.textContent = '';
                var a = document.createElement('strong');
                a.textContent = title;
                var b = document.createElement('span');
                b.textContent = text;
                tip.appendChild(a);
                tip.appendChild(b);
                tip.hidden = false;
                var half = tip.offsetWidth / 2;
                var left = Math.min(Math.max(x, half + 4), host.clientWidth - half - 4);
                tip.style.left = left + 'px';
                tip.style.top = Math.max(y - 10, tip.offsetHeight + 4) + 'px';
            }

            var barHost = document.getElementById('bar-chart');
            if (barHost && dash.months) {
                var barTip = makeTip(barHost);
                var summary = document.getElementById('bar-summary');
                var rangeBtns = [].slice.call(document.querySelectorAll('[data-range]'));
                var range = 6;

                var drawBars = function () {
                    var items = dash.months.slice(-range);
                    var old = barHost.querySelector('svg');
                    if (old) { barHost.removeChild(old); }
                    barTip.hidden = true;

                    var w = Math.max(barHost.clientWidth, 260);
                    var h = 280;
                    var m = { t: 14, r: 8, b: 34, l: 34 };
                    var iw = w - m.l - m.r;
                    var ih = h - m.t - m.b;
                    var max = 0;
                    var total = 0;

                    items.forEach(function (it) {
                        max = Math.max(max, it.value);
                        total += it.value;
                    });

                    var step = Math.max(1, Math.ceil(max / 4));
                    var top = step * 4;
                    var svg = svgNode('svg', { width: w, height: h, viewBox: '0 0 ' + w + ' ' + h, role: 'img', 'aria-label': 'Grafik batang jumlah artikel dipublikasikan per bulan, ' + range + ' bulan terakhir' }, null);

                    for (var t = 0; t <= 4; t++) {
                        var gy = m.t + ih - (t * step / top) * ih;
                        svgNode('line', { x1: m.l, x2: w - m.r, y1: gy, y2: gy, class: 'grid-line' }, svg);
                        var yl = svgNode('text', { x: m.l - 10, y: gy + 4, 'text-anchor': 'end', class: 'axis-text' }, svg);
                        yl.textContent = t * step;
                    }

                    var band = iw / items.length;
                    var bw = Math.min(46, band * 0.58);
                    var skip = band < 34 ? 2 : 1;

                    items.forEach(function (it, i) {
                        var x = m.l + band * i + (band - bw) / 2;
                        var bh = (it.value / top) * ih;
                        var y = m.t + ih - bh;
                        var isCurrent = i === items.length - 1;
                        var bar;

                        if (it.value > 0) {
                            var r = Math.min(9, bw / 2, bh);
                            bar = svgNode('path', {
                                d: 'M' + x + ',' + (y + bh) + 'L' + x + ',' + (y + r) + 'Q' + x + ',' + y + ' ' + (x + r) + ',' + y + 'L' + (x + bw - r) + ',' + y + 'Q' + (x + bw) + ',' + y + ' ' + (x + bw) + ',' + (y + r) + 'L' + (x + bw) + ',' + (y + bh) + 'Z',
                                class: 'bar' + (isCurrent ? ' is-current' : '')
                            }, svg);
                        } else {
                            bar = svgNode('rect', { x: x, y: m.t + ih - 4, width: bw, height: 4, rx: 2, class: 'bar-zero' }, svg);
                        }

                        if (i % skip === (items.length - 1) % skip) {
                            var xl = svgNode('text', { x: x + bw / 2, y: h - 10, 'text-anchor': 'middle', class: 'axis-text' }, svg);
                            xl.textContent = it.label;
                        }

                        var hit = svgNode('rect', {
                            x: m.l + band * i, y: m.t, width: band, height: ih + 8, class: 'hit', tabindex: 0,
                            'aria-label': it.full + ': ' + it.value + ' artikel'
                        }, svg);

                        var on = function () {
                            bar.classList.add('is-hover');
                            showTip(barTip, barHost, x + bw / 2, it.value > 0 ? y : m.t + ih - 4, it.full, it.value + ' artikel');
                        };

                        var off = function () {
                            bar.classList.remove('is-hover');
                            barTip.hidden = true;
                        };

                        hit.addEventListener('mouseenter', on);
                        hit.addEventListener('mouseleave', off);
                        hit.addEventListener('focus', on);
                        hit.addEventListener('blur', off);
                    });

                    barHost.insertBefore(svg, barTip);

                    if (summary) {
                        summary.textContent = total + ' artikel dipublikasikan dalam ' + range + ' bulan terakhir';
                    }
                };

                rangeBtns.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        range = parseInt(btn.getAttribute('data-range'), 10);
                        rangeBtns.forEach(function (b) {
                            var active = b === btn;
                            b.classList.toggle('is-on', active);
                            b.setAttribute('aria-pressed', active ? 'true' : 'false');
                        });
                        drawBars();
                    });
                });

                drawBars();

                if ('ResizeObserver' in window) {
                    var lastW = barHost.clientWidth;
                    new ResizeObserver(function () {
                        if (barHost.clientWidth !== lastW) {
                            lastW = barHost.clientWidth;
                            drawBars();
                        }
                    }).observe(barHost);
                } else {
                    window.addEventListener('resize', drawBars);
                }
            }

            var donut = document.getElementById('donut');
            if (donut) {
                var donutHost = document.getElementById('donut-host');
                var donutTip = makeTip(donutHost);
                var arcs = [].slice.call(donut.querySelectorAll('.arc'));
                var rows = [].slice.call(donut.querySelectorAll('.legend-item'));
                var numEl = document.getElementById('donut-value');
                var capEl = document.getElementById('donut-label');
                var defNum = numEl.textContent;
                var defCap = capEl.textContent;

                var activate = function (i) {
                    if (i === null) {
                        donut.removeAttribute('data-active');
                        numEl.textContent = defNum;
                        capEl.textContent = defCap;
                    } else {
                        donut.setAttribute('data-active', i);
                        numEl.textContent = arcs[i].getAttribute('data-value');
                        capEl.textContent = arcs[i].getAttribute('data-label');
                    }

                    arcs.forEach(function (a, k) { a.classList.toggle('is-active', k === i); });
                    rows.forEach(function (r, k) { r.classList.toggle('is-active', k === i); });
                };

                arcs.forEach(function (arc, i) {
                    var on = function (event) {
                        activate(i);
                        var box = donutHost.getBoundingClientRect();
                        var x = event.clientX ? event.clientX - box.left : box.width / 2;
                        var y = event.clientY ? event.clientY - box.top : 16;
                        showTip(donutTip, donutHost, x, y, arc.getAttribute('data-label'), arc.getAttribute('data-value') + ' artikel (' + arc.getAttribute('data-pct') + '%)');
                    };

                    var off = function () {
                        activate(null);
                        donutTip.hidden = true;
                    };

                    arc.addEventListener('mousemove', on);
                    arc.addEventListener('mouseenter', on);
                    arc.addEventListener('mouseleave', off);
                    arc.addEventListener('focus', on);
                    arc.addEventListener('blur', off);
                });

                rows.forEach(function (row, i) {
                    row.addEventListener('mouseenter', function () { activate(i); });
                    row.addEventListener('mouseleave', function () { activate(null); });
                });
            }

        })();
    </script>

</body>
</html>