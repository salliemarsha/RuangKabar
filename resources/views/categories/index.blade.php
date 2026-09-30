<!DOCTYPE html>
<html>
<head>
    <title>Kategori - RuangKabar</title>
</head>
<body>

    <h1>Daftar Kategori</h1>

    <a href="/categories/create">Tambah Kategori</a>

    <hr>

    @if ($categories->count())
        <ul>
            @foreach ($categories as $category)
                <li>
                    {{ $category->name }}
                    |
                    <a href="/categories/{{ $category->id }}/edit">Edit</a>
                    <form action="/categories/{{ $category->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
            Hapus
        </button>
    </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Belum ada kategori.</p>
        @endif

</body>
</html>