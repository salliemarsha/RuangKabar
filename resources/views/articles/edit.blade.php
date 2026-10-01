<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel - RuangKabar</title>
</head>
<body>

    <h1>Edit Artikel</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Judul</label>
            <br>
            <input
                type="text"
                name="title"
                value="{{ old('title', $article->title) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Kategori</label>
            <br>
            <select name="category_id" required>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ $article->category_id == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Isi Artikel</label>
            <br>
            <textarea name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
        </div>

        <br>

        <div>
            <label for="image">Gambar</label>
            <br>

            @if ($article->image)
                <img
                    src="{{ asset('storage/' . $article->image) }}"
                    alt="{{ $article->title }}"
                    width="200"
                >
                <br><br>
            @endif

            <input
                type="file"
                name="image"
                id="image"
                accept=".jpg,.jpeg,.png,.webp"
            >

            @error('image')
                <div>{{ $message }}</div>
            @enderror
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
                            {{ $article->tags->contains($tag->id) ? 'checked' : '' }}
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
                <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>
                    Published
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Update Artikel</button>
        <a href="/articles">Kembali</a>
    </form>

</body>
</html>