<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 155) }}">

    <title>{{ $article->title }} - RuangKabar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

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
    --danger: #A3321F;

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

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

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

a { color: inherit; }

a:focus-visible,
button:focus-visible,
input:focus-visible,
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

.skip-link:focus { top: 12px; }

.wrap {
    max-width: var(--wrap);
    margin: 0 auto;
    padding: 0 var(--pad);
}

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
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.btn:hover { background: var(--emerald); }
.btn:active { transform: scale(0.97); }

.btn--ghost {
    color: var(--emerald);
    background: transparent;
    border: 1px solid rgba(24, 60, 54, 0.3);
}

.btn--ghost:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}

.btn svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }
.btn:hover svg { transform: translateX(3px); }

.detail {
    max-width: 1100px;
    margin: 0 auto;
    padding: 28px var(--pad) 72px;
}

.crumbs { margin-bottom: 24px; }

.crumbs ol {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    min-width: 0;
    max-width: 820px;
    margin: 0 auto;
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
    flex: 0 1 auto;
    min-width: 0;
}

.crumbs li + li::before {
    content: "/";
    flex: none;
    margin: 0 10px;
    color: rgba(24, 60, 54, 0.3);
}

.crumbs li:first-child { flex: none; }
.crumbs li:nth-child(2) { max-width: 38%; }
.crumbs li:last-child { flex: 1 1 0; }

.crumbs a {
    display: block;
    overflow: hidden;
    padding: 10px 0;
    color: var(--text-soft);
    text-decoration: none;
    text-overflow: ellipsis;
    white-space: nowrap;
    transition: color var(--t-fast) ease-out;
}

.crumbs a:hover { color: var(--forest); }

.crumbs [aria-current="page"] {
    display: block;
    overflow: hidden;
    color: var(--emerald);
    text-overflow: ellipsis;
    white-space: nowrap;
}

.detail-head {
    max-width: 820px;
    margin: 0 auto 36px;
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
    letter-spacing: 0.02em;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.detail-cat::before {
    content: "";
    flex: none;
    width: 28px;
    height: 3px;
    background: var(--gold);
    border-radius: 2px;
}

.detail-cat:hover { color: var(--emerald); }

.detail-title {
    margin: 0 0 28px;
    font-family: var(--serif);
    font-size: clamp(30px, 4.4vw, 50px);
    font-weight: 600;
    line-height: 1.14;
    letter-spacing: -0.015em;
    color: var(--emerald);
    overflow-wrap: anywhere;
    text-wrap: balance;
}

.detail-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px 28px;
    padding: 18px 0;
    border-top: 1px solid var(--rule);
    border-bottom: 1px solid var(--rule);
}

.byline {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    font-family: var(--sans);
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: 50%;
}

.byline .avatar { box-shadow: 0 0 0 2px var(--ivory), 0 0 0 3px var(--gold); }

.byline-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
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
    align-items: center;
    gap: 6px 0;
    margin: 0;
    padding: 0;
    list-style: none;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.facts li { display: flex; align-items: center; }

.facts li + li::before {
    content: "";
    width: 4px;
    height: 4px;
    margin: 0 14px;
    background: var(--gold);
    border-radius: 50%;
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
    position: relative;
    aspect-ratio: 16 / 9;
    max-height: 560px;
    overflow: hidden;
    background: var(--sand);
    border-radius: var(--r-lg);
}

.detail-media > img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ph {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: var(--emerald);
}

.ph img {
    display: block;
    width: 56px;
    height: 56px;
    object-fit: contain;
    flex: none;
}

.detail-figure.is-empty .detail-media { aspect-ratio: 21 / 8; }

.detail-figure.is-empty .ph {
    position: relative;
    overflow: hidden;
}

.detail-figure.is-empty .ph::before {
    content: "";
    position: absolute;
    top: -140px;
    right: -80px;
    width: 380px;
    height: 380px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.detail-figure.is-empty .ph img {
    position: relative;
    width: 84px;
    height: 84px;
}

.reading {
    max-width: 720px;
    margin: 0 auto;
}

.article-body {
    font-family: var(--body);
    font-size: 18px;
    line-height: 1.85;
    color: var(--text);
}

.article-body p { margin: 0 0 1.45em; }

.article-body p:first-child {
    font-size: 1.1em;
    line-height: 1.8;
    color: var(--emerald);
}

.article-body p:last-child { margin-bottom: 0; }

.tags {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 10px 16px;
    margin-top: 44px;
    padding-top: 24px;
    border-top: 1px solid var(--rule);
}

.tags-label {
    flex: none;
    padding-top: 8px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--forest);
}

.tags-list {
    display: flex;
    flex: 1;
    flex-wrap: wrap;
    gap: 8px;
    min-width: 0;
    margin: 0;
    padding: 0;
    list-style: none;
}

.tags-list li {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    max-width: 100%;
    min-height: 36px;
    padding: 6px 16px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    line-height: 1.4;
    color: var(--emerald);
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    overflow-wrap: anywhere;
}

.tags-list li::before {
    content: "#";
    flex: none;
    color: var(--gold);
}

.share {
    margin-top: 40px;
    padding: 24px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 24px;
}

.share-title {
    margin: 0 0 16px;
    font-family: var(--sans);
    font-size: 15px;
    font-weight: 700;
    color: var(--emerald);
}

.share-list {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
}

.share-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-width: 0;
    height: 48px;
    padding: 0 12px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out, transform 120ms ease-out;
}

.share-btn svg {
    flex: none;
    width: 18px;
    height: 18px;
}

.share-btn:hover {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}

.share-btn:active { transform: scale(0.97); }

.share-status {
    min-height: 20px;
    margin: 12px 0 0;
    font-family: var(--body);
    font-size: 13px;
    color: var(--forest);
}

.share-status.is-error { color: var(--danger); }

.comments {
    margin-top: 56px;
    padding-top: 40px;
    border-top: 1px solid var(--rule);
}

.comments-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 0 24px;
    font-family: var(--serif);
    font-size: 30px;
    font-weight: 600;
    line-height: 1.2;
    color: var(--emerald);
}

.comments-count {
    padding: 3px 12px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--sand);
    border-radius: 999px;
}

.notice {
    margin: 0 0 24px;
    padding: 14px 18px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.6;
    color: var(--text);
    background: var(--white);
    border: 1px solid var(--sand);
    border-left: 3px solid var(--gold);
    border-radius: 12px;
}

.comment-form {
    margin-bottom: 32px;
    padding: 20px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 24px;
}

.field label {
    display: block;
    margin-bottom: 10px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--emerald);
}

.field textarea {
    display: block;
    width: 100%;
    min-height: 140px;
    padding: 16px 18px;
    font-family: var(--body);
    font-size: 16px;
    line-height: 1.65;
    color: var(--text);
    background: var(--ivory);
    border: 1px solid var(--rule);
    border-radius: var(--r-md);
    resize: vertical;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.field textarea::placeholder { color: var(--text-soft); }

.field textarea:focus {
    outline: none;
    background: var(--white);
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.18);
}

.form-error {
    margin: 8px 0 0;
    font-family: var(--body);
    font-size: 13px;
    color: var(--danger);
}

.comment-form .btn { margin-top: 16px; }

.login-prompt {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px 24px;
    margin-bottom: 32px;
    padding: 22px 24px;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 24px;
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

.comment-list { border-top: 1px solid var(--rule); }

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
    color: var(--emerald);
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
    font-size: 15.5px;
    line-height: 1.7;
    color: var(--text);
    white-space: pre-line;
    overflow-wrap: anywhere;
}

.comment-empty {
    margin: 0;
    padding: 24px;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.6;
    text-align: center;
    color: var(--text-soft);
    background: var(--white);
    border: 1px dashed rgba(24, 60, 54, 0.25);
    border-radius: 20px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 40px;
    padding: 12px 0;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.back-link span { transition: transform var(--t-ui) var(--ease); }
.back-link:hover { color: var(--emerald); }
.back-link:hover span { transform: translateX(-3px); }

.related {
    margin: 0 12px 72px;
    padding: 72px 0 80px;
    background: var(--sand);
    border-radius: var(--r-lg);
}

.related-head {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px 24px;
    margin-bottom: 40px;
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

.more-link svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }
.more-link:hover { color: var(--emerald); }
.more-link:hover svg { transform: translateX(3px); }

.cards {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px;
}

.cards--1 { grid-template-columns: minmax(0, 520px); }
.cards--2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
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

.card .media .ph img {
    width: 56px;
    height: 56px;
    object-fit: contain;
}

.card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 20px 10px 8px;
}

.cat {
    position: relative;
    z-index: 2;
    align-self: flex-start;
    margin-bottom: 10px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
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
    z-index: 1;
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

.meta span:first-child { font-weight: 500; color: var(--text); }

@media (hover: hover) {
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4);
    }

    .card:hover .media img { transform: scale(1.03); }
    .card:hover .media .ph img { transform: none; }
    .card:hover .title a { color: var(--forest); }
}

@keyframes rise {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: none; }
}

.js .reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity var(--t-enter) var(--ease), transform var(--t-enter) var(--ease);
}

.js .reveal.is-visible { opacity: 1; transform: none; }

.js .card.reveal.is-visible {
    transition: opacity var(--t-enter) var(--ease), transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

.footer { color: var(--on-dark); background: var(--emerald); }

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

.footer-links { margin: 0; padding: 0; list-style: none; }

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

.footer-links a:hover { color: var(--ivory); }

.footer-bottom {
    padding: 20px 0 28px;
    border-top: 1px solid rgba(250, 248, 243, 0.12);
    font-family: var(--sans);
    font-size: 13px;
}

@media (max-width: 1023px) {
    :root { --pad: 24px; --r-lg: 24px; }

    .detail { padding-bottom: 56px; }

    .detail-figure { margin-bottom: 44px; }

    .related { margin-bottom: 56px; padding: 56px 0 64px; }

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

    .card-body { padding: 12px 12px 8px 0; }

    .footer-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .footer-brand { grid-column: 1 / -1; }
}

@media (max-width: 719px) {
    :root { --pad: 16px; --r-lg: 22px; }

    .detail { padding-top: 20px; padding-bottom: 44px; }

    .crumbs { margin-bottom: 18px; }
    .crumbs li:nth-child(2) { max-width: 34%; }

    .detail-head { margin-bottom: 26px; }
    .detail-title { margin-bottom: 22px; }

    .detail-meta { gap: 12px 24px; padding: 16px 0; }

    .avatar { width: 42px; height: 42px; font-size: 15px; }

    .detail-figure { margin-bottom: 32px; }

    .detail-media { aspect-ratio: 4 / 3; border-radius: 20px; }
    .detail-figure.is-empty .detail-media { aspect-ratio: 16 / 7; }
    .detail-figure.is-empty .ph img { width: 64px; height: 64px; }

    .article-body { font-size: 17px; line-height: 1.8; }

    .tags { margin-top: 36px; padding-top: 20px; }

    .share { margin-top: 32px; padding: 20px; border-radius: 20px; }
    .share-list { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .comments { margin-top: 44px; padding-top: 32px; }
    .comments-title { font-size: 26px; }

    .comment-form { padding: 16px; border-radius: 20px; }
    .comment-form .btn { width: 100%; }

    .login-prompt { padding: 20px; border-radius: 20px; }
    .login-prompt-actions { width: 100%; }
    .login-prompt-actions .btn { flex: 1 1 0; }

    .comment-item { grid-template-columns: 36px minmax(0, 1fr); gap: 12px; padding: 20px 0; }
    .comment-item .avatar { width: 36px; height: 36px; font-size: 14px; }

    .related { margin: 0 8px 44px; padding: 44px 0 52px; }
    .related-head { margin-bottom: 28px; }
    .section-title { font-size: 28px; }

    .card { flex-direction: column; gap: 0; }

    .card .media {
        flex: none;
        aspect-ratio: 16 / 10;
        min-height: 0;
    }

    .card-body { padding: 18px 8px 6px; }
    .card .title { font-size: 20px; }

    .footer-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 28px 24px; padding-top: 44px; }
}

@media (max-width: 479px) {
    .footer-grid { grid-template-columns: minmax(0, 1fr); }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }

    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }

    .js .reveal { opacity: 1; transform: none; }

    .card:hover,
    .card:hover .media img,
    .back-link:hover span { transform: none; }
}
    </style>
</head>
<body>

    @php
        $str = \Illuminate\Support\Str::class;

        $plain = trim(strip_tags($article->content));
        $wordCount = $plain === '' ? 0 : count(preg_split('/\s+/u', $plain, -1, PREG_SPLIT_NO_EMPTY));
        $readMinutes = max(1, (int) ceil($wordCount / 200));

        $url = route('articles.show', $article);
        $shareWa = 'https://wa.me/?text=' . rawurlencode($article->title . ' - ' . $url);
        $shareFb = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($url);
        $shareX = 'https://twitter.com/intent/tweet?url=' . rawurlencode($url) . '&text=' . rawurlencode($article->title);

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
        $footerCategories = \App\Models\Category::orderBy('name')->get();
    @endphp

    <div class="progress" id="progress" aria-hidden="true"></div>

    <a class="skip-link" href="#konten">Lewati ke konten utama</a>

    @include('components.navbar-public')

    <main id="konten">
        <article class="detail">

            <nav class="crumbs" aria-label="Breadcrumb">
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a></li>
                    <li><span aria-current="page">{{ $article->title }}</span></li>
                </ol>
            </nav>

            <header class="detail-head">
                <a class="detail-cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

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
                        <div class="ph">
                            <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                        </div>
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
                        <a class="share-btn" href="{{ $shareWa }}" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21l1.65-4.9A8.5 8.5 0 1 1 8 19.4L3 21z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1.2-1.4-2-1-.9.7a3.6 3.6 0 0 1-1.6-1.6l.7-.9-1-2L9 9.5z"/></svg>
                            WhatsApp
                        </a>
                        <a class="share-btn" href="{{ $shareFb }}" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z"/></svg>
                            Facebook
                        </a>
                        <a class="share-btn" href="{{ $shareX }}" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4l14 16M19 4L5 20"/></svg>
                            X
                        </a>
                        <button class="share-btn" type="button" id="copy-link" data-url="{{ $url }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 14a4 4 0 0 0 5.66 0l3-3a4 4 0 0 0-5.66-5.66l-1 1"/><path d="M14 10a4 4 0 0 0-5.66 0l-3 3a4 4 0 0 0 5.66 5.66l1-1"/></svg>
                            Salin tautan
                        </button>
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

                <a class="back-link" href="/">
                    <span aria-hidden="true">&larr;</span> Kembali ke Beranda
                </a>

            </div>
        </article>

        @if ($related->count())
            <section class="related" aria-labelledby="related-title">
                <div class="wrap">
                    <div class="related-head">
                        <h2 class="section-title" id="related-title">{{ $relatedTitle }}</h2>
                        <a class="more-link" href="{{ route('articles.index') }}">
                            Lihat semua berita
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                        </a>
                    </div>

                    <div class="cards cards--{{ $related->count() }}">
                        @foreach ($related as $item)
                            <article class="card reveal">
                                <a class="media" href="{{ route('articles.show', $item) }}" tabindex="-1" aria-hidden="true">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="" loading="lazy">
                                    @else
                                        <div class="ph">
                                            <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                        </div>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <a class="cat" href="{{ route('kategori.show', $item->category) }}">{{ $item->category->name }}</a>

                                    <h3 class="title">
                                        <a href="{{ route('articles.show', $item) }}">{{ $item->title }}</a>
                                    </h3>

                                    <p class="card-excerpt">{{ $str::limit(strip_tags($item->content), 110) }}</p>

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
                    @foreach ($footerCategories as $cat)
                        <li><a href="{{ route('kategori.show', $cat) }}">{{ $cat->name }}</a></li>
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
    var bar = document.getElementById('progress');
    var body = document.querySelector('.article-body');

    if (bar && body) {
        var ticking = false;

        var update = function () {
            ticking = false;
            var rect = body.getBoundingClientRect();
            var total = rect.height - window.innerHeight * 0.5;
            var done = Math.min(Math.max(-rect.top + window.innerHeight * 0.4, 0), Math.max(total, 1));
            bar.style.transform = 'scaleX(' + (total > 0 ? done / total : 0) + ')';
        };

        var request = function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(update);
        };

        update();
        window.addEventListener('scroll', request, { passive: true });
        window.addEventListener('resize', request);
    }

    var copyBtn = document.getElementById('copy-link');
    var status = document.getElementById('share-status');

    if (copyBtn) {
        var statusTimer = null;

        var setStatus = function (text, isError) {
            if (!status) return;
            status.textContent = text;
            status.classList.toggle('is-error', !!isError);
            clearTimeout(statusTimer);
            statusTimer = setTimeout(function () {
                status.textContent = '';
                status.classList.remove('is-error');
            }, 2500);
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

        var report = function (ok) {
            if (ok) {
                setStatus('Tautan berita disalin.', false);
            } else {
                setStatus('Gagal menyalin tautan.', true);
            }
        };

        copyBtn.addEventListener('click', function () {
            var url = copyBtn.getAttribute('data-url');

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(
                    function () { report(true); },
                    function () { report(fallbackCopy(url)); }
                );
            } else {
                report(fallbackCopy(url));
            }
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