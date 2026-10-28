<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Baca berita kategori {{ $category->name }} terbaru di RuangKabar.">

    <title>{{ $category->name }} - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

    <script>document.documentElement.classList.add('js');</script>

    <style>
        :root {
            --emerald: #183C36;
            --forest: #376B5C;
            --gold: #B99A64;
            --sand: #E7E0D2;
            --ivory: #FAF8F3;
            --white: #FFFFFF;
            --text-soft: #4F615C;
            --on-dark: rgba(250, 248, 243, 0.82);
            --rule: rgba(24, 60, 54, 0.14);

            --sans: 'Plus Jakarta Sans', Arial, sans-serif;
            --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
            --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;

            --wrap: 1240px;
            --pad: 32px;
            --r-sm: 12px;
            --r-md: 16px;
            --r-lg: 28px;
            --ease: cubic-bezier(0.22, 1, 0.36, 1);
            --t-fast: 200ms;
            --t-ui: 300ms;
            --t-enter: 560ms;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: var(--sans);
            background: var(--ivory);
            color: var(--emerald);
            overflow-x: clip;
            overflow-wrap: break-word;
            -webkit-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
        }

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

        .skip-link:focus {
            top: 12px;
        }

        .wrap {
            max-width: var(--wrap);
            margin: 0 auto;
            padding: 0 var(--pad);
        }

        /* ---------- Header (identik dengan homepage) ---------- */
        .site-header {
            position: sticky;
            top: -10px;
            z-index: 50;
            height: 0;
        }

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

        .site-header.is-scrolled .bar {
            box-shadow: 0 14px 36px -10px rgba(24, 60, 54, 0.6);
        }

        .brand {
            display: inline-block;
            padding: 8px 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--ivory);
            text-decoration: none;
        }

        .brand span {
            color: var(--gold);
        }

        .nav {
            display: flex;
            flex: 1;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

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

        .nav-links a:hover {
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.08);
        }

        .nav-links a.is-current {
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.14);
            box-shadow: inset 0 -2px 0 var(--gold);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 0 4px;
        }

        .actions-user {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 6px 14px 6px 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ivory);
            border-right: 1px solid rgba(250, 248, 243, 0.2);
            margin-right: 8px;
        }

        .btn-dash {
            display: inline-flex;
            align-items: center;
            height: 36px;
            padding: 0 16px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.12);
            border: 1px solid rgba(250, 248, 243, 0.2);
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
        }

        .btn-dash:hover {
            background: rgba(250, 248, 243, 0.22);
            border-color: rgba(250, 248, 243, 0.35);
        }

        .actions .link-btn {
            padding: 8px 12px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--on-dark);
            background: none;
            border: 0;
            cursor: pointer;
            transition: color var(--t-fast) ease-out;
        }

        .actions a.link {
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 600;
            color: var(--on-dark);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .actions a.link:hover,
        .actions .link-btn:hover {
            color: var(--ivory);
        }

        .actions-form {
            display: contents;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 46px;
            padding: 0 24px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--white);
            background: var(--forest);
            border: 0;
            border-radius: 999px;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--t-fast) ease-out, transform 120ms ease-out;
        }

        .btn:hover {
            background: var(--emerald);
        }

        .btn:active {
            transform: scale(0.97);
        }

        .btn--ivory {
            height: 40px;
            padding: 0 20px;
            color: var(--emerald);
            background: var(--ivory);
        }

        .btn--ivory:hover {
            background: var(--sand);
        }

        .btn svg {
            width: 16px;
            height: 16px;
            transition: transform var(--t-ui) var(--ease);
        }

        .btn:hover svg {
            transform: translateX(3px);
        }

        /* ---------- Page header kategori ---------- */
        .cat-hero {
            padding: 120px 0 64px;
        }

        .crumbs ol {
            display: flex;
            align-items: center;
            gap: 0 10px;
            margin: 0 0 32px;
            padding: 0;
            list-style: none;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 500;
            color: var(--text-soft);
        }

        .crumbs li {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .crumbs li + li::before {
            content: "/";
            color: rgba(24, 60, 54, 0.35);
        }

        .crumbs a {
            color: var(--text-soft);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .crumbs a:hover {
            color: var(--forest);
        }

        .crumbs [aria-current] {
            color: var(--emerald);
        }

        .cat-hero-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px 48px;
        }

        .cat-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: var(--forest);
        }

        .cat-label::before {
            content: "";
            width: 28px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
        }

        .cat-title {
            margin: 0 0 12px;
            font-family: var(--serif);
            font-size: clamp(36px, 5vw, 58px);
            font-weight: 600;
            line-height: 1.1;
            letter-spacing: -0.015em;
        }

        .cat-count {
            font-family: var(--body);
            font-size: 15px;
            color: var(--text-soft);
        }

        .cat-count strong {
            color: var(--emerald);
            font-weight: 600;
        }

        /* ---------- Navigasi kategori (pills) ---------- */
        .cat-nav {
            padding: 0 0 56px;
        }

        .cat-nav-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 10px;
        }

        .cat-nav-label {
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            color: var(--text-soft);
            margin-right: 6px;
        }

        .pill {
            display: inline-block;
            padding: 8px 18px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--emerald);
            background: var(--white);
            border: 1px solid var(--rule);
            border-radius: 999px;
            text-decoration: none;
            transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
        }

        .pill:hover {
            background: var(--sand);
            border-color: rgba(24, 60, 54, 0.22);
        }

        .pill.is-active {
            color: var(--ivory);
            background: var(--emerald);
            border-color: var(--emerald);
            box-shadow: 0 4px 12px -4px rgba(24, 60, 54, 0.4);
        }

        /* ---------- Grid artikel ---------- */
        .articles-sec {
            padding: 0 0 96px;
        }

        .section-title {
            margin: 0 0 36px;
            font-family: var(--serif);
            font-size: 30px;
            font-weight: 600;
            line-height: 1.15;
            letter-spacing: -0.01em;
        }

        .section-title::after {
            content: "";
            display: block;
            width: 40px;
            height: 3px;
            margin-top: 12px;
            background: var(--gold);
            border-radius: 2px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }

        .card {
            display: flex;
            flex-direction: column;
            padding: 12px;
            background: var(--white);
            border: 1px solid rgba(24, 60, 54, 0.06);
            border-radius: 22px;
            transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
        }

        .media {
            display: block;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            text-decoration: none;
            background: var(--sand);
            border-radius: var(--r-md);
        }

        .media img {
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
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: rgba(24, 60, 54, 0.22);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px 10px 12px;
        }

        .cat {
            display: inline-block;
            margin-bottom: 10px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--forest);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        a.cat:hover {
            color: var(--emerald);
            text-decoration: underline;
            text-decoration-color: var(--gold);
            text-underline-offset: 3px;
        }

        .title {
            margin: 0 0 10px;
            font-family: var(--sans);
            font-weight: 700;
            font-size: 20px;
            line-height: 1.28;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
        }

        .title a {
            color: var(--emerald);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .card-excerpt {
            margin: 0 0 16px;
            font-family: var(--body);
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--text-soft);
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2px 14px;
            margin-top: auto;
            font-family: var(--body);
            font-size: 13px;
            color: var(--text-soft);
        }

        @media (hover: hover) {
            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4);
            }

            .card:hover .media img {
                transform: scale(1.03);
            }

            .card:hover .title a {
                color: var(--forest);
            }
        }

        /* ---------- Pagination ---------- */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 56px;
        }

        .pagination-wrap nav {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
        }

        .pagination-wrap nav a,
        .pagination-wrap nav span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--emerald);
            background: var(--white);
            border: 1px solid var(--rule);
            border-radius: 12px;
            text-decoration: none;
            transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, color var(--t-fast) ease-out;
        }

        .pagination-wrap nav a:hover {
            background: var(--sand);
            border-color: rgba(24, 60, 54, 0.22);
        }

        .pagination-wrap nav span[aria-current="page"] {
            color: var(--ivory);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        .pagination-wrap nav span.dots {
            background: transparent;
            border-color: transparent;
        }

        /* ---------- Empty state ---------- */
        .empty {
            padding: 88px 32px;
            text-align: center;
            background: var(--sand);
            border-radius: var(--r-lg);
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            margin: 0 auto 24px;
            background: var(--white);
            border-radius: 50%;
            color: var(--gold);
        }

        .empty-icon svg {
            width: 32px;
            height: 32px;
        }

        .empty strong {
            display: block;
            margin-bottom: 10px;
            font-family: var(--serif);
            font-size: 28px;
            font-weight: 600;
        }

        .empty p {
            max-width: 440px;
            margin: 0 auto 28px;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-soft);
        }

        /* ---------- Motion ---------- */
        @keyframes rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        .js .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity var(--t-enter) var(--ease), transform var(--t-enter) var(--ease);
        }

        .js .reveal.is-visible {
            opacity: 1;
            transform: none;
        }

        .js .card.reveal.is-visible {
            transition: opacity var(--t-enter) var(--ease), transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
        }

        /* ---------- Footer ---------- */
        .footer {
            color: var(--on-dark);
            background: var(--emerald);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 4fr);
            gap: 32px 48px;
            padding-top: 56px;
            padding-bottom: 44px;
        }

        .footer-about {
            max-width: 300px;
            margin: 10px 0 0;
            font-family: var(--body);
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-title {
            margin: 0 0 12px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--gold);
        }

        .footer-links {
            margin: 0;
            padding: 0;
            list-style: none;
        }

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

        .footer-links a:hover {
            color: var(--ivory);
        }

        .footer-bottom {
            padding: 20px 0 28px;
            border-top: 1px solid rgba(250, 248, 243, 0.12);
            font-family: var(--sans);
            font-size: 13px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 1023px) {
            :root {
                --pad: 24px;
                --r-lg: 24px;
            }

            .cat-hero {
                padding-top: 110px;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .footer-grid {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 719px) {
            :root {
                --pad: 20px;
                --r-lg: 22px;
            }

            .bar {
                padding: 4px 8px 4px 18px;
                gap: 0 12px;
            }

            .brand {
                font-size: 22px;
            }

            .actions {
                margin-left: auto;
            }

            .actions-user {
                display: none;
            }

            .nav {
                order: 3;
                flex-basis: 100%;
                justify-content: flex-start;
                padding-bottom: 8px;
            }

            .nav-links a {
                height: 36px;
                padding: 0 12px;
            }

            .cat-hero {
                padding-top: 140px;
                padding-bottom: 44px;
            }

            .cat-title {
                font-size: 32px;
            }

            .cards {
                grid-template-columns: minmax(0, 1fr);
            }

            .footer-grid {
                grid-template-columns: minmax(0, 1fr);
                padding-top: 40px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            .js .reveal {
                opacity: 1;
                transform: none;
            }

            .card:hover,
            .card:hover .media img {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <header class="site-header" id="site-header">
        <div class="wrap">
            <div class="bar">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>

                <nav class="nav" aria-label="Menu utama">
                    <ul class="nav-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="{{ route('articles.index') }}">Berita</a></li>
                    </ul>
                </nav>

                <div class="actions">
                    @auth
                        <span class="actions-user" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</span>

                        @if (auth()->user()->role === 'admin')
                            <a class="btn-dash" href="/admin/dashboard">Dashboard</a>
                        @elseif (auth()->user()->role === 'penulis')
                            <a class="btn-dash" href="/penulis/dashboard">Dashboard</a>
                        @else
                            <a class="btn-dash" href="/beranda">Akun Saya</a>
                        @endif

                        <form class="actions-form" action="/logout" method="POST">
                            @csrf
                            <button class="link-btn" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="link" href="{{ route('login') }}">Login</a>
                        <a class="btn btn--ivory" href="{{ route('register') }}">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main id="konten">

        {{-- Header kategori --}}
        <div class="cat-hero">
            <div class="wrap">
                <nav class="crumbs" aria-label="Breadcrumb">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li><span aria-current="page">{{ $category->name }}</span></li>
                    </ol>
                </nav>

                <div class="cat-hero-inner">
                    <div>
                        <span class="cat-label">KATEGORI</span>
                        <h1 class="cat-title">{{ $category->name }}</h1>
                        <p class="cat-count">
                            <strong>{{ $articles->total() }}</strong>
                            artikel ditemukan
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigasi kategori (pills) --}}
        @if ($categories->count() > 1)
            <div class="cat-nav">
                <div class="wrap">
                    <div class="cat-nav-inner">
                        <span class="cat-nav-label">Kategori lain:</span>
                        @foreach ($categories as $cat)
                            <a
                                class="pill {{ $cat->id === $category->id ? 'is-active' : '' }}"
                                href="{{ route('kategori.show', $cat) }}"
                                @if ($cat->id === $category->id) aria-current="page" @endif
                            >{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Daftar artikel --}}
        <section class="articles-sec" aria-labelledby="articles-title">
            <div class="wrap">

                @if ($articles->count())
                    <div class="cards">
                        @foreach ($articles as $article)
                            <article class="card reveal">
                                <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">RK</div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <a class="cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

                                    <h2 class="title">
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h2>

                                    <p class="card-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>

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

                    {{-- Pagination --}}
                    @if ($articles->hasPages())
                        <div class="pagination-wrap">
                            {{ $articles->links() }}
                        </div>
                    @endif

                @else
                    {{-- Empty state --}}
                    <div class="empty">
                        <div class="empty-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 12h6m-3-3v6M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <strong>Belum ada artikel di kategori ini</strong>
                        <p>Artikel dalam kategori <em>{{ $category->name }}</em> belum tersedia. Kunjungi kembali nanti atau jelajahi kategori lain.</p>
                        <a class="btn" href="/">
                            Kembali ke Beranda
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                        </a>
                    </div>
                @endif

            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="wrap footer-grid">
            <div class="footer-brand">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>
                <p class="footer-about">Portal berita dan informasi terkini.</p>
            </div>

            <div>
                <h2 class="footer-title">Jelajahi</h2>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('articles.index') }}">Semua Berita</a></li>
                    @foreach ($categories as $cat)
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
            var header = document.getElementById('site-header');
            if (header) {
                var onScroll = function () {
                    header.classList.toggle('is-scrolled', window.scrollY > 8);
                };
                onScroll();
                window.addEventListener('scroll', onScroll, { passive: true });
            }

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
