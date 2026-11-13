<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

    <script>
        try {
            if (localStorage.getItem('rk.sidebar') === '1' && window.innerWidth >= 1024) {
                document.documentElement.classList.add('sb-collapsed');
            }
        } catch (e) {}
    </script>

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
    --hd-h: 72px;
    --sb-w: 272px;
    --sb-w-min: 84px;
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



.dash-header {
    position: sticky;
    top: 0;
    z-index: 60;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    height: var(--hd-h);
    padding: 0 24px 0 16px;
    color: var(--ivory);
    background: var(--emerald);
    border-bottom: 1px solid rgba(250, 248, 243, 0.1);
}

.hd-left { display: flex; align-items: center; gap: 14px; min-width: 0; }

.hd-toggle {
    display: inline-flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    padding: 0;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.1);
    border: 0;
    border-radius: 12px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, transform 120ms ease-out;
}

.hd-toggle:hover { background: rgba(250, 248, 243, 0.2); }
.hd-toggle:active { transform: scale(0.95); }
.hd-toggle svg { width: 20px; height: 20px; }

.hd-brand { display: inline-flex; align-items: center; gap: 12px; min-width: 0; color: var(--ivory); text-decoration: none; }

.hd-logo { display: flex; flex: none; align-items: center; justify-content: center; width: auto; height: 46px; overflow: visible; background: transparent; border-radius: 0; }
.hd-logo img { display: block; width: auto; height: 100%; max-width: none; object-fit: contain; background: transparent; }

.hd-brand__text { display: flex; flex-direction: column; min-width: 0; line-height: 1.1; }
.hd-brand__name { font-size: 22px; font-weight: 800; letter-spacing: -0.03em; }
.hd-brand__name span { color: var(--gold); }
.hd-brand__sub { margin-top: 4px; font-size: 10px; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(250, 248, 243, 0.6); }

.hd-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

.hd-user {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 5px 16px 5px 5px;
    color: var(--ivory);
    text-decoration: none;
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.15);
    border-radius: 999px;
    transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.hd-user:hover { background: rgba(250, 248, 243, 0.18); border-color: rgba(250, 248, 243, 0.3); }

.hd-avatar {
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

.hd-user__text { display: flex; flex-direction: column; min-width: 0; line-height: 1.25; }
.hd-user__name { max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 13px; font-weight: 700; }
.hd-user__role { font-size: 10px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold); }

.hd-form { margin: 0; }

.hd-logout {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 44px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--ivory);
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, transform 120ms ease-out;
}

.hd-logout:hover { background: var(--sand); }
.hd-logout:active { transform: scale(0.97); }
.hd-logout svg { width: 18px; height: 18px; }

.dash {
    display: grid;
    grid-template-columns: var(--sb-w) minmax(0, 1fr);
    min-height: calc(100vh - var(--hd-h));
    min-height: calc(100dvh - var(--hd-h));
    transition: grid-template-columns 280ms var(--ease);
}

.sidebar {
    position: sticky;
    top: var(--hd-h);
    z-index: 40;
    display: flex;
    flex-direction: column;
    height: calc(100vh - var(--hd-h));
    height: calc(100dvh - var(--hd-h));
    overflow-x: hidden;
    overflow-y: auto;
    color: var(--on-dark);
    background: var(--emerald);
    border-right: 1px solid rgba(250, 248, 243, 0.08);
}

.sb-top { display: none; }

.sb-nav { flex: 1; padding: 14px; }

.sb-group-label {
    margin: 22px 12px 8px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    white-space: nowrap;
    color: rgba(185, 154, 100, 0.9);
}

.sb-group-label:first-child { margin-top: 6px; }

.sb-list { margin: 0; padding: 0; list-style: none; }

.sb-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 46px;
    margin-bottom: 3px;
    padding: 0 10px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 14px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.sb-ico {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    color: rgba(250, 248, 243, 0.7);
    background: rgba(250, 248, 243, 0.06);
    border-radius: 10px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, transform var(--t-ui) var(--ease);
}

.sb-ico svg { width: 18px; height: 18px; }
.sb-text { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

.sb-link:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.07); }
.sb-link:hover .sb-ico { color: var(--ivory); background: rgba(250, 248, 243, 0.12); transform: translateX(2px); }

.sb-link.is-active { color: var(--ivory); background: rgba(250, 248, 243, 0.13); }

.sb-link.is-active::before {
    content: "";
    position: absolute;
    left: -14px;
    top: 10px;
    bottom: 10px;
    width: 4px;
    background: var(--gold);
    border-radius: 0 4px 4px 0;
}

.sb-link.is-active .sb-ico { color: var(--emerald); background: var(--gold); transform: none; }

.sb-foot { padding: 12px 14px 18px; border-top: 1px solid rgba(250, 248, 243, 0.1); }
.sb-foot .sb-link { min-height: 42px; margin-bottom: 0; font-size: 13px; color: rgba(250, 248, 243, 0.7); }

.dash-main { min-width: 0; padding: 32px 40px 72px; }
.dash-content { max-width: 1120px; margin: 0 auto; }

.crumbs {
    display: flex;
    flex-wrap: wrap;
    gap: 0 8px;
    margin: 0 0 18px;
    padding: 0;
    list-style: none;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-soft);
}

.crumbs li + li::before { content: "/"; margin-right: 8px; color: var(--gold); }
.crumbs li:last-child { color: var(--emerald); font-weight: 700; }

.scrim { display: none; }

.form-layout { max-width: 960px; }

@media (min-width: 1024px) {
    html.sb-collapsed .dash { --sb-w: var(--sb-w-min); }
    html.sb-collapsed .sidebar { overflow: visible; }
    html.sb-collapsed .sb-nav { padding: 14px 12px; }
    html.sb-collapsed .sb-text { display: none; }

    html.sb-collapsed .sb-group-label {
        height: 1px;
        margin: 14px 8px;
        padding: 0;
        font-size: 0;
        background: rgba(250, 248, 243, 0.12);
    }

    html.sb-collapsed .sb-group-label:first-child { margin-top: 4px; }
    html.sb-collapsed .sb-link { justify-content: center; padding: 0; }
    html.sb-collapsed .sb-link.is-active::before { left: -12px; }
    html.sb-collapsed .sb-foot { padding: 12px; }

    html.sb-collapsed .sb-link::after {
        content: attr(data-title);
        position: absolute;
        left: calc(100% + 14px);
        top: 50%;
        z-index: 5;
        padding: 7px 12px;
        font-size: 12.5px;
        font-weight: 700;
        white-space: nowrap;
        color: var(--ivory);
        background: var(--emerald);
        border: 1px solid rgba(250, 248, 243, 0.18);
        border-radius: 10px;
        box-shadow: 0 12px 24px -12px rgba(24, 60, 54, 0.7);
        opacity: 0;
        pointer-events: none;
        transform: translate(-4px, -50%);
        transition: opacity var(--t-fast) ease-out, transform var(--t-fast) ease-out;
    }

    html.sb-collapsed .sb-link:hover::after,
    html.sb-collapsed .sb-link:focus-visible::after { opacity: 1; transform: translate(0, -50%); }
}

@media (max-width: 1023px) {
    .dash { grid-template-columns: minmax(0, 1fr); }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 80;
        width: min(300px, 86vw);
        height: auto;
        visibility: hidden;
        transform: translateX(-100%);
        transition: transform 280ms var(--ease), visibility 0s linear 280ms;
    }

    .sidebar.is-open { visibility: visible; transform: none; transition: transform 280ms var(--ease); }

    .sb-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        min-height: var(--hd-h);
        padding: 0 16px 0 26px;
        border-bottom: 1px solid rgba(250, 248, 243, 0.1);
    }

    .sb-top__title { font-size: 12px; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: var(--gold); }

    .sb-close {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        padding: 0;
        color: var(--ivory);
        background: rgba(250, 248, 243, 0.1);
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        transition: background var(--t-fast) ease-out;
    }

    .sb-close:hover { background: rgba(250, 248, 243, 0.2); }
    .sb-close svg { width: 18px; height: 18px; }

    .scrim {
        display: block;
        position: fixed;
        inset: 0;
        z-index: 70;
        background: rgba(24, 60, 54, 0.55);
        opacity: 0;
        visibility: hidden;
        transition: opacity 250ms ease, visibility 0s linear 250ms;
    }

    .scrim.is-visible { opacity: 1; visibility: visible; transition: opacity 250ms ease; }

    .dash-main { padding: 24px 24px 56px; }
    .hero { padding: 36px 32px; }
    .form-layout { grid-template-columns: minmax(0, 1fr); max-width: none; }
}

@media (max-width: 719px) {
    .dash-header { padding: 0 12px; gap: 8px; }
    .hd-brand__sub { display: none; }
    .hd-brand__name { font-size: 20px; }
    .hd-logo { width: auto; height: 38px; }
    .hd-user { padding: 4px; }
    .hd-user__text { display: none; }
    .hd-logout { width: 44px; padding: 0; justify-content: center; }
    .hd-logout__text { display: none; }

    .dash-main { padding: 16px 16px 48px; }
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
    .hd-brand__name { display: none; }
    .dash-main { padding: 12px 12px 40px; }
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

    @stack('styles')
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    @include('components.navbar-dashboard')

    <div class="dash" id="dash">
        @include('components.sidebar-dashboard')

        <div class="scrim" id="scrim"></div>

        <main class="dash-main" id="konten">
            <div class="dash-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>

(function () {
    var root = document.documentElement;
    var sidebar = document.getElementById('sidebar');
    var scrim = document.getElementById('scrim');
    var toggle = document.getElementById('sb-toggle');
    var closeBtn = document.getElementById('sb-close');
    var mq = window.matchMedia('(max-width: 1023px)');

    if (sidebar && scrim && toggle) {
        var isDrawerOpen = function () { return sidebar.classList.contains('is-open'); };

        var syncToggle = function () {
            var expanded;
            var label;

            if (mq.matches) {
                expanded = isDrawerOpen();
                label = expanded ? 'Tutup menu' : 'Buka menu';
            } else {
                expanded = !root.classList.contains('sb-collapsed');
                label = expanded ? 'Ciutkan sidebar' : 'Perluas sidebar';
            }

            toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            toggle.setAttribute('aria-label', label);
        };

        var openDrawer = function () {
            sidebar.classList.add('is-open');
            scrim.classList.add('is-visible');
            document.body.classList.add('menu-open');
            syncToggle();
            if (closeBtn) { closeBtn.focus(); }
        };

        var closeDrawer = function (returnFocus) {
            sidebar.classList.remove('is-open');
            scrim.classList.remove('is-visible');
            document.body.classList.remove('menu-open');
            syncToggle();
            if (returnFocus) { toggle.focus(); }
        };

        toggle.addEventListener('click', function () {
            if (mq.matches) {
                if (isDrawerOpen()) { closeDrawer(true); } else { openDrawer(); }
                return;
            }

            var collapsed = root.classList.toggle('sb-collapsed');

            try { localStorage.setItem('rk.sidebar', collapsed ? '1' : '0'); } catch (e) {}

            syncToggle();
        });

        if (closeBtn) { closeBtn.addEventListener('click', function () { closeDrawer(true); }); }
        scrim.addEventListener('click', function () { closeDrawer(true); });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && isDrawerOpen()) { closeDrawer(true); }
        });

        var onChange = function () {
            if (!mq.matches && isDrawerOpen()) { closeDrawer(false); }
            syncToggle();
        };

        if (mq.addEventListener) { mq.addEventListener('change', onChange); } else { mq.addListener(onChange); }

        sidebar.addEventListener('click', function (event) {
            var link = event.target.closest ? event.target.closest('a') : null;
            if (link && mq.matches && isDrawerOpen()) { closeDrawer(false); }
        });

        syncToggle();
    }

    document.querySelectorAll('[data-flash-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var box = btn.closest('.flash');
            if (box) { box.hidden = true; }
        });
    });
})();

    </script>

    @stack('scripts')

</body>
</html>