<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RuangKabar, portal berita dan informasi terkini.">

    <title>RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <script>document.documentElement.classList.add('js');</script>

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
            border: 0;
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

        .ph {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            min-height: 180px;
            overflow: hidden;
            background: var(--emerald);
        }

        .ph img {
            display: block;
            width: 55px !important;
            height: 55px !important;
            max-width: none;
            max-height: none;
            object-fit: contain !important;
            object-position: center;
            flex: 0 0 auto;
        }

        .section-title {
            margin: 0;
            font-family: var(--serif);
            font-size: 34px;
            font-weight: 600;
            line-height: 1.15;
            letter-spacing: -0.01em;
            color: var(--emerald);
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

        .headline {
            margin-top: 20px;
        }

        .headline__stage {
            position: relative;
            height: clamp(460px, 64vh, 620px);
            overflow: hidden;
            color: var(--ivory);
            background: var(--forest);
            border-radius: var(--r-lg);
            isolation: isolate;
        }

        .slide {
            position: absolute;
            inset: 0;
            z-index: 0;
            display: flex;
            align-items: flex-end;
            opacity: 0;
            visibility: hidden;
            transition: opacity 700ms ease, visibility 0s linear 700ms;
        }

        .slide.is-active {
            z-index: 1;
            opacity: 1;
            visibility: visible;
            transition-delay: 0s;
        }

        .slide__media {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .slide__media img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.04);
            transition: transform 6s ease-out;
        }

        .slide.is-active .slide__media img {
            transform: scale(1);
        }

        .slide__media .ph img {
            width: 15%;
            max-width: 100px;
            height: auto;
            max-height: 70%;
            object-fit: contain;
            flex-shrink: 0;
        }

        .slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(0deg, rgba(24, 60, 54, 0.94) 0%, rgba(24, 60, 54, 0.7) 34%, rgba(24, 60, 54, 0.12) 72%),
                linear-gradient(90deg, rgba(24, 60, 54, 0.55) 0%, rgba(24, 60, 54, 0) 65%);
        }

        .slide__body {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 780px;
            padding: 48px 56px 112px;
        }

        .slide__cat {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 7px 16px 7px 12px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ivory);
            text-decoration: none;
            background: rgba(250, 248, 243, 0.14);
            border: 1px solid rgba(250, 248, 243, 0.28);
            border-radius: 999px;
            transition: background var(--t-fast) ease-out;
        }

        .slide__cat::before {
            content: "";
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
        }

        .slide__cat:hover {
            background: rgba(250, 248, 243, 0.24);
        }

        .slide__title {
            display: -webkit-box;
            margin: 0 0 16px;
            overflow: hidden;
            font-family: var(--serif);
            font-size: clamp(28px, 3.9vw, 52px);
            font-weight: 600;
            line-height: 1.14;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }

        .slide__title a {
            color: var(--white);
            text-decoration: none;
        }

        .slide__meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px 24px;
            font-family: var(--body);
            font-size: 14px;
            color: var(--on-dark);
        }

        .slide__date {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .slide__date::before {
            content: "";
            width: 24px;
            height: 1px;
            background: var(--gold);
        }

        .headline__controls {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 56px 28px;
        }

        .headline__dots {
            display: flex;
            align-items: center;
        }

        .dot {
            display: flex;
            align-items: center;
            height: 44px;
            padding: 0 5px;
            background: none;
            border: 0;
            cursor: pointer;
        }

        .dot span {
            position: relative;
            display: block;
            width: 32px;
            height: 4px;
            overflow: hidden;
            background: rgba(250, 248, 243, 0.35);
            border-radius: 2px;
            transition: width var(--t-ui) var(--ease), background var(--t-fast) ease-out;
        }

        .dot:hover span {
            background: rgba(250, 248, 243, 0.6);
        }

        .dot.is-active span {
            width: 64px;
        }

        .dot.is-active span::after {
            content: "";
            position: absolute;
            inset: 0;
            background: var(--gold);
            transform-origin: left;
            animation: fill var(--interval, 5000ms) linear forwards;
        }

        .headline__arrows {
            display: flex;
            gap: 10px;
        }

        .arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            padding: 0;
            color: var(--ivory);
            background: rgba(250, 248, 243, 0.12);
            border: 1px solid rgba(250, 248, 243, 0.3);
            border-radius: 50%;
            cursor: pointer;
            transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
        }

        .arrow:hover {
            background: rgba(250, 248, 243, 0.24);
            border-color: rgba(250, 248, 243, 0.55);
        }

        .arrow:active {
            transform: scale(0.94);
        }

        .arrow svg {
            width: 18px;
            height: 18px;
        }

        .finder {
            margin-top: 28px;
        }

        .finder__card {
            padding: 24px;
            background: var(--white);
            border: 1px solid var(--rule);
            border-radius: 24px;
        }

        .search {
            display: flex;
            align-items: center;
            gap: 10px;
            height: 60px;
            padding: 0 6px 0 22px;
            background: var(--ivory);
            border: 1px solid var(--rule);
            border-radius: 999px;
            transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
        }

        .search:focus-within {
            border-color: var(--forest);
            box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.18);
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
            height: 56px;
            padding: 0;
            font-family: var(--body);
            font-size: 15px;
            color: var(--text);
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
            height: 46px;
        }

        .finder__cats {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--rule);
        }

        .finder__label {
            flex: none;
            padding-top: 11px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--forest);
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
            padding: 0 18px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 600;
            color: var(--emerald);
            text-decoration: none;
            white-space: nowrap;
            background: var(--ivory);
            border: 1px solid var(--rule);
            border-radius: 999px;
            transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
        }

        .chip::before {
            content: "";
            width: 6px;
            height: 6px;
            background: var(--gold);
            border-radius: 50%;
        }

        .chip:hover {
            color: var(--ivory);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        .latest {
            margin: 72px 12px 0;
            padding: 72px 0 80px;
            background: var(--sand);
            border-radius: var(--r-lg);
        }

        .latest__head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px 24px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .more-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--forest);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .more-link svg {
            width: 16px;
            height: 16px;
            transition: transform var(--t-ui) var(--ease);
        }

        .more-link:hover {
            color: var(--emerald);
        }

        .more-link:hover svg {
            transform: translateX(3px);
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }

        .cards--1 {
            grid-template-columns: minmax(0, 520px);
        }

        .cards--2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 12px;
            background: var(--white);
            border: 1px solid rgba(24, 60, 54, 0.06);
            border-radius: 22px;
            transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
        }

        .card .media {
            display: block;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: var(--sand);
            border-radius: var(--r-md);
        }

        .card .media img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 600ms var(--ease);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px 10px 8px;
        }

        .cat {
            position: relative;
            z-index: 1;
            align-self: flex-start;
            margin-bottom: 10px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--forest);
            text-decoration: none;
        }

        .cat:hover {
            color: var(--emerald);
            text-decoration: underline;
            text-decoration-color: var(--gold);
            text-underline-offset: 3px;
        }

        .card .title {
            display: -webkit-box;
            margin: 0 0 12px;
            overflow: hidden;
            font-family: var(--serif);
            font-size: 22px;
            font-weight: 600;
            line-height: 1.3;
            overflow-wrap: anywhere;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .card .title a {
            color: var(--emerald);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .card .title a::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            border-radius: 22px;
        }

        .card-excerpt {
            display: -webkit-box;
            margin: 0 0 18px;
            overflow: hidden;
            font-family: var(--body);
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--text-soft);
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2px 14px;
            margin-top: auto;
            padding-top: 14px;
            font-family: var(--body);
            font-size: 13px;
            color: var(--text-soft);
            border-top: 1px solid var(--rule);
        }

        .meta span:first-child {
            font-weight: 500;
            color: var(--text);
        }

        @media (hover: hover) {
            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4);
            }

            .card:hover .media img {
                transform: scale(1.03);
            }

            .card:hover .title a {
                color: var(--forest);
            }
        }

        .empty {
            margin: 28px 0 0;
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
            color: var(--emerald);
        }

        .empty p {
            max-width: 440px;
            margin: 0 auto;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-soft);
        }

        @keyframes fill {
            from { transform: scaleX(0); }
            to   { transform: scaleX(1); }
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

        .footer {
            margin-top: 72px;
            color: var(--on-dark);
            background: var(--emerald);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 3fr) minmax(0, 3fr);
            gap: 32px 48px;
            padding-top: 64px;
            padding-bottom: 48px;
        }

        .footer-about {
            max-width: 300px;
            margin: 16px 0 0;
            font-family: var(--body);
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-title {
            margin: 0 0 14px;
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

        @media (max-width: 1023px) {
            :root {
                --pad: 24px;
                --r-lg: 24px;
            }

            .headline__stage {
                height: 520px;
            }

            .slide__body {
                padding: 40px 40px 108px;
            }

            .headline__controls {
                padding: 0 40px 26px;
            }

            .latest {
                margin-top: 56px;
                padding: 56px 0 64px;
            }

            .cards,
            .cards--1,
            .cards--2 {
                grid-template-columns: minmax(0, 1fr);
                gap: 20px;
            }

            .card {
                flex-direction: row;
                align-items: stretch;
                gap: 20px;
            }

            .card .media {
                flex: 0 0 38%;
                aspect-ratio: auto;
                min-height: 200px;
            }

            .card-body {
                padding: 12px 12px 8px 0;
            }

            .footer {
                margin-top: 56px;
            }

            .footer-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 719px) {
            :root {
                --pad: 16px;
                --r-lg: 22px;
            }

            .headline {
                margin-top: 14px;
            }

            .headline__stage {
                height: 540px;
            }

            .slide__body {
                padding: 28px 22px 100px;
            }

            .slide__title {
                -webkit-line-clamp: 5;
            }

            .headline__controls {
                padding: 0 17px 20px;
            }

            .dot span {
                width: 22px;
            }

            .dot.is-active span {
                width: 44px;
            }

            .finder {
                margin-top: 20px;
            }

            .finder__card {
                padding: 16px;
                border-radius: 20px;
            }

            .search {
                height: 54px;
                padding-left: 16px;
            }

            .search input {
                height: 50px;
            }

            .search .btn {
                height: 42px;
                padding: 0 20px;
            }

            .finder__cats {
                flex-direction: column;
                gap: 12px;
                margin-top: 16px;
                padding-top: 16px;
            }

            .finder__label {
                padding-top: 0;
            }

            .chips {
                flex-wrap: nowrap;
                margin: 0 -16px;
                padding: 0 16px 4px;
                overflow-x: auto;
                scrollbar-width: none;
                -webkit-overflow-scrolling: touch;
            }

            .chips::-webkit-scrollbar {
                display: none;
            }

            .chip {
                flex: none;
            }

            .latest {
                margin: 44px 8px 0;
                padding: 44px 0 52px;
            }

            .latest__head {
                margin-bottom: 28px;
            }

            .section-title {
                font-size: 28px;
            }

            .card {
                flex-direction: column;
                gap: 0;
            }

            .card .media {
                flex: none;
                aspect-ratio: 16 / 10;
                min-height: 0;
            }

            .card-body {
                padding: 18px 8px 6px;
            }

            .card .title {
                font-size: 20px;
            }

            .footer {
                margin-top: 44px;
            }

            .footer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 28px 24px;
                padding-top: 44px;
            }
        }

        @media (max-width: 479px) {
            .footer-grid {
                grid-template-columns: minmax(0, 1fr);
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

            .slide__media img,
            .slide.is-active .slide__media img {
                transform: none;
            }

            .dot.is-active span::after {
                transform: none;
            }

            .js .reveal {
                opacity: 1;
                transform: none;
            }

            .card:hover,
            .card:hover .media img {
                transform: none;
            }
        }
    </style>
</head>
<body>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    @include('components.navbar-public')

    <main id="konten">
        <h1 class="sr-only">RuangKabar, portal berita dan informasi terkini</h1>

        @php
            $slides = $articles->take(3)->values();
            $latest = $articles->slice(3, 3)->values();
        @endphp

        @if ($slides->count())
            <section class="headline wrap" id="headline" aria-roledescription="carousel" aria-label="Berita utama" data-interval="5000">
                <div class="headline__stage">
                    <div aria-live="off">
                        @foreach ($slides as $i => $article)
                            <article class="slide {{ $i === 0 ? 'is-active' : '' }}" role="group" aria-roledescription="slide" aria-label="{{ $i + 1 }} dari {{ $slides->count() }}" @if ($i !== 0) aria-hidden="true" @endif>
                                <div class="slide__media">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" @if ($i === 0) fetchpriority="high" @endif>
                                    @else
                                        <div class="ph">
                                            <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                        </div>
                                    @endif
                                </div>

                                <div class="slide__body">
                                    <a class="slide__cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

                                    <h2 class="slide__title">
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h2>

                                    <div class="slide__meta">
                                        @if ($article->created_at)
                                            <time class="slide__date" datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                        @endif
                                        <a class="btn btn--gold" href="{{ route('articles.show', $article) }}">
                                            Baca Selengkapnya
                                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($slides->count() > 1)
                        <div class="headline__controls">
                            <div class="headline__dots" role="group" aria-label="Pilih berita utama">
                                @foreach ($slides as $i => $article)
                                    <button class="dot {{ $i === 0 ? 'is-active' : '' }}" type="button" aria-label="Berita {{ $i + 1 }}" @if ($i === 0) aria-current="true" @endif><span></span></button>
                                @endforeach
                            </div>

                            <div class="headline__arrows">
                                <button class="arrow" type="button" data-dir="-1" aria-label="Berita sebelumnya">
                                    <svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 3L5 9l6 6"/></svg>
                                </button>
                                <button class="arrow" type="button" data-dir="1" aria-label="Berita berikutnya">
                                    <svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 3l6 6-6 6"/></svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <section class="finder wrap" aria-label="Cari dan jelajahi berita">
            <div class="finder__card">
                <form class="search" action="{{ route('articles.index') }}" method="GET" role="search">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                    <label class="sr-only" for="q">Cari berita</label>
                    <input id="q" type="search" name="search" placeholder="Cari berita">
                    <button class="btn" type="submit">Cari</button>
                </form>

                @if ($categories->count())
                    <div class="finder__cats">
                        <span class="finder__label">Kategori</span>
                        <nav aria-label="Kategori berita">
                            <ul class="chips">
                                @foreach ($categories as $category)
                                    <li><a class="chip" href="{{ route('kategori.show', $category) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </section>

        @if ($latest->count())
            <section class="latest" aria-labelledby="latest-title">
                <div class="wrap">
                    <div class="latest__head">
                        <h2 class="section-title" id="latest-title">Berita Terbaru</h2>
                        <a class="more-link" href="{{ route('articles.index') }}">
                            Lihat semua berita
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                        </a>
                    </div>

                    <div class="cards cards--{{ $latest->count() }}">
                        @foreach ($latest as $article)
                            <article class="card reveal">
                                <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">
                                            <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                    </div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <a class="cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

                                    <h3 class="title">
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h3>

                                    <p class="card-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>

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

        @if (! $articles->count())
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
                <a class="rk-brand" href="/" aria-label="RuangKabar, ke beranda">
                    <svg class="rk-brand__mark" aria-hidden="true" focusable="false"><use href="#rk-mark"/></svg>
                    <span class="rk-brand__name">Ruang<span>Kabar</span></span>
                </a>
                <p class="footer-about">Portal berita dan informasi terkini.</p>
            </div>

            <div>
                <h2 class="footer-title">Jelajahi</h2>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('articles.index') }}">Semua Berita</a></li>
                </ul>
            </div>

            <div>
                <h2 class="footer-title">Kategori</h2>
                <ul class="footer-links">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('kategori.show', $category) }}">{{ $category->name }}</a></li>
                    @endforeach
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
            var root = document.getElementById('headline');
            if (root) {
                var slides = [].slice.call(root.querySelectorAll('.slide'));
                var dots = [].slice.call(root.querySelectorAll('.dot'));
                var total = slides.length;
                var interval = parseInt(root.getAttribute('data-interval'), 10) || 5000;
                var current = 0;
                var timer = null;

                root.style.setProperty('--interval', interval + 'ms');

                var render = function (index) {
                    current = (index + total) % total;

                    slides.forEach(function (slide, k) {
                        var on = k === current;
                        slide.classList.toggle('is-active', on);
                        slide.setAttribute('aria-hidden', on ? 'false' : 'true');
                    });

                    dots.forEach(function (dot) {
                        dot.classList.remove('is-active');
                        dot.removeAttribute('aria-current');
                    });

                    void root.offsetWidth;

                    if (dots[current]) {
                        dots[current].classList.add('is-active');
                        dots[current].setAttribute('aria-current', 'true');
                    }
                };

                var stop = function () {
                    if (timer !== null) {
                        clearTimeout(timer);
                        timer = null;
                    }
                };

                var schedule = function () {
                    stop();
                    if (total < 2 || document.hidden) return;
                    timer = setTimeout(function () {
                        render(current + 1);
                        schedule();
                    }, interval);
                };

                var go = function (index) {
                    render(index);
                    schedule();
                };

                dots.forEach(function (dot, k) {
                    dot.addEventListener('click', function () { go(k); });
                });

                [].slice.call(root.querySelectorAll('.arrow')).forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        go(current + parseInt(btn.getAttribute('data-dir'), 10));
                    });
                });

                var startX = null;
                root.addEventListener('touchstart', function (e) {
                    startX = e.touches[0].clientX;
                }, { passive: true });
                root.addEventListener('touchend', function (e) {
                    if (startX === null) return;
                    var dx = e.changedTouches[0].clientX - startX;
                    startX = null;
                    if (Math.abs(dx) > 50) go(current + (dx < 0 ? 1 : -1));
                }, { passive: true });

                document.addEventListener('visibilitychange', function () {
                    if (document.hidden) {
                        stop();
                    } else {
                        render(current);
                        schedule();
                    }
                });

                render(0);
                schedule();
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