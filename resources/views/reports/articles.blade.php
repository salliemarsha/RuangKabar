<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Artikel - RuangKabar</title>

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
    --sidebar-w: 268px;
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
    padding: 20px 16px 16px;
    overflow-y: auto;
    color: var(--on-dark);
    background: var(--emerald);
}

.sidebar-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 4px 6px 20px;
    border-bottom: 1px solid rgba(250, 248, 243, 0.1);
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    text-decoration: none;
}

.brand-mark {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    font-family: var(--serif);
    font-size: 17px;
    font-weight: 600;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 14px;
}

.brand-name {
    display: block;
    font-size: 21px;
    font-weight: 800;
    letter-spacing: -0.03em;
    line-height: 1.1;
    color: var(--ivory);
}

.brand-name span { color: var(--gold); }

.brand-sub {
    display: block;
    margin-top: 3px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.14em;
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

.side-nav { flex: 1; padding-top: 18px; }

.nav-label {
    margin: 18px 0 8px;
    padding: 0 10px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--gold);
}

.nav-label:first-child { margin-top: 0; }

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
    padding: 6px 10px 6px 6px;
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    border-radius: 14px;
    transition: color var(--t-fast) ease, background var(--t-fast) ease;
}

.nav-ico {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(250, 248, 243, 0.08);
    border-radius: 11px;
    transition: background var(--t-fast) ease, color var(--t-fast) ease;
}

.nav-ico svg { width: 18px; height: 18px; }

.nav-link:hover {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.06);
}

.nav-link.is-active {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.12);
}

.nav-link.is-active .nav-ico { color: var(--emerald); background: var(--gold); }

.nav-link.is-active::before {
    content: "";
    position: absolute;
    top: 50%;
    left: -16px;
    width: 4px;
    height: 24px;
    background: var(--gold);
    border-radius: 0 4px 4px 0;
    transform: translateY(-50%);
}

.sidebar-foot {
    margin-top: 16px;
    padding-top: 14px;
    border-top: 1px solid rgba(250, 248, 243, 0.1);
}

.main { min-width: 0; }

.topbar {
    position: sticky;
    top: 0;
    z-index: 20;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    min-height: 80px;
    padding: 12px 40px;
    background: rgba(250, 248, 243, 0.96);
    border-bottom: 1px solid var(--rule);
}

.topbar::after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 96px;
    height: 2px;
    background: var(--gold);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.menu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    flex: none;
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

.crumbs {
    display: flex;
    flex-wrap: wrap;
    gap: 0 10px;
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-soft);
}

.crumbs li + li::before {
    content: "/";
    margin-right: 10px;
    color: rgba(24, 60, 54, 0.35);
}

.crumbs li:last-child { font-weight: 700; color: var(--emerald); }

.topbar-right {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: none;
}

.site-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 4px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
}

.site-link svg { width: 14px; height: 14px; }
.site-link:hover { text-decoration: underline; text-underline-offset: 4px; }

.user-chip {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 5px 16px 5px 5px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
}

.avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    font-size: 14px;
    font-weight: 800;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
}

.user-text { line-height: 1.2; min-width: 0; }

.user-name {
    display: block;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--emerald);
}

.user-role {
    display: block;
    margin-top: 2px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
}

.logout-form { margin: 0; }

.logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 46px;
    padding: 0 20px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--ivory);
    background: var(--emerald);
    border: 0;
    border-radius: 999px;
    cursor: pointer;
    transition: background var(--t-fast) ease, transform 120ms ease;
}

.logout-btn svg { width: 16px; height: 16px; }
.logout-btn:hover { background: var(--forest); }
.logout-btn:active { transform: scale(0.97); }

.content {
    max-width: 1240px;
    margin: 0 auto;
    padding: 28px 40px 72px;
}

@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: none; }
}

.hero {
    position: relative;
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 28px;
    overflow: hidden;
    padding: 40px 44px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 28px;
    animation: rise 520ms var(--ease) both;
}

.hero::before {
    content: "";
    position: absolute;
    top: -170px;
    right: -100px;
    width: 440px;
    height: 440px;
    background: var(--forest);
    opacity: 0.42;
    border-radius: 50%;
}

.hero::after {
    content: "";
    position: absolute;
    right: 70px;
    bottom: -80px;
    width: 180px;
    height: 180px;
    border: 1.5px solid rgba(185, 154, 100, 0.4);
    border-radius: 50%;
}

.hero-main { position: relative; z-index: 1; max-width: 640px; }

.hero-label {
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

.hero-label::before {
    content: "";
    width: 7px;
    height: 7px;
    background: var(--gold);
    border-radius: 50%;
}

.hero-title {
    margin: 0 0 12px;
    font-family: var(--serif);
    font-size: clamp(32px, 4vw, 48px);
    font-weight: 600;
    line-height: 1.1;
    letter-spacing: -0.015em;
}

.hero-text {
    margin: 0 0 8px;
    font-family: var(--body);
    font-size: 15.5px;
    line-height: 1.7;
    color: var(--on-dark);
}

.hero-period {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0 0 24px;
    font-size: 13px;
    font-weight: 700;
    color: var(--gold);
}

.hero-period svg { width: 15px; height: 15px; }

.hero-actions { display: flex; flex-wrap: wrap; gap: 10px 12px; }

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
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.28);
}

.btn-line:hover { background: rgba(250, 248, 243, 0.2); }

.btn-forest { color: var(--white); background: var(--forest); }
.btn-forest:hover { background: var(--emerald); }

.date-card {
    position: relative;
    z-index: 1;
    display: flex;
    flex: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    align-self: center;
    width: 176px;
    padding: 22px 16px;
    text-align: center;
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 22px;
}

.date-day {
    font-family: var(--serif);
    font-size: 54px;
    font-weight: 600;
    line-height: 1;
    color: var(--gold);
}

.date-month {
    margin-top: 8px;
    font-size: 14px;
    font-weight: 700;
    color: var(--ivory);
}

.date-week {
    margin-top: 4px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--on-dark);
}

.stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-top: 22px;
}

.box {
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 24px;
}

.stat {
    display: flex;
    flex-direction: column;
    min-height: 196px;
    padding: 22px;
    animation: rise 520ms var(--ease) both;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease;
}

.stat:nth-child(2) { animation-delay: 60ms; }
.stat:nth-child(3) { animation-delay: 120ms; }
.stat:nth-child(4) { animation-delay: 180ms; }

.stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 34px -24px rgba(24, 60, 54, 0.45);
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    margin-bottom: 20px;
    border-radius: 14px;
}

.stat-icon svg { width: 21px; height: 21px; }

.tone-forest { color: var(--forest); background: rgba(55, 107, 92, 0.13); }
.tone-gold { color: #8D7243; background: rgba(185, 154, 100, 0.22); }
.tone-emerald { color: var(--emerald); background: rgba(24, 60, 54, 0.09); }

.stat-label {
    display: block;
    margin-bottom: 8px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-soft);
}

.stat-value {
    display: block;
    font-family: var(--serif);
    font-size: 44px;
    font-weight: 600;
    line-height: 1;
    letter-spacing: -0.02em;
    color: var(--emerald);
}

.stat-note {
    display: block;
    margin-top: auto;
    padding-top: 14px;
    font-family: var(--body);
    font-size: 12.5px;
    color: var(--text-soft);
}

.stat-dark {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}

.stat-dark .stat-icon { color: var(--emerald); background: var(--gold); }
.stat-dark .stat-label { color: var(--on-dark); }
.stat-dark .stat-value { color: var(--ivory); }
.stat-dark .stat-note { color: rgba(250, 248, 243, 0.62); }

.charts {
    display: grid;
    grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr);
    gap: 18px;
    margin-top: 18px;
}

.panel { animation: rise 520ms var(--ease) 120ms both; }

.box-head {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px 20px;
    padding: 26px 28px 0;
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

.box-sub {
    margin: 6px 0 0;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.chart {
    display: grid;
    grid-template-columns: 30px minmax(0, 1fr);
    gap: 0 12px;
    padding: 30px 28px 26px;
}

.chart-y {
    position: relative;
    height: 250px;
}

.chart-y span {
    position: absolute;
    right: 0;
    bottom: calc(var(--i) * 25%);
    transform: translateY(50%);
    font-family: var(--body);
    font-size: 12.5px;
    color: var(--text-soft);
}

.chart-area {
    position: relative;
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    height: 250px;
    border-bottom: 1px dashed rgba(24, 60, 54, 0.22);
}

.chart-line {
    position: absolute;
    right: 0;
    bottom: calc(var(--i) * 25%);
    left: 0;
    height: 0;
    border-top: 1px dashed rgba(24, 60, 54, 0.14);
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
    width: min(46px, 56%);
    height: max(var(--h), 5px);
    background: var(--forest);
    border-radius: 8px 8px 3px 3px;
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

.bar.is-zero { background: var(--sand); }
.bar:hover, .bar:focus-visible { background: var(--emerald); outline-offset: 4px; }

.bar-val {
    position: absolute;
    bottom: calc(100% + 6px);
    left: 50%;
    transform: translateX(-50%);
    font-size: 12.5px;
    font-weight: 800;
    color: var(--emerald);
}

.bar.is-zero .bar-val { display: none; }

.bar::after {
    content: attr(data-tip);
    position: absolute;
    bottom: calc(100% + 32px);
    left: 50%;
    z-index: 3;
    padding: 8px 12px;
    white-space: nowrap;
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
    font-weight: 600;
    color: var(--text-soft);
}

.donut-wrap { padding: 20px 28px 0; }

.donut {
    position: relative;
    width: min(100%, 230px);
    margin: 0 auto;
}

.donut svg { display: block; width: 100%; height: auto; }

.donut-center {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.donut-total {
    font-family: var(--serif);
    font-size: 40px;
    font-weight: 600;
    line-height: 1;
    color: var(--emerald);
}

.donut-unit {
    margin-top: 6px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-soft);
}

.legend {
    margin: 22px 0 0;
    padding: 0 28px 24px;
    list-style: none;
}

.legend li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 0;
    border-bottom: 1px solid var(--rule);
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}

.legend li:last-child { border-bottom: 0; }

.legend-dot { width: 9px; height: 9px; border-radius: 50%; }
.legend-count { margin-left: auto; font-weight: 800; color: var(--emerald); }
.legend-pct { min-width: 42px; text-align: right; font-family: var(--body); font-weight: 500; color: var(--text-soft); }

.table-box { margin-top: 18px; animation: rise 520ms var(--ease) 180ms both; }

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

.table-wrap {
    margin-top: 22px;
    overflow-x: auto;
}

.table {
    width: 100%;
    min-width: 880px;
    border-collapse: collapse;
}

.table th {
    padding: 14px 18px;
    text-align: left;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-soft);
    border-bottom: 1px solid var(--rule);
}

.table th:first-child, .table td:first-child { padding-left: 28px; }
.table th:last-child, .table td:last-child { padding-right: 28px; }

.table td {
    padding: 16px 18px;
    vertical-align: middle;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text);
    border-bottom: 1px solid var(--rule);
}

.table tbody tr { transition: background var(--t-fast) ease; }
.table tbody tr:hover { background: rgba(250, 248, 243, 0.85); }
.table tbody tr:last-child td { border-bottom: 0; }

.col-no { width: 64px; color: var(--text-soft); font-weight: 500; }
.col-title { width: 30%; }

.row-title {
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    font-family: var(--sans);
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.4;
    color: var(--emerald);
    text-decoration: none;
    overflow-wrap: anywhere;
    transition: color var(--t-fast) ease;
}

.row-title:hover { color: var(--forest); }

.row-date { white-space: nowrap; color: var(--text-soft); }

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

.act {
    display: inline-flex;
    align-items: center;
    height: 36px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: color var(--t-fast) ease, background var(--t-fast) ease, border-color var(--t-fast) ease;
}

.act:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.empty {
    margin: 24px 28px 28px;
    padding: 56px 24px;
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
    max-width: 440px;
    margin: 0 auto 20px;
    font-family: var(--body);
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
}

.chart-empty {
    margin: 26px 28px 28px;
    padding: 56px 24px;
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
    max-width: 380px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.65;
    color: var(--text-soft);
}

.print-head { display: none; }

.scrim { display: none; }

@media (max-width: 1180px) {
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .charts { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 959px) {
    .layout { grid-template-columns: minmax(0, 1fr); }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 40;
        width: min(312px, 88vw);
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

    .nav-link.is-active::before { left: -16px; }

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

    .menu-toggle { display: inline-flex; }

    .topbar { padding: 12px 24px; }
    .content { padding: 24px 24px 64px; }
    .hero { padding: 34px 32px; }
    .date-card { display: none; }
}

@media (max-width: 720px) {
    .topbar { padding: 10px 14px; min-height: 72px; }
    .site-link, .user-text { display: none; }
    .user-chip { padding: 5px; }
    .logout-btn { padding: 0 16px; height: 44px; }

    .content { padding: 18px 14px 56px; }
    .hero { padding: 28px 22px; border-radius: 24px; }
    .hero::before { width: 300px; height: 300px; top: -120px; right: -120px; }
    .hero::after { display: none; }
    .hero-actions .btn { flex: 1 1 100%; }

    .stats { gap: 12px; }
    .stat { min-height: 168px; padding: 18px; }
    .stat-value { font-size: 36px; }
    .stat-icon { width: 40px; height: 40px; margin-bottom: 16px; }

    .box { border-radius: 20px; }
    .box-head { padding: 20px 20px 0; }
    .box-title { font-size: 21px; }

    .chart { grid-template-columns: 24px minmax(0, 1fr); gap: 0 6px; padding: 24px 14px 20px 16px; }
    .chart-y, .chart-area { height: 210px; }
    .bar { width: min(32px, 70%); }
    .chart-x span { font-size: 11.5px; }

    .donut-wrap { padding: 16px 20px 0; }
    .legend { padding: 0 20px 20px; }
    .chart-empty { margin: 20px 16px 22px; padding: 40px 18px; }

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

    .table td.col-no { width: 100%; }
    .table td.col-title { display: block; width: 100%; padding-bottom: 10px; }
    .table td.col-title::before { display: none; }
    .table td.col-actions { padding-top: 12px; }
    .table td.col-actions::before { display: none; }
    .table td.col-actions .act { width: 100%; justify-content: center; }

    .empty { margin: 18px 16px 20px; padding: 40px 18px; }
}

@media (max-width: 420px) {
    .stats { grid-template-columns: minmax(0, 1fr); }
    .stat { min-height: 0; }
    .hero-title { font-size: 29px; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }

    .stat:hover { transform: none; }
}

@media print {
    @page { margin: 14mm; }

    html, body { background: #FFFFFF; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .sidebar, .scrim, .topbar, .hero, .no-print, .col-actions { display: none !important; }

    .layout { display: block; min-height: 0; }
    .content { max-width: none; padding: 0; }

    .print-head {
        display: block;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--emerald);
    }

    .print-head strong {
        display: block;
        font-family: var(--serif);
        font-size: 22px;
        color: var(--emerald);
    }

    .print-head span { display: block; margin-top: 4px; font-size: 11px; color: var(--text-soft); }

    .box { border-radius: 12px; break-inside: avoid; }

    .stats { grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; margin-top: 0; }
    .stat { min-height: 0; padding: 14px; }
    .stat-icon { display: none; }
    .stat-value { font-size: 28px; }
    .stat-note { padding-top: 8px; }

    .charts { grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr); gap: 10px; margin-top: 10px; }
    .chart { padding: 20px 18px 16px; }
    .chart-y, .chart-area { height: 190px; }
    .bar::after { display: none; }
    .donut { width: 170px; }
    .box-head { padding: 18px 18px 0; }
    .legend { padding: 0 18px 14px; }

    .table-box { margin-top: 10px; }
    .table-wrap { overflow: visible; }
    .table { min-width: 0; }
    .table thead { display: table-header-group; }
    .table tr { break-inside: avoid; }
    .table th, .table td { padding: 9px 10px; font-size: 11px; }
    .table th:first-child, .table td:first-child { padding-left: 14px; }
    .table th:last-child, .table td:last-child { padding-right: 14px; }
    .row-title { font-size: 11.5px; -webkit-line-clamp: unset; }
    a { color: inherit; text-decoration: none; }
}
    </style>
</head>
<body>

    @php
        $user = auth()->user();
        $initial = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 1));
        $roleLabel = ['admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pengguna'][$user->role] ?? ucfirst($user->role);
        $today = now()->locale('id');

        $dates = $articles->pluck('created_at')->filter();
        $periodStart = $dates->min();
        $periodEnd = $dates->max();

        $months = collect($monthlyLabels)->map(fn ($label, $i) => [
            'label' => explode(' ', $label)[0],
            'full' => $label,
            'count' => (int) ($monthlyData[$i] ?? 0),
        ]);

        $chartSum = $months->sum('count');
        $chartStep = max(1, (int) ceil(max(1, $months->max('count')) / 4));
        $chartTop = $chartStep * 4;

        $statusSum = $publishedArticles + $draftArticles;
        $ringRadius = 78;
        $ringLength = 2 * pi() * $ringRadius;
        $publishedLength = $statusSum > 0 ? $publishedArticles / $statusSum * $ringLength : 0;
        $draftLength = $statusSum > 0 ? $draftArticles / $statusSum * $ringLength : 0;
        $ringGap = ($publishedLength > 0 && $draftLength > 0) ? 3 : 0;
        $publishedPct = $statusSum > 0 ? round($publishedArticles / $statusSum * 100) : null;
        $draftPct = $statusSum > 0 ? round($draftArticles / $statusSum * 100) : null;
    @endphp

    <div class="layout">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi admin">
            <div class="sidebar-top">
                <a class="brand" href="/">
                    <span class="brand-mark" aria-hidden="true">RK</span>
                    <span>
                        <span class="brand-name">Ruang<span>Kabar</span></span>
                        <span class="brand-sub">Panel Admin</span>
                    </span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
                </button>
            </div>

            <nav class="side-nav" aria-label="Menu admin">
                <p class="nav-label">Utama</p>
                <ul class="nav-list">
                    <li>
                        <a class="nav-link" href="/admin/dashboard">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg></span>
                            Dashboard
                        </a>
                    </li>
                </ul>

                <p class="nav-label">Konten</p>
                <ul class="nav-list">
                    <li>
                        <a class="nav-link" href="{{ route('articles.index') }}">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h9l4 4v14H6z"/><path d="M15 3v4h4M9 12h7M9 16h7"/></svg></span>
                            Artikel
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></span>
                            Kategori
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('tags.index') }}">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12V4h8l10 10-8 8z"/><circle cx="7.5" cy="8.5" r="1.2"/></svg></span>
                            Tag
                        </a>
                    </li>
                </ul>

                <p class="nav-label">Pengelolaan</p>
                <ul class="nav-list">
                    <li>
                        <a class="nav-link" href="{{ route('comments.index') }}">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5h16v11H9l-5 4z"/></svg></span>
                            Komentar
                        </a>
                    </li>
                    <li>
                        <a class="nav-link is-active" href="{{ route('reports.articles') }}" aria-current="page">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 20V12M12 20V5M19 20v-9"/></svg></span>
                            Laporan
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 5.2a3 3 0 010 5.6M18 14.4c1.8.7 3 2.5 3 5.6"/></svg></span>
                            Pengguna
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-foot">
                <a class="nav-link" href="/">
                    <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11l8-7 8 7v9h-5v-6H9v6H4z"/></svg></span>
                    Lihat beranda
                </a>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        <div class="main">

            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 6h14M3 10h14M3 14h14"/></svg>
                    </button>

                    <ol class="crumbs">
                        <li>Admin</li>
                        <li>Laporan</li>
                    </ol>
                </div>

                <div class="topbar-right">
                    <a class="site-link" href="/" target="_blank" rel="noopener">
                        Lihat situs
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 2.5h4.5V7M13.5 2.5L7 9M11.5 9.5v3a1 1 0 01-1 1h-7a1 1 0 01-1-1v-7a1 1 0 011-1h3"/></svg>
                    </a>

                    <div class="user-chip">
                        <span class="avatar" aria-hidden="true">{{ $initial }}</span>
                        <span class="user-text">
                            <span class="user-name">{{ $user->name }}</span>
                            <span class="user-role">{{ $roleLabel }}</span>
                        </span>
                    </div>

                    <form class="logout-form" action="/logout" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4H5v16h4M16 8l4 4-4 4M20 12H9"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="content">

                <div class="print-head">
                    <strong>RuangKabar &mdash; Laporan Artikel</strong>
                    <span>Dicetak pada {{ now()->locale('id')->translatedFormat('d F Y, H:i') }}</span>
                </div>

                <section class="hero" aria-labelledby="report-title">
                    <div class="hero-main">
                        <span class="hero-label">Laporan Artikel</span>

                        <h1 class="hero-title" id="report-title">Laporan Artikel</h1>

                        <p class="hero-text">Ringkasan dan perkembangan publikasi berita RuangKabar: jumlah artikel, status terbit, serta tren pembuatan artikel dalam enam bulan terakhir.</p>

                        <p class="hero-period">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="14" height="12.5" rx="2"/><path d="M3 8.5h14M7 3v3M13 3v3"/></svg>
                            @if ($periodStart && $periodEnd)
                                Periode data: {{ $periodStart->locale('id')->translatedFormat('d M Y') }} &ndash; {{ $periodEnd->locale('id')->translatedFormat('d M Y') }}
                            @else
                                Periode data: belum ada artikel
                            @endif
                        </p>

                        <div class="hero-actions no-print">
                            <button class="btn btn-gold" type="button" onclick="window.print()">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.5 7V3h9v4M5.5 14H3.5V8h13v6h-2M5.5 11.5h9V17h-9z"/></svg>
                                Cetak Laporan
                            </button>
                            <a class="btn btn-line" href="/admin/dashboard">Kembali ke Dashboard</a>
                        </div>
                    </div>

                    <div class="date-card" aria-hidden="true">
                        <span class="date-day">{{ $today->format('d') }}</span>
                        <span class="date-month">{{ $today->translatedFormat('F Y') }}</span>
                        <span class="date-week">{{ $today->translatedFormat('l') }}</span>
                    </div>
                </section>

                <section class="stats" aria-label="Ringkasan statistik artikel">
                    <article class="box stat stat-dark">
                        <span class="stat-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h9l4 4v14H6z"/><path d="M15 3v4h4M9 12h7M9 16h7"/></svg>
                        </span>
                        <span class="stat-label">Total Artikel</span>
                        <span class="stat-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
                        <span class="stat-note">Seluruh artikel tersimpan</span>
                    </article>

                    <article class="box stat">
                        <span class="stat-icon tone-forest" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l3 3 5-6"/></svg>
                        </span>
                        <span class="stat-label">Artikel Terbit</span>
                        <span class="stat-value">{{ number_format($publishedArticles, 0, ',', '.') }}</span>
                        <span class="stat-note">Sudah tayang di portal</span>
                    </article>

                    <article class="box stat">
                        <span class="stat-icon tone-gold" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4L19 9l-4-4L4 16z"/><path d="M13 7l4 4"/></svg>
                        </span>
                        <span class="stat-label">Artikel Draft</span>
                        <span class="stat-value">{{ number_format($draftArticles, 0, ',', '.') }}</span>
                        <span class="stat-note">Belum dipublikasikan</span>
                    </article>

                    <article class="box stat">
                        <span class="stat-icon tone-emerald" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 5.2a3 3 0 010 5.6M18 14.4c1.8.7 3 2.5 3 5.6"/></svg>
                        </span>
                        <span class="stat-label">Total Penulis</span>
                        <span class="stat-value">{{ number_format($totalAuthors, 0, ',', '.') }}</span>
                        <span class="stat-note">Penulis yang memiliki artikel</span>
                    </article>
                </section>

                <div class="charts">

                    <section class="box panel" aria-labelledby="trend-title">
                        <div class="box-head">
                            <div>
                                <h2 class="box-title" id="trend-title">Perkembangan Artikel</h2>
                                <p class="box-sub">{{ number_format($chartSum, 0, ',', '.') }} artikel dibuat dalam 6 bulan terakhir</p>
                            </div>
                        </div>

                        @if ($chartSum > 0)
                            <div class="chart" role="group" aria-label="Grafik batang jumlah artikel per bulan">
                                <div class="chart-y" aria-hidden="true">
                                    @foreach (range(0, 4) as $i)
                                        <span style="--i: {{ $i }}">{{ $i * $chartStep }}</span>
                                    @endforeach
                                </div>

                                <div class="chart-area">
                                    @foreach (range(1, 3) as $i)
                                        <span class="chart-line" style="--i: {{ $i }}" aria-hidden="true"></span>
                                    @endforeach

                                    @foreach ($months as $month)
                                        <div class="bar-col">
                                            <div
                                                class="bar {{ $month['count'] === 0 ? 'is-zero' : '' }}"
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
                                <strong>Belum ada data perkembangan</strong>
                                <p>Grafik akan muncul setelah ada artikel yang dibuat dalam enam bulan terakhir.</p>
                            </div>
                        @endif
                    </section>

                    <section class="box panel" aria-labelledby="status-title">
                        <div class="box-head">
                            <div>
                                <h2 class="box-title" id="status-title">Status Artikel</h2>
                                <p class="box-sub">Distribusi seluruh artikel</p>
                            </div>
                        </div>

                        <div class="donut-wrap">
                            <div class="donut" role="img" aria-label="Published {{ $publishedArticles }} artikel, Draft {{ $draftArticles }} artikel">
                                <svg viewBox="0 0 200 200" aria-hidden="true">
                                    <circle cx="100" cy="100" r="{{ $ringRadius }}" fill="none" stroke="#E7E0D2" stroke-width="26"/>
                                    @if ($publishedLength > 0)
                                        <circle cx="100" cy="100" r="{{ $ringRadius }}" fill="none" stroke="#376B5C" stroke-width="26" stroke-dasharray="{{ round(max($publishedLength - $ringGap, 0), 2) }} {{ round($ringLength, 2) }}" transform="rotate(-90 100 100)"/>
                                    @endif
                                    @if ($draftLength > 0)
                                        <circle cx="100" cy="100" r="{{ $ringRadius }}" fill="none" stroke="#B99A64" stroke-width="26" stroke-dasharray="{{ round(max($draftLength - $ringGap, 0), 2) }} {{ round($ringLength, 2) }}" stroke-dashoffset="-{{ round($publishedLength, 2) }}" transform="rotate(-90 100 100)"/>
                                    @endif
                                </svg>

                                <div class="donut-center">
                                    <span class="donut-total">{{ number_format($totalArticles, 0, ',', '.') }}</span>
                                    <span class="donut-unit">Artikel</span>
                                </div>
                            </div>
                        </div>

                        <ul class="legend">
                            <li>
                                <span class="legend-dot" style="background: #376B5C"></span>
                                Published
                                <span class="legend-count">{{ number_format($publishedArticles, 0, ',', '.') }}</span>
                                <span class="legend-pct">{{ $publishedPct !== null ? $publishedPct . '%' : '-' }}</span>
                            </li>
                            <li>
                                <span class="legend-dot" style="background: #B99A64"></span>
                                Draft
                                <span class="legend-count">{{ number_format($draftArticles, 0, ',', '.') }}</span>
                                <span class="legend-pct">{{ $draftPct !== null ? $draftPct . '%' : '-' }}</span>
                            </li>
                        </ul>
                    </section>

                </div>

                <section class="box table-box" aria-labelledby="table-title">
                    <div class="box-head">
                        <div>
                            <h2 class="box-title" id="table-title">Daftar Artikel</h2>
                            <p class="box-sub">Seluruh artikel, dari yang terbaru</p>
                        </div>

                        <span class="pill">{{ number_format($totalArticles, 0, ',', '.') }} artikel</span>
                    </div>

                    @if ($articles->count())
                        <div class="table-wrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Judul Artikel</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th class="col-actions" scope="col">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td class="col-no" data-label="No.">{{ $loop->iteration }}</td>

                                            <td class="col-title" data-label="Judul">
                                                <a class="row-title" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                            </td>

                                            <td data-label="Penulis">{{ $article->user->name ?? '-' }}</td>

                                            <td data-label="Kategori">{{ $article->category->name ?? '-' }}</td>

                                            <td data-label="Status">
                                                @if ($article->status === 'published')
                                                    <span class="badge badge-published">Published</span>
                                                @elseif ($article->status === 'draft')
                                                    <span class="badge badge-draft">Draft</span>
                                                @else
                                                    <span class="badge badge-other">{{ ucfirst($article->status) }}</span>
                                                @endif
                                            </td>

                                            <td class="row-date" data-label="Dibuat">
                                                @if ($article->created_at)
                                                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d M Y') }}</time>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="col-actions" data-label="Aksi">
                                                <a class="act" href="{{ route('articles.show', $article) }}">Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty">
                            <strong>Belum ada data laporan</strong>
                            <p>Laporan akan terisi setelah ada artikel yang tersimpan.</p>
                            <a class="btn btn-forest no-print" href="{{ route('articles.create') }}">Tulis Artikel Pertama</a>
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