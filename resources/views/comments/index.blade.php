<!DOCTYPE html>
<html>
<head>
    <title>Komentar - RuangKabar</title>
</head>
<body>

    <h1>Daftar Komentar</h1>

    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($comments->count())
        @foreach ($comments as $comment)
            <article>
                <p>
                    <strong>{{ $comment->user->name }}</strong>
                    pada artikel:
                    <strong>{{ $comment->article->title }}</strong>
                </p>

                <p>
                    {{ $comment->comment }}
                </p>

                <p>
                    Status: {{ $comment->status }}
                </p>

                <form action="/comments/{{ $comment->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <select name="status">
                        <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>

                    <button type="submit">Simpan Status</button>
                </form>


                <form
                    action="/comments/{{ $comment->id }}"
                    method="POST"
                    style="display:inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Yakin ingin menghapus komentar ini?')"
                    >
                        Hapus
                    </button>
                </form>
            </article>

            <hr>
        @endforeach

        {{ $comments->links() }}
    @else
        <p>Belum ada komentar.</p>
    @endif

</body>
</html>