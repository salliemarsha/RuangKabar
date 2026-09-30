<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penulis - RuangKabar</title>
</head>
<body>

    <h1>Dashboard Penulis</h1>

    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <p>Anda login sebagai: {{ auth()->user()->role }}</p>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>