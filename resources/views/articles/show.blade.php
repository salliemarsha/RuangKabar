<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $article->title }} - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

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
        textarea:focus-visible {
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

        /* Progress membaca */
        .progress {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 60;
            width: 100%;
            height: 3px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: left;
            pointer-events: none;
        }

        /* ---------- Header (sama dengan homepage) ---------- */
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

        .btn--ghost {
            color: var(--emerald);
            background: transparent;
            border: 1px solid var(--rule);
        }

        .btn--ghost:hover {
            color: var(--white);
            background: var(--emerald);
            border-color: var(--emerald);
        }

        /* ---------- Halaman artikel ---------- */
        .detail {
            max-width: 1100px;
            margin: 0 auto;
            padding: 120px var(--pad) 0;
        }

        .crumbs ol {
            display: flex;
            align-items: center;
            gap: 0 10px;
            margin: 0 0 28px;
            padding: 0;
            list-style: none;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 500;
            color: var(--text-soft);
        }

        .crumbs li {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .crumbs li + li::before {
            content: "/";
            color: rgba(24, 60, 54, 0.35);
        }

        .crumbs a {
            padding: 8px 0;
            color: var(--text-soft);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .crumbs a:hover {
            color: var(--forest);
        }

        .crumbs li:last-child {
            flex: 1;
        }

        .crumbs [aria-current="page"] {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--emerald);
        }

        .detail-head {
            max-width: 900px;
            margin-bottom: 40px;
            animation: rise var(--t-enter) var(--ease) both;
        }

        .detail-cat {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--forest);
        }

        .detail-cat::before {
            content: "";
            width: 28px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
        }

        .detail-title {
            margin: 0 0 28px;
            font-family: var(--serif);
            font-size: clamp(32px, 5vw, 58px);
            font-weight: 600;
            line-height: 1.12;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
        }

        .detail-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px 32px;
            padding-top: 20px;
            border-top: 1px solid var(--rule);
        }

        .byline {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .avatar {
            display: flex;
            flex: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            font-family: var(--sans);
            font-size: 16px;
            font-weight: 700;
            color: var(--ivory);
            background: var(--emerald);
            border-radius: 50%;
        }

        .byline-text {
            display: flex;
            flex-direction: column;
            min-width: 0;
            font-family: var(--body);
            font-size: 12px;
            color: var(--text-soft);
        }

        .byline-text strong {
            font-family: var(--sans);
            font-size: 15px;
            font-weight: 700;
            color: var(--emerald);
            overflow-wrap: anywhere;
        }

        .facts {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 0;
            margin: 0;
            padding: 0;
            list-style: none;
            font-family: var(--body);
            font-size: 14px;
            color: var(--text-soft);
        }

        .facts li + li::before {
            content: "";
            display: inline-block;
            width: 1px;
            height: 14px;
            margin: 0 16px;
            vertical-align: -2px;
            background: rgba(24, 60, 54, 0.25);
        }

        .badge-draft {
            padding: 3px 10px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 700;
            color: var(--emerald);
            background: var(--sand);
            border-radius: 999px;
        }

        .detail-figure {
            margin: 0 0 56px;
            animation: rise var(--t-enter) var(--ease) 120ms both;
        }

        .detail-media {
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: var(--sand);
            border-radius: var(--r-lg);
        }

        .detail-media img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-ph {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 64px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: rgba(250, 248, 243, 0.3);
            background: var(--forest);
        }

        .detail-figure.is-empty .detail-media {
            aspect-ratio: 21 / 7;
        }

        /* ---------- Area membaca ---------- */
        .reading {
            max-width: 700px;
            margin: 0 auto;
        }

        .article-body {
            font-family: var(--body);
            font-size: 18.5px;
            line-height: 1.85;
            color: var(--emerald);
        }

        .article-body p {
            margin: 0 0 1.5em;
        }

        .article-body p:first-child {
            font-size: 1.12em;
            line-height: 1.75;
        }

        .article-body p:last-child {
            margin-bottom: 0;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 10px 14px;
            margin-top: 44px;
        }

        .tags-label {
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--text-soft);
        }

        .tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
            min-width: 0;
        }

        .tags-list li {
            max-width: 100%;
            padding: 6px 14px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
            color: var(--emerald);
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: 999px;
            overflow-wrap: anywhere;
        }

        /* Share */
        .share {
            margin-top: 40px;
            padding: 24px;
            background: var(--sand);
            border-radius: 22px;
        }

        .share-title {
            margin: 0 0 14px;
            font-family: var(--sans);
            font-size: 15px;
            font-weight: 700;
        }

        .share-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .share-list .btn {
            height: 44px;
            padding: 0 20px;
            color: var(--emerald);
            background: var(--white);
        }

        .share-list .btn:hover {
            color: var(--white);
            background: var(--emerald);
        }

        .share-status {
            min-height: 20px;
            margin: 12px 0 0;
            font-family: var(--body);
            font-size: 13px;
            color: var(--forest);
        }

        /* Komentar */
        .comments {
            margin-top: 56px;
            padding-top: 40px;
            border-top: 1px solid var(--rule);
        }

        .comments-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin: 0 0 24px;
            font-family: var(--serif);
            font-size: 30px;
            font-weight: 600;
            line-height: 1.2;
        }

        .comments-count {
            padding: 2px 12px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--emerald);
            background: var(--sand);
            border-radius: 999px;
        }

        .notice {
            margin: 0 0 20px;
            padding: 14px 18px;
            font-family: var(--body);
            font-size: 14px;
            line-height: 1.6;
            color: var(--emerald);
            background: var(--white);
            border: 1px solid var(--sand);
            border-left: 3px solid var(--gold);
            border-radius: 12px;
        }

        .comment-form {
            margin-bottom: 40px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
        }

        .field textarea {
            display: block;
            width: 100%;
            min-height: 140px;
            padding: 16px 18px;
            font-family: var(--body);
            font-size: 16px;
            line-height: 1.65;
            color: var(--emerald);
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: var(--r-md);
            resize: vertical;
            transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
        }

        .field textarea::placeholder {
            color: var(--text-soft);
        }

        .field textarea:focus {
            outline: none;
            border-color: var(--forest);
            box-shadow: 0 0 0 2px var(--forest);
        }

        .form-error {
            margin: 8px 0 0;
            font-family: var(--body);
            font-size: 13px;
            color: #A3321F;
        }

        .comment-form .btn {
            margin-top: 16px;
        }

        .login-prompt {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px 24px;
            margin-bottom: 40px;
            padding: 22px 24px;
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: 22px;
        }

        .login-prompt p {
            flex: 1 1 260px;
            margin: 0;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.65;
            color: var(--text-soft);
        }

        .login-prompt-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .comment-list {
            border-top: 1px solid var(--rule);
        }

        .comment-item {
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr);
            gap: 16px;
            padding: 24px 0;
            border-bottom: 1px solid var(--rule);
        }

        .comment-item .avatar {
            width: 44px;
            height: 44px;
            color: var(--emerald);
            background: var(--sand);
        }

        .comment-head {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 2px 14px;
            margin-bottom: 6px;
        }

        .comment-head strong {
            font-family: var(--sans);
            font-size: 15px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .comment-head time {
            font-family: var(--body);
            font-size: 13px;
            color: var(--text-soft);
        }

        .comment-text {
            margin: 0;
            font-family: var(--body);
            font-size: 16px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .comment-empty {
            margin: 0;
            padding: 22px 0;
            font-family: var(--body);
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-soft);
            border-top: 1px solid var(--rule);
            border-bottom: 1px solid var(--rule);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 40px 0 72px;
            padding: 10px 0;
            font-family: var(--sans);
            font-size: 14px;
            font-weight: 700;
            color: var(--forest);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* ---------- Berita terkait ---------- */
        .related {
            margin: 0 12px;
            padding: 80px 0 96px;
            background: var(--sand);
            border-radius: var(--r-lg);
        }

        .related-head {
            margin-bottom: 40px;
            text-align: center;
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
            margin: 14px auto 0;
            background: var(--gold);
            border-radius: 2px;
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
            display: block;
            aspect-ratio: 4 / 3;
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

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px 10px 12px;
        }

        .cat {
            margin-bottom: 10px;
            font-family: var(--sans);
            font-size: 13px;
            font-weight: 700;
            color: var(--forest);
        }

        .card .title {
            margin: 0 0 10px;
            font-family: var(--sans);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.28;
            letter-spacing: -0.015em;
            overflow-wrap: anywhere;
        }

        .card .title a {
            color: var(--emerald);
            text-decoration: none;
            transition: color var(--t-fast) ease-out;
        }

        .card-excerpt {
            margin: 0 0 16px;
            font-family: var(--body);
            font-size: 14.5px;
            line-height: 1.65;
            color: var(--text-soft);
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2px 14px;
            margin-top: auto;
            font-family: var(--body);
            font-size: 13px;
            color: var(--text-soft);
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

        .footer-wrap {
            margin-top: 12px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 1023px) {
            :root {
                --pad: 24px;
                --r-lg: 24px;
            }

            .detail {
                padding-top: 116px;
            }

            .detail-figure {
                margin-bottom: 44px;
            }

            .article-body {
                font-size: 18px;
            }

            .related {
                padding: 64px 0 72px;
            }

            .cards,
            .cards--2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
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

            .detail {
                padding-top: 156px;
            }

            .crumbs ol {
                margin-bottom: 20px;
            }

            .detail-head {
                margin-bottom: 28px;
            }

            .detail-title {
                margin-bottom: 22px;
            }

            .detail-meta {
                gap: 12px 24px;
                padding-top: 16px;
            }

            .detail-figure {
                margin-bottom: 36px;
            }

            .detail-media {
                aspect-ratio: 4 / 3;
            }

            .detail-figure.is-empty .detail-media {
                aspect-ratio: 16 / 7;
            }

            .article-body {
                font-size: 17px;
                line-height: 1.8;
            }

            .share {
                padding: 20px;
            }

            .share-list {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .share-list .btn {
                height: 48px;
                padding: 0 12px;
            }

            .comments {
                margin-top: 44px;
                padding-top: 32px;
            }

            .comments-title {
                font-size: 26px;
            }

            .comment-form .btn {
                width: 100%;
            }

            .comment-item {
                grid-template-columns: 36px minmax(0, 1fr);
                gap: 12px;
            }

            .comment-item .avatar {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .related {
                margin: 0 8px;
                padding: 52px 0 56px;
            }

            .section-title {
                font-size: 28px;
            }

            .cards,
            .cards--2,
            .cards--1 {
                grid-template-columns: minmax(0, 1fr);
                max-width: none;
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
            .card:hover .media img {
                transform: none;
            }
        }
    </style>
</head>
<body>

    @php
        $str = \Illuminate\Support\Str::class;

        // Estimasi waktu baca (~200 kata per menit), dihitung dari isi berita
        $plain = trim(strip_tags($article->content));
        $wordCount = $plain === '' ? 0 : count(preg_split('/\s+/u', $plain, -1, PREG_SPLIT_NO_EMPTY));
        $readMinutes = max(1, (int) ceil($wordCount / 200));

        // Tautan share memakai URL berita yang sebenarnya
        $url = route('articles.show', $article);
        $shareWa = 'https://wa.me/?text=' . rawurlencode($article->title . ' - ' . $url);
        $shareFb = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($url);
        $shareX = 'https://twitter.com/intent/tweet?url=' . rawurlencode($url) . '&text=' . rawurlencode($article->title);

        // Berita terkait: utamakan kategori yang sama, tanpa artikel yang sedang dibaca
        $sameCategory = \App\Models\Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        $related = $sameCategory;

        if ($related->count() < 3) {
            $filler = \App\Models\Article::with(['category', 'user'])
                ->where('status', 'published')
                ->whereNotIn('id', $related->pluck('id')->push($article->id))
                ->latest()
                ->take(3 - $related->count())
                ->get();

            $related = $related->concat($filler);
        }

        $relatedTitle = $sameCategory->count() === $related->count() ? 'Berita Terkait' : 'Baca Juga';
        $authorName = $article->user->name ?? 'Redaksi';
    @endphp

    <div class="progress" id="progress" aria-hidden="true"></div>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    <header class="site-header" id="site-header">
        <div class="wrap">
            <div class="bar">
                <a class="brand" href="/">Ruang<span>Kabar</span></a>

                <nav class="nav" aria-label="Menu utama">
                    <ul class="nav-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a class="is-current" href="{{ route('articles.index') }}">Berita</a></li>
                    </ul>
                </nav>

                <div class="actions">
                    <a class="icon-btn" href="{{ route('articles.index') }}" aria-label="Cari berita">
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
        <article class="detail">

            <nav class="crumbs" aria-label="Breadcrumb">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li><span>{{ $article->category->name }}</span></li>
                    <li><span aria-current="page">{{ $article->title }}</span></li>
                </ol>
            </nav>

            <header class="detail-head">
                <span class="detail-cat">{{ $article->category->name }}</span>

                <h1 class="detail-title">{{ $article->title }}</h1>

                <div class="detail-meta">
                    <div class="byline">
                        <span class="avatar" aria-hidden="true">{{ $str::upper($str::substr($authorName, 0, 1)) }}</span>
                        <span class="byline-text">
                            <span>Ditulis oleh</span>
                            <strong>{{ $authorName }}</strong>
                        </span>
                    </div>

                    <ul class="facts">
                        @if ($article->created_at)
                            <li><time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time></li>
                        @endif
                        <li>{{ $readMinutes }} menit baca</li>
                        @if ($article->status !== 'published')
                            <li><span class="badge-draft">{{ ucfirst($article->status) }}</span></li>
                        @endif
                    </ul>
                </div>
            </header>

            <figure class="detail-figure {{ $article->image ? '' : 'is-empty' }}">
                <div class="detail-media">
                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                    @else
                        <div class="detail-ph">RK</div>
                    @endif
                </div>
            </figure>

            <div class="reading">

                <div class="article-body">
                    @foreach (preg_split('/\R{2,}/', trim($article->content)) as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @endforeach
                </div>

                @if ($article->tags->count())
                    <div class="tags">
                        <span class="tags-label">Tag</span>
                        <ul class="tags-list">
                            @foreach ($article->tags as $tag)
                                <li>{{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="share" aria-labelledby="share-title">
                    <h2 class="share-title" id="share-title">Bagikan berita ini</h2>

                    <div class="share-list">
                        <a class="btn" href="{{ $shareWa }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                        <a class="btn" href="{{ $shareFb }}" target="_blank" rel="noopener noreferrer">Facebook</a>
                        <a class="btn" href="{{ $shareX }}" target="_blank" rel="noopener noreferrer">X</a>
                        <button class="btn" type="button" id="copy-link" data-url="{{ $url }}">Salin tautan</button>
                    </div>

                    <p class="share-status" id="share-status" role="status" aria-live="polite"></p>
                </section>

                <section class="comments" id="komentar" aria-labelledby="comments-title">
                    <h2 class="comments-title" id="comments-title">
                        Komentar
                        @if ($article->comments->count())
                            <span class="comments-count">{{ $article->comments->count() }}</span>
                        @endif
                    </h2>

                    @if (session('success'))
                        <p class="notice" role="status">{{ session('success') }}</p>
                    @endif

                    @auth
                        @if (auth()->user()->role === 'pengguna')
                            <form class="comment-form" action="/comments" method="POST">
                                @csrf

                                <input type="hidden" name="article_id" value="{{ $article->id }}">

                                <div class="field">
                                    <label for="comment">Tulis komentar</label>
                                    <textarea
                                        id="comment"
                                        name="comment"
                                        rows="5"
                                        required
                                        placeholder="Tulis komentar Anda..."
                                    >{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror

                                    @error('article_id')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn" type="submit">Kirim Komentar</button>
                            </form>
                        @else
                            <p class="notice">Komentar hanya dapat ditulis oleh akun pengguna.</p>
                        @endif
                    @else
                        <div class="login-prompt">
                            <p>Masuk atau daftar sebagai pengguna untuk ikut berkomentar pada berita ini.</p>

                            <div class="login-prompt-actions">
                                <a class="btn" href="{{ route('login') }}">Login</a>
                                <a class="btn btn--ghost" href="{{ route('register') }}">Daftar</a>
                            </div>
                        </div>
                    @endauth

                    @if ($article->comments->count())
                        <div class="comment-list">
                            @foreach ($article->comments as $comment)
                                @php $commenter = $comment->user->name ?? 'Pengguna'; @endphp

                                <article class="comment-item">
                                    <span class="avatar" aria-hidden="true">{{ $str::upper($str::substr($commenter, 0, 1)) }}</span>

                                    <div>
                                        <div class="comment-head">
                                            <strong>{{ $commenter }}</strong>
                                            @if ($comment->created_at)
                                                <time datetime="{{ $comment->created_at->toDateString() }}">{{ $comment->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                            @endif
                                        </div>

                                        <p class="comment-text">{{ $comment->comment }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="comment-empty">Belum ada komentar yang disetujui.</p>
                    @endif
                </section>

                <a class="back-link" href="{{ route('articles.index') }}">
                    <span aria-hidden="true">&larr;</span> Kembali ke daftar berita
                </a>

            </div>
        </article>

        @if ($related->count())
            <section class="related" aria-labelledby="related-title">
                <div class="wrap">
                    <div class="related-head">
                        <h2 class="section-title" id="related-title">{{ $relatedTitle }}</h2>
                    </div>

                    <div class="cards cards--{{ $related->count() }}">
                        @foreach ($related as $item)
                            <article class="card reveal">
                                <a class="media" href="{{ route('articles.show', $item) }}" tabindex="-1" aria-hidden="true">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">RK</div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <span class="cat">{{ $item->category->name }}</span>

                                    <h3 class="title">
                                        <a href="{{ route('articles.show', $item) }}">{{ $item->title }}</a>
                                    </h3>

                                    <p class="card-excerpt">{{ $str::limit(strip_tags($item->content), 100) }}</p>

                                    <div class="meta">
                                        <span>{{ $item->user->name ?? 'Redaksi' }}</span>
                                        @if ($item->created_at)
                                            <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    <footer class="footer footer-wrap">
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
            var header = document.getElementById('site-header');
            var bar = document.getElementById('progress');
            var body = document.querySelector('.article-body');

            function onScroll() {
                if (header) {
                    header.classList.toggle('is-scrolled', window.scrollY > 8);
                }

                if (bar && body) {
                    var rect = body.getBoundingClientRect();
                    var total = rect.height - window.innerHeight * 0.5;
                    var done = Math.min(Math.max(-rect.top + window.innerHeight * 0.4, 0), Math.max(total, 1));
                    bar.style.transform = 'scaleX(' + (total > 0 ? done / total : 0) + ')';
                }
            }

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);

            // Salin tautan
            var copyBtn = document.getElementById('copy-link');
            var status = document.getElementById('share-status');

            if (copyBtn) {
                var setStatus = function (text) {
                    if (!status) return;
                    status.textContent = text;
                    setTimeout(function () { status.textContent = ''; }, 2500);
                };

                var fallbackCopy = function (text) {
                    var ta = document.createElement('textarea');
                    ta.value = text;
                    ta.setAttribute('readonly', '');
                    ta.style.position = 'fixed';
                    ta.style.opacity = '0';
                    document.body.appendChild(ta);
                    ta.select();
                    var ok = false;
                    try { ok = document.execCommand('copy'); } catch (e) {}
                    document.body.removeChild(ta);
                    return ok;
                };

                copyBtn.addEventListener('click', function () {
                    var url = copyBtn.getAttribute('data-url');

                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(url).then(
                            function () { setStatus('Tautan berita disalin.'); },
                            function () { setStatus(fallbackCopy(url) ? 'Tautan berita disalin.' : 'Gagal menyalin tautan.'); }
                        );
                    } else {
                        setStatus(fallbackCopy(url) ? 'Tautan berita disalin.' : 'Gagal menyalin tautan.');
                    }
                });
            }

            // Scroll reveal (hanya kartu berita terkait)
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