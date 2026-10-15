<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kategori - RuangKabar</title>

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
            --sidebar-w: 256px;
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
            font-family: var(--sans);
            background: var(--bg);
            color: var(--ink);
            overflow-x: hidden;
            overflow-wrap: break-word;
            -webkit-text-size-adjust: 100%;
        }

        body.menu-open {
            overflow: hidden;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .sidebar a:focus-visible {
            outline-offset: -3px;
        }

        .admin {
            display: grid;
            grid-template-columns: var(--sidebar-w) minmax(0, 1fr);
            min-height: 100vh;
            min-height: 100dvh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            height: 100dvh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: var(--bg);
            border-right: 1px solid var(--line);
        }

        .sidebar-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 72px;
            padding: 12px 24px;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: inline-block;
            font-family: var(--serif);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--ink);
            text-decoration: none;
        }

        .brand span {
            color: var(--accent);
        }

        .brand .brand-sub {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-family: var(--sans);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .sidebar-close {
            display: none;
            width: 40px;
            height: 40px;
            margin: 0 -8px 0 0;
            font-size: 22px;
            line-height: 1;
            color: var(--ink);
            background: none;
            border: 1px solid var(--line);
            border-radius: 4px;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .side-nav {
            flex: 1;
            padding: 12px 0 8px;
        }

        .nav-group {
            list-style: none;
            margin: 0;
            padding: 8px 0;
        }

        .nav-group + .nav-group {
            border-top: 1px solid var(--line);
        }

        .nav-link {
            display: block;
            padding: 12px 24px 12px 22px;
            font-size: 14px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: color .2s, background .2s;
        }

        .nav-link:hover {
            color: var(--accent-strong);
            background: rgba(32, 33, 36, 0.04);
        }

        .nav-link.is-active {
            font-weight: 700;
            color: var(--accent-strong);
            border-left-color: var(--accent);
        }

        .sidebar-foot {
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .sidebar-foot .nav-link {
            font-size: 13px;
            color: var(--muted);
        }

        .main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 72px;
            padding: 12px 40px;
            background: var(--bg);
            border-bottom: 1px solid var(--line);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .menu-toggle {
            transition: border-color .2s, background .2s;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            background: none;
            border: 1px solid var(--line);
            border-radius: 4px;
            cursor: pointer;
        }

        .menu-toggle:hover,
        .sidebar-close:hover {
            border-color: var(--ink);
            background: rgba(32, 33, 36, 0.04);
        }

        .menu-toggle span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--ink);
        }

        .crumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 0 8px;
            margin: 0 0 2px;
            padding: 0;
            list-style: none;
            font-size: 12px;
            color: var(--muted);
        }

        .crumbs li + li::before {
            content: "/";
            margin-right: 8px;
        }

        .page-title {
            margin: 0;
            font-family: var(--serif);
            font-size: 24px;
            line-height: 1.25;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-shrink: 0;
        }

        .user-info {
            text-align: right;
            line-height: 1.35;
            min-width: 0;
        }

        .user-name {
            display: block;
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            height: 40px;
            padding: 0 18px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            background: transparent;
            border: 1px solid var(--ink);
            border-radius: 4px;
            cursor: pointer;
            transition: color .2s, background .2s;
        }

        .logout-btn:hover {
            color: var(--bg);
            background: var(--ink);
        }

        .logout-btn:active,
        .menu-toggle:active,
        .sidebar-close:active {
            transform: translateY(1px);
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .welcome-title {
            margin: 0 0 8px;
            font-family: var(--serif);
            font-size: 28px;
            line-height: 1.3;
            font-weight: 600;
        }

        .welcome-meta {
            margin: 0;
            font-size: 15px;
            color: var(--muted);
        }

        .form-wrap {
            max-width: 560px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 0;
            margin-bottom: 12px;
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }

        .back-link:hover {
            color: var(--accent-strong);
        }

        .form-lead {
            margin: 0 0 28px;
            font-size: 15px;
            line-height: 1.7;
            color: var(--muted);
        }

        .alert {
            margin: 0 0 24px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: 2px;
        }

        .alert-title {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 700;
            color: var(--accent-strong);
        }

        .alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .edit-context {
            margin: 0 0 24px;
            padding: 12px 0;
            font-size: 13px;
            color: var(--muted);
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            overflow-wrap: anywhere;
        }

        .edit-context strong {
            font-weight: 600;
            color: var(--ink);
        }

        .field {
            margin-bottom: 8px;
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
            height: 48px;
            padding: 0 14px;
            font-family: var(--sans);
            font-size: 16px;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: border-color .2s;
        }

        .field input:focus {
            border-color: var(--ink);
            outline: 1px solid var(--ink);
            outline-offset: 0;
        }

        .field input[aria-invalid="true"] {
            border-color: var(--accent-strong);
        }

        .hint {
            margin: 8px 0 0;
            font-size: 13px;
            line-height: 1.6;
            color: var(--muted);
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 24px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }

        .primary-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            padding: 0 26px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s;
        }

        .primary-action:hover {
            background: var(--accent-strong);
        }

        .primary-action:active {
            transform: translateY(1px);
        }

        .cancel-link {
            display: inline-block;
            padding: 12px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            transition: color .2s;
        }

        .cancel-link:hover {
            color: var(--accent-strong);
        }

        .scrim {
            display: none;
        }

        @media (max-width: 959px) {
            .admin {
                grid-template-columns: minmax(0, 1fr);
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 40;
                width: min(300px, 86vw);
                height: auto;
                visibility: hidden;
                transform: translateX(-100%);
                transition: transform .25s ease, visibility 0s linear .25s;
            }

            .sidebar.is-open {
                visibility: visible;
                transform: none;
                transition: transform .25s ease;
            }

            .sidebar-close {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .scrim {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 30;
                background: rgba(32, 33, 36, 0.45);
                opacity: 0;
                visibility: hidden;
                transition: opacity .25s ease, visibility 0s linear .25s;
            }

            .scrim.is-visible {
                opacity: 1;
                visibility: visible;
                transition: opacity .25s ease;
            }

            .menu-toggle {
                display: flex;
            }

            .topbar {
                padding: 12px 24px;
                min-height: 72px;
            }

            .content {
                padding: 32px 24px;
            }
        }

        @media (max-width: 639px) {
            .topbar {
                padding: 10px 16px;
                min-height: 72px;
                gap: 10px;
            }

            .topbar-left {
                gap: 10px;
            }

            .page-title {
                font-size: 19px;
            }

            .user-info {
                display: none;
            }

            .logout-btn {
                padding: 0 14px;
            }

            .content {
                padding: 24px 16px 40px;
            }

            .welcome-title {
                font-size: 22px;
            }
        }

        @media (max-width: 639px) {
            .topbar {
                padding: 10px 16px;
                min-height: 72px;
                gap: 10px;
            }

            .topbar-left {
                gap: 10px;
            }

            .page-title {
                font-size: 19px;
            }

            .user-info {
                display: none;
            }

            .logout-btn {
                padding: 0 14px;
            }

            .content {
                padding: 20px 16px 40px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 4px;
            }

            .cancel-link {
                text-align: center;
            }
        }

        @media (max-width: 359px) {
            .topbar {
                padding: 10px 12px;
            }

            .page-title {
                font-size: 17px;
            }

            .content {
                padding: 16px 12px 32px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }

            .logout-btn:active,
            .primary-action:active,
            .menu-toggle:active,
            .sidebar-close:active {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <div class="admin">

        <aside class="sidebar" id="sidebar" aria-label="Navigasi admin">
            <div class="sidebar-top">
                <a class="brand" href="/">
                    RUANG<span>KABAR</span>
                    <span class="brand-sub">Panel Admin</span>
                </a>

                <button class="sidebar-close" id="sidebarClose" type="button" aria-label="Tutup menu">&times;</button>
            </div>

            <nav class="side-nav" aria-label="Menu admin">
                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'is-active' : '' }}" href="/admin/dashboard" {!! request()->is('admin/dashboard') ? 'aria-current="page"' : '' !!}>Dashboard</a>
                    </li>
                </ul>

                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('articles*') ? 'is-active' : '' }}" href="{{ route('articles.index') }}" {!! request()->is('articles*') ? 'aria-current="page"' : '' !!}>Artikel</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('categories*') ? 'is-active' : '' }}" href="{{ route('categories.index') }}" {!! request()->is('categories*') ? 'aria-current="page"' : '' !!}>Kategori</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('tags*') ? 'is-active' : '' }}" href="{{ route('tags.index') }}" {!! request()->is('tags*') ? 'aria-current="page"' : '' !!}>Tag</a>
                    </li>
                </ul>

                <ul class="nav-group">
                    <li>
                        <a class="nav-link {{ request()->is('comments*') ? 'is-active' : '' }}" href="{{ route('comments.index') }}" {!! request()->is('comments*') ? 'aria-current="page"' : '' !!}>Komentar</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('reports/*') ? 'is-active' : '' }}" href="{{ route('reports.articles') }}" {!! request()->is('reports/*') ? 'aria-current="page"' : '' !!}>Laporan</a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-foot">
                <a class="nav-link" href="/">← Lihat beranda</a>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        <div class="main">

            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
                        <span></span><span></span><span></span>
                    </button>

                    <div>
                        <ol class="crumbs">
                            <li>Admin</li>
                            <li>Kategori</li>
                            <li>Edit</li>
                        </ol>
                        <h1 class="page-title">Edit Kategori</h1>
                    </div>
                </div>

                <div class="topbar-right">
                    <div class="user-info">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span class="user-role">{{ auth()->user()->role }}</span>
                    </div>

                    <form class="logout-form" action="/logout" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit">Logout</button>
                    </form>
                </div>
            </header>

            <main class="content">
                <div class="form-wrap">
                    <a class="back-link" href="/categories">← Kembali ke daftar kategori</a>

                    <p class="form-lead">Ubah nama kategori sesuai kebutuhan.</p>

                    @if ($errors->any())
                        <div class="alert" role="alert">
                            <strong class="alert-title">Terjadi kesalahan</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="edit-context">Slug saat ini: <strong>{{ $category->slug }}</strong></p>

                    <form action="/categories/{{ $category->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="field">
                            <label for="name">Nama Kategori</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $category->name) }}"
                                maxlength="100"
                                required
                                aria-describedby="name-hint"
                                {!! $errors->has('name') ? 'aria-invalid="true"' : '' !!}
                            >
                            <p class="hint" id="name-hint">Slug akan ikut diperbarui otomatis jika nama diubah.</p>
                        </div>

                        <div class="form-actions">
                            <button class="primary-action" type="submit">Update Kategori</button>
                            <a class="cancel-link" href="/categories">Batal</a>
                        </div>
                    </form>
                </div>
            </main>

        </div>

    </div>

    <script>
        (function () {
            var sidebar = document.getElementById('sidebar');
            var scrim = document.getElementById('scrim');
            var toggle = document.getElementById('menuToggle');
            var closeBtn = document.getElementById('sidebarClose');
            if (!sidebar || !scrim || !toggle || !closeBtn) return;

            function openMenu() {
                sidebar.classList.add('is-open');
                scrim.classList.add('is-visible');
                document.body.classList.add('menu-open');
                toggle.setAttribute('aria-expanded', 'true');
                closeBtn.focus();
            }

            function closeMenu(returnFocus) {
                sidebar.classList.remove('is-open');
                scrim.classList.remove('is-visible');
                document.body.classList.remove('menu-open');
                toggle.setAttribute('aria-expanded', 'false');
                if (returnFocus) toggle.focus();
            }

            toggle.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', function () { closeMenu(true); });
            scrim.addEventListener('click', function () { closeMenu(true); });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && sidebar.classList.contains('is-open')) {
                    closeMenu(true);
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 960 && sidebar.classList.contains('is-open')) {
                    closeMenu(false);
                }
            });
        })();
    </script>

</body>
</html>