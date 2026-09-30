<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel - RuangKabar</title>
</head>
<body>

    <h1>Tambah Artikel</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/articles" method="POST">
        @csrf

        <div>
            <label>Judul</label>
            <br>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <br>

        <div>
            <label>Kategori</label>
            <br>
            <select name="category_id" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Isi Artikel</label>
            <br>
            <textarea name="content" rows="10" required>{{ old('content') }}</textarea>
        </div>

        <br>

        <div>
            <label>Gambar</label>
            <br>
            <input type="text" name="image" value="{{ old('image') }}">
        </div>

        <br>

        <div>
            <label>Tag</label>
            <br>

            @if ($tags->count())
                @foreach ($tags as $tag)
                    <label>
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                        >
                        {{ $tag->name }}
                    </label>
                    <br>
                @endforeach
            @else
                <p>Belum ada tag.</p>
            @endif
        </div>

        <br>

        <div>
            <label>Status</label>
            <br>
            <select name="status" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <br>

        <button type="submit">Simpan Artikel</button>
        <a href="/articles">Kembali</a>
    </form>

</body>
</html>