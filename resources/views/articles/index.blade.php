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

</body>
</html>