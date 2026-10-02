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
        }

        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        /* ===== NAVBAR ===== */
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

        .nav-toggle {
            display: none;
            width: 40px;
            height: 40px;
            background: none;
            border: 1px solid var(--line);
            border-radius: 6px;
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

        /* ===== FEATURED NEWS ===== */
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
            border-radius: 6px;
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
            font-size: 12px;
            font-weight: 700;
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
            font-size: 18px;
            font-weight: 700;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--ink);
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

        /* Tablet */
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

        /* Mobile */
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

        /* ===== SECTION LAIN (BELUM DIKERJAKAN PADA TAHAP INI) ===== */
        .container {
            width: 84%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .section-title {
            margin-bottom: 25px;
            font-size: 26px;
        }

        .articles {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #e5e7eb;
        }

        .card-content {
            padding: 20px;
        }

        .category {
            font-size: 13px;
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .read-more {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

        .empty {
            background: white;
            padding: 30px;
            text-align: center;
            border: 1px solid #ddd;
        }

        footer {
            margin-top: 60px;
            padding: 25px;
            text-align: center;
            background: #1f2937;
            color: #d1d5db;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .articles {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

{{-- ================= NAVBAR ================= --}}
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
                <form method="POST" action="/logout" style="display:contents">
                    @csrf
                    <button type="submit" class="nav-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </div>
</header>

{{-- ================= FEATURED NEWS ================= --}}
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
                    <div class="cat" style="margin-top:0">{{ $featured->category->name }}</div>
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
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
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

        <h2 id="featured-title" class="compact-head" style="margin-bottom:0">Featured News</h2>
        <p class="featured-empty">Belum ada artikel yang dipublikasikan.</p>

    @endif

</section>

{{-- ================= BERITA TERBARU (belum dikerjakan) ================= --}}
<main class="container">

    <h2 class="section-title">Berita Terbaru</h2>

    @if ($articles->count())

        <div class="articles">

            @foreach ($articles as $article)

                <article class="card">

                    @if ($article->image)
                        <img
                            class="card-image"
                            src="{{ asset('storage/' . $article->image) }}"
                            alt="{{ $article->title }}"
                        >
                    @else
                        <div class="card-image"></div>
                    @endif

                    <div class="card-content">

                        <div class="category">
                            {{ $article->category->name }}
                        </div>

                        <h3>
                            {{ $article->title }}
                        </h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <a
                            class="read-more"
                            href="{{ route('articles.show', $article) }}"
                        >
                            Baca Selengkapnya →
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty">
            Belum ada artikel yang dipublikasikan.
        </div>

    @endif

</main>

<footer>
    &copy; {{ date('Y') }} RuangKabar. Semua hak dilindungi.
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
