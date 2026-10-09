<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Artikel - RuangKabar</title>

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

        *,
        *::before,
        *::after {
            box-sizing: border-box;
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
        button:focus-visible,
        input:focus-visible {
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
            min-height: 68px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 4px 24px;
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

        .nav-menu a,
        .nav-menu .nav-logout {
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            padding: 6px 0;
            border: 0;
            border-bottom: 2px solid transparent;
            background: none;
            cursor: pointer;
            transition: color .15s, border-color .15s;
        }

        .nav-menu a:hover,
        .nav-menu .nav-logout:hover {
            color: var(--accent);
        }

        .nav-menu a.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .nav-form {
            display: contents;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 72px;
        }

        .page-head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 460px);
            gap: 24px 48px;
            align-items: end;
            padding: 48px 0 32px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 32px;
        }

        .page-title {
            font-family: var(--serif);
            font-size: 40px;
            line-height: 1.15;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .page-desc {
            font-size: 16px;
            line-height: 1.6;
            color: var(--muted);
            margin: 0;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .search-form input[type="text"] {
            flex: 1 1 200px;
            min-width: 0;
            height: 44px;
            padding: 0 14px;
            font-family: var(--sans);
            font-size: 16px;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: border-color .15s;
        }

        .search-form input[type="text"]::placeholder {
            color: var(--muted);
        }

        .search-form input[type="text"]:focus {
            outline: none;
            border-color: var(--ink);
        }

        .search-form button {
            height: 44px;
            padding: 0 22px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            transition: background .15s;
        }

        .search-form button:hover {
            background: var(--accent);
        }

        .search-form a {
            flex-basis: 100%;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .search-form a:hover {
            text-decoration: underline;
        }

        .add-link {
            display: inline-block;
            padding: 8px 0;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .add-link:hover {
            text-decoration: underline;
        }

        .news-list {
            border-top: 2px solid var(--ink);
            margin-bottom: 40px;
        }

        .news-row {
            display: grid;
            grid-template-columns: 300px minmax(0, 1fr);
            gap: 32px;
            padding: 28px 0;
            border-bottom: 1px solid var(--line);
        }

        .row-media {
            display: block;
            text-decoration: none;
            aspect-ratio: 3 / 2;
            border-radius: 4px;
            overflow: hidden;
            background: #E7E3DA;
        }

        .row-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }

        .news-row:hover .row-media img {
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
            font-size: 40px;
            color: var(--line);
            background: #E7E3DA;
        }

        .cat {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .row-body {
            min-width: 0;
        }

        .row-title {
            font-family: var(--serif);
            font-size: 26px;
            line-height: 1.3;
            font-weight: 600;
            margin: 0 0 10px;
            overflow-wrap: anywhere;
        }

        .row-title a {
            color: var(--ink);
            text-decoration: none;
            transition: color .15s;
        }

        .row-title a:hover {
            color: var(--accent);
        }

        .row-excerpt {
            overflow-wrap: anywhere;
            font-size: 15px;
            line-height: 1.65;
            color: var(--muted);
            margin: 0 0 12px;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 18px;
            font-size: 13px;
            color: var(--muted);
        }

        .meta .status {
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-size: 11px;
            font-weight: 600;
        }

        .tags {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 12px 0 0;
            padding: 0;
        }

        .tags li {
            font-size: 12px;
            color: var(--muted);
            border: 1px solid var(--line);
            border-radius: 2px;
            padding: 2px 8px;
        }

        .row-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px 20px;
            margin-top: 14px;
        }

        .row-actions a,
        .row-actions button {
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            background: none;
            border: 0;
            padding: 8px 0;
            cursor: pointer;
            transition: color .15s;
        }

        .row-actions a:hover,
        .row-actions button:hover {
            color: var(--accent);
        }

        .inline-form {
            display: inline;
            margin: 0;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 24px;
        }

        .pg-numbers {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
        }

        .pg-gap {
            min-width: 24px;
            text-align: center;
            color: var(--muted);
        }

        .pg-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 44px;
            height: 44px;
            padding: 0 12px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            background: transparent;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: color .15s, border-color .15s, background .15s;
        }

        a.pg-link:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        .pg-link.is-current {
            color: var(--bg);
            background: var(--ink);
            border-color: var(--ink);
        }

        .pg-link.is-disabled {
            color: var(--muted);
            opacity: 0.45;
            border-style: dashed;
            cursor: not-allowed;
        }

        .pg-status {
            display: none;
            font-size: 13px;
            color: var(--muted);
            text-align: center;
        }

        .empty-state {
            max-width: 560px;
            padding: 48px 0 24px;
            border-top: 2px solid var(--ink);
        }

        .empty-title {
            font-family: var(--serif);
            font-size: 30px;
            line-height: 1.25;
            font-weight: 700;
            margin: 0 0 12px;
        }

        .empty-text {
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
            margin: 0 0 24px;
            overflow-wrap: anywhere;
        }

        .empty-link {
            display: inline-flex;
            align-items: center;
            height: 44px;
            padding: 0 22px;
            font-size: 14px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border-radius: 4px;
            text-decoration: none;
            transition: background .15s;
        }

        .empty-link:hover {
            background: var(--accent);
        }

        @media (max-width: 1023px) {
            .page {
                padding: 0 24px 56px;
            }

            .page-head {
                grid-template-columns: minmax(0, 1fr);
                padding: 40px 0 28px;
            }

            .page-title {
                font-size: 34px;
            }

            .search-form {
                max-width: 560px;
            }
        }

        @media (max-width: 767px) {
            .nav-inner {
                min-height: 60px;
                padding: 0 20px;
                gap: 0 16px;
            }

            .logo {
                font-size: 19px;
            }

            .nav-menu {
                gap: 18px;
            }

            .nav-menu a,
            .nav-menu .nav-logout {
                padding: 12px 0;
            }

            .page {
                padding: 0 20px 48px;
            }

            .page-head {
                padding: 28px 0 24px;
                margin-bottom: 24px;
            }

            .page-title {
                font-size: 28px;
            }

            .page-desc {
                font-size: 15px;
            }

            .search-form {
                max-width: none;
            }
        }

        @media (max-width: 380px) {
            .logo {
                font-size: 17px;
                letter-spacing: 0.02em;
            }

            .nav-menu {
                gap: 14px;
            }
        }

        @media (max-width: 1023px) {
            .news-row {
                grid-template-columns: 220px minmax(0, 1fr);
                gap: 24px;
                padding: 24px 0;
            }

            .row-title {
                font-size: 22px;
            }
        }

        @media (max-width: 767px) {
            .news-row {
                grid-template-columns: minmax(0, 1fr);
                gap: 16px;
                padding: 24px 0;
            }

            .row-media {
                margin: 0 -20px;
                border-radius: 0;
            }

            .row-title {
                font-size: 22px;
            }
        }

        @media (max-width: 639px) {
            .pg-numbers {
                display: none;
            }

            .pg-status {
                display: block;
            }

            .pg-text {
                display: none;
            }

            .pg-step {
                min-width: 48px;
            }

            .empty-state {
                padding: 36px 0 16px;
            }

            .empty-title {
                font-size: 24px;
            }

            .empty-text {
                font-size: 15px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }

            .news-row:hover .row-media img {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="nav-inner">
            <a class="logo" href="/">RUANG<span>KABAR</span></a>

            <nav class="nav-menu" aria-label="Menu utama">
                <a href="/">Beranda</a>
                <a href="{{ route('articles.index') }}" class="active" aria-current="page">Berita</a>

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

    <main class="page">

        <div class="page-head">
            <div>
                <h1 class="page-title">Berita Terkini</h1>
                <p class="page-desc">Temukan berita dan informasi terbaru dari RuangKabar.</p>
            </div>

            <form class="search-form" action="/articles" method="GET" role="search">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari berita..."
                    aria-label="Cari berita"
                >

                <button type="submit">Cari</button>

                @if ($search)
                    <a href="/articles">Reset</a>
                @endif
            </form>
        </div>

        <a class="add-link" href="/articles/create">Tambah Artikel</a>

        @if ($articles->count())
            <div class="news-list">
                @foreach ($articles as $article)
                    <article class="news-row">
                        <a class="row-media" href="/articles/{{ $article->id }}" tabindex="-1" aria-hidden="true">
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy">
                            @else
                                <div class="ph">RK</div>
                            @endif
                        </a>

                        <div class="row-body">
                            <div class="cat">{{ $article->category->name }}</div>

                            <h2 class="row-title">
                                <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                            </h2>

                            <p class="row-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
                            </p>

                            <div class="meta">
                                <span>{{ $article->user->name }}</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                                @if ($article->status !== 'published')
                                    <span class="status">{{ $article->status }}</span>
                                @endif
                            </div>

                            @if ($article->tags->count())
                                <ul class="tags">
                                    @foreach ($article->tags as $tag)
                                        <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="row-actions">
                                <a href="/articles/{{ $article->id }}">Lihat</a>
                                <a href="/articles/{{ $article->id }}/edit">Edit</a>
                                <form class="inline-form" action="/articles/{{ $article->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
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
                            <span aria-hidden="true">←</span><span class="pg-text">Sebelumnya</span>
                        </span>
                    @else
                        <a class="pg-link pg-step" href="{{ $articles->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">
                            <span aria-hidden="true">←</span><span class="pg-text">Sebelumnya</span>
                        </a>
                    @endif

                    <ul class="pg-numbers">
                        @foreach ($pages as $page)
                            @if (! $loop->first && $page - $pages[$loop->index - 1] > 1)
                                <li class="pg-gap" aria-hidden="true">…</li>
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
                            <span class="pg-text">Berikutnya</span><span aria-hidden="true">→</span>
                        </a>
                    @else
                        <span class="pg-link pg-step is-disabled" aria-disabled="true" aria-label="Halaman berikutnya">
                            <span class="pg-text">Berikutnya</span><span aria-hidden="true">→</span>
                        </span>
                    @endif
                </nav>
            @endif
        @else
            <section class="empty-state">
                @if ($search)
                    <div class="cat">Hasil pencarian</div>
                    <h2 class="empty-title">Berita tidak ditemukan</h2>
                    <p class="empty-text">
                        Tidak ada hasil untuk “{{ $search }}”. Coba kata kunci lain atau periksa kembali ejaannya.
                    </p>
                    <a class="empty-link" href="/articles">Lihat semua berita</a>
                @else
                    <div class="cat">Daftar berita</div>
                    <h2 class="empty-title">Belum ada berita untuk ditampilkan</h2>
                    <p class="empty-text">
                        Berita yang dipublikasikan akan muncul di halaman ini.
                    </p>
                @endif
            </section>
        @endif

    </main>

</body>
</html>