<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tag - RuangKabar</title>
</head>
<body>

    <h1>Tambah Tag</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tags" method="POST">
        @csrf

        <div>
            <label>Nama Tag</label>
            <br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <br>

        <button type="submit">Simpan Tag</button>
        <a href="/tags">Kembali</a>
    </form>

</body>
</html>