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

    <a href="/articles">Kembali ke Daftar Artikel</a>

</body>
</html>