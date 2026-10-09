<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RuangKabar - Portal Berita</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #F7F5F0;
            --ink: #202124;
            --accent: #C94B3C;
            --muted: #6B6B6B;
            --line: #D9D6CF;
            --serif: 'Lora', Georgia, serif;
            --sans: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            overflow-x: hidden;
        }

        body {
            font-family: var(--sans);
            background: var(--bg);
            color: var(--ink);
            overflow-x: hidden;
            overflow-wrap: break-word;
            -webkit-text-size-adjust: 100%;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .site-header {
            background: var(--bg);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            font-family: var(--serif);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--ink);
            text-decoration: none;
        }

        .logo span {
            color: var(--accent);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-menu a {
            font-size: 14px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            padding: 6px 0;
            border-bottom: 2px solid transparent;
            transition: color .15s, border-color .15s;
        }

        .nav-menu a:hover {
            color: var(--accent);
        }

        .nav-menu a.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .nav-menu .nav-logout {
            font: inherit;
            font-size: 14px;
            font-weight: 500;
            background: none;
            border: 0;
            color: var(--ink);
            cursor: pointer;
        }

        .nav-menu .nav-logout:hover {
            color: var(--accent);
        }

        .nav-form {
            display: contents;
        }

        .nav-toggle {
            display: none;
            width: 44px;
            height: 44px;
            background: none;
            border: 1px solid var(--line);
            border-radius: 4px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 4px;
        }

        .nav-toggle span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--ink);
            transition: transform .2s, opacity .2s;
        }

        .nav-toggle[aria-expanded="true"] span:nth-child(1) {
            transform: translateY(6px) rotate(45deg);
        }

        .nav-toggle[aria-expanded="true"] span:nth-child(2) {
            opacity: 0;
        }

        .nav-toggle[aria-expanded="true"] span:nth-child(3) {
            transform: translateY(-6px) rotate(-45deg);
        }

        @media (max-width: 767px) {
            .nav-inner {
                height: 60px;
                padding: 0 20px;
            }

            .nav-toggle {
                display: flex;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--bg);
                border-bottom: 1px solid var(--line);
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                padding: 8px 20px 16px;
            }

            .nav-menu.open {
                display: flex;
            }

            .nav-menu a,
            .nav-menu .nav-logout {
                padding: 14px 0;
                border-bottom: 1px solid var(--line);
                text-align: left;
                font-size: 15px;
            }

            .nav-menu a.active {
                border-bottom-color: var(--line);
            }
        }

        .featured {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px 16px;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(0, 1fr);
            gap: 48px;
        }

        .lead {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .lead-media {
            aspect-ratio: 16 / 10;
            border-radius: 4px;
            overflow: hidden;
            background: #E7E3DA;
        }

        .lead-media img,
        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }

        .lead:hover .lead-media img,
        .compact-item:hover .thumb img {
            transform: scale(1.03);
        }

        .ph {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--serif);
            font-weight: 700;
            color: var(--line);
            font-size: 48px;
            background: #E7E3DA;
        }

        .thumb .ph {
            font-size: 24px;
        }

        .cat {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .lead-body {
            padding-top: 22px;
            max-width: 680px;
        }

        .lead h2 {
            font-family: var(--serif);
            font-size: 38px;
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 14px;
            transition: color .15s;
        }

        .lead:hover h2 {
            color: var(--accent);
        }

        .lead-excerpt {
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .meta {
            font-size: 13px;
            color: var(--muted);
        }

        .lead-more {
            display: inline-block;
            margin-top: 16px;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        .compact-list {
            border-left: 1px solid var(--line);
            padding-left: 40px;
        }

        .compact-head {
            font-family: var(--serif);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--ink);
        }

        .featured > .compact-head {
            margin-bottom: 0;
        }

        .compact-item {
            display: grid;
            grid-template-columns: 92px minmax(0, 1fr);
            gap: 16px;
            padding: 18px 0;
            border-bottom: 1px solid var(--line);
            text-decoration: none;
            color: inherit;
        }

        .thumb {
            width: 92px;
            height: 92px;
            border-radius: 4px;
            overflow: hidden;
            background: #E7E3DA;
        }

        .compact-item h3 {
            font-family: var(--serif);
            font-size: 16px;
            line-height: 1.35;
            font-weight: 600;
            margin-bottom: 6px;
            transition: color .15s;
        }

        .compact-item:hover h3 {
            color: var(--accent);
        }

        .compact-item .cat {
            margin-bottom: 4px;
            font-size: 11px;
        }

        .featured-empty {
            padding: 32px 0;
            color: var(--muted);
            border-bottom: 1px solid var(--line);
        }

        @media (max-width: 1023px) {
            .featured {
                padding: 32px 24px 8px;
            }

            .featured-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }

            .lead h2 {
                font-size: 32px;
            }

            .compact-list {
                border-left: 0;
                padding-left: 0;
            }

            .compact-items {
                display: grid;
                grid-template-columns: 1fr 1fr;
                column-gap: 32px;
            }
        }

        @media (max-width: 767px) {
            .featured {
                padding: 20px 20px 8px;
            }

            .featured-grid {
                gap: 28px;
            }

            .lead-media {
                aspect-ratio: 4 / 3;
                margin: 0 -20px;
                border-radius: 0;
            }

            .lead-body {
                padding-top: 16px;
            }

            .lead h2 {
                font-size: 26px;
            }

            .lead-excerpt {
                font-size: 15px;
            }

            .compact-items {
                display: block;
            }

            .compact-item {
                grid-template-columns: 1fr 84px;
                gap: 14px;
            }

            .compact-item .thumb {
                order: 2;
                width: 84px;
                height: 84px;
            }
        }

        .latest {
            max-width: 1200px;
            margin: 0 auto;
            padding: 56px 24px 72px;
        }

        .latest-head {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 4px 16px;
            padding-bottom: 6px;
            margin-bottom: 32px;
            border-bottom: 2px solid var(--ink);
        }

        .latest-head h2 {
            font-family: var(--serif);
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .latest-all {
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            white-space: nowrap;
            padding: 8px 0;
        }

        .latest-all:hover {
            text-decoration: underline;
        }

        .latest-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 40px 32px;
        }

        .news-item {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .news-media {
            aspect-ratio: 3 / 2;
            border-radius: 4px;
            overflow: hidden;
            background: #E7E3DA;
            margin-bottom: 16px;
        }

        .news-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }

        .news-item:hover .news-media img {
            transform: scale(1.03);
        }

        .news-item h3 {
            font-family: var(--serif);
            font-size: 21px;
            line-height: 1.3;
            font-weight: 600;
            margin-bottom: 10px;
            transition: color .15s;
        }

        .news-item:hover h3 {
            color: var(--accent);
        }

        .news-excerpt {
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .news-item.wide {
            grid-column: span 2;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
            gap: 28px;
            align-items: start;
        }

        .news-item.wide .news-media {
            margin-bottom: 0;
            aspect-ratio: 4 / 3;
        }

        .news-item.wide h3 {
            font-size: 26px;
        }

        .latest-empty {
            padding: 32px 0;
            color: var(--muted);
            border-bottom: 1px solid var(--line);
        }

        @media (max-width: 1023px) {
            .latest {
                padding: 44px 24px 56px;
            }

            .latest-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 36px 28px;
            }

            .news-item.wide {
                grid-column: span 2;
            }
        }

        @media (max-width: 767px) {
            .latest {
                padding: 36px 20px 48px;
            }

            .latest-head h2 {
                font-size: 20px;
            }

            .latest-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .news-item,
            .news-item.wide {
                display: block;
                grid-column: auto;
                padding: 24px 0;
                border-bottom: 1px solid var(--line);
            }

            .news-item:first-child {
                padding-top: 0;
            }

            .news-item.wide .news-media {
                margin-bottom: 16px;
                aspect-ratio: 3 / 2;
            }

            .news-item h3,
            .news-item.wide h3 {
                font-size: 21px;
            }
        }

        .site-footer {
            background: var(--ink);
            color: #F7F5F0;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 56px 24px 40px;
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr) minmax(0, 1fr);
            gap: 40px;
        }

        .footer-logo {
            font-family: var(--serif);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #F7F5F0;
            text-decoration: none;
        }

        .footer-logo span {
            color: var(--accent);
        }

        .footer-about {
            margin-top: 12px;
            max-width: 320px;
            font-size: 14px;
            line-height: 1.7;
            color: #A8A8A8;
        }

        .footer-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 14px;
            color: #F7F5F0;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li + li {
            margin-top: 4px;
        }

        .footer-links a {
            display: inline-block;
            padding: 5px 0;
            font-size: 14px;
            color: #A8A8A8;
            text-decoration: none;
            transition: color .15s;
        }

        .footer-links a:hover {
            color: #F7F5F0;
        }

        .footer-info {
            font-size: 14px;
            line-height: 1.7;
            color: #A8A8A8;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 24px 28px;
            border-top: 1px solid #3A3B3E;
            font-size: 12.5px;
            color: #8A8A8A;
        }

        @media (max-width: 1023px) {
            .footer-inner {
                grid-template-columns: 1fr 1fr;
                padding: 48px 24px 32px;
            }

            .footer-brand {
                grid-column: span 2;
            }
        }

        @media (max-width: 767px) {
            .footer-inner {
                grid-template-columns: 1fr;
                gap: 32px;
                padding: 40px 20px 28px;
            }

            .footer-brand {
                grid-column: auto;
            }

            .footer-bottom {
                padding: 18px 20px 24px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }

            .lead:hover .lead-media img,
            .compact-item:hover .thumb img,
            .news-item:hover .news-media img {
                transform: none;
            }
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="nav-inner">
        <a class="logo" href="/">RUANG<span>KABAR</span></a>

        <button
            class="nav-toggle"
            id="navToggle"
            type="button"
            aria-label="Buka menu"
            aria-expanded="false"
            aria-controls="navMenu"
        >
            <span></span><span></span><span></span>
        </button>

        <nav class="nav-menu" id="navMenu" aria-label="Menu utama">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.index') ? 'active' : '' }}">Berita</a>
            <a href="{{ route('articles.index') }}">Kategori</a>
            <a href="{{ route('articles.index') }}">Search</a>

            @auth
                <form class="nav-form" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="nav-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </div>
</header>

<section class="featured" aria-labelledby="featured-title">

    @if ($articles->count())

        @php
            $featured = $articles->first();
            $others = $articles->slice(1);
        @endphp

        <div class="featured-grid">

            <a class="lead" href="{{ route('articles.show', $featured) }}">
                <div class="lead-media">
                    @if ($featured->image)
                        <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}">
                    @else
                        <div class="ph">RK</div>
                    @endif
                </div>

                <div class="lead-body">
                    <div class="cat">{{ $featured->category->name }}</div>
                    <h2 id="featured-title">{{ $featured->title }}</h2>
                    <p class="lead-excerpt">
                        {{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 160) }}
                    </p>
                    <div class="meta">
                        {{ $featured->user->name }}, {{ $featured->created_at->format('d M Y') }}
                    </div>
                    <span class="lead-more">Baca Selengkapnya →</span>
                </div>
            </a>

            <aside class="compact-list">
                <h2 class="compact-head">Berita Pilihan</h2>

                @if ($others->count())
                    <div class="compact-items">
                        @foreach ($others as $article)
                            <a class="compact-item" href="{{ route('articles.show', $article) }}">
                                <div class="thumb">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy">
                                    @else
                                        <div class="ph">RK</div>
                                    @endif
                                </div>
                                <div>
                                    <div class="cat">{{ $article->category->name }}</div>
                                    <h3>{{ $article->title }}</h3>
                                    <div class="meta">{{ $article->created_at->format('d M Y') }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="featured-empty">Belum ada berita lainnya.</p>
                @endif
            </aside>

        </div>

    @else

        <h2 id="featured-title" class="compact-head">Featured News</h2>
        <p class="featured-empty">Belum ada artikel yang dipublikasikan.</p>

    @endif

</section>

<section class="latest" aria-labelledby="latest-title">

    <div class="latest-head">
        <h2 id="latest-title">Berita Terbaru</h2>
        <a class="latest-all" href="{{ route('articles.index') }}">Lihat Semua →</a>
    </div>

    @php
        $latest = $articles->slice(1);
    @endphp

    @if ($latest->count())

        <div class="latest-grid">

            @foreach ($latest as $article)

                <a
                    class="news-item {{ $loop->first ? 'wide' : '' }}"
                    href="{{ route('articles.show', $article) }}"
                >
                    <div class="news-media">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy">
                        @else
                            <div class="ph">RK</div>
                        @endif
                    </div>

                    <div class="news-body">
                        <div class="cat">{{ $article->category->name }}</div>
                        <h3>{{ $article->title }}</h3>
                        <p class="news-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 110) }}
                        </p>
                        <div class="meta">
                            {{ $article->user->name }}, {{ $article->created_at->format('d M Y') }}
                        </div>
                    </div>
                </a>

            @endforeach

        </div>

    @else

        <p class="latest-empty">Belum ada berita terbaru.</p>

    @endif

</section>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <a class="footer-logo" href="/">RUANG<span>KABAR</span></a>
            <p class="footer-about">Portal berita dan informasi terkini.</p>
        </div>

        <div>
            <h2 class="footer-title">Navigasi</h2>
            <ul class="footer-links">
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('articles.index') }}">Berita</a></li>
                <li><a href="{{ route('articles.index') }}">Kategori</a></li>
            </ul>
        </div>

        <div>
            <h2 class="footer-title">Informasi</h2>
            <p class="footer-info">Portal Berita RuangKabar</p>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} RuangKabar. All rights reserved.
    </div>
</footer>

<script>
    (function () {
        var btn = document.getElementById('navToggle');
        var menu = document.getElementById('navMenu');
        if (!btn || !menu) return;

        btn.addEventListener('click', function () {
            var open = menu.classList.toggle('open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                menu.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>

</body>
</html>