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

        .article-body {
            max-width: 680px;
            font-size: 18px;
            line-height: 1.8;
            color: var(--ink);
        }

        .article-body p {
            margin: 0 0 1.4em;
        }

        .article-body p:last-child {
            margin-bottom: 0;
        }

        .article-tags {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 10px 14px;
            margin-top: 40px;
        }

        .tags-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
        }

        .tags-list {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            min-width: 0;
        }

        .tags-list li {
            max-width: 100%;
            font-size: 13px;
            line-height: 1.4;
            color: var(--muted);
            border: 1px solid var(--line);
            border-radius: 2px;
            padding: 5px 10px;
            overflow-wrap: anywhere;
        }

        .comment-section {
            max-width: 680px;
            margin-top: 48px;
            padding-top: 32px;
            border-top: 1px solid var(--line);
        }

        .comment-heading {
            display: flex;
            align-items: baseline;
            gap: 12px;
            font-family: var(--serif);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 700;
            margin: 0 0 24px;
        }

        .comment-count {
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
        }

        .form-notice {
            margin: 0 0 20px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.6;
            color: var(--ink);
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: 2px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .field textarea {
            display: block;
            width: 100%;
            min-height: 140px;
            padding: 14px;
            font-family: var(--sans);
            font-size: 16px;
            line-height: 1.6;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            resize: vertical;
            transition: border-color .15s;
        }

        .field textarea::placeholder {
            color: var(--muted);
        }

        .field textarea:focus {
            outline: none;
            border-color: var(--ink);
        }

        .form-error {
            margin: 8px 0 0;
            font-size: 13px;
            color: var(--accent);
        }

        .comment-form button {
            height: 44px;
            margin-top: 16px;
            padding: 0 24px;
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

        .comment-form button:hover {
            background: var(--accent);
        }

        .comment-list {
            border-top: 2px solid var(--ink);
        }

        .comment-item {
            padding: 20px 0;
            border-bottom: 1px solid var(--line);
        }

        .comment-head {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 2px 14px;
            margin-bottom: 8px;
        }

        .comment-head strong {
            font-size: 15px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .comment-head time {
            font-size: 13px;
            color: var(--muted);
        }

        .comment-text {
            margin: 0;
            font-size: 16px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .comment-empty {
            margin: 0;
            padding: 20px 0;
            font-size: 15px;
            line-height: 1.6;
            color: var(--muted);
            border-top: 2px solid var(--ink);
            border-bottom: 1px solid var(--line);
        }

        .back-link {
            display: inline-block;
            margin-top: 40px;
            padding: 8px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
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

            .article-body {
                font-size: 17.5px;
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

            .article-body {
                font-size: 16.5px;
                line-height: 1.75;
            }

            .article-body p {
                margin-bottom: 1.3em;
            }

            .article-tags {
                margin-top: 32px;
            }

            .comment-section {
                margin-top: 40px;
                padding-top: 28px;
            }

            .comment-heading {
                font-size: 22px;
                margin-bottom: 20px;
            }

            .comment-form button {
                width: 100%;
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

            <div class="article-body">
                @foreach (preg_split('/\R{2,}/', trim($article->content)) as $paragraph)
                    <p>{!! nl2br(e($paragraph)) !!}</p>
                @endforeach
            </div>

            @if ($article->tags->count())
                <div class="article-tags">
                    <span class="tags-label">Tag</span>
                    <ul class="tags-list">
                        @foreach ($article->tags as $tag)
                            <li>{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="comment-section" aria-labelledby="comment-form-title">
                <h2 class="comment-heading" id="comment-form-title">Berikan Komentar</h2>

                @if (session('success'))
                    <p class="form-notice" role="status">{{ session('success') }}</p>
                @endif

                <form class="comment-form" action="/comments" method="POST">
                    @csrf

                    <input type="hidden" name="article_id" value="{{ $article->id }}">

                    <div class="field">
                        <label for="comment">Komentar</label>
                        <textarea
                            id="comment"
                            name="comment"
                            rows="5"
                            required
                            placeholder="Tulis komentar Anda..."
                        >{{ old('comment') }}</textarea>

                        @error('comment')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit">Kirim Komentar</button>
                </form>
            </section>

            <section class="comment-section" aria-labelledby="comment-list-title">
                <h2 class="comment-heading" id="comment-list-title">
                    Komentar
                    @if ($article->comments->count())
                        <span class="comment-count">{{ $article->comments->count() }}</span>
                    @endif
                </h2>

                @if ($article->comments->count())
                    <div class="comment-list">
                        @foreach ($article->comments as $comment)
                            <article class="comment-item">
                                <div class="comment-head">
                                    <strong>{{ $comment->user->name }}</strong>
                                    @if ($comment->created_at)
                                        <time datetime="{{ $comment->created_at->toDateString() }}">{{ $comment->created_at->format('d M Y') }}</time>
                                    @endif
                                </div>

                                <p class="comment-text">{{ $comment->comment }}</p>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="comment-empty">Belum ada komentar yang disetujui.</p>
                @endif
            </section>

            <a class="back-link" href="/articles">Kembali ke Daftar Artikel</a>

        </div>

    </main>

</body>
</html>