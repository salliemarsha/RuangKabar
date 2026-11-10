<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Pengguna - RuangKabar</title>

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
    --on-dark: rgba(250, 248, 243, 0.82);
    --rule: rgba(24, 60, 54, 0.14);
    --sans: 'Plus Jakarta Sans', Arial, sans-serif;
    --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;
    --wrap: 1240px;
    --pad: 32px;
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

a { color: inherit; }

a:focus-visible,
button:focus-visible {
    outline: 2px solid var(--gold);
    outline-offset: 3px;
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

.wrap { max-width: var(--wrap); margin: 0 auto; padding: 0 var(--pad); }

.site-header { position: sticky; top: -10px; z-index: 50; height: 0; }

.bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 0 24px;
    min-height: 64px;
    margin-top: 26px;
    padding: 0 12px 0 24px;
    background: var(--emerald);
    border: 1px solid rgba(250, 248, 243, 0.1);
    border-radius: 20px;
    box-shadow: 0 10px 30px -14px rgba(24, 60, 54, 0.5);
    transition: box-shadow var(--t-ui) ease-out;
}

.site-header.is-scrolled .bar { box-shadow: 0 14px 36px -10px rgba(24, 60, 54, 0.6); }

.brand {
    display: inline-block;
    padding: 8px 0;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--ivory);
    text-decoration: none;
}

.brand span { color: var(--gold); }

.nav { display: flex; flex: 1; justify-content: center; }

.nav-links { display: flex; gap: 4px; margin: 0; padding: 0; list-style: none; }

.nav-links a {
    display: inline-flex;
    align-items: center;
    height: 40px;
    padding: 0 16px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 12px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.nav-links a:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.08); }

.nav-links a.is-current {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.14);
    box-shadow: inset 0 -2px 0 var(--gold);
}

.actions { display: flex; align-items: center; gap: 6px; }

.user-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 12px 5px 5px;
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.15);
    border-radius: 999px;
}

.avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    font-size: 11px;
    font-weight: 800;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
}

.user-chip-name {
    max-width: 130px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 13px;
    font-weight: 600;
    color: var(--ivory);
}

.actions-sep { width: 1px; height: 18px; margin: 0 6px; background: rgba(250, 248, 243, 0.18); }

.actions-form { display: contents; }

.link-btn {
    padding: 8px 8px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    color: rgba(250, 248, 243, 0.6);
    background: none;
    border: 0;
    cursor: pointer;
    transition: color var(--t-fast) ease-out;
}

.link-btn:hover { color: var(--ivory); }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 48px;
    padding: 0 26px;
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
.btn svg { width: 16px; height: 16px; flex: none; transition: transform var(--t-ui) var(--ease); }
.btn:hover svg { transform: translateX(3px); }

.btn--gold { color: var(--emerald); background: var(--gold); }
.btn--gold:hover { color: var(--emerald); background: #CBAE7C; }

.btn--light { color: var(--ivory); background: rgba(250, 248, 243, 0.1); border-color: rgba(250, 248, 243, 0.28); }
.btn--light:hover { color: var(--emerald); background: var(--ivory); border-color: var(--ivory); }

.hero {
    position: relative;
    overflow: hidden;
    margin: 8px 12px 0;
    padding: 170px 0 64px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: var(--r-lg);
}

.hero::before {
    content: "";
    position: absolute;
    top: -150px;
    right: -110px;
    width: 460px;
    height: 460px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.hero::after {
    content: "";
    position: absolute;
    right: 140px;
    bottom: -90px;
    width: 200px;
    height: 200px;
    border: 1px solid rgba(185, 154, 100, 0.5);
    border-radius: 50%;
}

.hero-inner {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 40px;
    animation: rise 560ms var(--ease) both;
}

.hero-text { min-width: 0; }

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
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

.hero-greet {
    margin: 0 0 6px;
    font-family: var(--body);
    font-size: 17px;
    color: var(--gold);
}

.hero-title {
    max-width: 820px;
    margin: 0 0 16px;
    font-family: var(--serif);
    font-size: clamp(36px, 5vw, 62px);
    font-weight: 600;
    line-height: 1.08;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.hero-lead {
    max-width: 560px;
    margin: 0 0 30px;
    font-family: var(--body);
    font-size: 17px;
    line-height: 1.7;
    color: var(--on-dark);
}

.hero-actions { display: flex; flex-wrap: wrap; gap: 12px; }

.hero-date {
    display: flex;
    flex: none;
    flex-direction: column;
    align-items: center;
    min-width: 160px;
    padding: 24px 28px;
    text-align: center;
    background: rgba(250, 248, 243, 0.08);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 22px;
}

.hero-date-day { font-family: var(--serif); font-size: 60px; font-weight: 600; line-height: 1; color: var(--gold); }
.hero-date-month { margin-top: 8px; font-size: 14px; font-weight: 700; }
.hero-date-week { margin-top: 2px; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--on-dark); }

.section { padding: 56px 0 0; }
.section:last-of-type { padding-bottom: 88px; }

.section-head {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 8px 20px;
    margin-bottom: 24px;
}

.section-title {
    position: relative;
    margin: 0;
    padding-bottom: 14px;
    font-family: var(--serif);
    font-size: clamp(26px, 3vw, 34px);
    font-weight: 600;
    line-height: 1.15;
    color: var(--emerald);
}

.section-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 48px;
    height: 3px;
    background: var(--gold);
    border-radius: 2px;
}

.section-sub { margin: 0; font-family: var(--body); font-size: 14.5px; color: var(--text-soft); }

.text-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.text-link svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }
.text-link:hover { color: var(--emerald); }
.text-link:hover svg { transform: translateX(3px); }

.summary { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }

.stat {
    position: relative;
    overflow: hidden;
    padding: 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

@media (hover: hover) {
    .stat:hover { transform: translateY(-3px); box-shadow: 0 18px 32px -22px rgba(24, 60, 54, 0.45); }
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    margin-bottom: 20px;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.12);
    border-radius: 14px;
}

.stat-icon svg { width: 22px; height: 22px; }
.stat-label { font-size: 13.5px; font-weight: 600; color: var(--text-soft); }

.stat-value {
    display: block;
    margin: 4px 0 8px;
    font-family: var(--serif);
    font-size: 46px;
    font-weight: 600;
    line-height: 1.1;
    color: var(--emerald);
}

.stat-note { font-family: var(--body); font-size: 13px; line-height: 1.55; color: var(--text-soft); }

.stat--lead { background: var(--emerald); border-color: var(--emerald); }
.stat--lead::after { content: ""; position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: var(--forest); opacity: 0.45; border-radius: 50%; }
.stat--lead > * { position: relative; z-index: 1; }
.stat--lead .stat-icon { color: var(--emerald); background: var(--gold); }
.stat--lead .stat-label, .stat--lead .stat-note { color: var(--on-dark); }
.stat--lead .stat-value { color: var(--ivory); }

.activity { display: grid; grid-template-columns: minmax(0, 1.8fr) minmax(0, 1fr); gap: 20px; align-items: start; }

.panel {
    min-width: 0;
    padding: 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.comments { margin: 0; padding: 0; list-style: none; }

.comment {
    display: grid;
    grid-template-columns: auto minmax(0, 1fr);
    gap: 16px;
    padding: 18px 0;
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}

.comment:first-child { padding-top: 0; }
.comment:last-child { padding-bottom: 0; border-bottom: 0; }

.comment-mark {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    color: var(--emerald);
    background: rgba(185, 154, 100, 0.22);
    border-radius: 14px;
}

.comment-mark svg { width: 20px; height: 20px; }
.comment-body { min-width: 0; }

.comment-article {
    display: inline-block;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
    color: var(--emerald);
    text-decoration: none;
    overflow-wrap: anywhere;
    transition: color var(--t-fast) ease-out;
}

a.comment-article:hover { color: var(--forest); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }

.comment-text { margin: 6px 0 10px; font-family: var(--body); font-size: 14.5px; line-height: 1.65; color: var(--text-soft); overflow-wrap: anywhere; }

.comment-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 12px; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }

.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    font-family: var(--sans);
    font-size: 11.5px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 999px;
}

.badge::before { content: ""; width: 7px; height: 7px; background: var(--c, var(--text-soft)); border-radius: 50%; }
.badge--ok { --c: var(--forest); }
.badge--wait { --c: var(--gold); }

.account { text-align: center; }

.account-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 76px;
    height: 76px;
    margin: 4px auto 14px;
    font-family: var(--serif);
    font-size: 32px;
    font-weight: 600;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
    box-shadow: 0 0 0 6px rgba(185, 154, 100, 0.22);
}

.account-name { margin: 0; font-size: 18px; font-weight: 800; color: var(--emerald); overflow-wrap: anywhere; }
.account-role { display: inline-block; margin: 8px 0 18px; padding: 4px 12px; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--forest); background: rgba(55, 107, 92, 0.12); border-radius: 999px; }

.account-list { margin: 0; padding: 14px 0 0; text-align: left; list-style: none; border-top: 1px solid var(--rule); }
.account-list li { display: flex; justify-content: space-between; gap: 12px; padding: 8px 0; font-family: var(--body); font-size: 13.5px; }
.account-list span { color: var(--text-soft); }
.account-list strong { font-weight: 600; text-align: right; color: var(--text); overflow-wrap: anywhere; }

.chips { display: flex; flex-wrap: wrap; gap: 8px; margin: 0 0 28px; padding: 0; list-style: none; }

.chips a {
    display: inline-flex;
    align-items: center;
    height: 40px;
    padding: 0 18px;
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--sand);
    border-radius: 999px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.chips a:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }

.news { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }

.media {
    display: block;
    overflow: hidden;
    text-decoration: none;
    background: var(--sand);
    border-radius: 16px;
}

.media img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform 600ms var(--ease); }

.ph {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 40px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: rgba(24, 60, 54, 0.22);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 12px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

.card .media { aspect-ratio: 4 / 3; }
.card-body { display: flex; flex-direction: column; flex: 1; padding: 20px 10px 10px; }

.cat {
    position: relative;
    z-index: 2;
    align-self: flex-start;
    margin-bottom: 10px;
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.cat:hover { color: var(--emerald); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }

.title { margin: 0 0 10px; font-size: 20px; font-weight: 700; line-height: 1.28; letter-spacing: -0.015em; overflow-wrap: anywhere; }

.title a { color: var(--emerald); text-decoration: none; transition: color var(--t-fast) ease-out; }
.stretch::after { content: ""; position: absolute; inset: 0; z-index: 1; }

.excerpt { margin: 0 0 16px; font-family: var(--body); font-size: 14.5px; line-height: 1.65; color: var(--text-soft); }
.meta { display: flex; flex-wrap: wrap; gap: 2px 14px; margin-top: auto; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

.card--feature {
    grid-column: span 2;
    flex-direction: row;
    align-items: center;
    gap: 32px;
    padding: 16px;
}

.card--feature .media { flex: 1 1 52%; aspect-ratio: 16 / 11; border-radius: 20px; }
.card--feature .card-body { flex: 1 1 48%; padding: 8px 20px 8px 0; }
.card--feature .title { font-family: var(--serif); font-size: clamp(24px, 2.6vw, 34px); font-weight: 600; line-height: 1.2; }
.card--feature .excerpt { font-size: 15.5px; line-height: 1.75; }

.more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 16px;
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
}

.more svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }

@media (hover: hover) {
    .card:hover { transform: translateY(-4px); box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4); }
    .card:hover .media img { transform: scale(1.03); }
    .card:hover .title a { color: var(--forest); }
    .card:hover .more svg { transform: translateX(4px); }
}

.empty { padding: 56px 28px; text-align: center; background: var(--sand); border-radius: 22px; }
.empty strong { display: block; margin-bottom: 8px; font-family: var(--serif); font-size: 26px; font-weight: 600; color: var(--emerald); }
.empty p { max-width: 440px; margin: 0 auto; font-family: var(--body); font-size: 15px; line-height: 1.7; color: var(--text-soft); }
.empty .btn { margin-top: 22px; }

.empty--panel { padding: 36px 20px; background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); }
.empty--panel strong { font-size: 22px; }

.footer { color: var(--on-dark); background: var(--emerald); }
.footer-inner { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 24px; padding-top: 28px; padding-bottom: 32px; font-size: 13px; }
.footer .brand { padding: 0; font-size: 20px; }

@keyframes rise {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: none; }
}

@media (max-width: 1023px) {
    :root { --pad: 24px; --r-lg: 24px; }
    .hero { padding: 160px 0 48px; }
    .hero-date { display: none; }
    .section { padding-top: 44px; }
    .summary { gap: 14px; }
    .stat { padding: 20px; }
    .stat-value { font-size: 38px; }
    .activity { grid-template-columns: minmax(0, 1fr); }
    .news { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
    .card--feature { flex-direction: column; align-items: stretch; gap: 20px; }
    .card--feature .card-body { padding: 4px 8px 12px; }
}

@media (max-width: 719px) {
    :root { --pad: 20px; --r-lg: 22px; }

    .bar { padding: 4px 8px 4px 18px; gap: 0 12px; }
    .brand { font-size: 22px; }
    .actions { margin-left: auto; }
    .user-chip-name { display: none; }
    .user-chip { padding: 4px; }
    .nav { order: 3; flex-basis: 100%; justify-content: flex-start; padding-bottom: 8px; }
    .nav-links a { height: 36px; padding: 0 12px; }

    .hero { margin: 6px 8px 0; padding: 176px 0 36px; }
    .hero::before { width: 320px; height: 320px; top: -120px; right: -120px; }
    .hero::after { display: none; }
    .hero-lead { font-size: 16px; }
    .hero-actions .btn { flex: 1 1 100%; }

    .section { padding-top: 36px; }
    .section:last-of-type { padding-bottom: 56px; }
    .summary { grid-template-columns: minmax(0, 1fr); }
    .stat { display: grid; grid-template-columns: auto minmax(0, 1fr); column-gap: 16px; align-items: center; }
    .stat-icon { grid-row: span 3; margin: 0; }
    .stat-value { margin: 0; font-size: 34px; }
    .panel { padding: 20px 16px; border-radius: 18px; }
    .news { grid-template-columns: minmax(0, 1fr); gap: 18px; }
    .card--feature { grid-column: auto; padding: 10px; }
    .empty { padding: 44px 20px; }
}

@media (max-width: 359px) {
    .brand { font-size: 20px; }
    .hero-title { font-size: 32px; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }

    .card:hover, .stat:hover, .card:hover .media img { transform: none; }
}
    </style>
</head>
<body>

    @php
        $user = auth()->user();
        $str = \Illuminate\Support\Str::class;
        $hour = (int) now()->format('G');
        $greeting = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));

        $hasCommentDate = \Illuminate\Support\Facades\Schema::hasColumn('comments', 'created_at');
        $totalComments = $user->comments()->count();
        $recentComments = $hasCommentDate ? $user->comments()->where('created_at', '>=', now()->subDays(30))->count() : null;
        $commentedArticles = $user->comments()->distinct()->count('article_id');
        $myComments = $user->comments()->with('article')->orderByDesc('id')->take(5)->get();

        $categories = \App\Models\Category::orderBy('name')->get();
        $featured = $articles->first();
        $rest = $articles->slice(1)->values();

        $tone = function ($status) {
            $key = strtolower((string) $status);

            if (in_array($key, ['approved', 'published', 'disetujui', 'tampil', 'visible'], true)) {
                return 'ok';
            }

            if (in_array($key, ['pending', 'menunggu', 'review'], true)) {
                return 'wait';
            }

            return 'neutral';
        };
    @endphp

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <header class="site-header" id="site-header">
        <div class="wrap">
            <div class="bar">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>

                <nav class="nav" aria-label="Menu utama">
                    <ul class="nav-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a class="is-current" href="/beranda" aria-current="page">Dashboard</a></li>
                        <li><a href="{{ route('articles.index') }}">Berita</a></li>
                    </ul>
                </nav>

                <div class="actions">
                    <div class="user-chip">
                        <span class="avatar" aria-hidden="true">{{ $str::upper($str::substr($user->name, 0, 1)) }}</span>
                        <span class="user-chip-name">{{ $user->name }}</span>
                    </div>

                    <span class="actions-sep" aria-hidden="true"></span>

                    <form class="actions-form" action="/logout" method="POST">
                        @csrf
                        <button class="link-btn" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main id="konten">
        <section class="hero" aria-labelledby="page-title">
            <div class="wrap hero-inner">
                <div class="hero-text">
                    <span class="hero-label">DASHBOARD PENGGUNA</span>

                    <p class="hero-greet">{{ $greeting }},</p>
                    <h1 class="hero-title" id="page-title">{{ $user->name }}</h1>

                    <p class="hero-lead">Temukan berita dan informasi terbaru dari berbagai kategori di RuangKabar, lalu bagikan pendapat Anda lewat komentar.</p>

                    <div class="hero-actions">
                        <a class="btn btn--gold" href="{{ route('articles.index') }}">Jelajahi Berita <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
                        <a class="btn btn--light" href="/">Kembali ke Beranda</a>
                    </div>
                </div>

                <div class="hero-date" aria-label="Tanggal hari ini">
                    <span class="hero-date-day">{{ now()->locale('id')->translatedFormat('d') }}</span>
                    <span class="hero-date-month">{{ now()->locale('id')->translatedFormat('F Y') }}</span>
                    <span class="hero-date-week">{{ now()->locale('id')->translatedFormat('l') }}</span>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="summary-title">
            <div class="wrap">
                <div class="section-head">
                    <h2 class="section-title" id="summary-title">Ringkasan Aktivitas</h2>
                    <p class="section-sub">Hanya menampilkan data akun Anda</p>
                </div>

                <div class="summary">
                    <article class="stat stat--lead">
                        <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>
                        <span class="stat-label">Total Komentar</span>
                        <span class="stat-value">{{ number_format($totalComments, 0, ',', '.') }}</span>
                        <span class="stat-note">Komentar yang pernah Anda tulis</span>
                    </article>

                    <article class="stat">
                        <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="7.5"/><path d="M10 5.5V10l3 2"/></svg></span>
                        <span class="stat-label">30 Hari Terakhir</span>
                        <span class="stat-value">{{ $recentComments === null ? '-' : number_format($recentComments, 0, ',', '.') }}</span>
                        <span class="stat-note">Komentar dalam sebulan terakhir</span>
                    </article>

                    <article class="stat">
                        <span class="stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>
                        <span class="stat-label">Artikel Dikomentari</span>
                        <span class="stat-value">{{ number_format($commentedArticles, 0, ',', '.') }}</span>
                        <span class="stat-note">Artikel berbeda yang Anda tanggapi</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="activity-title">
            <div class="wrap">
                <div class="section-head">
                    <h2 class="section-title" id="activity-title">Aktivitas Saya</h2>
                    <p class="section-sub">Lima komentar terakhir Anda</p>
                </div>

                <div class="activity">
                    <div class="panel">
                        @if ($myComments->isNotEmpty())
                            <ul class="comments">
                                @foreach ($myComments as $comment)
                                    <li class="comment">
                                        <span class="comment-mark" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>

                                        <div class="comment-body">
                                            @if ($comment->article)
                                                <a class="comment-article" href="{{ route('articles.show', $comment->article) }}">{{ $comment->article->title }}</a>
                                            @else
                                                <span class="comment-article">Artikel tidak tersedia</span>
                                            @endif

                                            <p class="comment-text">{{ $str::limit(strip_tags($comment->comment), 140) }}</p>

                                            <div class="comment-meta">
                                                @if ($comment->created_at)
                                                    <time datetime="{{ $comment->created_at->toDateString() }}">{{ $comment->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                                @endif

                                                @if ($comment->status)
                                                    <span class="badge badge--{{ $tone($comment->status) }}">{{ $str::ucfirst($comment->status) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty empty--panel">
                                <strong>Belum ada aktivitas komentar</strong>
                                <p>Baca berita yang menarik, lalu tulis komentar pertama Anda. Riwayatnya akan tampil di sini.</p>
                                <a class="btn" href="{{ route('articles.index') }}">Jelajahi Berita</a>
                            </div>
                        @endif
                    </div>

                    <aside class="panel account" aria-label="Informasi akun">
                        <div class="account-avatar" aria-hidden="true">{{ $str::upper($str::substr($user->name, 0, 1)) }}</div>
                        <h3 class="account-name">{{ $user->name }}</h3>
                        <span class="account-role">{{ $user->role }}</span>

                        <ul class="account-list">
                            <li><span>Username</span><strong>{{ $user->username }}</strong></li>
                            @if ($user->created_at)
                                <li><span>Bergabung</span><strong>{{ $user->created_at->locale('id')->translatedFormat('d F Y') }}</strong></li>
                            @endif
                        </ul>
                    </aside>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="news-title">
            <div class="wrap">
                <div class="section-head">
                    <h2 class="section-title" id="news-title">Berita Terbaru untuk Anda</h2>
                    <a class="text-link" href="{{ route('articles.index') }}">Lihat semua berita <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
                </div>

                @if ($categories->isNotEmpty())
                    <ul class="chips" aria-label="Jelajahi kategori">
                        @foreach ($categories as $cat)
                            <li><a href="{{ route('kategori.show', $cat) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                @endif

                @if ($articles->isNotEmpty())
                    <div class="news">
                        @if ($featured)
                            <article class="card card--feature">
                                <a class="media" href="{{ route('articles.show', $featured) }}" tabindex="-1" aria-hidden="true">
                                    @if ($featured->image)
                                        <img src="{{ asset('storage/' . $featured->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">RK</div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    @if ($featured->category)
                                        <a class="cat" href="{{ route('kategori.show', $featured->category) }}">{{ $featured->category->name }}</a>
                                    @endif

                                    <h3 class="title"><a class="stretch" href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a></h3>

                                    <p class="excerpt">{{ $str::limit(strip_tags($featured->content), 200) }}</p>

                                    <span class="more" aria-hidden="true">Baca Selengkapnya <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>

                                    <div class="meta">
                                        <span>{{ $featured->user->name ?? 'Redaksi' }}</span>
                                        @if ($featured->created_at)
                                            <time datetime="{{ $featured->created_at->toDateString() }}">{{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endif

                        @foreach ($rest as $article)
                            <article class="card">
                                <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">RK</div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    @if ($article->category)
                                        <a class="cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>
                                    @endif

                                    <h3 class="title"><a class="stretch" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>

                                    <p class="excerpt">{{ $str::limit(strip_tags($article->content), 110) }}</p>

                                    <span class="more" aria-hidden="true">Baca Selengkapnya <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>

                                    <div class="meta">
                                        <span>{{ $article->user->name ?? 'Redaksi' }}</span>
                                        @if ($article->created_at)
                                            <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty">
                        <strong>Belum ada berita yang dipublikasikan.</strong>
                        <p>Berita terbaru akan tampil di sini setelah dipublikasikan oleh redaksi.</p>
                        <a class="btn" href="{{ route('articles.index') }}">Lihat Daftar Berita</a>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="wrap footer-inner">
            <a class="brand" href="/">Ruang<span>Kabar</span></a>
            <span>&copy; {{ date('Y') }} RuangKabar. All rights reserved.</span>
        </div>
    </footer>

    <script>
(function () {
    var header = document.getElementById('site-header');
    if (!header) { return; }

    var onScroll = function () {
        header.classList.toggle('is-scrolled', window.scrollY > 8);
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
})();
    </script>

</body>
</html>