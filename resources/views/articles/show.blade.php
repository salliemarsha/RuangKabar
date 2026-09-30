<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }} - RuangKabar</title>
</head>
<body>

    <h1>{{ $article->title }}</h1>

    <p>
        Kategori: {{ $article->category->name }}
    </p>

    <p>
        Penulis: {{ $article->user->name }}
    </p>

    <p>
        Status: {{ $article->status }}
    </p>

    <hr>

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

</body>
</html>