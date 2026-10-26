<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Artikel - RuangKabar</title>

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

        .report-head {
            max-width: 1040px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px 24px;
            margin: 0 0 32px;
        }

        .report-intro {
            max-width: 560px;
        }

        .report-intro p {
            margin: 0 0 6px;
            font-size: 15px;
            line-height: 1.7;
            color: var(--muted);
        }

        .report-period {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .primary-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            padding: 0 22px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--bg);
            background: var(--ink);
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            transition: background .2s;
        }

        .primary-action:hover {
            background: var(--accent-strong);
        }

        .primary-action:active {
            transform: translateY(1px);
        }

        .print-head {
            display: none;
        }

        .summary {
            max-width: 1040px;
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) repeat(3, minmax(0, 1fr));
            border-top: 2px solid var(--ink);
            border-bottom: 1px solid var(--line);
            margin-bottom: 48px;
        }

        .sum {
            padding: 20px 24px;
            border-left: 1px solid var(--line);
        }

        .sum:first-child {
            padding-left: 0;
            border-left: 0;
        }

        .sum-label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .sum-lead .sum-label {
            color: var(--accent-strong);
        }

        .sum-value {
            display: block;
            font-family: var(--serif);
            font-size: clamp(28px, 3.2vw, 40px);
            line-height: 1.1;
            font-weight: 700;
            white-space: nowrap;
        }

        .sum-lead .sum-value {
            font-size: clamp(40px, 5vw, 56px);
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

        .report-table {
            width: 100%;
            max-width: 1040px;
            border-collapse: collapse;
        }

        .report-table th {
            padding: 14px 16px 14px 0;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-align: left;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--ink);
        }

        .report-table td {
            padding: 16px 16px 16px 0;
            font-size: 14px;
            line-height: 1.5;
            vertical-align: top;
            border-bottom: 1px solid var(--line);
            overflow-wrap: anywhere;
        }

        .report-table th:last-child,
        .report-table td:last-child {
            padding-right: 0;
        }

        .col-title {
            width: 36%;
        }

        .cell-title {
            font-family: var(--serif);
            font-size: 16px;
            font-weight: 600;
        }

        .cell-title a {
            color: var(--ink);
            text-decoration: none;
            transition: color .2s;
        }

        .cell-title a:hover {
            color: var(--accent-strong);
            text-decoration: underline;
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

        .badge-published {
            color: var(--bg);
            background: var(--ink);
            border: 1px solid var(--ink);
        }

        .badge-draft {
            color: var(--muted);
            background: transparent;
            border: 1px dashed var(--muted);
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
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
            color: var(--muted);
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

        @media (max-width: 1099px) {
            .summary {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .sum-lead {
                grid-column: 1 / -1;
                padding: 20px 0;
                border-bottom: 1px solid var(--line);
            }

            .sum:nth-child(2) {
                padding-left: 0;
                border-left: 0;
            }
        }

        @media (max-width: 767px) {
            .report-table,
            .report-table tbody,
            .report-table tr,
            .report-table td {
                display: block;
                width: 100%;
            }

            .report-table thead {
                position: absolute;
                width: 1px;
                height: 1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
            }

            .report-table tr {
                padding: 16px 0;
                border-bottom: 1px solid var(--line);
            }

            .report-table td {
                display: flex;
                align-items: baseline;
                gap: 12px;
                padding: 4px 0;
                border-bottom: 0;
            }

            .report-table td::before {
                content: attr(data-label);
                flex: 0 0 76px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--muted);
            }

            .report-table td.cell-title {
                display: block;
                padding-bottom: 6px;
            }

            .report-table td.cell-title::before {
                display: block;
                margin-bottom: 2px;
            }

            .col-title {
                width: 100%;
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

            .primary-action {
                width: 100%;
            }

            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sum {
                padding: 16px;
            }

            .sum:nth-child(2) {
                padding-left: 0;
                border-left: 0;
            }

            .sum:nth-child(3) {
                padding-left: 16px;
                border-left: 1px solid var(--line);
            }

            .sum:nth-child(4) {
                grid-column: 1 / -1;
                padding: 16px 0;
                border-left: 0;
                border-top: 1px solid var(--line);
            }

            .sum-value {
                font-size: 30px;
            }

            .sum-lead .sum-value {
                font-size: 44px;
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

        @media print {
            @page {
                margin: 16mm;
            }

            html,
            body {
                background: #FFFFFF;
                color: #000000;
            }

            .sidebar,
            .scrim,
            .topbar,
            .no-print {
                display: none !important;
            }

            .admin {
                display: block;
                min-height: 0;
            }

            .content {
                padding: 0;
            }

            .print-head {
                display: block;
                margin: 0 0 20px;
                padding-bottom: 12px;
                border-bottom: 2px solid #000000;
            }

            .print-head strong {
                display: block;
                font-family: var(--serif);
                font-size: 20px;
            }

            .print-head span {
                font-size: 11px;
            }

            .report-head {
                margin-bottom: 16px;
            }

            .summary {
                margin-bottom: 24px;
                break-inside: avoid;
            }

            .sum-value {
                font-size: 22px;
            }

            .sum-lead .sum-value {
                font-size: 28px;
            }

            .report-table th,
            .report-table td {
                font-size: 11px;
            }

            .report-table thead {
                display: table-header-group;
            }

            .report-table tr {
                break-inside: avoid;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .badge {
                border-color: #000000;
                color: #000000;
                background: transparent;
            }
        }
    </style>
</head>
<body>

    @php
        $totalArticles = $articles->count();
        $publishedArticles = $articles->where('status', 'published')->count();
        $draftArticles = $articles->where('status', 'draft')->count();
        $totalAuthors = $articles->pluck('user_id')->unique()->count();
    @endphp

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
                        <a class="nav-link is-active" href="{{ route('reports.articles') }}" aria-current="page">Laporan</a>
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
                            <li>Laporan</li>
                        </ol>
                        <h1 class="page-title">Laporan Artikel</h1>
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
                <div class="print-head">
                    <strong>RuangKabar — Laporan Artikel</strong>
                    <span>Dicetak pada {{ now()->format('d M Y, H:i') }}</span>
                </div>

                <div class="report-head">
                    <div class="report-intro">
                        <p>Rekap seluruh artikel yang tersimpan, lengkap dengan penulis, kategori, dan status.</p>
                        <span class="report-period">
                            @if ($totalArticles)
                                Periode: {{ $articles->last()->created_at->format('d M Y') }} – {{ $articles->first()->created_at->format('d M Y') }}
                            @else
                                Periode: belum ada data
                            @endif
                        </span>
                    </div>

                    <button class="primary-action no-print" type="button" onclick="window.print()">Cetak Laporan</button>
                </div>

                <div class="summary">
                    <div class="sum sum-lead">
                        <span class="sum-label">Total Artikel</span>
                        <span class="sum-value">{{ number_format($totalArticles, 0, ',', '.') }}</span>
                    </div>

                    <div class="sum">
                        <span class="sum-label">Terbit</span>
                        <span class="sum-value">{{ number_format($publishedArticles, 0, ',', '.') }}</span>
                    </div>

                    <div class="sum">
                        <span class="sum-label">Draft</span>
                        <span class="sum-value">{{ number_format($draftArticles, 0, ',', '.') }}</span>
                    </div>

                    <div class="sum">
                        <span class="sum-label">Penulis</span>
                        <span class="sum-value">{{ number_format($totalAuthors, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="list-head">
                    <h2 class="list-title">Daftar Artikel</h2>
                    <span class="list-count">{{ $totalArticles }} artikel</span>
                </div>

                @if ($totalArticles)
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th class="col-title" scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td class="cell-title" data-label="Judul">
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </td>
                                    <td data-label="Penulis">{{ $article->user->name ?? '-' }}</td>
                                    <td data-label="Kategori">{{ $article->category->name ?? '-' }}</td>
                                    <td data-label="Status">
                                        <span class="badge badge-{{ $article->status }}">{{ $article->status }}</span>
                                    </td>
                                    <td class="cell-date" data-label="Tanggal">{{ $article->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty">
                        <strong>Belum ada data laporan</strong>
                        <p>Laporan akan terisi setelah ada artikel yang tersimpan.</p>
                    </div>
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