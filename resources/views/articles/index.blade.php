
@extends('layouts.public')

@php
    $mSearch = trim((string) ($search ?? request('search')));
    $mBase = route('articles.index');
@endphp

@section('title', 'Jelajahi Berita')
@section('description', 'Telusuri berita dan informasi terbaru dari RuangKabar.')

@section('content')
    <div class="idx-page wrap">

        <section class="idx-hero" aria-labelledby="page-title">
            <div class="idx-hero__inner">
                <span class="idx-label">RUANGKABAR</span>
                <h1 class="idx-title" id="page-title">Jelajahi Berita</h1>
                <p class="idx-lead">Temukan berbagai berita dan informasi terbaru dari RuangKabar.</p>

                <div class="idx-hero__actions">
                    <span class="idx-stat">
                        <strong>{{ number_format($articles->total(), 0, ',', '.') }}</strong>
                        {{ $mSearch !== '' ? 'berita ditemukan' : 'berita tersedia' }}
                    </span>
                </div>
            </div>
        </section>

        @if (session('success'))
            <div class="idx-flash" role="status">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="10" cy="10" r="8"/>
                    <path d="M6.5 10.5l2.5 2.5 4.5-5"/>
                </svg>
                <p>{{ session('success') }}</p>
                <button class="idx-flash__close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="idx-flash idx-flash--error" role="alert">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10 2.5l8 14H2z"/>
                    <path d="M10 8v4M10 14.5v.01"/>
                </svg>
                <p>{{ session('error') }}</p>
                <button class="idx-flash__close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
            </div>
        @endif

        <div class="idx-bar">
            <form class="idx-search" action="{{ route('articles.index') }}" method="GET" role="search">
                <div class="idx-field">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <circle cx="9" cy="9" r="6"/>
                        <path d="M14 14l4 4"/>
                    </svg>

                    <label class="sr-only" for="idx-q">Cari berita</label>
                    <input
                        id="idx-q"
                        type="search"
                        name="search"
                        value="{{ $mSearch }}"
                        placeholder="Cari berita"
                        autocomplete="off"
                    >

                    <button class="btn" type="submit">Cari</button>
                </div>

                @if ($mSearch !== '')
                    <a class="btn btn--ghost" href="{{ $mBase }}">Reset</a>
                @endif
            </form>

            @if ($articles->count())
                <p class="idx-info" aria-live="polite">
                    Menampilkan
                    <strong>{{ $articles->firstItem() }}&ndash;{{ $articles->lastItem() }}</strong>
                    dari
                    <strong>{{ $articles->total() }}</strong>
                    berita
                </p>
            @endif
        </div>

        @if ($articles->count())
            <div class="idx-grid">
                @foreach ($articles as $row)
                    <article class="idx-card">
                        <a
                            class="idx-card__image"
                            href="{{ route('articles.show', $row) }}"
                            aria-label="Baca {{ $row->title }}"
                        >
                            @if ($row->image)
                                <img
                                    src="{{ asset('storage/' . $row->image) }}"
                                    alt=""
                                    loading="lazy"
                                >
                            @else
                                <span class="idx-card__ph">
                                    <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                </span>
                            @endif
                        </a>

                        <div class="idx-card__body">
                            <div class="idx-card__meta">
                                @if ($row->category)
                                    <a
                                        class="idx-cat"
                                        href="{{ route('kategori.show', $row->category) }}"
                                    >
                                        {{ $row->category->name }}
                                    </a>
                                @else
                                    <span class="idx-cat">Berita</span>
                                @endif

                                @if ($row->created_at)
                                    <time datetime="{{ $row->created_at->toDateString() }}">
                                        {{ $row->created_at->locale('id')->translatedFormat('d F Y') }}
                                    </time>
                                @endif
                            </div>

                            <h2 class="idx-card__title">
                                <a href="{{ route('articles.show', $row) }}">
                                    {{ $row->title }}
                                </a>
                            </h2>

                            <p class="idx-card__excerpt">
                                {{ \Illuminate\Support\Str::limit(trim(strip_tags($row->content)), 120) }}
                            </p>

                            <div class="idx-card__foot">
                                <span class="idx-author">
                                    {{ $row->user->name ?? 'RuangKabar' }}
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($articles->hasPages())
                @php
                    $current = $articles->currentPage();
                    $last = $articles->lastPage();

                    $window = collect(range(1, $last))
                        ->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)
                        ->values();

                    $previous = null;
                @endphp

                <nav class="idx-pager" aria-label="Navigasi halaman">
                    @if ($articles->onFirstPage())
                        <span class="idx-pager__btn is-disabled" aria-disabled="true">
                            <span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya
                        </span>
                    @else
                        <a class="idx-pager__btn" href="{{ $articles->previousPageUrl() }}" rel="prev">
                            <span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya
                        </a>
                    @endif

                    <ul class="idx-pager__pages">
                        @foreach ($window as $page)
                            @if ($previous !== null && $page - $previous > 1)
                                <li class="idx-pager__gap" aria-hidden="true">&hellip;</li>
                            @endif

                            <li>
                                @if ($page === $current)
                                    <span class="idx-pager__num is-current" aria-current="page">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a class="idx-pager__num" href="{{ $articles->url($page) }}" aria-label="Halaman {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            </li>

                            @php $previous = $page; @endphp
                        @endforeach
                    </ul>

                    @if ($articles->hasMorePages())
                        <a class="idx-pager__btn" href="{{ $articles->nextPageUrl() }}" rel="next">
                            Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span>
                        </a>
                    @else
                        <span class="idx-pager__btn is-disabled" aria-disabled="true">
                            Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span>
                        </span>
                    @endif

                    <span class="idx-pager__status">
                        Halaman {{ $current }} dari {{ $last }}
                    </span>
                </nav>
            @endif

        @elseif ($mSearch !== '')
            <div class="idx-empty">
                <strong>Berita tidak ditemukan.</strong>
                <p>
                    Tidak ada berita yang cocok dengan &ldquo;{{ $mSearch }}&rdquo;.
                    Coba kata kunci lain atau reset pencarian.
                </p>
                <a class="btn btn--ghost" href="{{ $mBase }}">Reset pencarian</a>
            </div>
        @else
            <div class="idx-empty">
                <strong>Belum ada berita.</strong>
                <p>Belum ada berita yang diterbitkan. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>

    @include('components.footer-public')
@endsection

@push('styles')
<style>
.idx-page { padding-top: 20px; padding-bottom: 0; }

.idx-page .btn svg { width: 16px; height: 16px; flex: none; }
.idx-page .btn--gold { color: var(--emerald); background: var(--gold); }
.idx-page .btn--gold:hover { color: var(--emerald); background: #CBAF7C; }
.idx-page .btn--line { color: var(--ivory); background: rgba(250, 248, 243, 0.1); border-color: rgba(250, 248, 243, 0.28); }
.idx-page .btn--line:hover { background: rgba(250, 248, 243, 0.2); border-color: rgba(250, 248, 243, 0.45); }

.idx-hero { position: relative; overflow: hidden; margin-bottom: 24px; padding: 44px 48px; color: var(--ivory); background: var(--emerald); border-radius: var(--r-lg); }
.idx-hero::before { content: ""; position: absolute; top: -140px; right: -100px; width: 400px; height: 400px; background: var(--forest); opacity: 0.45; border-radius: 50%; }
.idx-hero::after { content: ""; position: absolute; right: 72px; bottom: -64px; width: 140px; height: 140px; border: 1px solid rgba(185, 154, 100, 0.5); border-radius: 50%; }
.idx-hero__inner { position: relative; z-index: 1; }
.idx-label { display: inline-flex; align-items: center; gap: 10px; margin-bottom: 18px; padding: 8px 16px 8px 12px; font-size: 12px; font-weight: 700; letter-spacing: 0.1em; color: var(--ivory); background: rgba(250, 248, 243, 0.14); border: 1px solid rgba(250, 248, 243, 0.25); border-radius: 999px; }
.idx-label::before { content: ""; width: 8px; height: 8px; background: var(--gold); border-radius: 50%; }
.idx-title { max-width: 720px; margin: 0 0 12px; font-family: var(--serif); font-size: clamp(30px, 4vw, 46px); font-weight: 600; line-height: 1.12; letter-spacing: -0.015em; overflow-wrap: anywhere; }
.idx-lead { max-width: 540px; margin: 0; font-family: var(--body); font-size: 16px; line-height: 1.7; color: var(--on-dark); }
.idx-hero__actions { display: flex; flex-wrap: wrap; align-items: center; gap: 14px 16px; margin-top: 26px; }
.idx-stat { font-family: var(--body); font-size: 14px; color: var(--on-dark); }
.idx-stat strong { margin-right: 4px; font-family: var(--serif); font-size: 26px; font-weight: 600; color: var(--gold); }

.idx-flash { display: flex; align-items: flex-start; gap: 12px; margin: 0 0 24px; padding: 14px 16px; font-family: var(--body); font-size: 14px; line-height: 1.6; color: var(--emerald); background: var(--white); border: 1px solid var(--rule); border-left: 4px solid var(--forest); border-radius: 14px; }
.idx-flash svg { flex: none; width: 20px; height: 20px; margin-top: 2px; color: var(--forest); }
.idx-flash p { flex: 1; margin: 0; }
.idx-flash--error { color: var(--danger); background: #FFFAF8; border-left-color: var(--danger); }
.idx-flash--error svg { color: var(--danger); }
.idx-flash__close { flex: none; width: 32px; height: 32px; margin: -4px -6px 0 0; font-size: 20px; line-height: 1; color: var(--text-soft); background: none; border: 0; border-radius: 50%; cursor: pointer; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out; }
.idx-flash__close:hover { color: var(--emerald); background: var(--sand); }

.idx-bar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 20px; margin-bottom: 24px; }
.idx-search { display: flex; flex: 1 1 420px; align-items: center; gap: 10px; min-width: 0; max-width: 560px; }
.idx-field { display: flex; flex: 1; align-items: center; gap: 10px; min-width: 0; height: 56px; padding: 0 5px 0 20px; background: var(--white); border: 1px solid var(--rule); border-radius: 999px; transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out; }
.idx-field:focus-within { border-color: var(--forest); box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.18); }
.idx-field > svg { flex: none; width: 18px; height: 18px; color: var(--forest); }
.idx-field input { flex: 1; min-width: 0; height: 52px; padding: 0; font-family: var(--body); font-size: 15px; color: var(--text); background: transparent; border: 0; }
.idx-field input:focus { outline: none; }
.idx-field input::placeholder { color: var(--text-soft); }
.idx-field .btn { height: 44px; padding: 0 22px; }
.idx-search > .btn { height: 56px; }
.idx-info { margin: 0; font-family: var(--body); font-size: 14px; color: var(--text-soft); }
.idx-info strong { font-weight: 600; color: var(--text); }

.idx-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); align-items: stretch; gap: 24px; }
.idx-grid > * { min-width: 0; }
.idx-card { position: relative; display: flex; flex-direction: column; min-width: 0; padding: 12px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.06); border-radius: 22px; transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out; }
.idx-card__image { position: relative; display: block; aspect-ratio: 16 / 10; overflow: hidden; background: var(--sand); border-radius: var(--r-md); }
.idx-card__image > img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform 600ms var(--ease); }
.idx-card__ph { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; background: var(--emerald); }
.idx-card__ph img { display: block; width: 55px; height: 55px; object-fit: contain; }
.idx-card__body { display: flex; flex-direction: column; flex: 1; min-width: 0; padding: 18px 8px 6px; }
.idx-card__meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 14px; margin-bottom: 10px; font-family: var(--body); font-size: 13px; color: var(--text-soft); }
.idx-cat { position: relative; z-index: 1; align-self: flex-start; font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--forest); text-decoration: none; }
a.idx-cat:hover { color: var(--emerald); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.idx-card__title { display: -webkit-box; margin: 0 0 12px; overflow: hidden; font-family: var(--serif); font-size: 21px; font-weight: 600; line-height: 1.3; overflow-wrap: anywhere; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
.idx-card__title a { color: var(--emerald); text-decoration: none; transition: color var(--t-fast) ease-out; }
.idx-card__title a::after { content: ""; position: absolute; inset: 0; z-index: 0; border-radius: 22px; }
.idx-card__excerpt { display: -webkit-box; margin: 0 0 18px; overflow: hidden; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
.idx-card__foot { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px 14px; margin-top: auto; padding-top: 14px; font-family: var(--body); font-size: 13px; color: var(--text-soft); border-top: 1px solid var(--rule); }
.idx-author { min-width: 0; font-weight: 500; color: var(--text); overflow-wrap: anywhere; }

@media (hover: hover) {
    .idx-card:hover { transform: translateY(-4px); box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4); }
    .idx-card:hover .idx-card__image > img { transform: scale(1.03); }
    .idx-card:hover .idx-card__title a { color: var(--forest); }
}

.idx-pager { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px 10px; margin-top: 40px; }
.idx-pager__pages { display: flex; align-items: center; gap: 6px; margin: 0; padding: 0; list-style: none; }
.idx-pager__btn, .idx-pager__num { display: inline-flex; align-items: center; justify-content: center; height: 44px; font-family: var(--sans); font-size: 14px; font-weight: 700; color: var(--emerald); text-decoration: none; background: var(--white); border: 1px solid var(--rule); border-radius: 999px; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.idx-pager__btn { padding: 0 20px; }
.idx-pager__num { min-width: 44px; padding: 0 8px; }
a.idx-pager__btn:hover, a.idx-pager__num:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }
.idx-pager__num.is-current { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }
.idx-pager__btn.is-disabled { color: var(--text-soft); background: transparent; opacity: 0.6; }
.idx-pager__gap { padding: 0 4px; color: var(--text-soft); }
.idx-pager__status { display: none; font-family: var(--body); font-size: 14px; color: var(--text-soft); }

.idx-empty { padding: 64px 28px; text-align: center; background: var(--sand); border-radius: var(--r-lg); }
.idx-empty strong { display: block; margin-bottom: 8px; font-family: var(--serif); font-size: 26px; font-weight: 600; color: var(--emerald); }
.idx-empty p { max-width: 440px; margin: 0 auto; font-family: var(--body); font-size: 15px; line-height: 1.7; color: var(--text-soft); }

@media (max-width: 1100px) {
    .idx-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
}

@media (max-width: 1023px) {
    .idx-page { padding-bottom: 0; }
    .idx-hero { padding: 36px 32px; }
}

@media (max-width: 719px) {
    .idx-page { padding-top: 14px; padding-bottom: 0; }
    .idx-hero { padding: 28px 22px; border-radius: 22px; }
    .idx-hero::after { display: none; }
    .idx-grid { grid-template-columns: minmax(0, 1fr); gap: 18px; }
    .idx-card__title { font-size: 20px; }

    .idx-search { flex-basis: 100%; max-width: none; flex-wrap: wrap; }
    .idx-field { flex: 1 1 100%; height: 54px; padding-left: 16px; }
    .idx-field input { height: 50px; }
    .idx-field .btn { height: 42px; padding: 0 20px; }
    .idx-search > .btn { flex: 1 1 100%; height: 46px; }

    .idx-pager { margin-top: 28px; }
    .idx-pager__pages { display: none; }
    .idx-pager__status { display: block; order: -1; width: 100%; text-align: center; }
    .idx-pager__btn { flex: 1 1 0; padding: 0 10px; }
}

@media (prefers-reduced-motion: reduce) {
    .idx-card, .idx-card:hover, .idx-card:hover .idx-card__image > img { transform: none; }
}

/* ── Footer ─────────────────────────────────────────────── */
.pub-footer {
    margin-top: 72px;
    color: var(--on-dark);
    background: var(--emerald);
}
.pub-footer__grid {
    display: grid;
    grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 3fr) minmax(0, 3fr);
    gap: 32px 48px;
    padding-top: 64px;
    padding-bottom: 48px;
}
.pub-footer__about {
    max-width: 300px;
    margin: 16px 0 0;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.7;
}
.pub-footer__title {
    margin: 0 0 14px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--gold);
}
.pub-footer__links {
    margin: 0;
    padding: 0;
    list-style: none;
}
.pub-footer__links a {
    display: inline-block;
    padding: 6px 0;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 500;
    color: var(--on-dark);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}
.pub-footer__links a:hover { color: var(--ivory); }
.pub-footer__bottom {
    padding: 20px 0 28px;
    border-top: 1px solid rgba(250, 248, 243, 0.12);
    font-family: var(--sans);
    font-size: 13px;
}

@media (max-width: 1023px) {
    .pub-footer { margin-top: 56px; }
    .pub-footer__grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .pub-footer__brand { grid-column: 1 / -1; }
}
@media (max-width: 719px) {
    .pub-footer { margin-top: 44px; }
    .pub-footer__grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 28px 24px; padding-top: 44px; }
}
@media (max-width: 479px) {
    .pub-footer__grid { grid-template-columns: minmax(0, 1fr); }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    document.querySelectorAll('[data-flash-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const box = btn.closest('.idx-flash');

            if (box) {
                box.hidden = true;
            }
        });
    });
})();
</script>
@endpush
