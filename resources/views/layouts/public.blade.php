
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'RuangKabar, portal berita dan informasi terkini.')">

    <title>@yield('title', 'RuangKabar') - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --emerald: #183C36;
            --forest: #376B5C;
            --gold: #B99A64;
            --sand: #E7E0D2;
            --ivory: #FAF8F3;
            --white: #FFFFFF;
            --text: #26332F;
            --text-soft: #68736E;
            --on-dark: rgba(250, 248, 243, 0.82);
            --rule: rgba(24, 60, 54, 0.14);
            --danger: #A3392C;

            --sans: 'Plus Jakarta Sans', Arial, sans-serif;
            --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
            --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;

            --wrap: 1240px;
            --pad: 32px;
            --r-md: 16px;
            --r-lg: 28px;
            --ease: cubic-bezier(0.22, 1, 0.36, 1);
            --t-fast: 200ms;
            --t-ui: 300ms;
            --t-enter: 560ms;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: var(--sans);
            color: var(--text);
            background: var(--ivory);
            overflow-x: clip;
            overflow-wrap: break-word;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
        }

        a {
            color: inherit;
        }

        a:focus-visible,
        button:focus-visible,
        input:focus-visible {
            outline: 2px solid var(--gold);
            outline-offset: 3px;
        }

        .wrap {
            max-width: var(--wrap);
            margin: 0 auto;
            padding: 0 var(--pad);
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

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 48px;
            padding: 0 26px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--white);
            background: var(--forest);
            border: 1px solid transparent;
            border-radius: 999px;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: background var(--t-fast) ease-out, transform 120ms ease-out;
        }

        .btn:hover {
            background: var(--emerald);
        }

        .btn:active {
            transform: scale(0.97);
        }

        .btn--gold {
            color: var(--emerald);
            background: var(--gold);
        }

        .btn--gold:hover {
            color: var(--emerald);
            background: #CBAF7C;
        }

        .btn--ghost {
            color: var(--emerald);
            background: var(--white);
            border-color: var(--rule);
        }

        .btn--ghost:hover {
            color: var(--white);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        .btn--danger {
            color: var(--white);
            background: var(--danger);
        }

        .btn--danger:hover {
            background: #812D24;
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 1023px) {
            :root {
                --pad: 24px;
                --r-lg: 24px;
            }
        }

        @media (max-width: 719px) {
            :root {
                --pad: 16px;
                --r-lg: 22px;
            }
        }

        /* Unified RuangKabar Pagination */
        .pager {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 12px 10px;
            margin-top: 56px;
        }

        .pager-pages {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pager-btn,
        .pager-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--emerald);
            text-decoration: none;
            background: var(--white);
            border: 1px solid var(--rule);
            border-radius: 999px;
            transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
        }

        .pager-btn {
            padding: 0 20px;
        }

        .pager-num {
            min-width: 44px;
            padding: 0 8px;
        }

        a.pager-btn:hover,
        a.pager-num:hover {
            color: var(--white);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        .pager-num.is-current {
            color: var(--ivory);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        .pager-btn.is-disabled {
            color: var(--text-soft);
            background: transparent;
            opacity: 0.6;
            cursor: default;
        }

        .pager-gap {
            padding: 0 4px;
            color: var(--text-soft);
        }

        .pager-status {
            display: none;
            font-family: var(--body);
            font-size: 14px;
            color: var(--text-soft);
        }

        @media (max-width: 640px) {
            .pager {
                margin-top: 28px;
            }

            .pager-pages {
                display: none;
            }

            .pager-status {
                display: block;
                order: -1;
                width: 100%;
                text-align: center;
            }

            .pager-btn {
                flex: 1 1 0;
                padding: 0 10px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <a href="#konten" class="sr-only">Lewati ke konten utama</a>

    @include('components.navbar-public')

    <main id="konten">
        @yield('content')
    </main>

    @stack('scripts')

</body>
</html>
