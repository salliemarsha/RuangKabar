
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - RuangKabar</title>
</head>
<body>
    <h1>Pengaturan Akun</h1>

    <p>Kelola informasi dan keamanan akun Anda.</p>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Informasi Profil</h2>

    <form action="{{ route('account.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label>Username</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}" required>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <hr>

    <h2>Keamanan Akun</h2>

    <form action="{{ route('account.password.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label>Password Lama</label>
        <input type="password" name="current_password" required>

        <label>Password Baru</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Ubah Password</button>
    </form>

    <hr>

    <h2>Informasi Akun</h2>

    <p>Nama: {{ $user->name }}</p>
    <p>Username: {{ $user->username }}</p>
    <p>Role: {{ ucfirst($user->role) }}</p>
    <p>Tanggal Bergabung: {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}</p>

</body>
</html>
