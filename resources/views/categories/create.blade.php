<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori - RuangKabar</title>
</head>
<body>

    <h1>Tambah Kategori</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/categories" method="POST">
        @csrf

        <div>
            <label>Nama Kategori</label>
            <br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <br>

        <button type="submit">Simpan Kategori</button>
        <a href="/categories">Kembali</a>
    </form>

</body>
</html>