<!DOCTYPE html>
<html>
<head>
    <title>Login - RuangKabar</title>
</head>
<body>

    <h1>Login RuangKabar</h1>

    @if ($errors->any())
        <div>
            {{ $errors->first() }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div>
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

</body>
</html>