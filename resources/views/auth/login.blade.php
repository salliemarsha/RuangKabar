<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #F7F5F0;
            --ink: #202124;
            --accent: #C94B3C;
            --muted: #6B6B6B;
            --line: #D9D6CF;
            --serif: 'Lora', Georgia, serif;
            --sans: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--sans);
            background: var(--bg);
            color: var(--ink);
            overflow-x: hidden;
            overflow-wrap: break-word;
            -webkit-text-size-adjust: 100%;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .auth {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
            min-height: 100vh;
        }

        .auth-side {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 48px;
            padding: 40px 56px;
            border-right: 1px solid var(--line);
        }

        .brand {
            font-family: var(--serif);
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--ink);
            text-decoration: none;
        }

        .brand span {
            color: var(--accent);
        }

        .side-tagline {
            max-width: 340px;
            margin: 0;
            font-family: var(--serif);
            font-size: 32px;
            line-height: 1.25;
            font-weight: 600;
        }

        .auth-main {
            display: flex;
            align-items: center;
            padding: 48px 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .auth-title {
            font-family: var(--serif);
            font-size: 34px;
            line-height: 1.2;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .auth-lead {
            margin: 0 0 28px;
            font-size: 15px;
            line-height: 1.6;
            color: var(--muted);
        }

        .alert {
            margin: 0 0 24px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.6;
            color: var(--ink);
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: 2px;
        }

        .alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .field input {
            display: block;
            width: 100%;
            height: 46px;
            padding: 0 14px;
            font-family: var(--sans);
            font-size: 16px;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: border-color .15s;
        }

        .field input:focus {
            border-color: var(--ink);
            outline: 1px solid var(--ink);
            outline-offset: 0;
        }

        .auth-submit {
            width: 100%;
            height: 46px;
            margin-top: 4px;
            font-family: var(--sans);
            font-size: 15px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            transition: background .15s;
        }

        .auth-submit:hover {
            background: var(--accent);
        }

        .auth-links {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
            font-size: 14px;
            color: var(--muted);
        }

        .auth-links p {
            margin: 0;
        }

        .auth-links a {
            display: inline-block;
            padding: 6px 0;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        .auth-links .back {
            display: block;
            margin-top: 6px;
            color: var(--muted);
        }

        @media (max-width: 859px) {
            .auth {
                grid-template-columns: minmax(0, 1fr);
                grid-template-rows: auto 1fr;
            }

            .auth-side {
                padding: 20px;
                gap: 0;
                border-right: 0;
                border-bottom: 1px solid var(--line);
            }

            .side-tagline {
                display: none;
            }

            .brand {
                font-size: 21px;
            }

            .auth-main {
                align-items: flex-start;
                padding: 32px 20px 48px;
            }

            .auth-title {
                font-size: 30px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="auth">
        <aside class="auth-side">
            <a class="brand" href="/">RUANG<span>KABAR</span></a>
            <p class="side-tagline">Portal berita dan informasi terkini.</p>
        </aside>

        <main class="auth-main">
            <div class="auth-card">
                <h1 class="auth-title">Login</h1>
                <p class="auth-lead">Masuk ke akun RuangKabar Anda.</p>

                @if ($errors->any())
                    <div class="alert" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="username" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" required>
                    </div>

                    <button class="auth-submit" type="submit">Login</button>
                </form>

                <div class="auth-links">
                    <p>Belum punya akun? <a href="/register">Daftar</a></p>
                    <a class="back" href="/">← Kembali ke beranda</a>
                </div>
            </div>
        </main>
    </div>

</body>
</html>