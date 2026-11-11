<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Artikel - RuangKabar</title>

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


.content-inner { max-width: 1180px; }

.hero { margin-bottom: 24px; }

.edit-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 10px; margin-top: 22px; }

.meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    max-width: 100%;
    padding: 6px 14px;
    font-family: var(--body);
    font-size: 13px;
    color: var(--on-dark);
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 999px;
    overflow-wrap: anywhere;
}

.meta-chip strong { font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); }

.req { color: var(--danger); }
.form-note { margin: 0 0 20px; font-family: var(--body); font-size: 13.5px; color: var(--text-soft); }

.editor {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 24px;
    align-items: start;
}

.editor-main, .editor-side { display: flex; flex-direction: column; gap: 20px; min-width: 0; }

.ecard {
    min-width: 0;
    padding: 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.ecard-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 0 18px;
    padding: 0;
    font-family: var(--serif);
    font-size: 19px;
    font-weight: 600;
    color: var(--emerald);
}

.ecard-title .ti {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    color: var(--emerald);
    background: rgba(185, 154, 100, 0.22);
    border-radius: 11px;
}

.ecard-title .ti svg { width: 18px; height: 18px; }

.ecard .field { margin: 0 0 20px; padding: 0; border: 0; min-width: 0; }
.ecard .field:last-child { margin-bottom: 0; }

.field label, .field legend { display: block; margin: 0 0 10px; padding: 0; font-size: 14px; font-weight: 700; color: var(--emerald); }

.field input[type="text"].title-input {
    height: 64px;
    font-family: var(--serif);
    font-size: 24px;
    font-weight: 600;
    line-height: 1.2;
}

.field textarea,
.field select {
    display: block;
    width: 100%;
    font-family: var(--body);
    font-size: 16px;
    color: var(--emerald);
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 14px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.field textarea { min-height: 420px; padding: 18px; line-height: 1.8; resize: vertical; }

.field select {
    height: 52px;
    padding: 0 44px 0 16px;
    cursor: pointer;
    -webkit-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 18px center;
}

.field textarea:hover, .field select:hover { border-color: rgba(24, 60, 54, 0.3); }

.field textarea:focus, .field select:focus {
    outline: none;
    background-color: var(--white);
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4);
}

.field input.is-invalid, .field textarea.is-invalid, .field select.is-invalid { border-color: var(--danger); background-color: #FFFAF8; }

.count { display: flex; justify-content: space-between; gap: 12px; margin: 10px 0 0; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

.status-opts { display: grid; gap: 10px; }

.status-opt {
    position: relative;
    display: flex;
    align-items: center;
    gap: 14px;
    margin: 0;
    padding: 14px 16px;
    font-weight: 400;
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 16px;
    cursor: pointer;
    transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
}

.status-opt:hover { border-color: rgba(24, 60, 54, 0.35); }

.status-opt input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    opacity: 0;
    cursor: pointer;
}

.so-dot {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    background: var(--white);
    border: 2px solid var(--rule);
    border-radius: 50%;
    transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.so-dot::after { content: ""; width: 8px; height: 8px; background: var(--white); border-radius: 50%; transform: scale(0); transition: transform var(--t-fast) var(--ease); }

.so-text { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
.so-text strong { font-size: 14.5px; font-weight: 700; color: var(--emerald); }
.so-text small { font-family: var(--body); font-size: 12.5px; line-height: 1.5; color: var(--text-soft); }

.status-opt:has(input:checked) { background: var(--white); border-color: var(--forest); box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.14); }
.status-opt:has(input:checked) .so-dot { background: var(--forest); border-color: var(--forest); }
.status-opt:has(input:checked) .so-dot::after { transform: scale(1); }
.status-opt:has(input:focus-visible) { outline: 2px solid var(--gold); outline-offset: 2px; }

.tag-list { display: flex; flex-wrap: wrap; gap: 8px; }

.tag-option {
    position: relative;
    display: inline-flex;
    align-items: center;
    min-height: 40px;
    margin: 0;
    padding: 0 16px;
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--white);
    border: 1px solid var(--sand);
    border-radius: 999px;
    cursor: pointer;
    overflow-wrap: anywhere;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.tag-option input { position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; padding: 0; opacity: 0; cursor: pointer; }
.tag-option:hover { border-color: var(--forest); }
.tag-option::before { content: "#"; margin-right: 4px; color: var(--gold); font-family: var(--serif); font-size: 15px; }
.tag-option:has(input:checked) { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }
.tag-option:has(input:focus-visible) { outline: 2px solid var(--gold); outline-offset: 2px; }

.field label.status-opt { display: flex; align-items: center; gap: 14px; margin: 0; padding: 14px 16px; font-size: 14px; font-weight: 400; }
.field label.tag-option { display: inline-flex; align-items: center; min-height: 40px; margin: 0; padding: 0 16px; font-size: 13px; font-weight: 700; }
.field label.drop { display: flex; flex-direction: column; align-items: center; gap: 6px; margin: 0; padding: 26px 16px; font-size: 14px; font-weight: 400; }

.hint { margin: 10px 0 0; font-family: var(--body); font-size: 13px; line-height: 1.6; color: var(--text-soft); }
.field-error { margin: 10px 0 0; font-family: var(--body); font-size: 13.5px; font-weight: 500; color: var(--danger); }

.drop {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 26px 16px;
    text-align: center;
    font-weight: 400;
    background: var(--ivory);
    border: 1.5px dashed rgba(24, 60, 54, 0.3);
    border-radius: 16px;
    cursor: pointer;
    transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.drop:hover, .drop.is-over { background: var(--white); border-color: var(--forest); }
.drop:focus-within { border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }

.drop input { position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; padding: 0; opacity: 0; cursor: pointer; }

.drop-icon { display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; color: var(--forest); background: rgba(55, 107, 92, 0.12); border-radius: 14px; }
.drop-icon svg { width: 22px; height: 22px; }
.drop strong { font-size: 14px; font-weight: 700; color: var(--emerald); }
.drop span { font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }

.img-block { margin: 0 0 14px; }
.img-label { display: block; margin: 0 0 8px; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-soft); }

.img-frame { position: relative; overflow: hidden; background: var(--sand); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 16px; }
.img-frame img { display: block; width: 100%; aspect-ratio: 16 / 10; object-fit: cover; }

.img-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 10px; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.img-row span { min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

.img-clear {
    flex: none;
    padding: 6px 12px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--danger);
    background: none;
    border: 1px solid var(--rule);
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out;
}

.img-clear:hover { color: var(--white); background: var(--danger); border-color: var(--danger); }

.size-warn { margin: 10px 0 0; font-family: var(--body); font-size: 13px; font-weight: 500; color: var(--danger); }

.actions-card {
    grid-column: 1 / -1;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px 12px;
    padding: 20px 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.actions-card .btn { height: 50px; padding: 0 28px; }
.actions-card .btn svg { width: 18px; height: 18px; }
.actions-note { margin: 0 0 0 auto; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

@media (max-width: 1099px) {
    .editor { grid-template-columns: minmax(0, 1fr); }
    .field textarea { min-height: 340px; }
}

@media (max-width: 719px) {
    .ecard { padding: 20px 16px; border-radius: 18px; }
    .field input[type="text"].title-input { height: 58px; font-size: 21px; }
    .field textarea { min-height: 300px; padding: 14px; }
    .actions-card { flex-direction: column; align-items: stretch; padding: 16px; border-radius: 18px; }
    .actions-card .btn { width: 100%; }
    .actions-note { margin: 0; text-align: center; }
}

    </style>
</head>
<body>

    @php
        $isAdmin = auth()->user()->role === 'admin';
        $home = $isAdmin ? '/admin/dashboard' : '/penulis/dashboard';
        $panel = $isAdmin ? 'Panel Admin' : 'Panel Penulis';
    @endphp

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <div class="admin">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi">
            <div class="sidebar-top">
                <a class="brand" href="{{ $home }}" aria-label="RuangKabar - {{ $panel }}">
                    <span class="brand-mark" aria-hidden="true">RK</span>
                    <span class="brand-text">
                        <span class="brand-word">Ruang<span>Kabar</span></span>
                        <span class="brand-sub">{{ $panel }}</span>
                    </span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">&times;</button>
            </div>

            <nav class="side-nav" aria-label="Menu">
                @if ($isAdmin)
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
                @else
                    <p class="nav-label">Utama</p>
                    <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('penulis/dashboard') ? 'is-active' : '' }}" href="/penulis/dashboard" {!! request()->is('penulis/dashboard') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="6" height="6" rx="1.5"/><rect x="11" y="3" width="6" height="6" rx="1.5"/><rect x="3" y="11" width="6" height="6" rx="1.5"/><rect x="11" y="11" width="6" height="6" rx="1.5"/></svg></span>Dashboard</a>
                    </li>
                    </ul>
                    <p class="nav-label">Konten</p>
                    <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ ! request()->is('articles/create') ? 'is-active' : '' }}" href="{{ route('articles.index') }}" {!! ! request()->is('articles/create') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>Daftar Artikel</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('articles/create') ? 'is-active' : '' }}" href="{{ route('articles.create') }}" {!! request()->is('articles/create') ? 'aria-current="page"' : '' !!}><span class="nav-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 3.5l3.5 3.5L7 16.5H3.5V13z"/></svg></span>Tulis Artikel</a>
                    </li>
                    </ul>
                @endif
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

                    <a class="topbar-brand" href="{{ $home }}" aria-label="RuangKabar - Dashboard">
                        <span class="brand-mark" aria-hidden="true">RK</span>
                        <span class="brand-word">Ruang<span>Kabar</span></span>
                    </a>

                    <ol class="crumbs">
                        <li>{{ $isAdmin ? 'Admin' : 'Penulis' }}</li>
                        <li>Artikel</li>
                        <li>Edit</li>
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

                    <section class="hero" aria-labelledby="page-title">
                        <div class="hero-inner">
                            <a class="back-link" href="/articles"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 8H3M7 4L3 8l4 4"/></svg> Kembali ke daftar artikel</a>
                            <span class="hero-label">ARTIKEL</span>
                            <h1 class="hero-title" id="page-title">Edit Artikel</h1>
                            <p class="hero-lead">Perbarui isi dan pengaturan artikel. Slug ikut diperbarui otomatis jika judul diubah.</p>
                            <div class="edit-meta">
                                <span class="meta-chip"><strong>Slug</strong>{{ $article->slug }}</span>
                                <span class="meta-chip"><strong>Status</strong>{{ ucfirst($article->status) }}</span>
                                @if ($article->created_at)
                                    <span class="meta-chip"><strong>Dibuat</strong>{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                                @endif
                            </div>
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

                    <p class="form-note"><span class="req" aria-hidden="true">*</span> Kolom bertanda bintang wajib diisi.</p>

                    <form class="editor" action="/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="editor-main">
                            <section class="ecard" aria-label="Konten artikel">
                                <div class="field">
                                    <label for="title">Judul <span class="req" aria-hidden="true">*</span></label>
                                    <input class="title-input {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" id="title" name="title" value="{{ old('title', $article->title) }}" maxlength="255" placeholder="Tulis judul yang menarik" required {!! $errors->has('title') ? 'aria-invalid="true" aria-describedby="title-error"' : '' !!}>
                                    @error('title')
                                        <p class="field-error" id="title-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="content">Isi Artikel <span class="req" aria-hidden="true">*</span></label>
                                    <textarea class="{{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="10" placeholder="Mulai menulis isi artikel di sini" required {!! $errors->has('content') ? 'aria-invalid="true" aria-describedby="content-error"' : '' !!}>{{ old('content', $article->content) }}</textarea>
                                    @error('content')
                                        <p class="field-error" id="content-error">{{ $message }}</p>
                                    @enderror
                                    <p class="count"><span id="word-count">0 kata</span></p>
                                </div>
                            </section>
                        </div>

                        <div class="editor-side">
                            <section class="ecard" aria-labelledby="pub-title">
                                <h2 class="ecard-title" id="pub-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.8 10S5 4.5 10 4.5 18.2 10 18.2 10 15 15.5 10 15.5 1.8 10 1.8 10z"/><circle cx="10" cy="10" r="2.5"/></svg></span>Publikasi</h2>

                                <fieldset class="field">
                                    <legend>Status <span class="req" aria-hidden="true">*</span></legend>

                                    <div class="status-opts">
                                        <label class="status-opt">
                                            <input type="radio" name="status" value="draft" {{ old('status', $article->status) === 'draft' ? 'checked' : '' }} required>
                                            <span class="so-dot"></span>
                                            <span class="so-text"><strong>Draft</strong><small>Disimpan, belum tampil untuk pembaca.</small></span>
                                        </label>

                                        <label class="status-opt">
                                            <input type="radio" name="status" value="published" {{ old('status', $article->status) === 'published' ? 'checked' : '' }} required>
                                            <span class="so-dot"></span>
                                            <span class="so-text"><strong>Published</strong><small>Langsung tampil untuk pembaca.</small></span>
                                        </label>
                                    </div>

                                    @error('status')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                <div class="field">
                                    <label for="category_id">Kategori <span class="req" aria-hidden="true">*</span></label>
                                    <select class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ (string) old('category_id', $article->category_id) === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </section>

                            <section class="ecard" aria-labelledby="tag-title">
                                <h2 class="ecard-title" id="tag-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>Tag</h2>

                                <fieldset class="field">
                                    <legend class="sr-only">Pilih tag</legend>

                                    @if ($tags->count())
                                        <div class="tag-list">
                                            @foreach ($tags as $tag)
                                                <label class="tag-option">
                                                    <input
                                                        type="checkbox"
                                                        name="tags[]"
                                                        value="{{ $tag->id }}"
                                                        {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->all())) ? 'checked' : '' }}
                                                    >
                                                    {{ $tag->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="hint">Belum ada tag.</p>
                                    @endif

                                    @error('tags')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </section>

                            <section class="ecard" aria-labelledby="img-title">
                                <h2 class="ecard-title" id="img-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3.5" width="14" height="13" rx="2"/><circle cx="7.5" cy="8" r="1.4"/><path d="M3.5 14.5l4-3.5 3 2.5 2.5-2 3.5 3"/></svg></span>Gambar</h2>

                                <div class="field">

                                    @if ($article->image)
                                        <div class="img-block" id="img-current">
                                            <span class="img-label">Gambar saat ini</span>
                                            <div class="img-frame">
                                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="img-block" id="img-preview" hidden>
                                        <span class="img-label">Pratinjau gambar</span>
                                        <div class="img-frame"><img id="img-preview-img" alt="Pratinjau gambar yang dipilih"></div>
                                        <div class="img-row">
                                            <span id="img-preview-name"></span>
                                            <button class="img-clear" type="button" id="img-clear">Hapus pilihan</button>
                                        </div>
                                    </div>

                                    <label class="drop" id="drop" for="image">
                                        <span class="drop-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13V4M6.5 7.5L10 4l3.5 3.5M4 14v2h12v-2"/></svg></span>
                                        <strong>Pilih atau seret gambar ke sini</strong>
                                        <span>JPG, PNG, atau WEBP, maksimal 2 MB</span>
                                        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp">
                                    </label>

                                    <p class="size-warn" id="size-warn" hidden>Ukuran file melebihi 2 MB dan akan ditolak saat disimpan.</p>
                                    <p class="hint">Biarkan kosong untuk mempertahankan gambar saat ini. Pilih file baru untuk menggantinya.</p>

                                    @error('image')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </section>
                        </div>

                        <div class="actions-card">
                            <button class="btn" type="submit"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg> Update Artikel</button>
                            <a class="btn btn--ghost" href="/articles">Batal</a>
                        </div>
                    </form>

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

            var content = document.getElementById('content');
            var words = document.getElementById('word-count');

            if (content && words) {
                var countWords = function () {
                    var text = content.value.trim();
                    var n = text === '' ? 0 : text.split(/\s+/).length;
                    words.textContent = n + ' kata';
                };

                content.addEventListener('input', countWords);
                countWords();
            }

            var file = document.getElementById('image');
            var drop = document.getElementById('drop');
            var preview = document.getElementById('img-preview');
            var previewImg = document.getElementById('img-preview-img');
            var previewName = document.getElementById('img-preview-name');
            var clear = document.getElementById('img-clear');
            var warn = document.getElementById('size-warn');
            var current = document.getElementById('img-current');

            if (file && drop && preview && previewImg && previewName && clear) {
                var reset = function () {
                    file.value = '';
                    preview.hidden = true;
                    previewImg.removeAttribute('src');
                    if (warn) { warn.hidden = true; }
                    if (current) { current.hidden = false; }
                };

                file.addEventListener('change', function () {
                    var f = file.files && file.files[0];

                    if (!f) {
                        reset();
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewName.textContent = f.name + ' (' + (f.size / 1048576).toFixed(2) + ' MB)';
                        preview.hidden = false;
                        if (current) { current.hidden = true; }
                    };
                    reader.readAsDataURL(f);

                    if (warn) { warn.hidden = f.size <= 2097152; }
                });

                clear.addEventListener('click', reset);

                ['dragenter', 'dragover'].forEach(function (name) {
                    file.addEventListener(name, function () { drop.classList.add('is-over'); });
                });

                ['dragleave', 'drop', 'change'].forEach(function (name) {
                    file.addEventListener(name, function () { drop.classList.remove('is-over'); });
                });
            }

            var firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) { firstInvalid.focus(); }

        })();
    </script>

</body>
</html>