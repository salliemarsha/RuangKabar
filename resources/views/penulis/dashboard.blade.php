 @extends('layouts.dashboard')

@section('title', 'Dashboard Penulis')

@push('styles')
<style>
.btn--light {
    color: var(--ivory);
    background: transparent;
    border-color: rgba(250, 248, 243, 0.4);
}

.btn--light:hover {
    color: var(--emerald);
    background: var(--ivory);
    border-color: var(--ivory);
}

.pw-hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
}

.pw-hero-text {
    min-width: 0;
    max-width: 640px;
}

.pw-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 4px 12px;
    margin: 14px 0 0;
    font-family: var(--body);
    font-size: 14px;
    color: var(--on-dark);
}

.pw-meta strong {
    font-weight: 600;
    color: var(--ivory);
}

.pw-dot {
    width: 4px;
    height: 4px;
    background: rgba(250, 248, 243, 0.4);
    border-radius: 50%;
}

.pw-date {
    flex: none;
    min-width: 148px;
    padding: 18px 22px;
    text-align: center;
    background: rgba(250, 248, 243, 0.08);
    border: 1px solid rgba(185, 154, 100, 0.45);
    border-radius: 22px;
}

.pw-date-day {
    display: block;
    font-family: var(--serif);
    font-size: 52px;
    font-weight: 600;
    line-height: 1;
    color: var(--gold);
}

.pw-date-month {
    display: block;
    margin-top: 8px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--ivory);
}

.pw-date-week {
    display: block;
    margin-top: 2px;
    font-family: var(--body);
    font-size: 12.5px;
    color: var(--on-dark);
}

.pw-h {
    margin: 0 0 14px;
    font-family: var(--serif);
    font-size: 22px;
    font-weight: 600;
    color: var(--emerald);
}

.pw-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.pw-stat {
    display: flex;
    flex-direction: column;
    min-width: 0;
    padding: 22px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out, border-color var(--t-fast) ease-out;
}

.pw-stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 18px;
}

.pw-stat-label {
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--text-soft);
}

.pw-stat-icon {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 14px;
}

.pw-stat-icon svg {
    width: 21px;
    height: 21px;
}

.pw-stat-value {
    font-family: var(--serif);
    font-size: 42px;
    font-weight: 600;
    line-height: 1;
    color: var(--emerald);
}

.pw-stat-note {
    margin-top: 12px;
    font-family: var(--body);
    font-size: 13px;
    line-height: 1.45;
    color: var(--text-soft);
}

.tone-emerald {
    color: var(--emerald);
    background: rgba(24, 60, 54, 0.09);
}

.tone-forest {
    color: var(--forest);
    background: rgba(55, 107, 92, 0.13);
}

.tone-gold {
    color: #8D7243;
    background: rgba(185, 154, 100, 0.2);
}

@media (hover: hover) {
    .pw-stat:hover {
        transform: translateY(-3px);
        border-color: rgba(55, 107, 92, 0.3);
        box-shadow: 0 18px 30px -22px rgba(24, 60, 54, 0.5);
    }
}

.pw-panel {
    margin-top: 20px;
    min-width: 0;
    padding: 26px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 24px;
}

.pw-panel-head {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px 20px;
    margin-bottom: 22px;
}

.pw-panel-title {
    margin: 0;
    font-family: var(--serif);
    font-size: 21px;
    font-weight: 600;
    color: var(--emerald);
}

.pw-panel-sub {
    margin: 4px 0 0;
    font-family: var(--body);
    font-size: 13px;
    color: var(--text-soft);
}

.pw-chip {
    display: inline-flex;
    align-items: center;
    flex: none;
    height: 32px;
    padding: 0 14px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 999px;
}

.pw-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    white-space: nowrap;
}

.pw-link svg {
    width: 14px;
    height: 14px;
    transition: transform var(--t-ui) var(--ease);
}

.pw-link:hover {
    color: var(--emerald);
}

.pw-link:hover svg {
    transform: translateX(3px);
}

.chart {
    display: grid;
    grid-template-columns: 30px minmax(0, 1fr);
    gap: 0 10px;
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
    color: var(--text-soft);
}

.chart-y-title {
    grid-column: 1 / -1;
    margin: 0 0 14px;
    font-family: var(--sans);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
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
    width: min(56px, 62%);
    height: max(var(--h), 5px);
    background: var(--forest);
    border-radius: 12px 12px 4px 4px;
    transform-origin: bottom;
    animation: pwgrow 700ms var(--ease) both;
    transition: background var(--t-fast) ease-out;
}

.bar-col:nth-child(2) .bar {
    animation-delay: 60ms;
}

.bar-col:nth-child(3) .bar {
    animation-delay: 120ms;
}

.bar-col:nth-child(4) .bar {
    animation-delay: 180ms;
}

.bar-col:nth-child(5) .bar {
    animation-delay: 240ms;
}

.bar-col:nth-child(6) .bar {
    animation-delay: 300ms;
}

@keyframes pwgrow {
    from {
        transform: scaleY(0);
    }

    to {
        transform: scaleY(1);
    }
}

.bar.is-current {
    background: var(--gold);
}

.bar.is-zero {
    background: rgba(24, 60, 54, 0.14);
}

.bar:hover,
.bar:focus-visible {
    background: var(--emerald);
    outline-offset: 4px;
}

.bar.is-current:hover,
.bar.is-current:focus-visible {
    background: #A5864F;
}

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
    transition: opacity var(--t-fast) ease-out, transform var(--t-fast) ease-out, visibility 0s linear var(--t-fast);
}

.bar:hover::after,
.bar:focus-visible::after {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%);
    transition: opacity var(--t-fast) ease-out, transform var(--t-fast) ease-out, visibility 0s;
}

.bar-col:first-child .bar::after {
    left: 0;
    transform: translateY(4px);
}

.bar-col:first-child .bar:hover::after,
.bar-col:first-child .bar:focus-visible::after {
    transform: none;
}

.bar-col:last-child .bar::after {
    right: 0;
    left: auto;
    transform: translateY(4px);
}

.bar-col:last-child .bar:hover::after,
.bar-col:last-child .bar:focus-visible::after {
    transform: none;
}

.chart-x {
    grid-column: 2;
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    margin-top: 12px;
}

.chart-x span {
    text-align: center;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-soft);
}

.chart-x span:last-child {
    color: #8D7243;
}

.pw-empty {
    padding: 40px 22px;
    text-align: center;
    background: var(--ivory);
    border: 1px dashed rgba(24, 60, 54, 0.25);
    border-radius: 18px;
}

.pw-empty strong {
    display: block;
    margin-bottom: 6px;
    font-family: var(--serif);
    font-size: 20px;
    font-weight: 600;
    color: var(--emerald);
}

.pw-empty p {
    max-width: 400px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.65;
    color: var(--text-soft);
}

.pw-empty .btn {
    margin-top: 18px;
}

.table-wrap {
    margin: 0 -8px;
    min-width: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    padding: 0 10px 12px;
    font-family: var(--sans);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-align: left;
    text-transform: uppercase;
    color: var(--text-soft);
    border-bottom: 1px solid var(--rule);
}

.table td {
    padding: 14px 10px;
    font-family: var(--body);
    font-size: 13.5px;
    vertical-align: middle;
    color: var(--text);
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}

.table tbody tr {
    transition: background var(--t-fast) ease-out;
}

.table tbody tr:hover {
    background: rgba(250, 248, 243, 0.8);
}

.table tbody tr:last-child td {
    border-bottom: 0;
}

.col-title {
    width: 40%;
}

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
    transition: color var(--t-fast) ease-out;
}

.row-title:hover {
    color: var(--forest);
}

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

.cat-inline {
    display: none;
    margin-top: 8px;
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

.badge-published {
    color: #1F5A47;
    background: rgba(55, 107, 92, 0.16);
}

.badge-draft {
    color: #7A6130;
    background: rgba(185, 154, 100, 0.24);
}

.badge-other {
    color: var(--text-soft);
    background: rgba(104, 115, 110, 0.14);
}

.row-date {
    white-space: nowrap;
    color: var(--text-soft);
}

.col-actions {
    width: 1%;
    white-space: nowrap;
}

.row-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 6px;
}

.row-actions form {
    margin: 0;
}

.row-actions .act {
    height: 36px;
    padding: 0 12px;
    font-size: 12.5px;
}

.pw-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 24px;
}

.pw-pagination nav {
    display: flex;
    justify-content: center;
    width: 100%;
}

.pw-pagination nav > div:first-child {
    display: none;
}

.pw-pagination nav > div:last-child {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
}

.pw-pagination nav a,
.pw-pagination nav span[aria-current="page"],
.pw-pagination nav span[aria-disabled="true"] {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    padding: 0 12px;
    border: 1px solid var(--rule);
    border-radius: 10px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

.pw-pagination nav a {
    color: var(--emerald);
    background: var(--white);
    transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.pw-pagination nav a:hover {
    background: var(--ivory);
    border-color: var(--forest);
}

.pw-pagination nav span[aria-current="page"] {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}

.pw-pagination nav span[aria-disabled="true"] {
    color: var(--text-soft);
    background: var(--ivory);
    opacity: 0.65;
}

.pw-pagination nav svg {
    width: 16px;
    height: 16px;
}

@media (max-width: 1279px) {
    .col-cat {
        display: none;
    }

    .cat-inline {
        display: inline-block;
    }

    .col-title {
        width: auto;
    }
}

@media (max-width: 1023px) {
    .pw-date {
        display: none;
    }
}

@media (max-width: 719px) {
    .pw-stats {
        grid-template-columns: minmax(0, 1fr);
        gap: 12px;
    }

    .pw-stat {
        padding: 18px;
    }

    .pw-stat-top {
        margin-bottom: 12px;
    }

    .pw-stat-value {
        font-size: 36px;
    }

    .pw-panel {
        padding: 20px 16px;
        border-radius: 20px;
    }

    .chart {
        grid-template-columns: 24px minmax(0, 1fr);
        gap: 0 6px;
    }

    .chart-y,
    .chart-area {
        height: 200px;
    }

    .bar {
        width: min(34px, 70%);
    }

    .chart-x span {
        font-size: 11.5px;
    }

    .table-wrap {
        margin: 0;
    }

    .table thead {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
    }

    .table,
    .table tbody,
    .table tr,
    .table td {
        display: block;
        width: 100%;
    }

    .table tr {
        padding: 14px 0;
        border-bottom: 1px solid rgba(24, 60, 54, 0.08);
    }

    .table tbody tr:last-child {
        border-bottom: 0;
    }

    .table tbody tr:hover {
        background: transparent;
    }

    .table td {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 5px 0;
        border: 0;
    }

    .table td::before {
        content: attr(data-label);
        flex: none;
        font-family: var(--sans);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-soft);
    }

    .col-cat {
        display: flex;
    }

    .cat-inline {
        display: none;
    }

    .table td.col-title {
        display: block;
        padding-bottom: 8px;
    }

    .table td.col-title::before {
        display: none;
    }

    .table td.col-actions {
        width: 100%;
        padding-top: 10px;
        white-space: normal;
    }

    .table td.col-actions::before {
        display: none;
    }

    .row-actions {
        width: 100%;
    }

    .row-actions .act {
        flex: 1 1 0;
        justify-content: center;
    }

    .row-actions form {
        display: flex;
        flex: 1 1 0;
    }

    .row-actions form .act {
        flex: 1 1 100%;
    }

    .pw-pagination {
        margin-top: 20px;
    }

    .pw-pagination nav > div:last-child {
        gap: 6px;
    }

    .pw-pagination nav a,
    .pw-pagination nav span[aria-current="page"],
    .pw-pagination nav span[aria-disabled="true"] {
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
    }
}
</style>
@endpush

@section('content')

@php
    $user = auth()->user();

    $roleLabel = [
        'admin' => 'Admin',
        'penulis' => 'Penulis',
        'pengguna' => 'Pengguna',
    ][$user->role] ?? ucfirst($user->role);

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

<section class="hero" aria-labelledby="welcome-title">
    <div class="hero-inner pw-hero">
        <div class="pw-hero-text">
            <span class="hero-label">PANEL PENULIS</span>

            <h1 class="hero-title" id="welcome-title">
                Selamat datang, {{ $user->name }}!
            </h1>

            <p class="hero-lead">
                Kelola tulisan Anda dan pantau perkembangan artikel yang sudah dibuat dalam satu tempat.
            </p>

            <p class="pw-meta">
                <span>Anda login sebagai <strong>{{ $roleLabel }}</strong></span>
                <span class="pw-dot" aria-hidden="true"></span>
                <time datetime="{{ now()->toDateString() }}">{{ $today }}</time>
            </p>

            <div class="hero-actions">
                <a class="btn btn--gold" href="{{ route('articles.create') }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M8 3v10M3 8h10"/>
                    </svg>
                    Tulis Artikel Baru
                </a>

                <a class="btn btn--light" href="/">Lihat Beranda</a>
            </div>
        </div>

        <div class="pw-date" aria-hidden="true">
            <span class="pw-date-day">{{ now()->locale('id')->translatedFormat('d') }}</span>
            <span class="pw-date-month">{{ now()->locale('id')->translatedFormat('F Y') }}</span>
            <span class="pw-date-week">{{ now()->locale('id')->translatedFormat('l') }}</span>
        </div>
    </div>
</section>

<section aria-labelledby="stat-title">
    <h2 class="pw-h" id="stat-title">Ringkasan Artikel Anda</h2>

    <div class="pw-stats">
        <article class="pw-stat">
            <div class="pw-stat-top">
                <span class="pw-stat-label">Total Artikel</span>
                <span class="pw-stat-icon tone-emerald" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 3h9l4 4v14H6z"/>
                        <path d="M15 3v4h4M9 12h7M9 16h7"/>
                    </svg>
                </span>
            </div>
            <span class="pw-stat-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
            <span class="pw-stat-note">Seluruh artikel yang Anda tulis</span>
        </article>

        <article class="pw-stat">
            <div class="pw-stat-top">
                <span class="pw-stat-label">Dipublikasikan</span>
                <span class="pw-stat-icon tone-forest" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12.5l3 3 5-6"/>
                    </svg>
                </span>
            </div>
            <span class="pw-stat-value">{{ number_format($publishedArticles, 0, ',', '.') }}</span>
            <span class="pw-stat-note">Sudah tayang di portal</span>
        </article>

        <article class="pw-stat">
            <div class="pw-stat-top">
                <span class="pw-stat-label">Draft</span>
                <span class="pw-stat-icon tone-gold" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 20h4L19 9l-4-4L4 16z"/>
                        <path d="M13 7l4 4"/>
                    </svg>
                </span>
            </div>
            <span class="pw-stat-value">{{ number_format($draftArticles, 0, ',', '.') }}</span>
            <span class="pw-stat-note">Belum dipublikasikan</span>
        </article>
    </div>
</section>

<section class="pw-panel" aria-labelledby="chart-title">
    <div class="pw-panel-head">
        <div>
            <h2 class="pw-panel-title" id="chart-title">Produktivitas Artikel</h2>
            <p class="pw-panel-sub">
                Jumlah artikel yang Anda buat setiap bulan, enam bulan terakhir
            </p>
        </div>
        <span class="pw-chip">{{ $chartTotal }} artikel</span>
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
        <div class="pw-empty">
            <strong>Belum ada data produktivitas</strong>
            <p>Grafik akan muncul setelah Anda menulis artikel dalam enam bulan terakhir.</p>
        </div>
    @endif
</section>

<section class="pw-panel" aria-labelledby="posts-title">
    <div class="pw-panel-head">
        <div>
            <h2 class="pw-panel-title" id="posts-title">Artikel Terbaru</h2>
            <p class="pw-panel-sub">Daftar artikel yang Anda tulis</p>
        </div>

        <a class="pw-link" href="{{ route('articles.index') }}">
            Lihat Semua Artikel
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 8h10M9 4l4 4-4 4"/>
            </svg>
        </a>
    </div>

    @if ($articles->count())
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Judul Artikel</th>
                        <th scope="col" class="col-cat">Kategori</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td class="col-title" data-label="Judul">
                                <a class="row-title" href="{{ route('articles.show', $article) }}">
                                    {{ $article->title }}
                                </a>

                                <span class="cat-tag cat-inline">
                                    {{ $article->category?->name ?? '-' }}
                                </span>
                            </td>

                            <td class="col-cat" data-label="Kategori">
                                <span class="cat-tag">
                                    {{ $article->category?->name ?? '-' }}
                                </span>
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
                                    <time datetime="{{ $article->created_at->toDateString() }}">
                                        {{ $article->created_at->locale('id')->translatedFormat('d M Y') }}
                                    </time>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="col-actions" data-label="Aksi">
                                <div class="row-actions">
                                    <a class="act" href="{{ route('articles.show', $article) }}">
                                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/>
                                            <circle cx="10" cy="10" r="2.5"/>
                                        </svg>
                                        Lihat
                                    </a>

                                    <a class="act act--edit" href="{{ route('articles.edit', $article) }}">
                                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M3 17l3.5-.8L16 6.7 13.3 4 3.8 13.5z"/>
                                            <path d="M11.5 5.8l2.7 2.7"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('articles.destroy', $article) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="act act--delete"
                                            type="submit"
                                            onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                        >
                                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M4 6h12M8 6V4h4v2M6 6l.7 10h6.6L14 6"/>
                                            </svg>
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
            <div class="pw-pagination">
                {{ $articles->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <div class="pw-empty">
            <strong>Belum ada artikel</strong>
            <p>Anda belum memiliki artikel. Mulai tulis artikel pertama Anda.</p>
            <a class="btn" href="{{ route('articles.create') }}">Tulis Artikel Pertama</a>
        </div>
    @endif
</section>
@endsection