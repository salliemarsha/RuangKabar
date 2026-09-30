<!DOCTYPE html>
<html>
<head>
    <title>Tags - RuangKabar</title>
</head>
<body>

    <h1>Daftar Tag</h1>

    <a href="/tags/create">Tambah Tag</a>

    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($tags->count())
        <ul>
            @foreach ($tags as $tag)
                <li>
                    {{ $tag->name }}

                    |
                    <a href="/tags/{{ $tag->id }}/edit">Edit</a>

                    <form action="/tags/{{ $tag->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Yakin ingin menghapus tag ini?')">
                            Hapus
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Belum ada tag.</p>
    @endif

</body>
</html>