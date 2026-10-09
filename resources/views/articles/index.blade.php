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

        @media (max-width: 1023px) {
            .page {
                padding: 0 24px 56px;
            }

            .page-head {
                grid-template-columns: 1fr;
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

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
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

        <a href="/articles/create">Tambah Artikel</a>

        <hr>

        @if ($articles->count())
            @foreach ($articles as $article)
                <article>
                    <h2>{{ $article->title }}</h2>

                    <p>
                        Kategori: {{ $article->category->name }}
                    </p>

                    <p>
                        Penulis: {{ $article->user->name }}
                    </p>

                    <p>
                        Status: {{ $article->status }}
                    </p>

                    <p>
                        Tag:
                        @if ($article->tags->count())
                            @foreach ($article->tags as $tag)
                                {{ $tag->name }}@if (!$loop->last), @endif
                            @endforeach
                        @else
                            Belum ada tag
                        @endif
                    </p>

                    <a href="/articles/{{ $article->id }}">Lihat</a>
                    |
                    <a href="/articles/{{ $article->id }}/edit">Edit</a>
                    <form action="/articles/{{ $article->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                            Hapus
                        </button>
                    </form>
                </article>

                <hr>
            @endforeach

            {{ $articles->links() }}
        @else
            <p>Belum ada artikel.</p>
        @endif

    </main>

</body>
</html>