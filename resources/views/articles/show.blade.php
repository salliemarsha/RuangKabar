<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $article->title }} - RuangKabar</title>

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
        textarea:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .detail {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 72px;
        }

        .crumbs {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2px 10px;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 36px;
        }

        .crumbs a {
            display: inline-block;
            padding: 8px 0;
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }

        .crumbs a:hover {
            color: var(--accent);
        }

        .crumbs span[aria-current="page"] {
            color: var(--ink);
        }

        .detail-head {
            max-width: 820px;
            margin-bottom: 36px;
        }

        .detail-cat {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
            margin-bottom: 14px;
        }

        .detail-title {
            font-family: var(--serif);
            font-size: 46px;
            line-height: 1.18;
            font-weight: 700;
            margin: 0 0 22px;
            overflow-wrap: anywhere;
        }

        .detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px 22px;
            padding-top: 16px;
            border-top: 1px solid var(--line);
            font-size: 14px;
            color: var(--muted);
        }

        .detail-meta strong {
            font-weight: 600;
            color: var(--ink);
        }

        .detail-meta .status {
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-size: 12px;
            font-weight: 600;
        }

        .detail-figure {
            margin: 0 0 48px;
        }

        .detail-media {
            aspect-ratio: 16 / 9;
            border-radius: 4px;
            overflow: hidden;
            background: #E7E3DA;
        }

        .detail-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .detail-ph {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--serif);
            font-weight: 700;
            font-size: 56px;
            color: var(--line);
        }

        .detail-figure.is-empty .detail-media {
            aspect-ratio: 21 / 6;
        }

        .article-rest {
            max-width: 760px;
            line-height: 1.7;
        }

        .article-rest hr {
            border: 0;
            border-top: 1px solid var(--line);
            margin: 28px 0;
        }

        .article-rest textarea {
            max-width: 100%;
        }

        @media (max-width: 1023px) {
            .detail {
                padding: 28px 24px 56px;
            }

            .detail-title {
                font-size: 38px;
            }

            .detail-figure {
                margin-bottom: 40px;
            }
        }

        @media (max-width: 767px) {
            .detail {
                padding: 12px 20px 48px;
            }

            .crumbs {
                margin-bottom: 20px;
            }

            .detail-head {
                margin-bottom: 24px;
            }

            .detail-cat {
                margin-bottom: 10px;
            }

            .detail-title {
                font-size: 28px;
                line-height: 1.22;
                margin-bottom: 18px;
            }

            .detail-meta {
                font-size: 13px;
                gap: 4px 18px;
            }

            .detail-figure {
                margin: 0 -20px 32px;
            }

            .detail-media {
                aspect-ratio: 4 / 3;
                border-radius: 0;
            }

            .detail-figure.is-empty .detail-media {
                aspect-ratio: 16 / 7;
            }

            .detail-ph {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>

    <main class="detail">

        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="/">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('articles.index') }}">Berita</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">{{ $article->category->name }}</span>
        </nav>

        <header class="detail-head">
            <div class="detail-cat">{{ $article->category->name }}</div>

            <h1 class="detail-title">{{ $article->title }}</h1>

            <div class="detail-meta">
                <span>Oleh <strong>{{ $article->user->name }}</strong></span>
                <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->format('d M Y') }}</time>
                @if ($article->status !== 'published')
                    <span class="status">{{ $article->status }}</span>
                @endif
            </div>
        </header>

        <figure class="detail-figure {{ $article->image ? '' : 'is-empty' }}">
            <div class="detail-media">
                @if ($article->image)
                    <img
                        src="{{ asset('storage/' . $article->image) }}"
                        alt="{{ $article->title }}"
                    >
                @else
                    <div class="detail-ph">RK</div>
                @endif
            </div>
        </figure>

        <div class="article-rest">

            <div>
                {!! nl2br(e($article->content)) !!}
            </div>

            <hr>

            <h2>Berikan Komentar</h2>

            <form action="/comments" method="POST">
                @csrf

                <input type="hidden" name="article_id" value="{{ $article->id }}">

                <div>
                    <label>Komentar</label>
                    <br>
                    <textarea
                        name="comment"
                        rows="5"
                        required
                        placeholder="Tulis komentar Anda..."
                    ></textarea>
                </div>

                <br>

                <button type="submit">Kirim Komentar</button>
            </form>

            <hr>

            <h2>Komentar</h2>

            @if ($article->comments->count())
                @foreach ($article->comments as $comment)
                    <div>
                        <strong>{{ $comment->user->name }}</strong>

                        <p>{{ $comment->comment }}</p>
                    </div>

                    <hr>
                @endforeach
            @else
                <p>Belum ada komentar yang disetujui.</p>
            @endif

            <a href="/articles">Kembali ke Daftar Artikel</a>

        </div>

    </main>

</body>
</html>