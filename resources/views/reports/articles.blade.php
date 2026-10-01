<!DOCTYPE html>
<html>
<head>
    <title>Laporan Artikel - RuangKabar</title>
</head>
<body>

    <h1>Laporan Data Artikel</h1>

    <p>
        Tanggal laporan: {{ now()->format('d-m-Y H:i') }}
    </p>

    <hr>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Artikel</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ $article->status }}</td>
                    <td>{{ $article->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data artikel.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <button onclick="window.print()">Cetak Laporan</button>

</body>
</html>