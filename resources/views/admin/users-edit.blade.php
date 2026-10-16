<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna | RuangKabar</title>
</head>
<body>
    <h1>Edit Pengguna</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >
        </div>

        <div>
            <label for="username">Username</label>
            <input
                id="username"
                type="text"
                name="username"
                value="{{ old('username', $user->username) }}"
                required
            >
        </div>

        <div>
            <label for="role">Peran</label>
            <select id="role" name="role" required>
                <option value="penulis"
                    @selected(old('role', $user->role) === 'penulis')>
                    Penulis
                </option>
                <option value="pengguna"
                    @selected(old('role', $user->role) === 'pengguna')>
                    Pembaca
                </option>
            </select>
        </div>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin.users.index') }}">Batal</a>
    </form>
</body>
</html>