@extends('layouts.dashboard')

@section('title', 'Dashboard')

@push('styles')
<style>
.dx-hero { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
.dx-hero-text { min-width: 0; max-width: 640px; }
.dx-date { flex: none; min-width: 148px; padding: 18px 22px; text-align: center; background: rgba(250, 248, 243, 0.08); border: 1px solid rgba(185, 154, 100, 0.45); border-radius: 22px; }
.dx-date-day { display: block; font-family: var(--serif); font-size: 52px; font-weight: 600; line-height: 1; color: var(--gold); }
.dx-date-month { display: block; margin-top: 8px; font-family: var(--sans); font-size: 14px; font-weight: 700; color: var(--ivory); }
.dx-date-week { display: block; margin-top: 2px; font-family: var(--body); font-size: 12.5px; color: var(--on-dark); }

.dx-h { margin: 0 0 14px; font-family: var(--serif); font-size: 22px; font-weight: 600; color: var(--emerald); }
.dx-section { margin-top: 28px; }

.dx-stats { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 16px; }
.dx-stat { position: relative; display: flex; flex-direction: column; min-width: 0; padding: 20px; color: inherit; text-decoration: none; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; transition: transform var(--t-ui) var(--ease), border-color var(--t-fast) ease-out, box-shadow var(--t-ui) ease-out; }
.dx-stat-top { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 18px; }
.dx-stat-icon { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; color: var(--emerald); background: rgba(185, 154, 100, 0.2); border-radius: 13px; transition: background var(--t-fast) ease-out; }
.dx-stat-icon svg { width: 20px; height: 20px; }
.dx-stat-label { font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--text-soft); }
.dx-stat-value { font-family: var(--serif); font-size: 38px; font-weight: 600; line-height: 1; color: var(--emerald); }
.dx-stat-foot { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 8px; margin-top: 12px; }
.dx-stat-note { font-family: var(--body); font-size: 12.5px; line-height: 1.45; color: var(--text-soft); }
.dx-pill { display: inline-flex; align-items: center; gap: 3px; padding: 2px 8px; font-family: var(--sans); font-size: 11.5px; font-weight: 700; border-radius: 999px; }
.dx-pill svg { width: 11px; height: 11px; }
.dx-pill--up { color: var(--forest); background: rgba(55, 107, 92, 0.12); }
.dx-pill--down { color: var(--danger); background: var(--danger-soft); }
.dx-pill--flat { color: var(--text-soft); background: var(--sand); }

@media (hover: hover) {
    .dx-stat:hover { transform: translateY(-3px); border-color: rgba(55, 107, 92, 0.3); box-shadow: 0 18px 30px -22px rgba(24, 60, 54, 0.5); }
    .dx-stat:hover .dx-stat-icon { background: var(--gold); }
}

.dx-stat:active { transform: scale(0.985); }

.dx-report { position: relative; display: flex; align-items: center; justify-content: space-between; gap: 28px; overflow: hidden; padding: 28px 32px; color: inherit; text-decoration: none; background: var(--ivory); border: 1px solid rgba(185, 154, 100, 0.55); border-radius: 24px; transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out, border-color var(--t-fast) ease-out; }
.dx-report::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 5px; background: var(--gold); }
.dx-report-main { display: flex; align-items: center; gap: 20px; min-width: 0; }
.dx-report-icon { display: flex; flex: none; align-items: center; justify-content: center; width: 56px; height: 56px; color: var(--ivory); background: var(--emerald); border-radius: 18px; }
.dx-report-icon svg { width: 26px; height: 26px; }
.dx-report-eyebrow { display: block; margin-bottom: 4px; font-family: var(--sans); font-size: 11.5px; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--forest); }
.dx-report-title { margin: 0; font-family: var(--serif); font-size: 24px; font-weight: 600; color: var(--emerald); }
.dx-report-text { max-width: 560px; margin: 6px 0 0; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); }
.dx-report-cta { display: inline-flex; flex: none; align-items: center; gap: 8px; height: 46px; padding: 0 22px; font-family: var(--sans); font-size: 14px; font-weight: 700; color: var(--white); background: var(--emerald); border-radius: 999px; transition: background var(--t-fast) ease-out; }
.dx-report-cta svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }

@media (hover: hover) {
    .dx-report:hover { transform: translateY(-2px); border-color: var(--gold); box-shadow: 0 20px 34px -26px rgba(24, 60, 54, 0.55); }
    .dx-report:hover .dx-report-cta { background: var(--forest); }
    .dx-report:hover .dx-report-cta svg { transform: translateX(3px); }
}

.dx-report:active { transform: scale(0.99); }

.dx-row { display: grid; grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr); gap: 20px; margin-top: 20px; }
.dx-panel { min-width: 0; padding: 26px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 24px; }
.dx-panel-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
.dx-panel-title { margin: 0; font-family: var(--serif); font-size: 21px; font-weight: 600; color: var(--emerald); }
.dx-panel-sub { margin: 4px 0 0; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

.dx-seg { display: inline-flex; flex: none; padding: 4px; background: var(--ivory); border: 1px solid var(--rule); border-radius: 999px; }
.dx-seg-btn { height: 32px; padding: 0 14px; font-family: var(--sans); font-size: 12.5px; font-weight: 700; color: var(--text-soft); background: transparent; border: 0; border-radius: 999px; cursor: pointer; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out; }
.dx-seg-btn:hover { color: var(--emerald); }
.dx-seg-btn.is-on { color: var(--white); background: var(--emerald); }

.dx-chart { position: relative; width: 100%; min-height: 280px; }
.dx-chart svg { display: block; max-width: 100%; overflow: visible; }
.dx-grid { stroke: rgba(24, 60, 54, 0.1); stroke-width: 1; stroke-dasharray: 3 4; }
.dx-axis { font-family: var(--body); font-size: 11.5px; fill: var(--text-soft); }
.dx-bar { fill: var(--forest); transform-box: fill-box; transform-origin: 50% 100%; animation: dxgrow 700ms var(--ease) both; transition: fill var(--t-fast) ease-out, opacity var(--t-fast) ease-out; }
.dx-bar.is-current { fill: var(--gold); }
.dx-bar-zero { fill: var(--sand); }
.dx-chart.has-hover .dx-bar { opacity: 0.4; }
.dx-chart.has-hover .dx-bar.is-hover { opacity: 1; fill: var(--emerald); }
.dx-chart.has-hover .dx-bar.is-current.is-hover { fill: #A68650; }
.dx-band { fill: rgba(185, 154, 100, 0.12); opacity: 0; transition: opacity var(--t-fast) ease-out; pointer-events: none; }
.dx-band.is-on { opacity: 1; }
.dx-hit { fill: transparent; cursor: pointer; outline: none; }
.dx-value { font-family: var(--sans); font-size: 11.5px; font-weight: 700; fill: var(--emerald); text-anchor: middle; opacity: 0; transition: opacity var(--t-fast) ease-out; pointer-events: none; }
.dx-value.is-on { opacity: 1; }

@keyframes dxgrow { from { transform: scaleY(0); } to { transform: scaleY(1); } }
@keyframes dxarc { from { stroke-dasharray: 0.01 600; } }

.dx-tip { position: absolute; z-index: 5; min-width: 120px; padding: 9px 13px; color: var(--ivory); text-align: center; white-space: nowrap; pointer-events: none; background: var(--emerald); border-radius: 12px; box-shadow: 0 14px 26px -14px rgba(24, 60, 54, 0.7); transform: translate(-50%, -100%); }
.dx-tip::after { content: ""; position: absolute; left: 50%; bottom: -5px; width: 10px; height: 10px; background: var(--emerald); transform: translateX(-50%) rotate(45deg); }
.dx-tip strong { display: block; font-family: var(--sans); font-size: 12px; font-weight: 600; color: var(--on-dark); }
.dx-tip span { display: block; margin-top: 2px; font-family: var(--serif); font-size: 17px; font-weight: 600; color: var(--gold); }

.dx-donut { display: flex; flex-direction: column; gap: 22px; }
.dx-donut-host { position: relative; width: 100%; max-width: 220px; margin: 0 auto; }
.dx-donut-svg { display: block; width: 100%; height: auto; overflow: visible; }
.dx-arc { cursor: pointer; outline: none; transition: stroke-width var(--t-fast) ease-out, opacity var(--t-fast) ease-out; animation: dxarc 900ms var(--ease) both; }
.dx-donut[data-active] .dx-arc { opacity: 0.4; }
.dx-donut[data-active] .dx-arc.is-active { opacity: 1; stroke-width: 30; }
.dx-donut-num { font-family: var(--serif); font-size: 34px; font-weight: 600; fill: var(--emerald); }
.dx-donut-cap { font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; fill: var(--text-soft); }
.dx-legend { display: grid; gap: 4px; margin: 0; padding: 0; list-style: none; }
.dx-legend-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; font-family: var(--body); font-size: 13.5px; color: var(--text); border-radius: 12px; transition: background var(--t-fast) ease-out; }
.dx-legend-item.is-active { background: var(--ivory); }
.dx-legend-dot { flex: none; width: 10px; height: 10px; border-radius: 50%; }
.dx-legend-name { flex: 1; min-width: 0; font-weight: 600; }
.dx-legend-count { font-family: var(--sans); font-weight: 700; color: var(--emerald); }
.dx-legend-pct { min-width: 38px; text-align: right; color: var(--text-soft); }

.dx-link { display: inline-flex; align-items: center; gap: 6px; font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--forest); text-decoration: none; white-space: nowrap; }
.dx-link svg { width: 14px; height: 14px; transition: transform var(--t-ui) var(--ease); }
.dx-link:hover { color: var(--emerald); }
.dx-link:hover svg { transform: translateX(3px); }
.dx-link--foot { margin-top: 18px; }

.dx-table-wrap { margin: 0 -8px; overflow-x: auto; }
.dx-table { width: 100%; border-collapse: collapse; }
.dx-table th { padding: 0 8px 12px; font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-align: left; text-transform: uppercase; color: var(--text-soft); border-bottom: 1px solid var(--rule); }
.dx-table td { padding: 14px 8px; font-family: var(--body); font-size: 13.5px; vertical-align: middle; color: var(--text); border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.dx-table tbody tr:last-child td { border-bottom: 0; }
.dx-col-end { text-align: right !important; }
.dx-art-title { display: block; max-width: 340px; font-family: var(--sans); font-size: 14px; font-weight: 700; line-height: 1.4; color: var(--emerald); text-decoration: none; overflow-wrap: anywhere; }
.dx-art-title:hover { text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.dx-art-by { display: block; margin-top: 2px; font-size: 12.5px; color: var(--text-soft); }
.dx-badge { display: inline-flex; align-items: center; gap: 7px; padding: 4px 11px; font-family: var(--sans); font-size: 12px; font-weight: 700; color: var(--emerald); white-space: nowrap; background: var(--ivory); border: 1px solid var(--rule); border-radius: 999px; }
.dx-badge::before { content: ""; width: 7px; height: 7px; background: var(--c, var(--text-soft)); border-radius: 50%; }
.dx-view { display: inline-flex; align-items: center; height: 34px; padding: 0 14px; font-family: var(--sans); font-size: 12.5px; font-weight: 700; color: var(--emerald); text-decoration: none; border: 1px solid var(--rule); border-radius: 999px; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.dx-view:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }

.dx-rank { margin: 0; padding: 0; list-style: none; }
.dx-rank-item { padding: 13px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.dx-rank-item:first-child { padding-top: 0; }
.dx-rank-item:last-child { border-bottom: 0; }
.dx-rank-top { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
.dx-rank-name { font-family: var(--sans); font-size: 14.5px; font-weight: 700; color: var(--emerald); text-decoration: none; overflow-wrap: anywhere; }
.dx-rank-name:hover { text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.dx-rank-count { flex: none; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.dx-rank-bar { height: 8px; overflow: hidden; background: var(--sand); border-radius: 999px; }
.dx-rank-bar span { display: block; height: 100%; background: linear-gradient(90deg, var(--forest), var(--gold)); border-radius: 999px; transform-origin: left; animation: dxfill 800ms var(--ease) both; }

@keyframes dxfill { from { transform: scaleX(0); } }

.dx-empty { padding: 36px 20px; text-align: center; background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); border-radius: 18px; }
.dx-empty strong { display: block; margin-bottom: 6px; font-family: var(--serif); font-size: 20px; font-weight: 600; color: var(--emerald); }
.dx-empty p { max-width: 360px; margin: 0 auto; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); }
.dx-empty .btn { margin-top: 18px; height: 42px; }


@media (max-width: 1279px) {
    .dx-stats { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    .dx-stat { grid-column: span 2; }
    .dx-stat:nth-child(1), .dx-stat:nth-child(2) { grid-column: span 3; }
}

@media (max-width: 1099px) {
    .dx-row { grid-template-columns: minmax(0, 1fr); }
    .dx-donut { flex-direction: row; align-items: center; justify-content: center; gap: 36px; }
    .dx-donut-host { flex: 0 0 220px; margin: 0; }
    .dx-legend { flex: 1; max-width: 380px; }
}

@media (max-width: 1023px) {
    .dx-date { display: none; }
}

@media (max-width: 819px) {
    .dx-report { flex-direction: column; align-items: flex-start; padding: 24px 22px 24px 26px; }
}

@media (max-width: 719px) {
    .dx-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .dx-stat, .dx-stat:nth-child(1), .dx-stat:nth-child(2) { grid-column: span 1; padding: 16px; }
    .dx-stat:nth-child(1) { grid-column: span 2; }
    .dx-stat:last-child:nth-child(even) { grid-column: span 1; }
    .dx-stat-value { font-size: 32px; }
    .dx-panel { padding: 20px 16px; border-radius: 20px; }
    .dx-panel-head { flex-wrap: wrap; }
    .dx-seg { width: 100%; }
    .dx-seg-btn { flex: 1; }
    .dx-donut { flex-direction: column; gap: 22px; }
    .dx-donut-host { flex-basis: auto; margin: 0 auto; }
    .dx-legend { max-width: none; width: 100%; }
    .dx-report-main { flex-direction: column; align-items: flex-start; gap: 14px; }
    .dx-report-cta { width: 100%; justify-content: center; }

    .dx-table-wrap { margin: 0; overflow: visible; }
    .dx-table thead { display: none; }
    .dx-table, .dx-table tbody, .dx-table tr, .dx-table td { display: block; width: 100%; }
    .dx-table tbody tr { padding: 14px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
    .dx-table tbody tr:last-child { border-bottom: 0; }
    .dx-table td { padding: 0; border: 0; }
    .dx-table td + td { margin-top: 8px; }
    .dx-table td[data-label]:not([data-label="Artikel"]) { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
    .dx-table td[data-label]:not([data-label="Artikel"])::before { content: attr(data-label); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-soft); }
    .dx-art-title { max-width: none; }
    .dx-col-end { text-align: left !important; }
    .dx-col-end .dx-view { width: 100%; justify-content: center; }
}
</style>
@endpush

@section('content')

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
    <div class="hero-inner dx-hero">
        <div class="dx-hero-text">
            <span class="hero-label">DASHBOARD ADMIN</span>
            <h1 class="hero-title" id="page-title">Selamat datang, {{ auth()->user()->name }}!</h1>
            <p class="hero-lead">Anda login sebagai {{ auth()->user()->role }}. Pantau publikasi, status artikel, dan aktivitas RuangKabar dalam satu tempat.</p>
            <div class="hero-actions">
                <a class="btn btn--gold" href="{{ route('articles.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tulis Artikel Baru</a>
            </div>
        </div>

        <div class="dx-date" aria-label="Tanggal hari ini">
            <span class="dx-date-day">{{ $now->copy()->locale('id')->translatedFormat('d') }}</span>
            <span class="dx-date-month">{{ $now->copy()->locale('id')->translatedFormat('F Y') }}</span>
            <span class="dx-date-week">{{ $now->copy()->locale('id')->translatedFormat('l') }}</span>
        </div>
    </div>
</section>

<section aria-labelledby="stat-title">
    <h2 class="dx-h" id="stat-title">Ringkasan Cepat</h2>
    <div class="dx-stats">
        <a class="dx-stat" href="{{ route('articles.index') }}">
            <span class="dx-stat-top">
                <span class="dx-stat-label">Total Artikel</span>
                <span class="dx-stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 2.5h7l3 3v12H5z"/><path d="M12 2.5v3h3M7.5 10h5M7.5 13h5"/></svg></span>
            </span>
            <span class="dx-stat-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
            <span class="dx-stat-foot">
                @if ($articleDelta)
                    <span class="dx-pill dx-pill--{{ $articleDelta['dir'] }}">@if ($articleDelta['dir'] === 'up')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V2M2.5 5.5L6 2l3.5 3.5"/></svg>@elseif ($articleDelta['dir'] === 'down')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2v8M2.5 6.5L6 10l3.5-3.5"/></svg>@endif{{ $articleDelta['pct'] }}%</span>
                @endif
                    <span class="dx-stat-note">
                        {{ number_format($articlesThis, 0, ',', '.') }} baru bulan ini
                        @if ($articleDelta)
                            , {{ number_format($articlesLast, 0, ',', '.') }} bulan lalu
                        @endif
                    </span>            
                </span>
        </a>

        <a class="dx-stat" href="{{ route('categories.index') }}">
            <span class="dx-stat-top">
                <span class="dx-stat-label">Total Kategori</span>
                <span class="dx-stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 6V5a1 1 0 011-1h4l2 2h7a1 1 0 011 1v8a1 1 0 01-1 1h-13a1 1 0 01-1-1z"/></svg></span>
            </span>
            <span class="dx-stat-value">{{ number_format($totalCategories, 0, ',', '.') }}</span>
            <span class="dx-stat-foot"><span class="dx-stat-note">{{ number_format($usedCategories, 0, ',', '.') }} sudah dipakai artikel</span></span>
        </a>

        <a class="dx-stat" href="{{ route('tags.index') }}">
            <span class="dx-stat-top">
                <span class="dx-stat-label">Total Tag</span>
                <span class="dx-stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>
            </span>
            <span class="dx-stat-value">{{ number_format($totalTags, 0, ',', '.') }}</span>
            <span class="dx-stat-foot"><span class="dx-stat-note">{{ number_format($usedTags, 0, ',', '.') }} sudah dipakai artikel</span></span>
        </a>

        <a class="dx-stat" href="{{ route('comments.index') }}">
            <span class="dx-stat-top">
                <span class="dx-stat-label">Total Komentar</span>
                <span class="dx-stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>
            </span>
            <span class="dx-stat-value">{{ number_format($totalComments, 0, ',', '.') }}</span>
            <span class="dx-stat-foot"><span class="dx-stat-note">Kelola di moderasi komentar</span></span>
        </a>

        <a class="dx-stat" href="{{ route('admin.users.index') }}">
            <span class="dx-stat-top">
                <span class="dx-stat-label">Total Pengguna</span>
                <span class="dx-stat-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="7" r="3"/><path d="M2.5 16c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14 4.5a3 3 0 010 5.5M17.5 16c0-2.2-1.2-3.8-3-4.6"/></svg></span>
            </span>
            <span class="dx-stat-value">{{ number_format($totalUsers, 0, ',', '.') }}</span>
            <span class="dx-stat-foot">
                @if ($userDelta)
                    <span class="dx-pill dx-pill--{{ $userDelta['dir'] }}">@if ($userDelta['dir'] === 'up')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V2M2.5 5.5L6 2l3.5 3.5"/></svg>@elseif ($userDelta['dir'] === 'down')<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2v8M2.5 6.5L6 10l3.5-3.5"/></svg>@endif{{ $userDelta['pct'] }}%</span>
                @endif
                <span class="dx-stat-note">{{ number_format($totalWriters, 0, ',', '.') }} penulis, {{ number_format($totalReaders, 0, ',', '.') }} pembaca</span>
            </span>
        </a>
    </div>
</section>

<section class="dx-section" aria-labelledby="report-title">
    <a class="dx-report" href="{{ route('reports.articles') }}">
        <span class="dx-report-main">
            <span class="dx-report-icon" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16V9M10 16V4M16 16v-5"/></svg></span>
            <span>
                <span class="dx-report-eyebrow">Ringkasan Laporan</span>
                <h2 class="dx-report-title" id="report-title">Laporan RuangKabar</h2>
                <p class="dx-report-text">Buka halaman Laporan untuk melihat rekap lengkap yang disusun dari data portal. Ringkasan di dashboard ini hanya pengantar, rincian tetap ada di halaman Laporan.</p>
            </span>
        </span>
        <span class="dx-report-cta">Buka Laporan <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
    </a>
</section>

<section class="dx-row" aria-label="Grafik">
    <article class="dx-panel" aria-labelledby="bar-title">
        <header class="dx-panel-head">
            <div>
                <h2 class="dx-panel-title" id="bar-title">Publikasi Artikel</h2>
                <p class="dx-panel-sub" id="bar-summary">Artikel dipublikasikan per bulan</p>
            </div>
            <div class="dx-seg" role="group" aria-label="Rentang waktu">
                <button class="dx-seg-btn is-on" type="button" data-range="6" aria-pressed="true">6 bulan</button>
                <button class="dx-seg-btn" type="button" data-range="12" aria-pressed="false">12 bulan</button>
            </div>
        </header>

        @if ($hasMonthData)
            <div class="dx-chart" id="bar-chart"></div>
        @else
            <div class="dx-empty">
                <strong>Belum ada artikel terbit</strong>
                <p>Grafik muncul setelah ada artikel berstatus published dalam 12 bulan terakhir.</p>
            </div>
        @endif
    </article>

    <article class="dx-panel" aria-labelledby="donut-title">
        <header class="dx-panel-head">
            <div>
                <h2 class="dx-panel-title" id="donut-title">Status Artikel</h2>
                <p class="dx-panel-sub">Distribusi seluruh artikel</p>
            </div>
        </header>

        @if ($statusTotal > 0)
            <div class="dx-donut" id="donut">
                <div class="dx-donut-host" id="donut-host">
                    <svg class="dx-donut-svg" viewBox="0 0 200 200" role="img" aria-label="Grafik donat status artikel">
                        <circle cx="100" cy="100" r="70" fill="none" stroke="#E7E0D2" stroke-width="26" opacity="0.55"/>
                        <g transform="rotate(-90 100 100)">
                            @foreach ($statusData as $i => $seg)
                                @php
                                    $len = ($seg['value'] / $statusTotal) * $circ;
                                    $dash = max($len - $gap, 0.01);
                                @endphp
                                <circle class="dx-arc" tabindex="0" data-index="{{ $i }}" data-label="{{ $seg['label'] }}" data-value="{{ $seg['value'] }}" data-pct="{{ round(($seg['value'] / $statusTotal) * 100) }}" cx="100" cy="100" r="70" fill="none" stroke="{{ $seg['color'] }}" stroke-width="26" stroke-dasharray="{{ round($dash, 3) }} {{ round($circ, 3) }}" stroke-dashoffset="{{ round(-$cum, 3) }}" aria-label="{{ $seg['label'] }}: {{ $seg['value'] }} artikel"/>
                                @php $cum += $len; @endphp
                            @endforeach
                        </g>
                        <text class="dx-donut-num" id="donut-value" x="100" y="102" text-anchor="middle">{{ $statusTotal }}</text>
                        <text class="dx-donut-cap" id="donut-label" x="100" y="122" text-anchor="middle">Artikel</text>
                    </svg>
                </div>

                <ul class="dx-legend">
                    @foreach ($statusData as $i => $seg)
                        <li class="dx-legend-item" data-index="{{ $i }}">
                            <span class="dx-legend-dot" style="background: {{ $seg['color'] }}"></span>
                            <span class="dx-legend-name">{{ $seg['label'] }}</span>
                            <span class="dx-legend-count">{{ number_format($seg['value'], 0, ',', '.') }}</span>
                            <span class="dx-legend-pct">{{ round(($seg['value'] / $statusTotal) * 100) }}%</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="dx-empty">
                <strong>Belum ada artikel</strong>
                <p>Distribusi status akan tampil setelah artikel pertama dibuat.</p>
            </div>
        @endif
    </article>
</section>

<section class="dx-row" aria-label="Artikel dan kategori">
    <article class="dx-panel" aria-labelledby="recent-title">
        <header class="dx-panel-head">
            <div>
                <h2 class="dx-panel-title" id="recent-title">Artikel Terbaru</h2>
                <p class="dx-panel-sub">Enam artikel yang terakhir dibuat</p>
            </div>
            <a class="dx-link" href="{{ route('articles.index') }}">Semua artikel <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
        </header>

        @if ($recentArticles->isNotEmpty())
            <div class="dx-table-wrap">
                <table class="dx-table">
                    <thead>
                        <tr>
                            <th scope="col">Artikel</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="dx-col-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentArticles as $article)
                            @php [$sLabel, $sColor] = $statusInfo($article->status); @endphp
                            <tr>
                                <td data-label="Artikel">
                                    <a class="dx-art-title" href="{{ route('articles.show', $article) }}">{{ \Illuminate\Support\Str::limit($article->title, 70) }}</a>
                                    <span class="dx-art-by">{{ $article->user->name ?? 'Redaksi' }}</span>
                                </td>
                                <td data-label="Kategori">{{ $article->category->name ?? '-' }}</td>
                                <td data-label="Status"><span class="dx-badge" style="--c: {{ $sColor }}">{{ $sLabel }}</span></td>
                                <td data-label="Tanggal">{{ $article->created_at ? $article->created_at->locale('id')->translatedFormat('d M Y') : '-' }}</td>
                                <td class="dx-col-end"><a class="dx-view" href="{{ route('articles.show', $article) }}" aria-label="Lihat artikel {{ $article->title }}">Lihat</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="dx-empty">
                <strong>Belum ada artikel</strong>
                <p>Artikel terbaru akan tampil di sini setelah dibuat.</p>
                <a class="btn" href="{{ route('articles.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tulis Artikel Baru</a>
            </div>
        @endif
    </article>

    <article class="dx-panel" aria-labelledby="topcat-title">
        <header class="dx-panel-head">
            <div>
                <h2 class="dx-panel-title" id="topcat-title">Kategori Terpopuler</h2>
                <p class="dx-panel-sub">Berdasarkan jumlah artikel</p>
            </div>
        </header>

        @if ($topCategories->isNotEmpty() && $totalArticles > 0)
            <ul class="dx-rank">
                @foreach ($topCategories as $cat)
                    <li class="dx-rank-item">
                        <div class="dx-rank-top">
                            <a class="dx-rank-name" href="{{ route('kategori.show', $cat) }}" target="_blank" rel="noopener">{{ $cat->name }}</a>
                            <span class="dx-rank-count">{{ number_format($cat->articles_count, 0, ',', '.') }} artikel</span>
                        </div>
                        <div class="dx-rank-bar"><span style="width: {{ round(($cat->articles_count / $topMax) * 100) }}%; animation-delay: {{ $loop->index * 80 }}ms"></span></div>
                    </li>
                @endforeach
            </ul>
            <a class="dx-link dx-link--foot" href="{{ route('categories.index') }}">Kelola kategori <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
        @else
            <div class="dx-empty">
                <strong>Belum ada data</strong>
                <p>Peringkat muncul setelah kategori dipakai oleh artikel.</p>
                <a class="btn" href="{{ route('categories.create') }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tambah Kategori</a>
            </div>
        @endif
    </article>
</section>

@endsection

@push('scripts')
<script>
(function () {
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
        tip.className = 'dx-tip';
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
        tip.style.top = Math.max(y - 12, tip.offsetHeight + 4) + 'px';
    }

    var barHost = document.getElementById('bar-chart');
    if (barHost && dash.months) {
        var barTip = makeTip(barHost);
        var summary = document.getElementById('bar-summary');
        var rangeBtns = [].slice.call(document.querySelectorAll('[data-range]'));
        var range = 6;
        var animate = true;

        var drawBars = function () {
            var items = dash.months.slice(-range);
            var old = barHost.querySelector('svg');
            if (old) { barHost.removeChild(old); }
            barTip.hidden = true;
            barHost.classList.remove('has-hover');

            var w = Math.max(barHost.clientWidth, 260);
            var h = 280;
            var m = { t: 26, r: 8, b: 34, l: 34 };
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
                svgNode('line', { x1: m.l, x2: w - m.r, y1: gy, y2: gy, class: 'dx-grid' }, svg);
                var yl = svgNode('text', { x: m.l - 10, y: gy + 4, 'text-anchor': 'end', class: 'dx-axis' }, svg);
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

                var bg = svgNode('rect', { x: m.l + band * i + 2, y: m.t - 10, width: band - 4, height: ih + 10, rx: 10, class: 'dx-band' }, svg);

                if (it.value > 0) {
                    var r = Math.min(9, bw / 2, bh);
                    bar = svgNode('path', {
                        d: 'M' + x + ',' + (y + bh) + 'L' + x + ',' + (y + r) + 'Q' + x + ',' + y + ' ' + (x + r) + ',' + y + 'L' + (x + bw - r) + ',' + y + 'Q' + (x + bw) + ',' + y + ' ' + (x + bw) + ',' + (y + r) + 'L' + (x + bw) + ',' + (y + bh) + 'Z',
                        class: 'dx-bar' + (isCurrent ? ' is-current' : '')
                    }, svg);
                    if (animate) { bar.style.animationDelay = (i * 45) + 'ms'; } else { bar.style.animation = 'none'; }
                } else {
                    bar = svgNode('rect', { x: x, y: m.t + ih - 4, width: bw, height: 4, rx: 2, class: 'dx-bar-zero' }, svg);
                }

                var val = svgNode('text', { x: x + bw / 2, y: (it.value > 0 ? y : m.t + ih - 4) - 8, class: 'dx-value' }, svg);
                val.textContent = it.value;

                if (i % skip === (items.length - 1) % skip) {
                    var xl = svgNode('text', { x: x + bw / 2, y: h - 10, 'text-anchor': 'middle', class: 'dx-axis' }, svg);
                    xl.textContent = it.label;
                }

                var hit = svgNode('rect', {
                    x: m.l + band * i, y: m.t - 10, width: band, height: ih + 18, class: 'dx-hit', tabindex: 0,
                    'aria-label': it.full + ': ' + it.value + ' artikel'
                }, svg);

                var on = function () {
                    barHost.classList.add('has-hover');
                    bar.classList.add('is-hover');
                    bg.classList.add('is-on');
                    val.classList.add('is-on');
                    barTip.hidden = true;
                    showTip(barTip, barHost, x + bw / 2, (it.value > 0 ? y : m.t + ih - 4) - 14, it.full, it.value + ' artikel');
                };

                var off = function () {
                    barHost.classList.remove('has-hover');
                    bar.classList.remove('is-hover');
                    bg.classList.remove('is-on');
                    val.classList.remove('is-on');
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

            animate = false;
        };

        rangeBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                range = parseInt(btn.getAttribute('data-range'), 10);
                animate = true;
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
        var arcs = [].slice.call(donut.querySelectorAll('.dx-arc'));
        var rows = [].slice.call(donut.querySelectorAll('.dx-legend-item'));
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
@endpush