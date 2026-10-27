<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RuangKabar, portal berita dan informasi terkini.">

    <title>RuangKabar - Portal Berita</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

    <script>document.documentElement.classList.add('js');</script>

    <style>
        :root {
            --emerald: #183C36;
            --forest: #376B5C;
            --gold: #B99A64;
            --sand: #E7E0D2;
            --ivory: #FAF8F3;
            --white: #FFFFFF;
            --text-soft: #4F615C;
            --on-dark: rgba(250, 248, 243, 0.82);
            --rule: rgba(24, 60, 54, 0.14);

            --sans: 'Plus Jakarta Sans', Arial, sans-serif;
            --serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
            --body: 'Inter', 'Plus Jakarta Sans', Arial, sans-serif;

            --wrap: 1240px;
            --pad: 32px;
            --r-sm: 12px;
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
            background: var(--ivory);
            color: var(--emerald);
            overflow-x: clip; /* clip (bukan hidden) agar header sticky tetap berfungsi */
            overflow-wrap: break-word;
            -webkit-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
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

        .skip-link {
            position: absolute;
            left: 16px;
            top: -64px;
            z-index: 100;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 600;
            color: var(--emerald);
            background: var(--gold);
            border-radius: 8px;
            text-decoration: none;
            transition: top var(--t-fast) var(--ease);
        }

        .skip-link:focus {
            top: 12px;
        }

        .wrap {
            max-width: var(--wrap);
            margin: 0 auto;
            padding: 0 var(--pad);
        }

        /* ---------- Header: bar melayang di atas hero ---------- */
        .site-header {
            position: sticky;
            top: -10px;
            z-index: 50;
            height: 0;
        }

        .bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0 24px;
            min-height: 64px;
            margin-top: 26px;
            padding: 0 12px 0 24px;
            background: var(--emerald);
            border: 1px solid rgba(250, 248, 243, 0.1);
            border-radius: 20px;
            box-shadow: 0 10px 30px -14px rgba(24, 60, 54, 0.5);
            transition: box-shadow var(--t-ui) ease-out;
        }

        .site-header.is-scrolled .bar {
            box-shadow: 0 14px 36px -10px rgba(24, 60, 54, 0.6);
        }

        .brand {
            display: inline-block;
            padding: 8px 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--ivory);
            text-decoration: none;
        }

        .brand span {
            color: var(--gold);
        }

        .nav {
            display: flex;
            flex: 1;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            height: 40px;
            padding: 0 16px;
            font-size: 14px;
            font-weight: 600;
            color: var(--on-dark);
            text-decoration: none;
            border-radius: 12px;
            transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
        }

        .nav-links a:hover {
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.08);
        }

        .nav-links a.is-current {
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.14);
            box-shadow: inset 0 -2px 0 var(--gold);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px 14px;
        }

        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.1);
            border-radius: 50%;
            transition: background var(--t-fast) ease-out;
        }

        .icon-btn:hover {
            background: rgba(250, 248, 243, 0.2);
        }

        .icon-btn svg {
            width: 18px;
            height: 18px;
        }

        .actions-user {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 13px;
            font-weight: 600;
            color: var(--ivory);
        }

        .actions a.link,
        .actions .link-btn {
            padding: 10px 2px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--on-dark);
            text-decoration: none;
            background: none;
            border: 0;
            cursor: pointer;
            transition: color var(--t-fast) ease-out;
        }

        .actions a.link:hover,
        .actions .link-btn:hover {
            color: var(--ivory);
        }

        .actions-form {
            display: contents;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 46px;
            padding: 0 24px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--white);
            background: var(--forest);
            border: 0;
            border-radius: 999px;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--t-fast) ease-out, transform 120ms ease-out;
        }

        .btn:hover {
            background: var(--emerald);
        }

        .btn:active {
            transform: scale(0.97);
        }

        .btn--ivory {
            height: 40px;
            padding: 0 20px;
            color: var(--emerald);
            background: var(--ivory);
        }

        .btn--ivory:hover {
            background: var(--sand);
        }

        .btn--gold {
            height: 50px;
            padding: 0 28px;
            color: var(--emerald);
            background: var(--gold);
        }

        .btn--gold:hover {
            background: #CBAF7C;
        }

        .btn svg {
            width: 16px;
            height: 16px;
            transition: transform var(--t-ui) var(--ease);
        }

        .btn:hover svg {
            transform: translateX(3px);
        }

        .link-quiet {
            padding: 12px 4px;
            font-size: 14px;
            font-weight: 700;
            color: var(--forest);
            text-decoration: none;
        }

        .link-quiet:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* ---------- Shared ---------- */
        .cat {
            display: inline-block;
            margin-bottom: 10px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--forest);
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2px 14px;
            font-family: var(--body);
            font-size: 13px;
            color: var(--text-soft);
        }

        .media {
            display: block;
            overflow: hidden;
            text-decoration: none;
            background: var(--sand);
            border-radius: var(--r-md);
        }

        .media img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 600ms var(--ease);
        }

        .ph {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: rgba(24, 60, 54, 0.22);
        }

        .title {
            margin: 0;
            font-family: var(--sans);
            font-weight: 700;
            line-height: 1.28;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
        }

        .title a {
            color: var(--emerald);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .section-title {
            margin: 0;
            font-family: var(--serif);
            font-size: 34px;
            font-weight: 600;
            line-height: 1.15;
            letter-spacing: -0.01em;
        }

        .section-title::after {
            content: "";
            display: block;
            width: 48px;
            height: 3px;
            margin-top: 14px;
            background: var(--gold);
            border-radius: 2px;
        }

        @media (hover: hover) {
            .lead-media:hover img,
            .card:hover .media img,
            .row:hover .media img {
                transform: scale(1.03);
            }

            .card:hover .title a,
            .row:hover .title a {
                color: var(--forest);
            }

            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4);
            }
        }

        /* ---------- Hero: foto penuh, teks di atas foto ---------- */
        .hero {
            position: relative;
            display: flex;
            align-items: flex-end;
            min-height: clamp(560px, 82vh, 760px);
            margin: 8px 12px 0;
            overflow: hidden;
            color: var(--ivory);
            background: var(--forest);
            border-radius: var(--r-lg);
        }

        .hero-bg {
            position: absolute;
            inset: 0;
        }

        .hero-bg img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-bg .ph {
            font-size: 72px;
            color: rgba(250, 248, 243, 0.2);
        }

        /* Scrim hanya untuk keterbacaan teks, bukan menutup seluruh foto */
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(24, 60, 54, 0.86) 0%, rgba(24, 60, 54, 0.55) 42%, rgba(24, 60, 54, 0) 78%),
                linear-gradient(0deg, rgba(24, 60, 54, 0.5) 0%, rgba(24, 60, 54, 0) 38%);
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            width: 100%;
            padding-top: 150px;
            padding-bottom: 128px;
        }

        .hero-copy {
            max-width: 620px;
            animation: rise var(--t-enter) var(--ease) both;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding: 8px 16px 8px 12px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.14);
            border: 1px solid rgba(250, 248, 243, 0.25);
            border-radius: 999px;
        }

        .hero-label::before {
            content: "";
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
        }

        .hero-title {
            margin: 0 0 18px;
            font-family: var(--serif);
            font-size: clamp(34px, 4.6vw, 62px);
            font-weight: 600;
            line-height: 1.1;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
        }

        .hero-title a {
            color: var(--white);
            text-decoration: none;
        }

        .hero-excerpt {
            margin: 0 0 22px;
            font-family: var(--body);
            font-size: 17px;
            line-height: 1.7;
            color: var(--on-dark);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px 16px;
            margin-bottom: 28px;
            font-family: var(--body);
            font-size: 13px;
            color: var(--on-dark);
        }

        .hero-meta .hero-cat {
            padding: 4px 12px;
            font-family: var(--sans);
            font-weight: 600;
            color: var(--ivory);
            border: 1px solid rgba(250, 248, 243, 0.4);
            border-radius: 999px;
        }

        /* ---------- Panel pencarian melayang ---------- */
        .panel-wrap {
            position: relative;
            z-index: 3;
            margin-top: -52px;
        }

        .panel {
            display: flex;
            align-items: center;
            gap: 16px 28px;
            padding: 10px;
            background: var(--sand);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 999px;
            box-shadow: 0 20px 40px -20px rgba(24, 60, 54, 0.45);
            animation: rise var(--t-enter) var(--ease) 200ms both;
        }

        .search {
            display: flex;
            flex: 1 1 52%;
            align-items: center;
            gap: 10px;
            min-width: 0;
            height: 56px;
            padding: 0 6px 0 20px;
            background: var(--white);
            border-radius: 999px;
            transition: box-shadow var(--t-fast) ease-out;
        }

        .search:focus-within {
            box-shadow: 0 0 0 2px var(--forest);
        }

        .search > svg {
            flex: none;
            width: 18px;
            height: 18px;
            color: var(--forest);
        }

        .search input {
            flex: 1;
            min-width: 0;
            height: 52px;
            padding: 0;
            font-family: var(--body);
            font-size: 15px;
            color: var(--emerald);
            background: transparent;
            border: 0;
        }

        .search input:focus {
            outline: none;
        }

        .search input::placeholder {
            color: var(--text-soft);
        }

        .search .btn {
            height: 44px;
        }

        .cats {
            display: flex;
            flex: 1 1 48%;
            align-items: center;
            gap: 16px;
            min-width: 0;
            padding-right: 20px;
        }

        .cats-label {
            flex: none;
            margin: 0;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--text-soft);
        }

        .cats-list {
            display: flex;
            min-width: 0;
            margin: 0;
            padding: 0;
            overflow-x: auto;
            list-style: none;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            scrollbar-width: none;
        }

        .cats-list::-webkit-scrollbar {
            display: none;
        }

        .cats-list li + li::before {
            content: "";
            display: inline-block;
            width: 1px;
            height: 14px;
            margin: 0 14px;
            vertical-align: -2px;
            background: rgba(24, 60, 54, 0.25);
        }

        /* ---------- Blok berita pilihan (gambar + badge bulat) ---------- */
        .lead {
            padding: 96px 0 88px;
        }

        .lead-grid {
            display: grid;
            grid-template-columns: minmax(0, 6fr) minmax(0, 5fr);
            gap: 72px;
            align-items: center;
        }

        .lead-visual {
            position: relative;
        }

        .lead-media {
            aspect-ratio: 4 / 3.1;
            border-radius: var(--r-lg);
        }

        .lead-badge {
            position: absolute;
            top: -22px;
            left: -22px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            width: 100px;
            height: 100px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
            text-align: center;
            color: var(--ivory);
            background: var(--emerald);
            border: 4px solid var(--ivory);
            border-radius: 50%;
        }

        .lead-badge svg {
            width: 20px;
            height: 20px;
            color: var(--gold);
        }

        .lead-go {
            position: absolute;
            right: -14px;
            bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            color: var(--emerald);
            background: var(--gold);
            border: 4px solid var(--ivory);
            border-radius: 50%;
            transition: transform var(--t-ui) var(--ease), background var(--t-fast) ease-out;
        }

        .lead-go:hover {
            background: #CBAF7C;
            transform: scale(1.08);
        }

        .lead-go svg {
            width: 20px;
            height: 20px;
        }

        .lead-title {
            margin: 0 0 18px;
            font-family: var(--serif);
            font-size: clamp(28px, 3.1vw, 42px);
            font-weight: 600;
            line-height: 1.16;
            letter-spacing: -0.01em;
            overflow-wrap: anywhere;
        }

        .lead-title a {
            color: var(--emerald);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .lead-title a:hover {
            color: var(--forest);
        }

        .lead-excerpt {
            margin: 0 0 20px;
            font-family: var(--body);
            font-size: 16px;
            line-height: 1.75;
            color: var(--text-soft);
        }

        .lead .meta {
            margin-bottom: 28px;
        }

        .lead-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 20px;
        }

        /* ---------- Kartu berita (latar sand) ---------- */
        .cards-sec {
            padding: 80px 0 96px;
            background: var(--sand);
            border-radius: var(--r-lg);
            margin: 0 12px;
        }

        .cards-head {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 44px;
            text-align: center;
        }

        .cards-head .section-title::after {
            margin-left: auto;
            margin-right: auto;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
            margin: 0 auto;
        }

        .cards--1 {
            grid-template-columns: minmax(0, 1fr);
            max-width: 420px;
        }

        .cards--2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 880px;
        }

        .card {
            display: flex;
            flex-direction: column;
            padding: 12px;
            background: var(--white);
            border: 1px solid rgba(24, 60, 54, 0.06);
            border-radius: 22px;
            transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
        }

        .card .media {
            aspect-ratio: 4 / 3;
            border-radius: var(--r-md);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px 10px 12px;
        }

        .card .title {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card-excerpt {
            margin: 0 0 16px;
            font-family: var(--body);
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--text-soft);
        }

        .card .meta {
            margin-top: auto;
        }

        /* ---------- Berita lainnya (daftar) ---------- */
        .more {
            padding: 80px 0 96px;
        }

        .more-grid {
            display: grid;
            grid-template-columns: minmax(0, 4fr) minmax(0, 8fr);
            gap: 48px;
            align-items: start;
        }

        .more-intro {
            position: sticky;
            top: 120px;
        }

        .more-intro p {
            max-width: 300px;
            margin: 20px 0 24px;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-soft);
        }

        .rows {
            border-top: 1px solid var(--rule);
        }

        .row {
            display: grid;
            grid-template-columns: 220px minmax(0, 1fr);
            gap: 28px;
            align-items: center;
            padding: 28px 0;
            border-bottom: 1px solid var(--rule);
        }

        .row .media {
            aspect-ratio: 4 / 3;
        }

        .row .title {
            margin-bottom: 10px;
            font-size: 22px;
        }

        .row-excerpt {
            margin: 0 0 12px;
            font-family: var(--body);
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--text-soft);
        }

        /* ---------- Motion ---------- */
        @keyframes rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        .js .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity var(--t-enter) var(--ease), transform var(--t-enter) var(--ease);
        }

        .js .reveal.is-visible {
            opacity: 1;
            transform: none;
        }

        .js .card.reveal.is-visible {
            transition: opacity var(--t-enter) var(--ease), transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
        }

        /* ---------- Empty ---------- */
        .empty {
            margin: 160px 0 80px;
            padding: 72px 32px;
            text-align: center;
            background: var(--sand);
            border-radius: var(--r-lg);
        }

        .empty strong {
            display: block;
            margin-bottom: 8px;
            font-family: var(--serif);
            font-size: 28px;
            font-weight: 600;
        }

        .empty p {
            max-width: 440px;
            margin: 0 auto;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-soft);
        }

        /* ---------- Footer ---------- */
        .footer {
            color: var(--on-dark);
            background: var(--emerald);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 4fr);
            gap: 32px 48px;
            padding-top: 56px;
            padding-bottom: 44px;
        }

        .footer-about {
            max-width: 300px;
            margin: 10px 0 0;
            font-family: var(--body);
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-title {
            margin: 0 0 12px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--gold);
        }

        .footer-links {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-links a {
            display: inline-block;
            padding: 6px 0;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 500;
            color: var(--on-dark);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .footer-links a:hover {
            color: var(--ivory);
        }

        .footer-bottom {
            padding: 20px 0 28px;
            border-top: 1px solid rgba(250, 248, 243, 0.12);
            font-family: var(--sans);
            font-size: 13px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 1023px) {
            :root {
                --pad: 24px;
                --r-lg: 24px;
            }

            .hero {
                min-height: 600px;
            }

            .hero-inner {
                padding-top: 130px;
                padding-bottom: 116px;
            }

            .hero::after {
                background:
                    linear-gradient(0deg, rgba(24, 60, 54, 0.9) 0%, rgba(24, 60, 54, 0.6) 50%, rgba(24, 60, 54, 0.1) 100%);
            }

            .panel {
                flex-wrap: wrap;
                padding: 12px;
                border-radius: 28px;
            }

            .search,
            .cats {
                flex: 1 1 100%;
            }

            .cats {
                padding: 0 8px 4px;
            }

            .lead {
                padding: 72px 0 64px;
            }

            .lead-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 40px;
            }

            .lead-badge {
                top: 14px;
                left: 14px;
            }

            .lead-go {
                right: 14px;
                bottom: 14px;
            }

            .cards-sec {
                padding: 64px 0 72px;
            }

            .cards,
            .cards--2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .more {
                padding: 56px 0 64px;
            }

            .more-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 28px;
            }

            .more-intro {
                position: static;
            }

            .footer-grid {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 719px) {
            :root {
                --pad: 20px;
                --r-lg: 22px;
            }

            .bar {
                padding: 4px 8px 4px 18px;
                gap: 0 12px;
            }

            .brand {
                font-size: 22px;
            }

            .actions {
                margin-left: auto;
            }

            .actions-user {
                display: none;
            }

            .nav {
                order: 3;
                flex-basis: 100%;
                justify-content: flex-start;
                padding-bottom: 8px;
            }

            .nav-links a {
                height: 36px;
                padding: 0 12px;
            }

            .hero {
                min-height: 580px;
                margin: 6px 8px 0;
            }

            .hero-inner {
                padding-top: 150px;
                padding-bottom: 100px;
            }

            .hero-excerpt {
                font-size: 16px;
            }

            .hero-excerpt,
            .hero-meta {
                margin-bottom: 20px;
            }

            .panel-wrap {
                margin-top: -44px;
            }

            .section-title {
                font-size: 28px;
            }

            .cards-sec {
                margin: 0 8px;
                padding: 52px 0 56px;
            }

            .cards,
            .cards--2,
            .cards--1 {
                grid-template-columns: minmax(0, 1fr);
                max-width: none;
            }

            .lead-badge {
                width: 84px;
                height: 84px;
                font-size: 11px;
            }

            .row {
                grid-template-columns: 112px minmax(0, 1fr);
                gap: 16px;
                align-items: start;
                padding: 20px 0;
            }

            .row .title {
                font-size: 17px;
            }

            .row-excerpt {
                display: none;
            }

            .footer-grid {
                grid-template-columns: minmax(0, 1fr);
                padding-top: 40px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            .js .reveal {
                opacity: 1;
                transform: none;
            }

            .card:hover,
            .lead-go:hover,
            .lead-media:hover img,
            .card:hover .media img,
            .row:hover .media img {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <header class="site-header" id="site-header">
        <div class="wrap">
            <div class="bar">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>

                <nav class="nav" aria-label="Menu utama">
                    <ul class="nav-links">
                        <li><a class="is-current" href="/" aria-current="page">Beranda</a></li>
                        <li><a href="{{ route('articles.index') }}">Berita</a></li>
                    </ul>
                </nav>

                <div class="actions">
                    <a class="icon-btn search-toggle" href="{{ route('articles.index') }}" aria-label="Cari berita">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                    </a>

                    @auth
                        <span class="actions-user">{{ auth()->user()->name }}</span>

                        @if (auth()->user()->role === 'admin')
                            <a class="link" href="/admin/dashboard">Dashboard</a>
                        @elseif (auth()->user()->role === 'penulis')
                            <a class="link" href="/penulis/dashboard">Dashboard</a>
                        @else
                            <a class="link" href="/beranda">Akun Saya</a>
                        @endif

                        <form class="actions-form" action="/logout" method="POST">
                            @csrf
                            <button class="link-btn" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="link" href="{{ route('login') }}">Login</a>
                        <a class="btn btn--ivory" href="{{ route('register') }}">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main id="konten">
        @if ($articles->count())
            @php
                $featured = $articles->first();
                $lead = $articles->get(1);
                $cards = $articles->slice(2, 3)->values();
                $more = $articles->slice(5)->values();
                $categories = \App\Models\Category::orderBy('name')->get();
            @endphp

            {{-- Hero --}}
            <section class="hero" aria-label="Berita utama">
                <div class="hero-bg">
                    @if ($featured->image)
                        <img src="{{ asset('storage/' . $featured->image) }}" alt="">
                    @else
                        <div class="ph">RK</div>
                    @endif
                </div>

                <div class="wrap hero-inner">
                    <div class="hero-copy">
                        <span class="hero-label">BERITA TERBARU</span>

                        <h1 class="hero-title">
                            <a href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a>
                        </h1>

                        <p class="hero-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 200) }}</p>

                        <div class="hero-meta">
                            <span class="hero-cat">{{ $featured->category->name }}</span>
                            <span>Oleh {{ $featured->user->name }}</span>
                            @if ($featured->created_at)
                                <time datetime="{{ $featured->created_at->toDateString() }}">{{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                            @endif
                        </div>

                        <a class="btn btn--gold" href="{{ route('articles.show', $featured) }}">
                            Baca Selengkapnya
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                        </a>
                    </div>
                </div>
            </section>

            {{-- Panel pencarian & kategori --}}
            <div class="wrap panel-wrap">
                <div class="panel" id="cari">
                    <form class="search" action="{{ route('articles.index') }}" method="GET" role="search">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                        <label class="sr-only" for="q">Cari berita</label>
                        <input id="q" type="search" name="search" placeholder="Cari berita">
                        <button class="btn" type="submit">Cari</button>
                    </form>

                    @if ($categories->count())
                        <div class="cats">
                            <p class="cats-label" id="cats-title">Kategori</p>
                            <ul class="cats-list" aria-labelledby="cats-title">
                                @foreach ($categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Berita pilihan --}}
            @if ($lead)
                <section class="lead" aria-labelledby="lead-title">
                    <div class="wrap lead-grid">
                        <div class="lead-visual reveal">
                            <a class="media lead-media" href="{{ route('articles.show', $lead) }}" tabindex="-1" aria-hidden="true">
                                @if ($lead->image)
                                    <img src="{{ asset('storage/' . $lead->image) }}" alt="" loading="lazy">
                                @else
                                    <div class="ph">RK</div>
                                @endif
                            </a>

                            <span class="lead-badge" aria-hidden="true">
                                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.5 5.3 5.8.7-4.3 4 1.1 5.7L10 14.3 4.9 17.2 6 11.5l-4.3-4 5.8-.7L10 1.5z"/></svg>
                                <span>Berita<br>Pilihan</span>
                            </span>

                            <a class="lead-go" href="{{ route('articles.show', $lead) }}" aria-label="Baca: {{ $lead->title }}">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12L12 4M6 4h6v6"/></svg>
                            </a>
                        </div>

                        <div class="lead-copy reveal">
                            <span class="cat">{{ $lead->category->name }}</span>

                            <h2 class="lead-title" id="lead-title">
                                <a href="{{ route('articles.show', $lead) }}">{{ $lead->title }}</a>
                            </h2>

                            <p class="lead-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($lead->content), 190) }}</p>

                            <div class="meta">
                                <span>Oleh {{ $lead->user->name }}</span>
                                @if ($lead->created_at)
                                    <time datetime="{{ $lead->created_at->toDateString() }}">{{ $lead->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                            </div>

                            <div class="lead-actions">
                                <a class="btn" href="{{ route('articles.show', $lead) }}">
                                    Baca Selengkapnya
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                                </a>
                                <a class="link-quiet" href="{{ route('articles.index') }}">Lihat semua berita</a>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            {{-- Kartu berita --}}
            @if ($cards->count())
                <section class="cards-sec" aria-labelledby="cards-title">
                    <div class="wrap">
                        <div class="cards-head">
                            <h2 class="section-title" id="cards-title">Berita Terbaru</h2>
                        </div>

                        <div class="cards cards--{{ $cards->count() }}">
                            @foreach ($cards as $article)
                                <article class="card reveal">
                                    <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                        @if ($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                        @else
                                            <div class="ph">RK</div>
                                        @endif
                                    </a>

                                    <div class="card-body">
                                        <span class="cat">{{ $article->category->name }}</span>

                                        <h3 class="title">
                                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                        </h3>

                                        <p class="card-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 110) }}</p>

                                        <div class="meta">
                                            <span>{{ $article->user->name }}</span>
                                            @if ($article->created_at)
                                                <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- Berita lainnya --}}
            @if ($more->count())
                <section class="more" aria-labelledby="more-title">
                    <div class="wrap more-grid">
                        <div class="more-intro">
                            <h2 class="section-title" id="more-title">Berita Lainnya</h2>
                            <p>Kabar lain dari redaksi RuangKabar.</p>
                            <a class="btn" href="{{ route('articles.index') }}">
                                Lihat semua berita
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                            </a>
                        </div>

                        <div class="rows">
                            @foreach ($more as $article)
                                <article class="row reveal">
                                    <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                        @if ($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                        @else
                                            <div class="ph">RK</div>
                                        @endif
                                    </a>

                                    <div>
                                        <span class="cat">{{ $article->category->name }}</span>

                                        <h3 class="title">
                                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                        </h3>

                                        <p class="row-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 130) }}</p>

                                        <div class="meta">
                                            <span>{{ $article->user->name }}</span>
                                            @if ($article->created_at)
                                                <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @else
            <div class="wrap">
                <div class="empty">
                    <strong>Belum ada berita yang dipublikasikan</strong>
                    <p>Berita terbaru akan tampil di halaman ini setelah dipublikasikan.</p>
                </div>
            </div>
        @endif
    </main>

    <footer class="footer">
        <div class="wrap footer-grid">
            <div class="footer-brand">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>
                <p class="footer-about">Portal berita dan informasi terkini.</p>
            </div>

            <div>
                <h2 class="footer-title">Jelajahi</h2>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('articles.index') }}">Berita</a></li>
                </ul>
            </div>

            <div>
                <h2 class="footer-title">Akun</h2>
                <ul class="footer-links">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li><a href="/admin/dashboard">Dashboard</a></li>
                        @elseif (auth()->user()->role === 'penulis')
                            <li><a href="/penulis/dashboard">Dashboard</a></li>
                        @else
                            <li><a href="/beranda">Akun Saya</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="wrap">
            <div class="footer-bottom">
                &copy; {{ date('Y') }} RuangKabar. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        (function () {
            var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            var header = document.getElementById('site-header');
            if (header) {
                var onScroll = function () {
                    header.classList.toggle('is-scrolled', window.scrollY > 8);
                };
                onScroll();
                window.addEventListener('scroll', onScroll, { passive: true });
            }

            // Ikon cari di header: arahkan ke panel pencarian jika ada, jika tidak ikuti tautan biasa.
            var toggle = document.querySelector('.search-toggle');
            var panel = document.getElementById('cari');
            var input = document.getElementById('q');
            if (toggle && panel && input) {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    panel.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
                    setTimeout(function () { input.focus({ preventScroll: true }); }, reduce ? 0 : 450);
                });
            }

            var items = document.querySelectorAll('.reveal');
            if (!items.length) return;

            if (!('IntersectionObserver' in window)) {
                items.forEach(function (el) { el.classList.add('is-visible'); });
                return;
            }

            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        (function (el) {
                            setTimeout(function () { el.style.transitionDelay = ''; }, 900);
                        })(entry.target);
                        io.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });

            items.forEach(function (el, i) {
                el.style.transitionDelay = (i % 3) * 80 + 'ms';
                io.observe(el);
            });
        })();
    </script>

</body>
</html>