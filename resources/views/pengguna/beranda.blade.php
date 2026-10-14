<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beranda - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #F7F5F0;
            --ink: #202124;
            --accent: #C94B3C;
            --accent-strong: #B8402F;
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
            min-height: 100dvh;
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

        .site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: var(--bg);
            border-bottom: 1px solid var(--line);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            min-height: 68px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 4px 24px;
        }

        .logo {
            display: inline-block;
            padding: 8px 0;
            font-family: var(--serif);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--ink);
            text-decoration: none;
        }

        .logo span {
            color: var(--accent);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-menu a,
        .nav-menu .nav-logout {
            padding: 10px 0;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            background: none;
            border: 0;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: color .2s, border-color .2s;
        }

        .nav-menu a:hover,
        .nav-menu .nav-logout:hover {
            color: var(--accent-strong);
        }

        .nav-user {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-left: 28px;
            border-left: 1px solid var(--line);
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
        }

        .nav-form {
            display: contents;
        }

        .welcome {
            max-width: 1200px;
            margin: 0 auto;
            padding: 72px 24px 96px;
        }

        .welcome-inner {
            max-width: 820px;
        }

        .welcome-eyebrow {
            margin-bottom: 18px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-strong);
        }

        .welcome-title {
            margin: 0 0 20px;
            font-family: var(--serif);
            font-size: 56px;
            line-height: 1.12;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .welcome-lead {
            max-width: 560px;
            margin: 0 0 8px;
            font-size: 18px;
            line-height: 1.7;
            color: var(--muted);
        }

        .welcome-role {
            margin: 0 0 36px;
            font-size: 14px;
            color: var(--muted);
        }

        .welcome-role strong {
            font-weight: 600;
            color: var(--ink);
        }

        .welcome-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px 24px;
            padding-top: 28px;
            border-top: 1px solid var(--line);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            height: 48px;
            padding: 0 26px;
            font-size: 15px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border-radius: 4px;
            text-decoration: none;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: var(--accent-strong);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        .btn-link {
            display: inline-block;
            padding: 12px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent-strong);
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 1023px) {
            .welcome {
                padding: 56px 24px 72px;
            }

            .welcome-title {
                font-size: 44px;
            }
        }

        @media (max-width: 767px) {
            .nav-inner {
                min-height: 60px;
                padding: 0 20px;
                gap: 0 16px;
            }

            .logo {
                font-size: 19px;
            }

            .nav-menu {
                gap: 18px;
            }

            .nav-user {
                display: none;
            }

            .nav-menu a,
            .nav-menu .nav-logout {
                padding: 12px 0;
            }

            .welcome {
                padding: 40px 20px 56px;
            }

            .welcome-eyebrow {
                margin-bottom: 14px;
            }

            .welcome-title {
                font-size: 34px;
                margin-bottom: 16px;
            }

            .welcome-lead {
                font-size: 16px;
            }

            .welcome-role {
                margin-bottom: 28px;
            }

            .welcome-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 4px;
            }

            .btn-primary {
                justify-content: center;
            }

            .btn-link {
                text-align: center;
            }
        }

        @media (max-width: 380px) {
            .logo {
                font-size: 17px;
                letter-spacing: 0.02em;
            }

            .nav-menu {
                gap: 14px;
            }

            .welcome-title {
                font-size: 30px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }

            .btn-primary:active {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="nav-inner">
            <a class="logo" href="/">RUANG<span>KABAR</span></a>

            <nav class="nav-menu" aria-label="Menu utama">
                <a href="/">Beranda</a>
                <a href="{{ route('articles.index') }}">Berita</a>
                <span class="nav-user">{{ auth()->user()->name }}</span>

                <form class="nav-form" action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-logout">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="welcome">
        <div class="welcome-inner">
            <div class="welcome-eyebrow">Beranda RuangKabar</div>

            <h1 class="welcome-title">Selamat datang, {{ auth()->user()->name }}!</h1>

            <p class="welcome-lead">Jelajahi berita dan informasi terkini dari RuangKabar, lalu bagikan pendapat Anda lewat komentar.</p>

            <p class="welcome-role">Anda login sebagai: <strong>{{ auth()->user()->role }}</strong></p>

            <div class="welcome-actions">
                <a class="btn-primary" href="{{ route('articles.index') }}">Baca Berita</a>
                <a class="btn-link" href="/">Kembali ke beranda utama</a>
            </div>
        </div>
    </main>

</body>
</html>