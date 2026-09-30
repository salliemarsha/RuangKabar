<!DOCTYPE html>
<html>
<head>
    <title>Daftar - RuangKabar</title>
</head>
<body>

    <h1>Daftar Akun RuangKabar</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <p>
        Sudah punya akun?
        <a href="/login">Login</a>
    </p>

</body>
</html>