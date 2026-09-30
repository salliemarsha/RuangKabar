<!DOCTYPE html>
<html>
<head>
    <title>Edit Tag - RuangKabar</title>
</head>
<body>

    <h1>Edit Tag</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tags/{{ $tag->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Tag</label>
            <br>
            <input
                type="text"
                name="name"
                value="{{ old('name', $tag->name) }}"
                required
            >
        </div>

        <br>

        <button type="submit">Update Tag</button>
        <a href="/tags">Kembali</a>
    </form>

</body>
</html>