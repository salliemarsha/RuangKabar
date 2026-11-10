<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Penulis - RuangKabar</title>

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
    --on-dark: rgba(250, 248, 243, 0.78);
    --rule: rgba(24, 60, 54, 0.12);
    --sans: 'Plus Jakarta Sans', Arial, sans-serif;
    --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;
    --sidebar-w: 272px;
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
    --t-fast: 180ms;
    --t-ui: 280ms;
}

*, *::before, *::after { box-sizing: border-box; }

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
button:focus-visible {
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

.layout {
    display: grid;
    grid-template-columns: var(--sidebar-w) minmax(0, 1fr);
    min-height: 100vh;
    min-height: 100dvh;
}

.sidebar {
    position: sticky;
    top: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
    height: 100dvh;
    padding: 24px 18px 20px;
    overflow-y: auto;
    color: var(--on-dark);
    background: var(--emerald);
}

.sidebar-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    padding: 4px 10px 22px;
}

.brand {
    display: inline-block;
    text-decoration: none;
}

.brand-name {
    display: block;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--ivory);
}

.brand-name span { color: var(--gold); }

.brand-sub {
    display: block;
    margin-top: 4px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(250, 248, 243, 0.5);
}

.sidebar-close {
    display: none;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    padding: 0;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.1);
    border: 0;
    border-radius: 12px;
    cursor: pointer;
    transition: background var(--t-fast) ease;
}

.sidebar-close:hover { background: rgba(250, 248, 243, 0.2); }
.sidebar-close svg { width: 18px; height: 18px; }

.side-nav { flex: 1; }

.nav-label {
    margin: 0 0 8px;
    padding: 0 12px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(250, 248, 243, 0.42);
}

.nav-list {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.nav-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    height: 46px;
    padding: 0 14px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 14px;
    transition: color var(--t-fast) ease, background var(--t-fast) ease;
}

.nav-link svg {
    flex: none;
    width: 20px;
    height: 20px;
    opacity: 0.85;
}

.nav-link:hover {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.08);
}

.nav-link.is-active {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.13);
}

.nav-link.is-active::before {
    content: "";
    position: absolute;
    top: 12px;
    bottom: 12px;
    left: 0;
    width: 3px;
    background: var(--gold);
    border-radius: 0 3px 3px 0;
}

.nav-link.is-active svg { color: var(--gold); opacity: 1; }

.account {
    margin-top: 20px;
    padding: 14px;
    background: rgba(250, 248, 243, 0.07);
    border: 1px solid rgba(250, 248, 243, 0.1);
    border-radius: 18px;
}

.account-head {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    font-size: 15px;
    font-weight: 800;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
}

.account-text { min-width: 0; }

.account-name {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 700;
    color: var(--ivory);
}

.account-role {
    display: block;
    margin-top: 2px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
}

.account-actions {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 8px;
    margin-top: 14px;
}

.account-actions form { margin: 0; display: contents; }

.account-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 40px;
    padding: 0 10px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--on-dark);
    text-decoration: none;
    background: rgba(250, 248, 243, 0.08);
    border: 0;
    border-radius: 12px;
    cursor: pointer;
    transition: color var(--t-fast) ease, background var(--t-fast) ease;
}

.account-btn svg { width: 15px; height: 15px; }
.account-btn:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.16); }

.main { min-width: 0; }

.topbar {
    position: sticky;
    top: 0;
    z-index: 20;
    display: none;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-height: 68px;
    padding: 10px 16px;
    background: rgba(250, 248, 243, 0.96);
    border-bottom: 1px solid var(--rule);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.menu-toggle {
    display: inline-flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    padding: 0;
    color: var(--emerald);
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 14px;
    cursor: pointer;
    transition: background var(--t-fast) ease;
}

.menu-toggle:hover { background: var(--sand); }
.menu-toggle svg { width: 20px; height: 20px; }

.topbar-brand {
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--emerald);
    text-decoration: none;
}

.topbar-brand span { color: var(--gold); }

.topbar .avatar { width: 38px; height: 38px; font-size: 14px; }

.content {
    max-width: 1180px;
    margin: 0 auto;
    padding: 32px 40px 72px;
}

@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: none; }
}

.welcome {
    position: relative;
    overflow: hidden;
    padding: 44px 44px 40px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 28px;
    animation: rise 520ms var(--ease) both;
}

.welcome::before {
    content: "";
    position: absolute;
    top: -150px;
    right: -90px;
    width: 420px;
    height: 420px;
    background: var(--forest);
    opacity: 0.42;
    border-radius: 50%;
}

.welcome::after {
    content: "";
    position: absolute;
    right: 90px;
    bottom: -70px;
    width: 170px;
    height: 170px;
    border: 1.5px solid rgba(185, 154, 100, 0.4);
    border-radius: 50%;
}

.welcome-inner { position: relative; z-index: 1; max-width: 640px; }

.welcome-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    padding: 7px 16px 7px 12px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.12);
    border: 1px solid rgba(250, 248, 243, 0.22);
    border-radius: 999px;
}

.welcome-label::before {
    content: "";
    width: 7px;
    height: 7px;
    background: var(--gold);
    border-radius: 50%;
}

.welcome-title {
    margin: 0 0 12px;
    font-family: var(--serif);
    font-size: clamp(30px, 3.6vw, 44px);
    font-weight: 600;
    line-height: 1.12;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.welcome-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 4px 14px;
    margin: 0 0 26px;
    font-family: var(--body);
    font-size: 15px;
    color: var(--on-dark);
}

.welcome-meta strong { font-weight: 600; color: var(--ivory); }

.welcome-meta .dot {
    width: 4px;
    height: 4px;
    background: rgba(250, 248, 243, 0.4);
    border-radius: 50%;
}

.welcome-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px 12px;
}

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
    text-decoration: none;
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease, color var(--t-fast) ease, transform 120ms ease;
}

.btn:active { transform: scale(0.97); }
.btn svg { width: 16px; height: 16px; }

.btn-gold { color: var(--emerald); background: var(--gold); }
.btn-gold:hover { background: #CBAF7C; }

.btn-line {
    color: var(--ivory);
    background: transparent;
    border: 1px solid rgba(250, 248, 243, 0.38);
}

.btn-line:hover { background: rgba(250, 248, 243, 0.14); }

.btn-forest { color: var(--white); background: var(--forest); }
.btn-forest:hover { background: var(--emerald); }

.stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    margin-top: 24px;
}

.box {
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 24px;
}

.stat {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    padding: 24px;
    animation: rise 520ms var(--ease) both;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease;
}

.stat:nth-child(2) { animation-delay: 70ms; }
.stat:nth-child(3) { animation-delay: 140ms; }

.stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 34px -24px rgba(24, 60, 54, 0.45);
}

.stat-label {
    display: block;
    margin-bottom: 12px;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-soft);
}

.stat-value {
    display: block;
    font-family: var(--serif);
    font-size: clamp(38px, 4vw, 52px);
    font-weight: 600;
    line-height: 1;
    letter-spacing: -0.02em;
    color: var(--emerald);
}

.stat-note {
    display: block;
    margin-top: 12px;
    font-family: var(--body);
    font-size: 13px;
    color: var(--text-soft);
}

.stat-icon {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 16px;
}

.stat-icon svg { width: 22px; height: 22px; }

.tone-emerald { color: var(--emerald); background: rgba(24, 60, 54, 0.09); }
.tone-forest { color: var(--forest); background: rgba(55, 107, 92, 0.13); }
.tone-gold { color: #8D7243; background: rgba(185, 154, 100, 0.2); }

.section { margin-top: 24px; animation: rise 520ms var(--ease) 120ms both; }

.box-head {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px 20px;
    padding: 24px 28px 0;
}

.box-title {
    margin: 0;
    font-family: var(--serif);
    font-size: 24px;
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: -0.01em;
    color: var(--emerald);
}

.box-title::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    margin-top: 10px;
    background: var(--gold);
    border-radius: 2px;
}

.box-sub {
    margin: 12px 0 0;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.pill {
    display: inline-flex;
    align-items: center;
    height: 34px;
    padding: 0 14px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 999px;
}

.link-more {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 0;
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
}

.link-more svg { width: 15px; height: 15px; transition: transform var(--t-ui) var(--ease); }
.link-more:hover { text-decoration: underline; text-underline-offset: 4px; }
.link-more:hover svg { transform: translateX(3px); }

.chart {
    display: grid;
    grid-template-columns: 34px minmax(0, 1fr);
    gap: 0 10px;
    padding: 28px 28px 24px;
}

.chart-y {
    position: relative;
    height: 240px;
}

.chart-y span {
    position: absolute;
    right: 0;
    bottom: calc(var(--i) * 25%);
    transform: translateY(50%);
    font-family: var(--body);
    font-size: 12px;
    font-weight: 500;
    color: var(--text-soft);
}

.chart-y-title {
    grid-column: 1 / -1;
    margin: 0 0 14px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-soft);
}

.chart-area {
    position: relative;
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    height: 240px;
    border-bottom: 1.5px solid rgba(24, 60, 54, 0.28);
}

.chart-line {
    position: absolute;
    right: 0;
    bottom: calc(var(--i) * 25%);
    left: 0;
    height: 0;
    border-top: 1px dashed var(--rule);
}

.bar-col {
    position: relative;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    height: 100%;
}

.bar {
    position: relative;
    width: min(58px, 62%);
    height: max(var(--h), 5px);
    background: var(--forest);
    border-radius: 12px 12px 4px 4px;
    transform-origin: bottom;
    animation: grow 700ms var(--ease) both;
    transition: background var(--t-fast) ease;
}

.bar-col:nth-child(2) .bar { animation-delay: 60ms; }
.bar-col:nth-child(3) .bar { animation-delay: 120ms; }
.bar-col:nth-child(4) .bar { animation-delay: 180ms; }
.bar-col:nth-child(5) .bar { animation-delay: 240ms; }
.bar-col:nth-child(6) .bar { animation-delay: 300ms; }

@keyframes grow {
    from { transform: scaleY(0); }
    to   { transform: scaleY(1); }
}

.bar.is-current { background: var(--gold); }
.bar.is-zero { background: rgba(24, 60, 54, 0.14); }
.bar:hover, .bar:focus-visible { background: var(--emerald); outline-offset: 4px; }
.bar.is-current:hover, .bar.is-current:focus-visible { background: #A5864F; }

.bar-val {
    position: absolute;
    bottom: calc(100% + 6px);
    left: 50%;
    transform: translateX(-50%);
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 800;
    color: var(--emerald);
}

.bar::after {
    content: attr(data-tip);
    position: absolute;
    bottom: calc(100% + 32px);
    left: 50%;
    z-index: 3;
    padding: 8px 12px;
    white-space: nowrap;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 600;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 10px;
    box-shadow: 0 10px 24px -10px rgba(24, 60, 54, 0.6);
    opacity: 0;
    visibility: hidden;
    transform: translateX(-50%) translateY(4px);
    pointer-events: none;
    transition: opacity var(--t-fast) ease, transform var(--t-fast) ease, visibility 0s linear var(--t-fast);
}

.bar:hover::after,
.bar:focus-visible::after {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%);
    transition: opacity var(--t-fast) ease, transform var(--t-fast) ease, visibility 0s;
}

.bar-col:first-child .bar::after { left: 0; transform: translateY(4px); }
.bar-col:first-child .bar:hover::after,
.bar-col:first-child .bar:focus-visible::after { transform: none; }
.bar-col:last-child .bar::after { right: 0; left: auto; transform: translateY(4px); }
.bar-col:last-child .bar:hover::after,
.bar-col:last-child .bar:focus-visible::after { transform: none; }

.chart-x {
    grid-column: 2;
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    margin-top: 12px;
}

.chart-x span {
    text-align: center;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-soft);
}

.chart-x span:last-child { color: #8D7243; }

.chart-empty {
    margin: 24px 28px 28px;
    padding: 44px 24px;
    text-align: center;
    background: rgba(231, 224, 210, 0.45);
    border-radius: 18px;
}

.chart-empty strong {
    display: block;
    margin-bottom: 6px;
    font-family: var(--serif);
    font-size: 20px;
    font-weight: 600;
    color: var(--emerald);
}

.chart-empty p {
    max-width: 420px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.65;
    color: var(--text-soft);
}

.table-wrap {
    margin-top: 20px;
    overflow-x: auto;
}

.table {
    width: 100%;
    min-width: 760px;
    border-collapse: collapse;
}

.table th {
    padding: 14px 20px;
    text-align: left;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-soft);
    background: rgba(231, 224, 210, 0.4);
    border-top: 1px solid var(--rule);
    border-bottom: 1px solid var(--rule);
}

.table th:first-child, .table td:first-child { padding-left: 28px; }
.table th:last-child, .table td:last-child { padding-right: 28px; }

.table td {
    padding: 18px 20px;
    vertical-align: middle;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text);
    border-bottom: 1px solid var(--rule);
}

.table tbody tr { transition: background var(--t-fast) ease; }
.table tbody tr:hover { background: rgba(250, 248, 243, 0.8); }
.table tbody tr:last-child td { border-bottom: 0; }

.col-title { width: 38%; }

.row-title {
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    font-family: var(--sans);
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
    color: var(--emerald);
    text-decoration: none;
    overflow-wrap: anywhere;
    transition: color var(--t-fast) ease;
}

.row-title:hover { color: var(--forest); }

.cat-tag {
    display: inline-block;
    padding: 4px 12px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 600;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 999px;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 5px 12px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    border-radius: 999px;
}

.badge::before {
    content: "";
    width: 6px;
    height: 6px;
    background: currentColor;
    border-radius: 50%;
}

.badge-published { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.badge-draft { color: #7A6130; background: rgba(185, 154, 100, 0.24); }
.badge-other { color: var(--text-soft); background: rgba(104, 115, 110, 0.14); }

.row-date { white-space: nowrap; color: var(--text-soft); }

.row-actions {
    display: flex;
    align-items: center;
    gap: 4px 6px;
}

.row-actions form { margin: 0; }

.act {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    padding: 0 12px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: transparent;
    border: 1px solid var(--rule);
    border-radius: 999px;
    cursor: pointer;
    transition: color var(--t-fast) ease, background var(--t-fast) ease, border-color var(--t-fast) ease;
}

.act svg { width: 14px; height: 14px; }

.act:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.act-danger { color: #A3321F; border-color: rgba(163, 50, 31, 0.25); }

.act-danger:hover {
    color: var(--white);
    background: #A3321F;
    border-color: #A3321F;
}

.empty {
    margin: 24px 28px 28px;
    padding: 52px 24px;
    text-align: center;
    background: rgba(231, 224, 210, 0.45);
    border-radius: 18px;
}

.empty strong {
    display: block;
    margin-bottom: 6px;
    font-family: var(--serif);
    font-size: 22px;
    font-weight: 600;
    color: var(--emerald);
}

.empty p {
    max-width: 420px;
    margin: 0 auto 20px;
    font-family: var(--body);
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
}

.pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 28px 24px;
    border-top: 1px solid var(--rule);
}

.pg-numbers {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pg-gap { min-width: 24px; text-align: center; color: var(--text-soft); }

.pg-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    font-family: var(--sans);
    font-size: 13.5px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: color var(--t-fast) ease, background var(--t-fast) ease, border-color var(--t-fast) ease;
}

a.pg-link:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.pg-link.is-current {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}

.pg-link.is-disabled {
    color: var(--text-soft);
    background: transparent;
    opacity: 0.55;
    cursor: not-allowed;
}

.pg-status {
    display: none;
    font-family: var(--body);
    font-size: 13px;
    color: var(--text-soft);
    text-align: center;
}

.scrim { display: none; }

@media (max-width: 1100px) {
    .content { padding: 28px 28px 64px; }
    .welcome { padding: 36px 32px 34px; }
}

@media (max-width: 959px) {
    .layout { grid-template-columns: minmax(0, 1fr); }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 40;
        width: min(310px, 88vw);
        height: auto;
        visibility: hidden;
        transform: translateX(-100%);
        transition: transform var(--t-ui) var(--ease), visibility 0s linear var(--t-ui);
    }

    .sidebar.is-open {
        visibility: visible;
        transform: none;
        transition: transform var(--t-ui) var(--ease);
    }

    .sidebar-close { display: inline-flex; }

    .scrim {
        display: block;
        position: fixed;
        inset: 0;
        z-index: 30;
        background: rgba(16, 43, 38, 0.55);
        opacity: 0;
        visibility: hidden;
        transition: opacity var(--t-ui) ease, visibility 0s linear var(--t-ui);
    }

    .scrim.is-visible {
        opacity: 1;
        visibility: visible;
        transition: opacity var(--t-ui) ease;
    }

    .topbar { display: flex; }
}

@media (max-width: 860px) {
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .stats .stat:last-child { grid-column: 1 / -1; }
}

@media (max-width: 720px) {
    .content { padding: 20px 16px 56px; }
    .welcome { padding: 30px 22px 28px; border-radius: 24px; }
    .welcome::before { width: 300px; height: 300px; top: -120px; right: -120px; }
    .welcome::after { display: none; }
    .welcome-actions .btn { flex: 1 1 100%; }

    .stats { grid-template-columns: minmax(0, 1fr); gap: 14px; }
    .stat { padding: 20px; }

    .box { border-radius: 20px; }
    .box-head { padding: 20px 20px 0; }
    .box-title { font-size: 21px; }

    .chart { grid-template-columns: 26px minmax(0, 1fr); gap: 0 6px; padding: 22px 14px 18px 16px; }
    .chart-y, .chart-area { height: 200px; }
    .bar { width: min(36px, 70%); }
    .chart-x span { font-size: 11.5px; }
    .chart-empty { margin: 18px 16px 20px; padding: 34px 18px; }

    .table { min-width: 0; }

    .table thead {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
    }

    .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

    .table tr { padding: 16px 20px; border-bottom: 1px solid var(--rule); }
    .table tbody tr:last-child { border-bottom: 0; }
    .table tbody tr:hover { background: transparent; }

    .table td,
    .table th:first-child, .table td:first-child,
    .table th:last-child, .table td:last-child {
        padding: 6px 0;
        border: 0;
    }

    .table td {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .table td::before {
        content: attr(data-label);
        flex: none;
        font-family: var(--sans);
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-soft);
    }

    .table td.col-title { display: block; width: 100%; padding-bottom: 10px; }
    .table td.col-title::before { display: none; }
    .table td.col-actions { padding-top: 12px; }
    .table td.col-actions::before { display: none; }
    .row-actions { width: 100%; }
    .row-actions .act { flex: 1 1 0; justify-content: center; }
    .row-actions form { flex: 1 1 0; display: flex; }
    .row-actions form .act { flex: 1 1 100%; }

    .empty { margin: 18px 16px 20px; padding: 40px 18px; }

    .pagination { padding: 18px 16px 20px; }
    .pg-numbers { display: none; }
    .pg-status { display: block; }
    .pg-text { display: none; }
    .pg-link.pg-step { min-width: 46px; padding: 0 12px; }
}

@media (max-width: 380px) {
    .content { padding: 16px 12px 48px; }
    .welcome-title { font-size: 27px; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }

    .stat:hover { transform: none; }
}
    </style>
</head>
<body>

    @php
        $user = auth()->user();
        $roleLabel = ['admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pengguna'][$user->role] ?? ucfirst($user->role);
        $initial = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 1));
        $today = now()->locale('id')->translatedFormat('l, d F Y');

        $monthlyCounts = \App\Models\Article::where('user_id', $user->id)
            ->whereNotNull('created_at')
            ->where('created_at', '>=', now()->startOfMonth()->subMonths(5))
            ->get(['id', 'created_at'])
            ->groupBy(fn ($row) => $row->created_at->format('Y-m'))
            ->map->count();

        $months = collect(range(5, 0))->map(function ($offset) use ($monthlyCounts) {
            $date = now()->startOfMonth()->subMonths($offset)->locale('id');

            return [
                'label' => $date->translatedFormat('M'),
                'full' => $date->translatedFormat('F Y'),
                'count' => (int) ($monthlyCounts[$date->format('Y-m')] ?? 0),
            ];
        });

        $chartTotal = $months->sum('count');
        $chartStep = max(1, (int) ceil(max(1, $months->max('count')) / 4));
        $chartTop = $chartStep * 4;
    @endphp

    <div class="layout">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi penulis">
            <div class="sidebar-top">
                <a class="brand" href="/">
                    <span class="brand-name">Ruang<span>Kabar</span></span>
                    <span class="brand-sub">Panel Penulis</span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
                </button>
            </div>

            <nav class="side-nav" aria-label="Menu penulis">
                <p class="nav-label">Menu</p>

                <ul class="nav-list">
                    <li>
                        <a class="nav-link {{ request()->is('penulis/dashboard') ? 'is-active' : '' }}" href="/penulis/dashboard" {!! request()->is('penulis/dashboard') ? 'aria-current="page"' : '' !!}>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('articles') ? 'is-active' : '' }}" href="{{ route('articles.index') }}" {!! request()->is('articles') ? 'aria-current="page"' : '' !!}>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h9l4 4v14H6z"/><path d="M15 3v4h4M9 12h7M9 16h7"/></svg>
                            Daftar Artikel
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('articles/create') ? 'is-active' : '' }}" href="{{ route('articles.create') }}" {!! request()->is('articles/create') ? 'aria-current="page"' : '' !!}>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 20l4-1 11-11-3-3L5 16z"/><path d="M14 7l3 3"/></svg>
                            Tulis Artikel
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="account">
                <div class="account-head">
                    <span class="avatar" aria-hidden="true">{{ $initial }}</span>
                    <div class="account-text">
                        <span class="account-name">{{ $user->name }}</span>
                        <span class="account-role">{{ $roleLabel }}</span>
                    </div>
                </div>

                <div class="account-actions">
                    <a class="account-btn" href="/">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11l8-7 8 7v9h-5v-6H9v6H4z"/></svg>
                        Beranda
                    </a>

                    <form action="/logout" method="POST">
                        @csrf
                        <button class="account-btn" type="submit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4H5v16h4M16 8l4 4-4 4M20 12H9"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        <div class="main">

            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 6h14M3 10h14M3 14h14"/></svg>
                    </button>

                    <a class="topbar-brand" href="/">Ruang<span>Kabar</span></a>
                </div>

                <span class="avatar" aria-hidden="true">{{ $initial }}</span>
            </header>

            <main class="content">

                <section class="welcome" aria-labelledby="welcome-title">
                    <div class="welcome-inner">
                        <span class="welcome-label">Panel Penulis</span>

                        <h1 class="welcome-title" id="welcome-title">Selamat datang, {{ $user->name }}!</h1>

                        <p class="welcome-meta">
                            <span>Anda login sebagai <strong>{{ $roleLabel }}</strong></span>
                            <span class="dot" aria-hidden="true"></span>
                            <time datetime="{{ now()->toDateString() }}">{{ $today }}</time>
                        </p>

                        <div class="welcome-actions">
                            <a class="btn btn-gold" href="{{ route('articles.create') }}">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg>
                                Tulis Artikel Baru
                            </a>
                            <a class="btn btn-line" href="/">Lihat Beranda</a>
                        </div>
                    </div>
                </section>

                <section class="stats" aria-label="Ringkasan artikel Anda">
                    <article class="box stat">
                        <div>
                            <span class="stat-label">Total Artikel</span>
                            <span class="stat-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
                            <span class="stat-note">Seluruh artikel yang Anda tulis</span>
                        </div>
                        <span class="stat-icon tone-emerald" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h9l4 4v14H6z"/><path d="M15 3v4h4M9 12h7M9 16h7"/></svg>
                        </span>
                    </article>

                    <article class="box stat">
                        <div>
                            <span class="stat-label">Dipublikasikan</span>
                            <span class="stat-value">{{ number_format($publishedArticles, 0, ',', '.') }}</span>
                            <span class="stat-note">Sudah tayang di portal</span>
                        </div>
                        <span class="stat-icon tone-forest" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l3 3 5-6"/></svg>
                        </span>
                    </article>

                    <article class="box stat">
                        <div>
                            <span class="stat-label">Draft</span>
                            <span class="stat-value">{{ number_format($draftArticles, 0, ',', '.') }}</span>
                            <span class="stat-note">Belum dipublikasikan</span>
                        </div>
                        <span class="stat-icon tone-gold" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4L19 9l-4-4L4 16z"/><path d="M13 7l4 4"/></svg>
                        </span>
                    </article>
                </section>

                <section class="box section" aria-labelledby="chart-title">
                    <div class="box-head">
                        <div>
                            <h2 class="box-title" id="chart-title">Produktivitas Artikel</h2>
                            <p class="box-sub">Jumlah artikel yang Anda buat setiap bulan, enam bulan terakhir</p>
                        </div>

                        <span class="pill">{{ $chartTotal }} artikel</span>
                    </div>

                    @if ($chartTotal > 0)
                        <div class="chart" role="group" aria-label="Grafik batang jumlah artikel per bulan">
                            <p class="chart-y-title">Jumlah artikel</p>

                            <div class="chart-y" aria-hidden="true">
                                @foreach (range(0, 4) as $i)
                                    <span style="--i: {{ $i }}">{{ $i * $chartStep }}</span>
                                @endforeach
                            </div>

                            <div class="chart-area">
                                @foreach (range(1, 4) as $i)
                                    <span class="chart-line" style="--i: {{ $i }}" aria-hidden="true"></span>
                                @endforeach

                                @foreach ($months as $month)
                                    <div class="bar-col">
                                        <div
                                            class="bar {{ $loop->last ? 'is-current' : '' }} {{ $month['count'] === 0 ? 'is-zero' : '' }}"
                                            style="--h: {{ round($month['count'] / $chartTop * 100, 2) }}%"
                                            tabindex="0"
                                            role="img"
                                            aria-label="{{ $month['full'] }}: {{ $month['count'] }} artikel"
                                            data-tip="{{ $month['full'] }}: {{ $month['count'] }} artikel"
                                        >
                                            <span class="bar-val" aria-hidden="true">{{ $month['count'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="chart-x" aria-hidden="true">
                                @foreach ($months as $month)
                                    <span>{{ $month['label'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="chart-empty">
                            <strong>Belum ada data produktivitas</strong>
                            <p>Grafik akan muncul setelah Anda menulis artikel dalam enam bulan terakhir.</p>
                        </div>
                    @endif
                </section>

                <section class="box section" aria-labelledby="posts-title">
                    <div class="box-head">
                        <h2 class="box-title" id="posts-title">Artikel Terbaru</h2>

                        <a class="link-more" href="{{ route('articles.index') }}">
                            Lihat Semua Artikel
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                        </a>
                    </div>

                    @if ($articles->count())
                        <div class="table-wrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul Artikel</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td class="col-title" data-label="Judul">
                                                <a class="row-title" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                            </td>

                                            <td data-label="Kategori">
                                                <span class="cat-tag">{{ $article->category->name ?? '-' }}</span>
                                            </td>

                                            <td data-label="Status">
                                                @if ($article->status === 'published')
                                                    <span class="badge badge-published">Dipublikasikan</span>
                                                @elseif ($article->status === 'draft')
                                                    <span class="badge badge-draft">Draft</span>
                                                @else
                                                    <span class="badge badge-other">{{ ucfirst($article->status) }}</span>
                                                @endif
                                            </td>

                                            <td class="row-date" data-label="Tanggal">
                                                @if ($article->created_at)
                                                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d M Y') }}</time>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="col-actions" data-label="Aksi">
                                                <div class="row-actions">
                                                    <a class="act" href="{{ route('articles.show', $article) }}">
                                                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                                        Lihat
                                                    </a>

                                                    <a class="act" href="{{ route('articles.edit', $article) }}">
                                                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 17l3.5-.8L16 6.7 13.3 4 3.8 13.5z"/><path d="M11.5 5.8l2.7 2.7"/></svg>
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('articles.destroy', $article) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="act act-danger" type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h12M8 6V4h4v2M6 6l.7 10h6.6L14 6"/></svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($articles->hasPages())
                            @php
                                $current = $articles->currentPage();
                                $last = $articles->lastPage();
                                $pages = collect([1, $last, $current - 1, $current, $current + 1])
                                    ->filter(fn ($page) => $page >= 1 && $page <= $last)
                                    ->unique()
                                    ->sort()
                                    ->values();
                            @endphp

                            <nav class="pagination" aria-label="Navigasi halaman">
                                @if ($articles->onFirstPage())
                                    <span class="pg-link pg-step is-disabled" aria-disabled="true" aria-label="Halaman sebelumnya">
                                        <span aria-hidden="true">&larr;</span><span class="pg-text">Sebelumnya</span>
                                    </span>
                                @else
                                    <a class="pg-link pg-step" href="{{ $articles->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">
                                        <span aria-hidden="true">&larr;</span><span class="pg-text">Sebelumnya</span>
                                    </a>
                                @endif

                                <ul class="pg-numbers">
                                    @foreach ($pages as $page)
                                        @if (! $loop->first && $page - $pages[$loop->index - 1] > 1)
                                            <li class="pg-gap" aria-hidden="true">&hellip;</li>
                                        @endif
                                        <li>
                                            @if ($page === $current)
                                                <span class="pg-link is-current" aria-current="page">{{ $page }}</span>
                                            @else
                                                <a class="pg-link" href="{{ $articles->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                                <span class="pg-status">Halaman {{ $current }} dari {{ $last }}</span>

                                @if ($articles->hasMorePages())
                                    <a class="pg-link pg-step" href="{{ $articles->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">
                                        <span class="pg-text">Berikutnya</span><span aria-hidden="true">&rarr;</span>
                                    </a>
                                @else
                                    <span class="pg-link pg-step is-disabled" aria-disabled="true" aria-label="Halaman berikutnya">
                                        <span class="pg-text">Berikutnya</span><span aria-hidden="true">&rarr;</span>
                                    </span>
                                @endif
                            </nav>
                        @endif
                    @else
                        <div class="empty">
                            <strong>Belum ada artikel</strong>
                            <p>Anda belum memiliki artikel. Mulai tulis artikel pertama Anda.</p>
                            <a class="btn btn-forest" href="{{ route('articles.create') }}">Tulis Artikel Pertama</a>
                        </div>
                    @endif
                </section>

            </main>

        </div>

    </div>

    <script>
(function () {
    var sidebar = document.getElementById('sidebar');
    var scrim = document.getElementById('scrim');
    var toggle = document.getElementById('menuToggle');
    var closeBtn = document.getElementById('sidebarClose');
    if (!sidebar || !scrim || !toggle || !closeBtn) { return; }

    function openMenu() {
        sidebar.classList.add('is-open');
        scrim.classList.add('is-visible');
        document.body.classList.add('menu-open');
        toggle.setAttribute('aria-expanded', 'true');
        closeBtn.focus();
    }

    function closeMenu(returnFocus) {
        sidebar.classList.remove('is-open');
        scrim.classList.remove('is-visible');
        document.body.classList.remove('menu-open');
        toggle.setAttribute('aria-expanded', 'false');
        if (returnFocus) { toggle.focus(); }
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', function () { closeMenu(true); });
    scrim.addEventListener('click', function () { closeMenu(true); });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && sidebar.classList.contains('is-open')) {
            closeMenu(true);
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 960 && sidebar.classList.contains('is-open')) {
            closeMenu(false);
        }
    });
})();
    </script>

</body>
</html>