<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengelolaan Pengguna | RuangKabar</title>

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

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .intro {
            max-width: 1040px;
            margin: 0 0 24px;
        }

        .intro p {
            max-width: 560px;
            margin: 0;
            font-size: 15px;
            line-height: 1.7;
            color: var(--muted);
        }

        .notice {
            max-width: 1040px;
            margin: 0 0 24px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: 2px;
        }

        .alert {
            max-width: 1040px;
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

        .filter {
            max-width: 1040px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin: 0 0 28px;
        }

        .filter input[type="search"] {
            flex: 1 1 260px;
            min-width: 0;
            height: 46px;
            padding: 0 14px;
            font-family: var(--sans);
            font-size: 16px;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: border-color .2s;
        }

        .filter select {
            flex: 0 1 180px;
            height: 46px;
            padding: 0 12px;
            font-family: var(--sans);
            font-size: 15px;
            color: var(--ink);
            background: #FFFFFF;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: border-color .2s;
        }

        .filter input[type="search"]:focus,
        .filter select:focus {
            border-color: var(--ink);
            outline: 1px solid var(--ink);
            outline-offset: 0;
        }

        .primary-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            padding: 0 22px;
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

        .reset-link {
            padding: 12px 4px;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent-strong);
            text-decoration: none;
        }

        .reset-link:hover {
            text-decoration: underline;
        }

        .list-head {
            max-width: 1040px;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--ink);
        }

        .list-title {
            margin: 0;
            font-family: var(--serif);
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .list-count {
            font-size: 13px;
            color: var(--muted);
        }

        .users-table {
            width: 100%;
            max-width: 1040px;
            border-collapse: collapse;
        }

        .users-table th {
            padding: 14px 16px 14px 0;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-align: left;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--ink);
        }

        .users-table td {
            padding: 16px 16px 16px 0;
            font-size: 14px;
            line-height: 1.5;
            vertical-align: middle;
            border-bottom: 1px solid var(--line);
            overflow-wrap: anywhere;
        }

        .users-table th:last-child,
        .users-table td:last-child {
            padding-right: 0;
        }

        .cell-name {
            font-family: var(--serif);
            font-size: 16px;
            font-weight: 600;
        }

        .cell-muted {
            color: var(--muted);
        }

        .cell-date {
            white-space: nowrap;
            color: var(--muted);
        }

        .badge {
            display: inline-block;
            padding: 3px 9px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-radius: 2px;
            white-space: nowrap;
        }

        .badge-admin {
            color: var(--bg);
            background: var(--ink);
            border: 1px solid var(--ink);
        }

        .badge-penulis {
            color: var(--accent-strong);
            background: transparent;
            border: 1px solid var(--accent-strong);
        }

        .badge-pengguna {
            color: var(--muted);
            background: transparent;
            border: 1px dashed var(--muted);
        }

        .row-actions {
            display: flex;
            align-items: center;
            gap: 0 18px;
        }

        .row-actions a,
        .row-actions button {
            padding: 12px 0;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            background: none;
            border: 0;
            cursor: pointer;
            transition: color .2s;
        }

        .row-actions a:hover,
        .row-actions button:hover {
            color: var(--accent-strong);
        }

        .row-actions form {
            margin: 0;
        }

        .protected {
            font-size: 12px;
            color: var(--muted);
        }

        .empty {
            max-width: 1040px;
            padding: 32px 0;
            border-bottom: 1px solid var(--line);
        }

        .empty strong {
            display: block;
            margin-bottom: 6px;
            font-family: var(--serif);
            font-size: 20px;
            font-weight: 700;
        }

        .empty p {
            margin: 0 0 16px;
            font-size: 15px;
            line-height: 1.6;
            color: var(--muted);
        }

        .pagination {
            max-width: 1040px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 24px;
        }

        .pg-numbers {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
        }

        .pg-gap {
            min-width: 24px;
            text-align: center;
            color: var(--muted);
        }

        .pg-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 44px;
            height: 44px;
            padding: 0 12px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            text-decoration: none;
            border: 1px solid var(--line);
            border-radius: 4px;
            transition: color .2s, border-color .2s;
        }

        a.pg-link:hover {
            color: var(--accent-strong);
            border-color: var(--accent);
        }

        .pg-link.is-current {
            color: var(--bg);
            background: var(--ink);
            border-color: var(--ink);
        }

        .pg-link.is-disabled {
            color: var(--muted);
            opacity: 0.45;
            border-style: dashed;
            cursor: not-allowed;
        }

        .pg-status {
            display: none;
            font-size: 13px;
            color: var(--muted);
            text-align: center;
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

        @media (max-width: 767px) {
            .users-table,
            .users-table tbody,
            .users-table tr,
            .users-table td {
                display: block;
                width: 100%;
            }

            .users-table thead {
                position: absolute;
                width: 1px;
                height: 1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
            }

            .users-table tr {
                padding: 16px 0;
                border-bottom: 1px solid var(--line);
            }

            .users-table td {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 4px 0;
                border-bottom: 0;
            }

            .users-table td::before {
                content: attr(data-label);
                flex: 0 0 84px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--muted);
            }

            .users-table td.empty-cell {
                display: block;
            }

            .users-table td.empty-cell::before {
                display: none;
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

            .filter select {
                flex: 1 1 100%;
            }

            .filter .primary-action {
                flex: 1;
            }

            .pg-numbers {
                display: none;
            }

            .pg-status {
                display: block;
            }

            .pg-text {
                display: none;
            }

            .pg-link.pg-step {
                min-width: 48px;
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
                        <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                    </li>
                </ul>

                <ul class="nav-group">
                    <li>
                        <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('tags.index') }}">Tag</a>
                    </li>
                </ul>

                <ul class="nav-group">
                    <li>
                        <a class="nav-link" href="{{ route('comments.index') }}">Komentar</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('reports.articles') }}">Laporan</a>
                    </li>
                    <li>
                        <a class="nav-link is-active" href="{{ route('admin.users.index') }}" aria-current="page">Pengguna</a>
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
                            <li>Pengguna</li>
                        </ol>
                        <h1 class="page-title">Pengelolaan Pengguna</h1>
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
                <div class="intro">
                    <p>Kelola akun penulis dan pembaca. Akun admin dilindungi dan tidak dapat diubah atau dihapus dari halaman ini.</p>
                </div>

                @if (session('success'))
                    <p class="notice" role="status">{{ session('success') }}</p>
                @endif

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

                <form class="filter" action="{{ route('admin.users.index') }}" method="GET" role="search">
                    <label class="sr-only" for="search">Cari nama atau username</label>
                    <input
                        id="search"
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama atau username"
                    >

                    <label class="sr-only" for="role">Filter peran</label>
                    <select id="role" name="role">
                        <option value="" {{ $role === '' ? 'selected' : '' }}>Semua peran</option>
                        <option value="penulis" {{ $role === 'penulis' ? 'selected' : '' }}>Penulis</option>
                        <option value="pengguna" {{ $role === 'pengguna' ? 'selected' : '' }}>Pembaca</option>
                    </select>

                    <button class="primary-action" type="submit">Cari</button>

                    @if ($search !== '' || $role !== '')
                        <a class="reset-link" href="{{ route('admin.users.index') }}">Reset</a>
                    @endif
                </form>

                <div class="list-head">
                    <h2 class="list-title">Pengguna</h2>
                    <span class="list-count">Total hasil: {{ $users->total() }}</span>
                </div>

                <table class="users-table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Terdaftar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="cell-name" data-label="Nama">{{ $user->name }}</td>
                                <td class="cell-muted" data-label="Username">{{ $user->username }}</td>
                                <td data-label="Peran">
                                    <span class="badge badge-{{ $user->role }}">{{ $user->role === 'pengguna' ? 'Pembaca' : ucfirst($user->role) }}</span>
                                </td>
                                <td class="cell-date" data-label="Terdaftar">{{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}</td>
                                <td data-label="Aksi">
                                    @if ($user->role !== 'admin')
                                        <div class="row-actions">
                                            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>

                                            <form
                                                action="{{ route('admin.users.destroy', $user->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="protected">Akun admin dilindungi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty-cell" colspan="5">
                                    <div class="empty">
                                        @if ($search !== '' || $role !== '')
                                            <strong>Pengguna tidak ditemukan</strong>
                                            <p>Tidak ada pengguna yang cocok dengan pencarian atau filter Anda.</p>
                                            <a class="reset-link" href="{{ route('admin.users.index') }}">Reset pencarian</a>
                                        @else
                                            <strong>Belum ada pengguna</strong>
                                            <p>Akun yang terdaftar akan tampil di sini.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($users->hasPages())
                    @php
                        $current = $users->currentPage();
                        $last = $users->lastPage();
                        $pages = collect([1, $last, $current - 1, $current, $current + 1])
                            ->filter(fn ($page) => $page >= 1 && $page <= $last)
                            ->unique()
                            ->sort()
                            ->values();
                    @endphp

                    <nav class="pagination" aria-label="Navigasi halaman">
                        @if ($users->onFirstPage())
                            <span class="pg-link pg-step is-disabled" aria-disabled="true" aria-label="Halaman sebelumnya">
                                <span aria-hidden="true">←</span><span class="pg-text">Sebelumnya</span>
                            </span>
                        @else
                            <a class="pg-link pg-step" href="{{ $users->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">
                                <span aria-hidden="true">←</span><span class="pg-text">Sebelumnya</span>
                            </a>
                        @endif

                        <ul class="pg-numbers">
                            @foreach ($pages as $page)
                                @if (! $loop->first && $page - $pages[$loop->index - 1] > 1)
                                    <li class="pg-gap" aria-hidden="true">…</li>
                                @endif
                                <li>
                                    @if ($page === $current)
                                        <span class="pg-link is-current" aria-current="page">{{ $page }}</span>
                                    @else
                                        <a class="pg-link" href="{{ $users->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <span class="pg-status">Halaman {{ $current }} dari {{ $last }}</span>

                        @if ($users->hasMorePages())
                            <a class="pg-link pg-step" href="{{ $users->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">
                                <span class="pg-text">Berikutnya</span><span aria-hidden="true">→</span>
                            </a>
                        @else
                            <span class="pg-link pg-step is-disabled" aria-disabled="true" aria-label="Halaman berikutnya">
                                <span class="pg-text">Berikutnya</span><span aria-hidden="true">→</span>
                            </span>
                        @endif
                    </nav>
                @endif
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