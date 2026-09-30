<!DOCTYPE html>
<html>
<head>
    <title>Beranda - RuangKabar</title>
</head>
<body>

    <h1>Beranda RuangKabar</h1>

    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <p>Anda login sebagai: {{ auth()->user()->role }}</p>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>