<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Pengguna | RuangKabar</title>
</head>
<body>
    <main>
        <h1>Pengelolaan Pengguna</h1>

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

        <form action="{{ route('admin.users.index') }}" method="GET">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama atau username"
            >

            <select name="role">
                <option value="" {{ $role === '' ? 'selected' : '' }}>
                    Semua peran
                </option>
                <option value="penulis" {{ $role === 'penulis' ? 'selected' : '' }}>
                    Penulis
                </option>
                <option value="pengguna" {{ $role === 'pengguna' ? 'selected' : '' }}>
                    Pembaca
                </option>
            </select>

            <button type="submit">Cari</button>
            <a href="{{ route('admin.users.index') }}">Reset</a>
        </form>

        <p>Total hasil: {{ $users->total() }}</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Peran</th>
                    <th>Tanggal Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            {{ $user->role === 'pengguna' ? 'Pembaca' : ucfirst($user->role) }}
                        </td>
                        <td>{{ $user->created_at ?? '—' }}</td>
                        <td>
                            @if ($user->role !== 'admin')
                                <a href="{{ route('admin.users.edit', $user->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Hapus</button>
                                </form>
                            @else
                                <span>Akun admin dilindungi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada pengguna yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </main>
</body>
</html>
