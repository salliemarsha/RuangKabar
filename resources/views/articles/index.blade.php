<!DOCTYPE html>
<html>
<head>
    <title>Artikel - RuangKabar</title>
</head>
<body>

    <h1>Daftar Artikel</h1>

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

                <a href="/articles/{{ $article->id }}">Lihat</a>
                |
                <a href="/articles/{{ $article->id }}/edit">Edit</a>
            </article>

            <hr>
        @endforeach

        {{ $articles->links() }}
    @else
        <p>Belum ada artikel.</p>
    @endif

</body>
</html>