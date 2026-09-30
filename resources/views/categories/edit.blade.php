<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori - RuangKabar</title>
</head>
<body>

    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/categories/{{ $category->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Kategori</label>
            <br>
            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                required
            >
        </div>

        <br>

        <button type="submit">Update Kategori</button>
        <a href="/categories">Kembali</a>
    </form>

</body>
</html>