
@extends('layouts.dashboard')

@section('title', 'Laporan ' . $report['label'])

@push('styles')
<style>
.crumbs a { color: inherit; text-decoration: none; transition: color var(--t-fast) ease-out; }
.crumbs a:hover { color: var(--forest); }
.crumbs ol { display: flex; flex-wrap: wrap; align-items: center; gap: 0 8px; margin: 0; padding: 0; list-style: none; }
.crumbs li { list-style: none; }
.crumbs li + li::before { content: "/"; margin-right: 8px; color: var(--gold); }
.crumbs li:last-child { color: var(--emerald); font-weight: 700; }

.print-only { display: none; }

.hero-period { display: inline-flex; align-items: center; gap: 8px; margin: 18px 0 0; font-family: var(--body); font-size: 13.5px; font-weight: 600; color: var(--gold); }
.hero-period svg { width: 16px; height: 16px; flex: none; }

.btn--light { color: var(--ivory); background: rgba(250, 248, 243, 0.1); border-color: rgba(250, 248, 243, 0.28); }
.btn--light:hover { color: var(--emerald); background: var(--ivory); border-color: var(--ivory); }

.tabs {
    display: flex;
    gap: 6px;
    margin: 0 0 18px;
    padding: 6px;
    overflow-x: auto;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 20px;
    scrollbar-width: none;
}
.tabs::-webkit-scrollbar { display: none; }

.tab {
    display: inline-flex;
    flex: 1 0 auto;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-height: 48px;
    padding: 0 20px;
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
    color: var(--text-soft);
    text-decoration: none;
    border-radius: 14px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}
.tab svg { width: 18px; height: 18px; flex: none; }
.tab:hover { color: var(--emerald); background: var(--ivory); }
.tab.is-on { color: var(--ivory); background: var(--emerald); }
.tab.is-on svg { color: var(--gold); }

.box { background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }

.filters { margin-bottom: 18px; padding: 22px 24px; }
.filters-form { display: flex; flex-wrap: wrap; align-items: flex-end; gap: 14px 16px; }

.f-field { display: flex; flex-direction: column; gap: 8px; min-width: 0; }
.f-field label { font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-soft); }

.f-control {
    height: 46px;
    min-width: 170px;
    padding: 0 16px;
    font-family: var(--body);
    font-size: 14.5px;
    color: var(--emerald);
    background-color: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 14px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
}

select.f-control {
    padding-right: 42px;
    cursor: pointer;
    -webkit-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
}

.f-control:hover { border-color: rgba(24, 60, 54, 0.3); }
.f-control:focus { outline: none; border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }

.f-actions { display: flex; gap: 10px; margin-left: auto; }
.f-actions .btn { height: 46px; }

.presets { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-top: 18px; padding-top: 18px; border-top: 1px solid var(--rule); }
.presets-label { margin-right: 6px; font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-soft); }

.preset {
    display: inline-flex;
    align-items: center;
    height: 36px;
    padding: 0 16px;
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}
.preset:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }
.preset.is-on { color: var(--emerald); background: rgba(185, 154, 100, 0.28); border-color: var(--gold); }

.stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 18px; }

.stat { display: flex; flex-direction: column; min-width: 0; min-height: 190px; padding: 22px; overflow: hidden; position: relative; }
.stat-icon { display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; margin-bottom: 18px; border-radius: 14px; }
.stat-icon svg { width: 22px; height: 22px; }

.tone-forest { color: var(--forest); background: rgba(55, 107, 92, 0.13); }
.tone-gold { color: #8D7243; background: rgba(185, 154, 100, 0.24); }
.tone-emerald { color: var(--emerald); background: rgba(24, 60, 54, 0.09); }

.stat-label { font-size: 13.5px; font-weight: 600; color: var(--text-soft); }
.stat-value { display: block; margin: 6px 0 0; font-family: var(--serif); font-size: 42px; font-weight: 600; line-height: 1.05; letter-spacing: -0.02em; color: var(--emerald); }
.stat-note { display: block; margin-top: auto; padding-top: 14px; font-family: var(--body); font-size: 12.5px; line-height: 1.5; color: var(--text-soft); }

.stat--dark { background: var(--emerald); border-color: var(--emerald); }
.stat--dark::after { content: ""; position: absolute; top: -50px; right: -50px; width: 140px; height: 140px; background: var(--forest); opacity: 0.45; border-radius: 50%; }
.stat--dark > * { position: relative; z-index: 1; }
.stat--dark .stat-icon { color: var(--emerald); background: var(--gold); }
.stat--dark .stat-label, .stat--dark .stat-note { color: var(--on-dark); }
.stat--dark .stat-value { color: var(--ivory); }

.charts { display: grid; grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr); gap: 16px; margin-bottom: 18px; }
.charts--equal { grid-template-columns: repeat(2, minmax(0, 1fr)); }

.panel { min-width: 0; padding: 26px 28px 28px; }
.panel-head { margin-bottom: 22px; }
.panel-title { margin: 0; font-family: var(--serif); font-size: 22px; font-weight: 600; line-height: 1.25; color: var(--emerald); }
.panel-sub { margin: 6px 0 0; font-family: var(--body); font-size: 13.5px; color: var(--text-soft); }

.chart { display: grid; grid-template-columns: 28px minmax(0, 1fr); gap: 0 10px; }
.chart-y { position: relative; height: 240px; }
.chart-y span { position: absolute; right: 0; bottom: calc(var(--i) * 25%); transform: translateY(50%); font-family: var(--body); font-size: 12px; color: var(--text-soft); }
.chart-area { position: relative; display: grid; grid-template-columns: repeat(var(--n), minmax(0, 1fr)); height: 240px; border-bottom: 1px dashed rgba(24, 60, 54, 0.25); }
.chart-line { position: absolute; right: 0; bottom: calc(var(--i) * 25%); left: 0; height: 0; border-top: 1px dashed rgba(24, 60, 54, 0.12); }
.bar-col { position: relative; display: flex; align-items: flex-end; justify-content: center; height: 100%; }

.bar {
    position: relative;
    width: min(44px, 62%);
    height: max(var(--h), 5px);
    background: var(--forest);
    border-radius: 8px 8px 3px 3px;
    transform-origin: bottom;
    animation: grow 700ms var(--ease) both;
    transition: background var(--t-fast) ease-out;
}
@keyframes grow { from { transform: scaleY(0); } to { transform: scaleY(1); } }

.bar.is-zero { background: var(--sand); }
.bar:hover, .bar:focus-visible { background: var(--emerald); outline-offset: 4px; }
.bar-val { position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%); font-size: 12px; font-weight: 800; color: var(--emerald); }
.bar.is-zero .bar-val { display: none; }

.bar::after {
    content: attr(data-tip);
    position: absolute;
    bottom: calc(100% + 30px);
    left: 50%;
    z-index: 3;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 10px;
    opacity: 0;
    visibility: hidden;
    transform: translateX(-50%) translateY(4px);
    pointer-events: none;
    transition: opacity var(--t-fast) ease-out, transform var(--t-fast) ease-out, visibility 0s linear var(--t-fast);
}
.bar:hover::after, .bar:focus-visible::after { opacity: 1; visibility: visible; transform: translateX(-50%); transition: opacity var(--t-fast) ease-out, transform var(--t-fast) ease-out, visibility 0s; }
.bar-col:first-child .bar::after { left: 0; transform: translateY(4px); }
.bar-col:first-child .bar:hover::after, .bar-col:first-child .bar:focus-visible::after { transform: none; }
.bar-col:last-child .bar::after { right: 0; left: auto; transform: translateY(4px); }
.bar-col:last-child .bar:hover::after, .bar-col:last-child .bar:focus-visible::after { transform: none; }

.chart-x { grid-column: 2; display: grid; grid-template-columns: repeat(var(--n), minmax(0, 1fr)); margin-top: 12px; }
.chart-x span { overflow: hidden; text-align: center; text-overflow: clip; white-space: nowrap; font-size: 12px; font-weight: 600; color: var(--text-soft); }
.chart--many .chart-x span { font-size: 10.5px; }
.chart--many .bar-val { font-size: 10.5px; }

/* Donut chart */
.donut {
    position: relative;
    width: min(100%, 220px);
    aspect-ratio: 1 / 1;
    margin: 24px auto 8px;
}
.donut svg {
    display: block;
    width: 100%;
    height: 100%;
    overflow: visible;
}
.donut-segment {
    cursor: pointer;
    pointer-events: stroke;
    stroke-linecap: butt;
    transition: stroke-width 180ms ease, filter 180ms ease, opacity 180ms ease;
}
.donut-segment:hover,
.donut-segment:focus-visible,
.donut-segment.is-active {
    stroke-width: 32;
    filter: drop-shadow(0 2px 4px rgba(24, 60, 54, 0.25));
    outline: none;
}
.donut-segment:focus-visible { stroke-width: 34; }

.donut-center {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    pointer-events: none;
}
.donut-total { font-family: var(--serif); font-size: 38px; font-weight: 600; line-height: 1; color: var(--emerald); }
.donut-unit { margin-top: 6px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }

.donut-tooltip {
    position: absolute;
    top: -42px;
    left: 50%;
    z-index: 5;
    min-width: 150px;
    max-width: 220px;
    padding: 9px 14px;
    color: var(--ivory);
    background: var(--emerald);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    text-align: center;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translate(-50%, 5px);
    transition: opacity 160ms ease, transform 160ms ease, visibility 160ms ease;
}
.donut-tooltip.is-visible {
    opacity: 1;
    visibility: visible;
    transform: translate(-50%, 0);
}
.donut-tooltip strong { display: block; font-size: 13px; font-weight: 800; }
.donut-tooltip span { display: block; margin-top: 3px; font-size: 11.5px; color: var(--on-dark); white-space: nowrap; }

.legend { margin: 18px 0 0; padding: 0; list-style: none; }
.legend li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 0;
    font-size: 14px;
    font-weight: 600;
    border-bottom: 1px solid var(--rule);
    border-radius: 5px;
    transition: background 160ms ease, padding 160ms ease;
    cursor: pointer;
}
.legend li:last-child { border-bottom: 0; padding-bottom: 0; }
.legend li.is-active { padding-right: 8px; padding-left: 8px; background: rgba(55, 107, 92, 0.08); }
.legend li:focus-visible { outline: 2px solid var(--gold); outline-offset: 3px; }
.legend-dot { flex: none; width: 10px; height: 10px; border-radius: 50%; }
.legend-count { margin-left: auto; font-weight: 800; color: var(--emerald); }
.legend-pct { min-width: 42px; text-align: right; font-family: var(--body); font-weight: 500; color: var(--text-soft); }

.rank { margin: 0; padding: 0; list-style: none; }
.rank li { padding: 12px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.rank li:first-child { padding-top: 0; }
.rank li:last-child { padding-bottom: 0; border-bottom: 0; }
.rank-top { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
.rank-name { font-size: 14.5px; font-weight: 700; color: var(--emerald); overflow-wrap: anywhere; }
.rank-count { flex: none; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.rank-bar { height: 8px; overflow: hidden; background: var(--sand); border-radius: 999px; }
.rank-bar span { display: block; height: 100%; background: linear-gradient(90deg, var(--forest), var(--gold)); border-radius: 999px; }

.chart-empty { padding: 44px 20px; text-align: center; background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); border-radius: 18px; }
.chart-empty strong { display: block; margin-bottom: 6px; font-family: var(--serif); font-size: 19px; font-weight: 600; color: var(--emerald); }
.chart-empty p { max-width: 360px; margin: 0 auto; font-family: var(--body); font-size: 13.5px; line-height: 1.6; color: var(--text-soft); }

.table-box { margin-bottom: 18px; }
.table-head { display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 10px 20px; padding: 26px 28px 0; }
.pill { display: inline-flex; align-items: center; height: 34px; padding: 0 14px; font-size: 12.5px; font-weight: 700; color: var(--forest); background: rgba(55, 107, 92, 0.1); border-radius: 999px; }

.table-wrap { margin-top: 22px; overflow-x: auto; }
.table { width: 100%; min-width: 860px; border-collapse: collapse; }

.table th {
    padding: 14px 18px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
    color: var(--text-soft);
    background: rgba(231, 224, 210, 0.45);
    border-bottom: 1px solid var(--rule);
}
.table td { padding: 15px 18px; vertical-align: middle; font-family: var(--body); font-size: 14px; color: var(--text); border-bottom: 1px solid rgba(24, 60, 54, 0.08); overflow-wrap: anywhere; }
.table th:first-child, .table td:first-child { padding-left: 28px; }
.table th:last-child, .table td:last-child { padding-right: 28px; }
.table tbody tr:last-child td { border-bottom: 0; }
.table tbody tr { transition: background var(--t-fast) ease-out; }
.table tbody tr:hover { background: rgba(231, 224, 210, 0.3); }

.col-no { width: 64px; color: var(--text-soft); }
.col-main { width: 28%; }
.col-wide { width: 30%; }
.col-num { text-align: right; }
.col-date { white-space: nowrap; color: var(--text-soft); }

.row-title { font-family: var(--sans); font-size: 14.5px; font-weight: 700; line-height: 1.4; color: var(--emerald); text-decoration: none; transition: color var(--t-fast) ease-out; }
.row-title:hover { color: var(--forest); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }

.badge { display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; font-family: var(--sans); font-size: 12px; font-weight: 700; white-space: nowrap; border-radius: 999px; }
.badge::before { content: ""; width: 6px; height: 6px; background: currentColor; border-radius: 50%; }
.badge--published, .badge--approved, .badge--penulis { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.badge--draft, .badge--pending, .badge--pengguna { color: #7A6130; background: rgba(185, 154, 100, 0.26); }
.badge--admin { color: var(--ivory); background: var(--emerald); }
.badge--rejected { color: var(--danger); background: var(--danger-soft); }
.badge--other { color: var(--text-soft); background: rgba(104, 115, 110, 0.14); }

.table-empty { margin: 22px 28px 28px; padding: 44px 20px; text-align: center; font-family: var(--body); font-size: 14.5px; color: var(--text-soft); background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); border-radius: 18px; }

@media (prefers-reduced-motion: reduce) {
    .donut-segment,
    .donut-tooltip,
    .legend li { transition: none !important; }
}

@media (max-width: 1180px) {
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .charts, .charts--equal { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 719px) {
    .tab { flex: 0 0 auto; padding: 0 16px; min-height: 44px; }
    .filters { padding: 18px 16px; }
    .f-field, .f-control { width: 100%; min-width: 0; }
    .f-field { flex: 1 1 100%; }
    .f-actions { width: 100%; margin-left: 0; }
    .f-actions .btn { flex: 1; }
    .stats { gap: 12px; }
    .stat { min-height: 0; padding: 18px; }
    .stat-value { font-size: 34px; }
    .panel { padding: 22px 16px 24px; border-radius: 18px; }
    .box { border-radius: 18px; }
    .chart { grid-template-columns: 24px minmax(0, 1fr); gap: 0 6px; }
    .chart-y, .chart-area { height: 200px; }
    .bar { width: min(30px, 70%); }
    .chart-x span { font-size: 10.5px; }
    .table-head { padding: 22px 16px 0; }
    .table { min-width: 0; }
    .table thead { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0, 0, 0, 0); }
    .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
    .table tr { padding: 16px; border-bottom: 1px solid var(--rule); }
    .table tbody tr:last-child { border-bottom: 0; }
    .table td, .table td:first-child, .table td:last-child { padding: 6px 0; border: 0; }
    .table td { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; text-align: right; }
    .table td::before { content: attr(data-label); flex: none; font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; text-align: left; color: var(--text-soft); }
    .table td.col-no { display: none; }
    .table td.col-main { display: block; padding-bottom: 10px; text-align: left; }
    .table td.col-main::before { display: none; }
    .table-empty { margin: 18px 16px 22px; }
}

@media (max-width: 420px) {
    .stats { grid-template-columns: minmax(0, 1fr); }
}

@page { size: A4; margin: 16mm 14mm 18mm; }

@media print {
    html, body { background: #FFFFFF !important; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .skip-link, .dash-header, .sidebar, .scrim, .no-print, .crumbs, .hero, .tabs, .filters, .bar::after, .donut-tooltip { display: none !important; }

    .dash { display: block; min-height: 0; }
    .dash-main { padding: 0; }
    .dash-content { max-width: none; }

    .print-only { display: block; }

    .doc-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 0 0 14px; padding: 0 0 12px; border-bottom: 2.5px solid var(--gold); }
    .doc-brand { display: flex; align-items: center; gap: 12px; }
    .doc-logo { display: flex; align-items: center; justify-content: center; width: 46px; height: 46px; background: var(--emerald); border-radius: 10px; }
    .doc-logo img { display: block; width: 36px; height: 36px; object-fit: contain; }
    .doc-org strong { display: block; font-family: var(--sans); font-size: 17px; font-weight: 800; letter-spacing: -0.02em; color: var(--emerald); }
    .doc-org span { display: block; margin-top: 2px; font-size: 9.5px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }
    .doc-kind { text-align: right; font-size: 9.5px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }

    .doc-title { margin: 0 0 10px; font-family: var(--serif); font-size: 24px; font-weight: 600; line-height: 1.2; color: var(--emerald); }

    .doc-meta { width: 100%; margin: 0 0 14px; border-collapse: collapse; font-size: 10.5px; }
    .doc-meta th { width: 120px; padding: 5px 10px 5px 0; text-align: left; font-weight: 700; color: var(--text-soft); vertical-align: top; }
    .doc-meta td { padding: 5px 0; color: var(--text); }
    .doc-meta tr { border-bottom: 0.5px solid #D9D6CF; }

    .doc-section { margin: 14px 0 6px; font-family: var(--serif); font-size: 14px; font-weight: 600; color: var(--emerald); break-after: avoid; }

    .box { border: 0.75px solid #CFCABD; border-radius: 8px; background: #FFFFFF; }

    .stats { grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 8px; margin-bottom: 10px; }
    .stat { min-height: 0; padding: 10px 12px; break-inside: avoid; }
    .stat--dark { background: #FFFFFF; border: 0.75px solid #CFCABD; }
    .stat--dark::after { display: none; }
    .stat--dark .stat-label, .stat--dark .stat-note { color: var(--text-soft); }
    .stat--dark .stat-value { color: var(--emerald); }
    .stat-icon { display: none; }
    .stat-label { font-size: 9.5px; }
    .stat-value { margin: 2px 0 0; font-size: 22px; }
    .stat-note { padding-top: 4px; font-size: 8.5px; }

    .charts { grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr); gap: 8px; margin-bottom: 10px; break-inside: avoid; }
    .charts--equal { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .panel { padding: 12px 14px 14px; break-inside: avoid; }
    .panel-head { margin-bottom: 10px; }
    .panel-title { font-size: 13px; }
    .panel-sub { margin-top: 2px; font-size: 9px; }
    .chart-y, .chart-area { height: 150px; }
    .chart-y span, .chart-x span, .bar-val { font-size: 8.5px; }
    .donut { width: 130px; margin: 12px auto 4px; }
    .donut-total { font-size: 24px; }
    .donut-unit { font-size: 7.5px; }
    .donut-segment { stroke-width: 26 !important; filter: none !important; }
    .legend { margin-top: 8px; }
    .legend li { padding: 5px 0; font-size: 9.5px; }
    .rank li { padding: 6px 0; }
    .rank-name { font-size: 9.5px; }
    .rank-count { font-size: 8.5px; }
    .rank-bar { height: 6px; }
    .chart-empty { padding: 18px 10px; }
    .chart-empty strong { font-size: 12px; }
    .chart-empty p { font-size: 9px; }

    .table-box { margin-bottom: 10px; }
    .table-head { padding: 12px 14px 0; break-after: avoid; }
    .table-head .panel-title { font-size: 13px; }
    .pill { height: 22px; padding: 0 10px; font-size: 9px; }
    .table-wrap { margin-top: 8px; overflow: visible; }
    .table { min-width: 0; }
    .table thead { display: table-header-group; }
    .table tr { break-inside: avoid; }
    .table th, .table td { padding: 6px 8px; font-size: 9.5px; }
    .table th { font-size: 8.5px; background: #F1ECDF; }
    .table th:first-child, .table td:first-child { padding-left: 12px; }
    .table th:last-child, .table td:last-child { padding-right: 12px; }
    .row-title { font-size: 9.5px; color: var(--text); }
    .badge { padding: 2px 8px; font-size: 8.5px; }
    .table-empty { margin: 8px 12px 12px; padding: 16px; font-size: 10px; }
    a { color: inherit; text-decoration: none; }
}
</style>
@endpush

@section('content')
    @php
        $mUser = auth()->user();

        $icons = [
            'article' => '<path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/>',
            'check' => '<circle cx="10" cy="10" r="7.5"/><path d="M6.5 10.5l2.5 2.5 4.5-5"/>',
            'draft' => '<path d="M13 3.5l3.5 3.5L7 16.5H3.5V13z"/>',
            'users' => '<circle cx="8" cy="7" r="3"/><path d="M2.5 16c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14 4.5a3 3 0 010 5.5M17.5 16c0-2.2-1.2-3.8-3-4.6"/>',
            'pen' => '<path d="M13 3.5l3.5 3.5L7 16.5H3.5V13z"/>',
            'book' => '<path d="M3 4.5h5a2 2 0 012 2V16a2 2 0 00-2-2H3zM17 4.5h-5a2 2 0 00-2 2V16a2 2 0 012-2h5z"/>',
            'shield' => '<path d="M10 2.5l6 2.2v5c0 3.6-2.5 6.2-6 7.8-3.5-1.6-6-4.2-6-7.8v-5z"/><path d="M7.5 10l2 2 3.5-4"/>',
            'comment' => '<path d="M3 4h14v10H9l-4 3v-3H3z"/>',
            'clock' => '<circle cx="10" cy="10" r="7.5"/><path d="M10 5.5V10l3 2"/>',
            'x' => '<circle cx="10" cy="10" r="7.5"/><path d="M7.5 7.5l5 5M12.5 7.5l-5 5"/>',
            'folder' => '<path d="M2.5 6V5a1 1 0 011-1h4l2 2h7a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1z"/>',
            'tag' => '<path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/>',
        ];

        $tabIcons = [
            'artikel' => 'article',
            'pengguna' => 'users',
            'komentar' => 'comment',
            'kategori' => 'folder',
        ];

        $svg = fn ($key) => '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[$key] . '</svg>';

        $fromValue = $from ? $from->toDateString() : '';
        $toValue = $to ? $to->toDateString() : '';
        $isAdmin = $mUser?->role === 'admin';
    @endphp

    <nav class="crumbs no-print" aria-label="Breadcrumb">
        <ol>
            <li><a href="/admin/dashboard">Admin</a></li>
            <li><a href="{{ route('reports.articles') }}">Laporan</a></li>
            <li aria-current="page">{{ $report['label'] }}</li>
        </ol>
    </nav>

    <section class="print-only" aria-hidden="true">
        <div class="doc-head">
            <div class="doc-brand">
                <span class="doc-logo"><img src="{{ asset('images/logo-ruangkabar.png') }}" alt=""></span>
                <span class="doc-org">
                    <strong>RuangKabar</strong>
                    <span>Portal Berita dan Informasi</span>
                </span>
            </div>
            <div class="doc-kind">Dokumen Laporan Resmi</div>
        </div>

        <h1 class="doc-title">{{ $report['title'] }}</h1>

        <table class="doc-meta">
            <tr><th>Jenis laporan</th><td>{{ $report['label'] }}</td></tr>
            <tr><th>Periode</th><td>{{ $periodLabel }}</td></tr>
            <tr><th>Filter</th><td>{{ $filterSummary }}</td></tr>
            <tr><th>Disusun oleh</th><td>{{ $mUser?->name ?? '-' }}</td></tr>
            <tr><th>Tanggal dibuat</th><td>{{ now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB</td></tr>
        </table>

        <h2 class="doc-section">Ringkasan Statistik</h2>
    </section>

    <section class="hero no-print" aria-labelledby="page-title">
        <div class="hero-inner">
            <span class="hero-label">PUSAT LAPORAN RUANGKABAR</span>
            <h1 class="hero-title" id="page-title">{{ $report['title'] }}</h1>
            <p class="hero-lead">{{ $report['description'] }}</p>

            <p class="hero-period">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="14" height="12.5" rx="2"/><path d="M3 8.5h14M7 3v3M13 3v3"/></svg>
                Periode: {{ $periodLabel }}
            </p>

            <div class="hero-actions">
                <button class="btn btn--gold" type="button" data-print>
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.5 7V3h9v4M5.5 14H3.5V8h13v6h-2M5.5 11.5h9V17h-9z"/></svg>
                    Cetak / Simpan PDF
                </button>
                <a class="btn btn--light" href="/admin/dashboard">Kembali ke Dashboard</a>
            </div>
        </div>
    </section>

    <nav class="tabs no-print" aria-label="Jenis laporan">
        @foreach ($types as $key => $label)
            <a class="tab {{ $type === $key ? 'is-on' : '' }}" href="{{ route('reports.articles', array_filter(['jenis' => $key, 'dari' => $fromValue, 'sampai' => $toValue])) }}" {!! $type === $key ? 'aria-current="page"' : '' !!}>
                {!! $svg($tabIcons[$key]) !!}
                {{ $label }}
            </a>
        @endforeach
    </nav>

    <section class="box filters no-print" aria-label="Filter laporan">
        <form class="filters-form" action="{{ route('reports.articles') }}" method="GET">
            <input type="hidden" name="jenis" value="{{ $type }}">

            <div class="f-field">
                <label for="dari">Dari tanggal</label>
                <input class="f-control" type="date" id="dari" name="dari" value="{{ $fromValue }}">
            </div>

            <div class="f-field">
                <label for="sampai">Sampai tanggal</label>
                <input class="f-control" type="date" id="sampai" name="sampai" value="{{ $toValue }}">
            </div>

            @foreach ($report['filters'] as $filter)
                <div class="f-field">
                    <label for="f-{{ $filter['name'] }}">{{ $filter['label'] }}</label>
                    <select class="f-control" id="f-{{ $filter['name'] }}" name="{{ $filter['name'] }}">
                        @foreach ($filter['options'] as $optValue => $optLabel)
                            <option value="{{ $optValue }}" {{ (string) $filter['value'] === (string) $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <div class="f-actions">
                <button class="btn" type="submit">Terapkan</button>
                <a class="btn btn--ghost" href="{{ route('reports.articles', ['jenis' => $type]) }}">Reset</a>
            </div>
        </form>

        <div class="presets">
            <span class="presets-label">Periode cepat</span>
            @foreach ($presets as $preset)
                <a class="preset {{ $preset['active'] ? 'is-on' : '' }}" href="{{ $preset['url'] }}">{{ $preset['label'] }}</a>
            @endforeach
        </div>
    </section>

    <section class="stats" aria-label="Ringkasan statistik">
        @foreach ($report['stats'] as $stat)
            <article class="box stat {{ $stat['tone'] === 'dark' ? 'stat--dark' : '' }}">
                <span class="stat-icon {{ $stat['tone'] === 'dark' ? '' : 'tone-' . $stat['tone'] }}">{!! $svg($stat['icon']) !!}</span>
                <span class="stat-label">{{ $stat['label'] }}</span>
                <span class="stat-value">{{ number_format($stat['value'], 0, ',', '.') }}</span>
                <span class="stat-note">{{ $stat['note'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="charts {{ $report['chart_layout'] === 'equal' ? 'charts--equal' : '' }}" aria-label="Grafik laporan">
        @foreach ($report['charts'] as $chart)
            @php
                $values = array_column($chart['items'], 'value');
                $sum = array_sum($values);
            @endphp

            <article class="box panel" aria-labelledby="chart-{{ $loop->index }}">
                <header class="panel-head">
                    <h2 class="panel-title" id="chart-{{ $loop->index }}">{{ $chart['title'] }}</h2>
                    <p class="panel-sub">
                        @if ($chart['type'] === 'bar')
                            {{ number_format($sum, 0, ',', '.') }} {{ $chart['unit'] }} pada periode ini
                        @else
                            {{ $chart['sub'] }}
                        @endif
                    </p>
                </header>

                @if ($sum > 0)
                    @if ($chart['type'] === 'bar')
                        @php
                            $n = count($chart['items']);
                            $step = max(1, (int) ceil(max($values) / 4));
                            $top = $step * 4;
                        @endphp

                        <div class="chart {{ $n > 8 ? 'chart--many' : '' }}" style="--n: {{ $n }}" role="group" aria-label="{{ $chart['title'] }}">
                            <div class="chart-y" aria-hidden="true">
                                @foreach (range(0, 4) as $i)
                                    <span style="--i: {{ $i }}">{{ $i * $step }}</span>
                                @endforeach
                            </div>

                            <div class="chart-area">
                                @foreach (range(1, 3) as $i)
                                    <span class="chart-line" style="--i: {{ $i }}" aria-hidden="true"></span>
                                @endforeach

                                @foreach ($chart['items'] as $item)
                                    <div class="bar-col">
                                        <div class="bar {{ $item['value'] === 0 ? 'is-zero' : '' }}" style="--h: {{ round($item['value'] / $top * 100, 2) }}%" tabindex="0" role="img" aria-label="{{ $item['full'] }}: {{ $item['value'] }} {{ $chart['unit'] }}" data-tip="{{ $item['full'] }}: {{ $item['value'] }} {{ $chart['unit'] }}">
                                            <span class="bar-val" aria-hidden="true">{{ $item['value'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="chart-x" aria-hidden="true">
                                @foreach ($chart['items'] as $item)
                                    <span>{{ $item['label'] }}</span>
                                @endforeach
                            </div>
                        </div>

                    @elseif ($chart['type'] === 'donut')
                        @php
                            $radius = 78;
                            $length = 2 * pi() * $radius;
                            $used = collect($chart['items'])->filter(fn ($i) => $i['value'] > 0)->count();
                            $gap = $used > 1 ? 3 : 0;
                            $offset = 0;
                        @endphp

                        <div class="donut" data-donut role="group" aria-label="{{ $chart['title'] }}">
                            <svg viewBox="0 0 200 200" aria-hidden="true">
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="{{ $radius }}"
                                    fill="none"
                                    stroke="#E7E0D2"
                                    stroke-width="26"
                                />

                                <g transform="rotate(-90 100 100)">
                                    @foreach ($chart['items'] as $index => $item)
                                        @if ($item['value'] > 0)
                                            @php
                                                $segment = ($item['value'] / $sum) * $length;
                                                $percentage = round(($item['value'] / $sum) * 100);
                                                $formattedValue = number_format($item['value'], 0, ',', '.');
                                                $segmentColor = $item['color'] ?? '#16A34A';
                                            @endphp

                                            <circle
                                                class="donut-segment"
                                                cx="100"
                                                cy="100"
                                                r="{{ $radius }}"
                                                fill="none"
                                                stroke="{{ $segmentColor }}"
                                                stroke-width="26"
                                                stroke-dasharray="{{ round(max($segment - $gap, 0.01), 2) }} {{ round($length, 2) }}"
                                                stroke-dashoffset="-{{ round($offset, 2) }}"
                                                tabindex="0"
                                                role="button"
                                                aria-label="{{ $item['label'] }}: {{ $formattedValue }} {{ $chart['unit'] }}, {{ $percentage }} persen"
                                                aria-pressed="false"
                                                data-donut-index="{{ $index }}"
                                                data-label="{{ $item['label'] }}"
                                                data-value="{{ $formattedValue }}"
                                                data-unit="{{ $chart['unit'] }}"
                                                data-percent="{{ $percentage }}"
                                            />

                                            @php
                                                $offset += $segment;
                                            @endphp
                                        @endif
                                    @endforeach
                                </g>
                            </svg>

                            <div class="donut-center" aria-hidden="true">
                                <span class="donut-total">{{ number_format($sum, 0, ',', '.') }}</span>
                                <span class="donut-unit">{{ $chart['unit'] }}</span>
                            </div>

                            <div class="donut-tooltip" role="status" aria-live="polite">
                                <strong></strong>
                                <span></span>
                            </div>
                        </div>

                        <ul class="legend">
                            @foreach ($chart['items'] as $index => $item)
                                @php
                                    $percentage = round(($item['value'] / $sum) * 100);
                                    $segmentColor = $item['color'] ?? '#16A34A';
                                @endphp

                                <li
                                    data-legend-index="{{ $index }}"
                                    tabindex="0"
                                    role="button"
                                    aria-pressed="false"
                                    aria-label="{{ $item['label'] }}: {{ number_format($item['value'], 0, ',', '.') }} {{ $chart['unit'] }}, {{ $percentage }} persen"
                                >
                                    <span class="legend-dot" style="background: {{ $segmentColor }}"></span>
                                    {{ $item['label'] }}
                                    <span class="legend-count">{{ number_format($item['value'], 0, ',', '.') }}</span>
                                    <span class="legend-pct">{{ $percentage }}%</span>
                                </li>
                            @endforeach
                        </ul>

                    @else
                        @php $maxRank = max($values); @endphp

                        <ul class="rank">
                            @foreach ($chart['items'] as $item)
                                <li>
                                    <div class="rank-top">
                                        <span class="rank-name">{{ $item['label'] }}</span>
                                        <span class="rank-count">{{ number_format($item['value'], 0, ',', '.') }} {{ $chart['unit'] }}</span>
                                    </div>
                                    <div class="rank-bar"><span style="width: {{ round($item['value'] / $maxRank * 100) }}%"></span></div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    <div class="chart-empty">
                        <strong>Belum ada data</strong>
                        <p>Grafik akan muncul jika ada data pada periode dan filter yang dipilih.</p>
                    </div>
                @endif
            </article>
        @endforeach
    </section>

    @foreach ($report['tables'] as $table)
        <section class="box table-box" aria-labelledby="table-{{ $loop->index }}">
            <header class="table-head">
                <div>
                    <h2 class="panel-title" id="table-{{ $loop->index }}">{{ $table['title'] }}</h2>
                    <p class="panel-sub">{{ $table['sub'] }}</p>
                </div>

                <span class="pill">{{ number_format(count($table['rows']), 0, ',', '.') }} data</span>
            </header>

            @if (count($table['rows']))
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($table['columns'] as $column)
                                    <th class="{{ $column['class'] ?? '' }}" scope="col">{{ $column['label'] }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($table['rows'] as $row)
                                <tr>
                                    @foreach ($row as $ci => $cell)
                                        <td class="{{ $table['columns'][$ci]['class'] ?? '' }}" data-label="{{ $table['columns'][$ci]['label'] }}">
                                            @if (is_array($cell) && isset($cell['badge']))
                                                <span class="badge badge--{{ $cell['tone'] ?? 'other' }}">{{ $cell['badge'] }}</span>
                                            @elseif (is_array($cell) && isset($cell['href']))
                                                <a class="row-title" href="{{ $cell['href'] }}">{{ $cell['t'] }}</a>
                                            @else
                                                {{ is_array($cell) ? $cell['t'] : $cell }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="table-empty">{{ $table['empty'] }}</p>
            @endif
        </section>
    @endforeach
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    document.querySelectorAll('[data-print]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            window.print();
        });
    });

    document.querySelectorAll('[data-donut]').forEach(function (donut) {
        const panel = donut.closest('.panel');

        if (!panel) return;

        const tooltip = donut.querySelector('.donut-tooltip');
        const tooltipTitle = tooltip ? tooltip.querySelector('strong') : null;
        const tooltipDetail = tooltip ? tooltip.querySelector('span') : null;

        const segments = Array.from(donut.querySelectorAll('[data-donut-index]'));
        const legends = Array.from(panel.querySelectorAll('[data-legend-index]'));

        let pinnedIndex = null;

        function findSegment(index) {
            return segments.find(function (segment) {
                return segment.dataset.donutIndex === String(index);
            });
        }

        function findLegend(index) {
            return legends.find(function (legend) {
                return legend.dataset.legendIndex === String(index);
            });
        }

        function clearActive() {
            segments.forEach(function (segment) {
                segment.classList.remove('is-active');
                segment.setAttribute('aria-pressed', 'false');
            });

            legends.forEach(function (legend) {
                legend.classList.remove('is-active');
                legend.setAttribute('aria-pressed', 'false');
            });
        }

        function hideTooltip() {
            if (tooltip) {
                tooltip.classList.remove('is-visible');
            }
        }

        function showItem(index, pin) {
            const segment = findSegment(index);
            const legend = findLegend(index);

            if (!segment) return;

            clearActive();

            segment.classList.add('is-active');
            segment.setAttribute('aria-pressed', pin ? 'true' : 'false');

            if (legend) {
                legend.classList.add('is-active');
                legend.setAttribute('aria-pressed', pin ? 'true' : 'false');
            }

            if (tooltipTitle && tooltipDetail) {
                tooltipTitle.textContent = segment.dataset.label || '';
                tooltipDetail.textContent =
                    segment.dataset.value + ' ' +
                    segment.dataset.unit + ' • ' +
                    segment.dataset.percent + '%';
            }

            if (tooltip) {
                tooltip.classList.add('is-visible');
            }

            if (pin) {
                pinnedIndex = String(index);
            }
        }

        function restorePinned() {
            if (pinnedIndex !== null) {
                showItem(pinnedIndex, true);
            } else {
                clearActive();
                hideTooltip();
            }
        }

        function togglePinned(index) {
            const selectedIndex = String(index);

            if (pinnedIndex === selectedIndex) {
                pinnedIndex = null;
                clearActive();
                hideTooltip();
            } else {
                showItem(selectedIndex, true);
            }
        }

        segments.forEach(function (segment) {
            const index = segment.dataset.donutIndex;

            segment.addEventListener('pointerenter', function () {
                if (pinnedIndex === null) {
                    showItem(index, false);
                }
            });

            segment.addEventListener('pointerleave', function () {
                if (pinnedIndex === null) {
                    restorePinned();
                }
            });

            segment.addEventListener('focus', function () {
                if (pinnedIndex === null) {
                    showItem(index, false);
                }
            });

            segment.addEventListener('blur', function () {
                if (pinnedIndex === null) {
                    restorePinned();
                }
            });

            segment.addEventListener('click', function () {
                togglePinned(index);
            });

            segment.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    togglePinned(index);
                }

                if (event.key === 'Escape') {
                    pinnedIndex = null;
                    clearActive();
                    hideTooltip();
                }
            });
        });

        legends.forEach(function (legend) {
            const index = legend.dataset.legendIndex;

            legend.addEventListener('pointerenter', function () {
                if (pinnedIndex === null) {
                    showItem(index, false);
                }
            });

            legend.addEventListener('pointerleave', function () {
                if (pinnedIndex === null) {
                    restorePinned();
                }
            });

            legend.addEventListener('focus', function () {
                if (pinnedIndex === null) {
                    showItem(index, false);
                }
            });

            legend.addEventListener('blur', function () {
                if (pinnedIndex === null) {
                    restorePinned();
                }
            });

            legend.addEventListener('click', function () {
                togglePinned(index);
            });

            legend.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    togglePinned(index);
                }

                if (event.key === 'Escape') {
                    pinnedIndex = null;
                    clearActive();
                    hideTooltip();
                }
            });
        });

        panel.addEventListener('click', function (event) {
            if (
                !event.target.closest('[data-donut-index]') &&
                !event.target.closest('[data-legend-index]')
            ) {
                pinnedIndex = null;
                clearActive();
                hideTooltip();
            }
        });
    });
})();
</script>
@endpush
