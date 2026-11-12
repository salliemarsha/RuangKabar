<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $category->name }} - Berita - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <script>document.documentElement.classList.add('js');</script>

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
    --gap: 28px;
    --r-md: 16px;
    --r-lg: 28px;
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
    --t-fast: 200ms;
    --t-ui: 300ms;
    --t-enter: 560ms;
}

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    font-family: var(--sans);
    color: var(--text);
    background: var(--ivory);
    overflow-x: clip;
    overflow-wrap: break-word;
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
}

a { color: inherit; }

a:focus-visible,
button:focus-visible,
input:focus-visible {
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

.wrap {
    max-width: var(--wrap);
    margin: 0 auto;
    padding: 0 var(--pad);
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
    color: var(--white);
    background: var(--forest);
    border: 0;
    border-radius: 999px;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.btn:hover { background: var(--emerald); }
.btn:active { transform: scale(0.97); }

.btn--ghost {
    color: var(--emerald);
    background: transparent;
    border: 1px solid rgba(24, 60, 54, 0.3);
}

.btn--ghost:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.page-head { margin-top: 20px; }

.page-head__panel {
    position: relative;
    overflow: hidden;
    padding: 52px 56px 40px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: var(--r-lg);
}

.page-head__panel::before {
    content: "";
    position: absolute;
    top: -170px;
    right: -100px;
    width: 460px;
    height: 460px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.page-head__panel::after {
    content: "";
    position: absolute;
    right: 84px;
    top: 64px;
    width: 150px;
    height: 150px;
    border: 1px solid rgba(185, 154, 100, 0.45);
    border-radius: 50%;
}

.page-head__inner {
    position: relative;
    z-index: 1;
    animation: rise var(--t-enter) var(--ease) both;
}

.page-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding: 8px 16px 8px 12px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.14);
    border: 1px solid rgba(250, 248, 243, 0.25);
    border-radius: 999px;
}

.page-label::before {
    content: "";
    width: 8px;
    height: 8px;
    background: var(--gold);
    border-radius: 50%;
}

.page-title {
    max-width: 760px;
    margin: 0 0 14px;
    font-family: var(--serif);
    font-size: clamp(34px, 4.6vw, 56px);
    font-weight: 600;
    line-height: 1.1;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.page-lead {
    max-width: 600px;
    margin: 0;
    font-family: var(--body);
    font-size: 16px;
    line-height: 1.7;
    color: var(--on-dark);
}

.page-head__cats {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(250, 248, 243, 0.16);
}

.chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 40px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    white-space: nowrap;
    background: rgba(250, 248, 243, 0.08);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 999px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.chip:hover {
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.18);
}

.chip.is-active {
    color: var(--emerald);
    background: var(--ivory);
    border-color: var(--ivory);
}

.chip.is-active::before {
    content: "";
    width: 6px;
    height: 6px;
    background: var(--gold);
    border-radius: 50%;
}

.listing { padding-top: 40px; padding-bottom: 88px; }

.listing-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px 24px;
    margin-bottom: 28px;
}

.result-info {
    margin: 0;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.result-info strong { font-weight: 600; color: var(--text); }

.search {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    max-width: 400px;
    height: 52px;
    padding: 0 5px 0 20px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
}

.search:focus-within {
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.18);
}

.search > svg {
    flex: none;
    width: 18px;
    height: 18px;
    color: var(--forest);
}

.search input {
    flex: 1;
    min-width: 0;
    height: 48px;
    padding: 0;
    font-family: var(--body);
    font-size: 15px;
    color: var(--text);
    background: transparent;
    border: 0;
}

.search input:focus { outline: none; }
.search input::placeholder { color: var(--text-soft); }
.search .btn { height: 42px; padding: 0 22px; }

.media {
    display: block;
    overflow: hidden;
    text-decoration: none;
    background: var(--sand);
    border-radius: var(--r-md);
}

.media > img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 600ms var(--ease);
}

.ph {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: var(--emerald);
}

.ph img {
    display: block;
    width: 56px;
    height: 56px;
    object-fit: contain;
    flex: none;
}

.cat {
    position: relative;
    z-index: 2;
    align-self: flex-start;
    margin-bottom: 10px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.cat:hover {
    color: var(--emerald);
    text-decoration: underline;
    text-decoration-color: var(--gold);
    text-underline-offset: 3px;
}

.stretch::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 1;
}

.meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 2px 14px;
    margin-top: auto;
    padding-top: 14px;
    font-family: var(--body);
    font-size: 13px;
    color: var(--text-soft);
    border-top: 1px solid var(--rule);
}

.meta span:first-child { font-weight: 500; color: var(--text); }

.feature {
    position: relative;
    display: grid;
    grid-template-columns: minmax(0, 7fr) minmax(0, 5fr);
    gap: 44px;
    align-items: center;
    margin-bottom: var(--gap);
    padding: 16px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: var(--r-lg);
    transition: box-shadow var(--t-ui) ease-out;
}

.feature .media {
    aspect-ratio: 16 / 11;
    border-radius: 20px;
}

.feature-body {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-width: 0;
    padding: 8px 24px 8px 0;
}

.feature-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
}

.feature-label::before {
    content: "";
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.feature-title {
    display: -webkit-box;
    margin: 0 0 14px;
    overflow: hidden;
    font-family: var(--serif);
    font-size: clamp(24px, 2.6vw, 36px);
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: -0.01em;
    overflow-wrap: anywhere;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
}

.feature-title a {
    color: var(--emerald);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.feature-excerpt {
    display: -webkit-box;
    margin: 0 0 20px;
    overflow: hidden;
    font-family: var(--body);
    font-size: 16px;
    line-height: 1.75;
    color: var(--text-soft);
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
}

.feature .meta {
    width: 100%;
    margin-top: 0;
    margin-bottom: 20px;
}

.feature-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
}

.feature-more svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }

.grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: var(--gap);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    padding: 12px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

.card .media { aspect-ratio: 16 / 10; }

.card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 20px 10px 8px;
}

.card .title {
    display: -webkit-box;
    margin: 0 0 12px;
    overflow: hidden;
    font-family: var(--serif);
    font-size: 22px;
    font-weight: 600;
    line-height: 1.3;
    letter-spacing: -0.01em;
    overflow-wrap: anywhere;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

.card .title a {
    color: var(--emerald);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.card-excerpt {
    display: -webkit-box;
    margin: 0 0 18px;
    overflow: hidden;
    font-family: var(--body);
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

@media (hover: hover) {
    .card:hover,
    .feature:hover { box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4); }

    .card:hover { transform: translateY(-4px); }

    .card:hover .media > img,
    .feature:hover .media > img { transform: scale(1.03); }

    .card:hover .title a,
    .feature:hover .feature-title a { color: var(--forest); }

    .feature:hover .feature-more svg { transform: translateX(4px); }
}

.pager {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 12px 10px;
    margin-top: 56px;
}

.pager-pages {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pager-btn,
.pager-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 44px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.pager-btn { padding: 0 20px; }
.pager-num { min-width: 44px; padding: 0 8px; }

a.pager-btn:hover,
a.pager-num:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.pager-num.is-current {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}

.pager-btn.is-disabled {
    color: var(--text-soft);
    background: transparent;
    opacity: 0.6;
}

.pager-gap { padding: 0 4px; color: var(--text-soft); }

.pager-status {
    display: none;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.empty {
    padding: 72px 32px;
    text-align: center;
    background: var(--sand);
    border-radius: var(--r-lg);
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    margin: 0 auto 20px;
    color: var(--gold);
    background: var(--emerald);
    border-radius: 50%;
}

.empty-icon svg { width: 28px; height: 28px; }

.empty strong {
    display: block;
    margin-bottom: 8px;
    font-family: var(--serif);
    font-size: 28px;
    font-weight: 600;
    color: var(--emerald);
}

.empty p {
    max-width: 460px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.7;
    color: var(--text-soft);
}

.empty-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: 24px;
}

@keyframes rise {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: none; }
}

.js .reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity var(--t-enter) var(--ease), transform var(--t-enter) var(--ease);
}

.js .reveal.is-visible { opacity: 1; transform: none; }

.js .card.reveal.is-visible {
    transition: opacity var(--t-enter) var(--ease), transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

.footer { color: var(--on-dark); background: var(--emerald); }

.footer-grid {
    display: grid;
    grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 3fr) minmax(0, 3fr);
    gap: 32px 48px;
    padding-top: 64px;
    padding-bottom: 48px;
}

.footer-about {
    max-width: 300px;
    margin: 16px 0 0;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.7;
}

.footer-title {
    margin: 0 0 14px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--gold);
}

.footer-links { margin: 0; padding: 0; list-style: none; }

.footer-links a {
    display: inline-block;
    padding: 6px 0;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 500;
    color: var(--on-dark);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.footer-links a:hover { color: var(--ivory); }

.footer-bottom {
    padding: 20px 0 28px;
    border-top: 1px solid rgba(250, 248, 243, 0.12);
    font-family: var(--sans);
    font-size: 13px;
}

@media (max-width: 1023px) {
    :root { --pad: 24px; --r-lg: 24px; --gap: 20px; }

    .page-head__panel { padding: 44px 40px 34px; }
    .page-head__panel::after { display: none; }

    .listing { padding-top: 32px; padding-bottom: 72px; }

    .feature { grid-template-columns: minmax(0, 1fr); gap: 20px; }
    .feature-body { padding: 4px 8px 12px; }

    .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .footer-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .footer-brand { grid-column: 1 / -1; }
}

@media (max-width: 719px) {
    :root { --pad: 16px; --r-lg: 22px; --gap: 18px; }

    .page-head { margin-top: 14px; }
    .page-head__panel { padding: 32px 22px 26px; }
    .page-head__panel::before { width: 300px; height: 300px; top: -120px; right: -120px; }

    .page-label { margin-bottom: 16px; }
    .page-lead { font-size: 15px; }

    .page-head__cats { margin-top: 24px; padding-top: 20px; }

    .chips {
        flex-wrap: nowrap;
        margin: 0 -22px;
        padding: 0 22px 4px;
        overflow-x: auto;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
    }

    .chips::-webkit-scrollbar { display: none; }

    .chip { flex: none; }

    .listing { padding-top: 28px; padding-bottom: 56px; }

    .listing-bar { flex-direction: column; align-items: stretch; gap: 14px; }
    .search { max-width: none; order: -1; }

    .feature { padding: 10px; border-radius: 22px; }
    .feature .media { aspect-ratio: 4 / 3; }
    .feature-body { padding: 4px 8px 10px; }
    .feature-excerpt { font-size: 15px; }

    .grid { grid-template-columns: minmax(0, 1fr); }

    .card-body { padding: 18px 8px 6px; }
    .card .title { font-size: 20px; }

    .pager { margin-top: 40px; }
    .pager-pages { display: none; }
    .pager-status { display: block; order: -1; width: 100%; text-align: center; }
    .pager-btn { flex: 1 1 0; padding: 0 10px; }

    .empty { padding: 48px 20px; }
    .empty strong { font-size: 24px; }
    .empty-actions .btn { width: 100%; }

    .footer-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 28px 24px; padding-top: 44px; }
}

@media (max-width: 479px) {
    .footer-grid { grid-template-columns: minmax(0, 1fr); }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }

    .js .reveal { opacity: 1; transform: none; }

    .card:hover,
    .card:hover .media > img,
    .feature:hover .media > img,
    .feature:hover .feature-more svg { transform: none; }
}
    </style>
</head>
<body>

    @php
        $str = \Illuminate\Support\Str::class;
        $allCategories = \App\Models\Category::orderBy('name')->get();
        $isPaginator = $articles instanceof \Illuminate\Contracts\Pagination\Paginator;
        $items = collect($isPaginator ? $articles->items() : $articles);
        $total = $isPaginator && method_exists($articles, 'total') ? $articles->total() : $items->count();
        $featured = $items->first();
        $rest = $items->slice(1)->values();
        $hasDescription = !empty($category->description);
    @endphp

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    @include('components.navbar-public')

    <main id="konten">
        <section class="page-head wrap" aria-labelledby="page-title">
            <div class="page-head__panel">
                <div class="page-head__inner">
                    <span class="page-label">KATEGORI</span>

                    <h1 class="page-title" id="page-title">{{ $category->name }}</h1>

                    <p class="page-lead">
                        @if ($hasDescription)
                            {{ $category->description }}
                        @elseif ($total > 0)
                            {{ $total }} berita dalam kategori ini.
                        @else
                            Belum ada berita dalam kategori ini.
                        @endif
                    </p>

                    @if ($allCategories->count())
                        <nav class="page-head__cats" aria-label="Kategori berita">
                            <ul class="chips">
                                <li><a class="chip" href="{{ route('articles.index') }}">Semua</a></li>
                                @foreach ($allCategories as $cat)
                                    <li>
                                        <a
                                            class="chip {{ $cat->is($category) ? 'is-active' : '' }}"
                                            href="{{ route('kategori.show', $cat) }}"
                                            {!! $cat->is($category) ? 'aria-current="page"' : '' !!}
                                        >{{ $cat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </section>

        <section class="listing wrap" aria-label="Berita kategori {{ $category->name }}">
            <div class="listing-bar">
                <p class="result-info">
                    @if ($items->isNotEmpty())
                        @if ($isPaginator && $articles->firstItem())
                            Menampilkan <strong>{{ $articles->firstItem() }}&ndash;{{ $articles->lastItem() }}</strong> dari <strong>{{ $total }}</strong> berita
                        @else
                            <strong>{{ $total }}</strong> berita
                        @endif
                    @else
                        Belum ada berita
                    @endif
                </p>

                <form class="search" action="{{ route('articles.index') }}" method="GET" role="search">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                    <label class="sr-only" for="q">Cari berita</label>
                    <input id="q" type="search" name="search" placeholder="Cari berita" value="{{ request('search') }}" autocomplete="off">
                    <button class="btn" type="submit">Cari</button>
                </form>
            </div>

            @if ($items->isNotEmpty())
                @if ($featured)
                    <article class="feature reveal">
                        <a class="media" href="{{ route('articles.show', $featured) }}" tabindex="-1" aria-hidden="true">
                            @if ($featured->image)
                                <img src="{{ asset('storage/' . $featured->image) }}" alt="" loading="lazy">
                            @else
                                <div class="ph">
                                    <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                </div>
                            @endif
                        </a>

                        <div class="feature-body">
                            <span class="feature-label">Berita Unggulan</span>

                            <a class="cat" href="{{ route('kategori.show', $featured->category) }}">{{ $featured->category->name }}</a>

                            <h2 class="feature-title">
                                <a class="stretch" href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a>
                            </h2>

                            <p class="feature-excerpt">{{ $str::limit(strip_tags($featured->content), 220) }}</p>

                            <div class="meta">
                                <span>{{ $featured->user->name ?? 'Redaksi' }}</span>
                                @if ($featured->created_at)
                                    <time datetime="{{ $featured->created_at->toDateString() }}">{{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                            </div>

                            <span class="feature-more" aria-hidden="true">
                                Baca Selengkapnya
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                            </span>
                        </div>
                    </article>
                @endif

                @if ($rest->isNotEmpty())
                    <div class="grid">
                        @foreach ($rest as $article)
                            <article class="card reveal">
                                <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">
                                            <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                        </div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <a class="cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

                                    <h3 class="title">
                                        <a class="stretch" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h3>

                                    <p class="card-excerpt">{{ $str::limit(strip_tags($article->content), 110) }}</p>

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
                @endif

                @if ($isPaginator && $articles->hasPages())
                    @php
                        $current = $articles->currentPage();
                        $last = $articles->lastPage();
                        $window = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)->values();
                        $prev = null;
                    @endphp

                    <nav class="pager" aria-label="Navigasi halaman">
                        @if ($articles->onFirstPage())
                            <span class="pager-btn is-disabled" aria-disabled="true"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</span>
                        @else
                            <a class="pager-btn" href="{{ $articles->previousPageUrl() }}" rel="prev"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</a>
                        @endif

                        <ul class="pager-pages">
                            @foreach ($window as $page)
                                @if ($prev !== null && $page - $prev > 1)
                                    <li class="pager-gap" aria-hidden="true">&hellip;</li>
                                @endif

                                <li>
                                    @if ($page === $current)
                                        <span class="pager-num is-current" aria-current="page">{{ $page }}</span>
                                    @else
                                        <a class="pager-num" href="{{ $articles->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                                    @endif
                                </li>

                                @php $prev = $page; @endphp
                            @endforeach
                        </ul>

                        @if ($articles->hasMorePages())
                            <a class="pager-btn" href="{{ $articles->nextPageUrl() }}" rel="next">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></a>
                        @else
                            <span class="pager-btn is-disabled" aria-disabled="true">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></span>
                        @endif

                        <span class="pager-status">Halaman {{ $current }} dari {{ $last }}</span>
                    </nav>
                @endif
            @else
                <div class="empty">
                    <span class="empty-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h11a2 2 0 0 1 2 2v13a1 1 0 0 0 1 1H6a2 2 0 0 1-2-2V5a1 1 0 0 1 1-1z"/><path d="M18 9h2a1 1 0 0 1 1 1v8a2 2 0 0 1-2 2"/><path d="M8 8h6M8 12h6M8 16h4"/></svg>
                    </span>

                    <strong>Belum ada berita dalam kategori ini.</strong>
                    <p>Berita pada kategori <em>{{ $category->name }}</em> akan tampil di sini setelah dipublikasikan.</p>

                    <div class="empty-actions">
                        <a class="btn" href="{{ route('articles.index') }}">Semua Berita</a>
                        <a class="btn btn--ghost" href="/">Kembali ke Beranda</a>
                    </div>
                </div>
            @endif
        </section>
    </main>

    <footer class="footer">
        <div class="wrap footer-grid">
            <div class="footer-brand">
                <a class="rk-brand" href="/" aria-label="RuangKabar, ke beranda">
                    <svg class="rk-brand__mark" aria-hidden="true" focusable="false"><use href="#rk-mark"/></svg>
                    <span class="rk-brand__name">Ruang<span>Kabar</span></span>
                </a>
                <p class="footer-about">Portal berita dan informasi terkini.</p>
            </div>

            <div>
                <h2 class="footer-title">Jelajahi</h2>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('articles.index') }}">Semua Berita</a></li>
                </ul>
            </div>

            <div>
                <h2 class="footer-title">Kategori</h2>
                <ul class="footer-links">
                    @foreach ($allCategories as $cat)
                        <li><a href="{{ route('kategori.show', $cat) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="footer-title">Akun</h2>
                <ul class="footer-links">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li><a href="/admin/dashboard">Dashboard</a></li>
                        @elseif (auth()->user()->role === 'penulis')
                            <li><a href="/penulis/dashboard">Dashboard</a></li>
                        @else
                            <li><a href="/beranda">Akun Saya</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="wrap">
            <div class="footer-bottom">
                &copy; {{ date('Y') }} RuangKabar. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
(function () {
    var items = document.querySelectorAll('.reveal');
    if (!items.length) return;

    if (!('IntersectionObserver' in window)) {
        items.forEach(function (el) { el.classList.add('is-visible'); });
        return;
    }

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                (function (el) {
                    setTimeout(function () { el.style.transitionDelay = ''; }, 900);
                })(entry.target);
                io.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });

    items.forEach(function (el, i) {
        el.style.transitionDelay = (i % 3) * 80 + 'ms';
        io.observe(el);
    });
})();
    </script>

</body>
</html>