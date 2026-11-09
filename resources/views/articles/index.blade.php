<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Berita - RuangKabar</title>

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

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    font-family: var(--sans);
    background: var(--ivory);
    color: var(--text);
    overflow-x: clip;
    overflow-wrap: break-word;
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
}

a { color: inherit; }

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

.skip-link:focus { top: 12px; }

.wrap {
    max-width: var(--wrap);
    margin: 0 auto;
    padding: 0 var(--pad);
}

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

.site-header.is-scrolled .bar { box-shadow: 0 14px 36px -10px rgba(24, 60, 54, 0.6); }

.brand {
    display: inline-block;
    padding: 8px 0;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--ivory);
    text-decoration: none;
}

.brand span { color: var(--gold); }

.nav {
    display: flex;
    flex: 1;
    justify-content: center;
    transition: opacity var(--t-fast) ease-out, visibility 0s;
}

.bar.is-searching .nav {
    opacity: 0;
    visibility: hidden;
    transition: opacity var(--t-fast) ease-out, visibility 0s linear var(--t-fast);
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
    gap: 6px;
}

.icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    padding: 0;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.1);
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    transition: background var(--t-fast) ease-out;
}

.icon-btn:hover { background: rgba(250, 248, 243, 0.2); }
.icon-btn svg { width: 18px; height: 18px; }

.icon-btn .i-close,
.bar.is-searching .icon-btn .i-search { display: none; }

.bar.is-searching .icon-btn .i-close { display: block; }

.search-wrap {
    position: relative;
    display: flex;
    align-items: center;
    --sw: 340px;
}

.nav-search {
    position: absolute;
    top: 50%;
    right: calc(100% + 8px);
    z-index: 2;
    width: 0;
    height: 44px;
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    background: var(--white);
    border-radius: 999px;
    transform: translateY(-50%);
    transition: width var(--t-ui) var(--ease), opacity var(--t-fast) ease-out, visibility 0s linear var(--t-ui);
}

.nav-search:focus-within { box-shadow: 0 0 0 2px var(--gold); }

.bar.is-searching .nav-search {
    width: var(--sw);
    opacity: 1;
    visibility: visible;
    transition: width var(--t-ui) var(--ease), opacity var(--t-fast) ease-out, visibility 0s;
}

.nav-search-field {
    display: flex;
    align-items: center;
    gap: 10px;
    width: var(--sw);
    height: 44px;
    padding: 0 4px 0 16px;
}

.nav-search-field > svg {
    flex: none;
    width: 18px;
    height: 18px;
    color: var(--forest);
}

.nav-search input {
    flex: 1;
    min-width: 0;
    height: 40px;
    padding: 0;
    font-family: var(--body);
    font-size: 15px;
    color: var(--emerald);
    background: transparent;
    border: 0;
}

.nav-search input:focus { outline: none; }
.nav-search input::placeholder { color: var(--text-soft); }
.nav-search .btn { height: 36px; padding: 0 18px; font-size: 13px; }

.user-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 12px 5px 5px;
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.15);
    border-radius: 999px;
}

.user-chip-avatar {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    font-family: var(--sans);
    font-size: 11px;
    font-weight: 800;
    color: var(--emerald);
    background: var(--gold);
    border-radius: 50%;
    text-transform: uppercase;
}

.user-chip-name {
    max-width: 130px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    color: var(--ivory);
}

.actions-sep {
    width: 1px;
    height: 18px;
    flex-shrink: 0;
    background: rgba(250, 248, 243, 0.18);
    margin: 0 6px;
}

.actions a.link,
.actions .link-btn {
    padding: 8px 6px;
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
.actions .link-btn:hover { color: var(--ivory); }

.actions .link-btn--logout { font-size: 13px; color: rgba(250, 248, 243, 0.52); }
.actions .link-btn--logout:hover { color: rgba(250, 248, 243, 0.85); }

.actions-form { display: contents; }

.btn-dash {
    display: inline-flex;
    align-items: center;
    height: 36px;
    padding: 0 16px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    color: var(--ivory);
    background: rgba(250, 248, 243, 0.12);
    border: 1px solid rgba(250, 248, 243, 0.2);
    border-radius: 10px;
    text-decoration: none;
    cursor: pointer;
    transition: background var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.btn-dash:hover {
    background: rgba(250, 248, 243, 0.22);
    border-color: rgba(250, 248, 243, 0.35);
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
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, transform 120ms ease-out;
}

.btn:hover { background: var(--emerald); }
.btn:active { transform: scale(0.97); }

.btn--ivory { height: 40px; padding: 0 20px; color: var(--emerald); background: var(--ivory); }
.btn--ivory:hover { background: var(--sand); }

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

.btn svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }
.btn:hover svg { transform: translateX(3px); }

.page-head {
    position: relative;
    overflow: hidden;
    margin: 8px 12px 0;
    padding: 170px 0 56px;
    color: var(--ivory);
    background: var(--emerald);
    border-radius: var(--r-lg);
}

.page-head::before {
    content: "";
    position: absolute;
    top: -150px;
    right: -110px;
    width: 460px;
    height: 460px;
    background: var(--forest);
    opacity: 0.45;
    border-radius: 50%;
}

.page-head-inner {
    position: relative;
    z-index: 1;
    animation: rise var(--t-enter) var(--ease) both;
}

.page-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
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

.page-label::before {
    content: "";
    width: 8px;
    height: 8px;
    background: var(--gold);
    border-radius: 50%;
}

.page-title {
    max-width: 900px;
    margin: 0 0 14px;
    font-family: var(--serif);
    font-size: clamp(36px, 5vw, 64px);
    font-weight: 600;
    line-height: 1.1;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.page-lead {
    max-width: 620px;
    margin: 0 0 28px;
    font-family: var(--body);
    font-size: 17px;
    line-height: 1.7;
    color: var(--on-dark);
}

.page-clear {
    display: inline-flex;
    align-items: center;
    height: 40px;
    margin: 0 0 24px;
    padding: 0 18px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--ivory);
    text-decoration: none;
    border: 1px solid rgba(250, 248, 243, 0.35);
    border-radius: 999px;
    transition: background var(--t-fast) ease-out;
}

.page-clear:hover { background: rgba(250, 248, 243, 0.14); }

.chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.chips a {
    display: inline-flex;
    align-items: center;
    height: 40px;
    padding: 0 18px;
    white-space: nowrap;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    color: var(--on-dark);
    text-decoration: none;
    background: rgba(250, 248, 243, 0.1);
    border: 1px solid rgba(250, 248, 243, 0.18);
    border-radius: 999px;
    transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out;
}

.chips a:hover { color: var(--ivory); background: rgba(250, 248, 243, 0.2); }

.chips a.is-active {
    color: var(--emerald);
    background: var(--gold);
    border-color: var(--gold);
}

.listing { padding: 56px 0 88px; }

.listing-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px 20px;
    margin-bottom: 28px;
}


.result-info {
    margin: 0;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.result-info strong { font-weight: 600; color: var(--text); }

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

.cat {
    position: relative;
    z-index: 2;
    display: inline-block;
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

.title,
.feature-title {
    margin: 0;
    font-weight: 700;
    letter-spacing: -0.015em;
    overflow-wrap: anywhere;
}

.title { font-family: var(--sans); font-size: 20px; line-height: 1.28; margin-bottom: 10px; }

.title a,
.feature-title a {
    color: var(--emerald);
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}

.stretch::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 1;
}

.meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 2px 14px;
    margin-top: auto;
    font-family: var(--body);
    font-size: 13px;
    color: var(--text-soft);
}

.badge-draft {
    position: relative;
    z-index: 2;
    padding: 2px 10px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    color: var(--emerald);
    background: var(--sand);
    border-radius: 999px;
}

.manage {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 4px 18px;
    margin-top: 14px;
    padding-top: 10px;
    border-top: 1px solid var(--rule);
}

.manage form { margin: 0; }

.manage a,
.manage button {
    padding: 8px 0;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 700;
    color: var(--forest);
    text-decoration: none;
    background: none;
    border: 0;
    cursor: pointer;
}

.manage a:hover { text-decoration: underline; text-underline-offset: 3px; }
.manage .danger { color: #A3321F; }
.manage .danger:hover { text-decoration: underline; text-underline-offset: 3px; }

.feature {
    position: relative;
    display: grid;
    grid-template-columns: minmax(0, 7fr) minmax(0, 5fr);
    gap: 44px;
    align-items: center;
    margin-bottom: 32px;
    padding: 16px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: var(--r-lg);
    transition: box-shadow var(--t-ui) ease-out;
}

.feature .media { aspect-ratio: 16 / 11; border-radius: 20px; }

.feature-body { display: flex; flex-direction: column; align-items: flex-start; padding: 8px 24px 8px 0; }

.feature-title {
    margin-bottom: 14px;
    font-family: var(--serif);
    font-size: clamp(26px, 2.8vw, 38px);
    font-weight: 600;
    line-height: 1.18;
    letter-spacing: -0.01em;
}

.feature-excerpt {
    margin: 0 0 18px;
    font-family: var(--body);
    font-size: 16px;
    line-height: 1.75;
    color: var(--text-soft);
}

.feature .meta { margin-top: 0; margin-bottom: 22px; }

.feature-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--forest);
}

.feature-more svg { width: 16px; height: 16px; transition: transform var(--t-ui) var(--ease); }

.grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 12px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
    transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out;
}

.card .media { aspect-ratio: 4 / 3; }

.card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 20px 10px 10px;
}

.card-excerpt {
    margin: 0 0 16px;
    font-family: var(--body);
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
}

@media (hover: hover) {
    .card:hover,
    .feature:hover {
        box-shadow: 0 18px 36px -22px rgba(24, 60, 54, 0.4);
    }

    .card:hover { transform: translateY(-4px); }

    .card:hover .media img,
    .feature:hover .media img { transform: scale(1.03); }

    .card:hover .title a,
    .feature:hover .feature-title a { color: var(--forest); }

    .feature:hover .feature-more svg { transform: translateX(4px); }
}

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
    border: 1px solid var(--sand);
    border-radius: 999px;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.pager-btn { padding: 0 20px; }
.pager-num { min-width: 44px; padding: 0 8px; }

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

.pager-btn.is-disabled { color: var(--text-soft); background: transparent; opacity: 0.6; }

.pager-gap { padding: 0 4px; color: var(--text-soft); }

.pager-status {
    display: none;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}

.empty {
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
    max-width: 460px;
    margin: 0 auto;
    font-family: var(--body);
    font-size: 15px;
    line-height: 1.7;
    color: var(--text-soft);
}

.empty-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: 24px;
}

.empty .btn--ghost { border-color: rgba(24, 60, 54, 0.3); }

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

    .search-wrap { order: 9; margin-left: 2px; }

    .bar.is-searching .brand,
    .bar.is-searching .actions > :not(.search-wrap) {
        visibility: hidden;
        transition: visibility 0s linear var(--t-ui);
    }

    .page-head { padding: 160px 0 48px; }
    .listing { padding: 44px 0 72px; }

    .feature { grid-template-columns: minmax(0, 1fr); gap: 20px; }
    .feature-body { padding: 4px 8px 12px; }

    .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }

    .footer-grid { grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); }
    .footer-brand { grid-column: 1 / -1; }
}

@media (max-width: 719px) {
    :root { --pad: 20px; --r-lg: 22px; }

    .bar { padding: 4px 8px 4px 18px; gap: 0 12px; }
    .brand { font-size: 22px; }
    .actions { margin-left: auto; }
    .user-chip-name { display: none; }
    .nav-search input { font-size: 16px; }

    .nav {
        order: 3;
        flex-basis: 100%;
        justify-content: flex-start;
        padding-bottom: 8px;
    }

    .nav-links a { height: 36px; padding: 0 12px; }

    .page-head { margin: 6px 8px 0; padding: 176px 0 36px; }
    .page-head::before { width: 320px; height: 320px; top: -120px; right: -120px; }
    .page-lead { font-size: 16px; }

    .chips {
        flex-wrap: nowrap;
        margin: 0 calc(var(--pad) * -1);
        padding: 0 var(--pad) 4px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .chips::-webkit-scrollbar { display: none; }

    .listing { padding: 32px 0 56px; }

    .feature { padding: 10px; border-radius: 22px; }
    .feature .media { aspect-ratio: 4 / 3; }

    .grid { grid-template-columns: minmax(0, 1fr); gap: 18px; }

    .pager-pages { display: none; }
    .pager-status { display: block; order: 0; width: 100%; text-align: center; }
    .pager { margin-top: 40px; }
    .pager-btn { flex: 1 1 0; padding: 0 12px; }

    .empty { padding: 48px 20px; }

    .footer-grid { grid-template-columns: minmax(0, 1fr); padding-top: 40px; }
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
    .feature:hover .media img,
    .feature:hover .feature-more svg { transform: none; }
}
    </style>
</head>
<body>

    @php
        $str = \Illuminate\Support\Str::class;
        $categories = \App\Models\Category::orderBy('name')->get();
        $isPaginator = $articles instanceof \Illuminate\Contracts\Pagination\Paginator;
        $items = collect($isPaginator ? $articles->items() : $articles);
        $total = $isPaginator && method_exists($articles, 'total') ? $articles->total() : $items->count();
        $featured = $items->first();
        $rest = $items->slice(1)->values();
        $searchTerm = trim((string) ($search ?? request('search')));
        $user = auth()->user();
        $canCreate = $user && in_array($user->role, ['admin', 'penulis'], true);
        $canManage = function ($article) use ($user) {
            return $user && ($user->role === 'admin' || ($user->role === 'penulis' && (int) $article->user_id === (int) $user->id));
        };
    @endphp

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
                    <div class="search-wrap" id="search-wrap">
                        <form class="nav-search" id="nav-search" action="{{ route('articles.index') }}" method="GET" role="search">
                            <div class="nav-search-field">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                                <label class="sr-only" for="nav-q">Cari berita</label>
                                <input id="nav-q" type="search" name="search" placeholder="Cari berita" value="{{ request('search') }}" autocomplete="off">
                                <button class="btn" type="submit">Cari</button>
                            </div>
                        </form>

                        <button class="icon-btn" id="search-toggle" type="button" aria-label="Cari berita" aria-expanded="false" aria-controls="nav-search">
                            <svg class="i-search" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                            <svg class="i-close" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
                        </button>
                    </div>

                    @auth
                        <div class="user-chip">
                            <span class="user-chip-avatar" aria-hidden="true">{{ $str::upper($str::substr(auth()->user()->name, 0, 1)) }}</span>
                            <span class="user-chip-name">{{ auth()->user()->name }}</span>
                        </div>

                        <span class="actions-sep" aria-hidden="true"></span>

                        @if (auth()->user()->role === 'admin')
                            <a class="btn-dash" href="/admin/dashboard">Dashboard</a>
                        @elseif (auth()->user()->role === 'penulis')
                            <a class="btn-dash" href="/penulis/dashboard">Dashboard</a>
                        @else
                            <a class="btn-dash" href="/beranda">Akun Saya</a>
                        @endif

                        <form class="actions-form" action="/logout" method="POST">
                            @csrf
                            <button class="link-btn link-btn--logout" type="submit">Logout</button>
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
        <section class="page-head" aria-labelledby="page-title">
            <div class="wrap page-head-inner">
                <span class="page-label">BERITA</span>

                <h1 class="page-title" id="page-title">{{ $searchTerm !== '' ? 'Hasil Pencarian' : 'Semua Berita' }}</h1>

                <p class="page-lead">
                    @if ($searchTerm !== '')
                        Menampilkan {{ $total }} berita untuk &ldquo;{{ $searchTerm }}&rdquo;.
                    @else
                        Kabar terbaru dan terpercaya dari redaksi RuangKabar.
                    @endif
                </p>

                @if ($searchTerm !== '')
                    <a class="page-clear" href="{{ route('articles.index') }}">Hapus pencarian</a>
                @endif

                @if ($categories->count())
                    <ul class="chips" aria-label="Kategori berita">
                        <li><a class="is-active" href="{{ route('articles.index') }}" aria-current="page">Semua</a></li>
                        @foreach ($categories as $cat)
                            <li><a href="{{ route('kategori.show', $cat) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>

        <section class="listing" aria-label="Daftar berita">
            <div class="wrap">
                @if (session('success'))
                    <p class="notice" role="status">{{ session('success') }}</p>
                @endif

                @if ($items->isNotEmpty() || $canCreate)
                    <div class="listing-bar">
                        @if ($items->isNotEmpty())
                        <p class="result-info">
                            @if ($isPaginator && $articles->firstItem())
                                Menampilkan <strong>{{ $articles->firstItem() }}&ndash;{{ $articles->lastItem() }}</strong> dari <strong>{{ $total }}</strong> berita
                            @else
                                <strong>{{ $total }}</strong> berita
                            @endif
                        </p>
                        @endif

                        @if ($canCreate)
                            <a class="btn" href="{{ route('articles.create') }}">Tambah Artikel</a>
                        @endif
                    </div>
                @endif

                @if ($items->isNotEmpty())
                    @if ($featured)
                    <article class="feature reveal">
                            <a class="media" href="{{ route('articles.show', $featured) }}" tabindex="-1" aria-hidden="true">
                                @if ($featured->image)
                                    <img src="{{ asset('storage/' . $featured->image) }}" alt="" loading="lazy">
                                @else
                                    <div class="ph">RK</div>
                                @endif
                            </a>

                        <div class="feature-body">
                            <a class="cat" href="{{ route('kategori.show', $featured->category) }}">{{ $featured->category->name }}</a>

                            <h2 class="feature-title">
                                <a class="stretch" href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a>
                            </h2>

                            <p class="feature-excerpt">{{ $str::limit(strip_tags($featured->content), 220) }}</p>

                            <div class="meta">
                                <span>{{ $featured->user->name ?? 'Redaksi' }}</span>
                                @if ($featured->created_at)
                                    <time datetime="{{ $featured->created_at->toDateString() }}">{{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                                @if ($featured->status !== 'published')
                                    <span class="badge-draft">{{ ucfirst($featured->status) }}</span>
                                @endif
                            </div>

                            <span class="feature-more" aria-hidden="true">
                                Baca Selengkapnya
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                            </span>

                    @if ($canManage($featured))
                        <div class="manage">
                            <a href="{{ route('articles.edit', $featured) }}">Edit</a>
                            <form action="{{ route('articles.destroy', $featured) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="danger" type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif

                        </div>
                    </article>
                    @endif

                    @if ($rest->isNotEmpty())
                        <div class="grid">
                            @foreach ($rest as $article)
                            <article class="card reveal">
                            <a class="media" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                                @else
                                    <div class="ph">RK</div>
                                @endif
                            </a>

                                <div class="card-body">
                                    <a class="cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>

                                    <h3 class="title">
                                        <a class="stretch" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h3>

                                    <p class="card-excerpt">{{ $str::limit(strip_tags($article->content), 110) }}</p>

                            <div class="meta">
                                <span>{{ $article->user->name ?? 'Redaksi' }}</span>
                                @if ($article->created_at)
                                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                                @if ($article->status !== 'published')
                                    <span class="badge-draft">{{ ucfirst($article->status) }}</span>
                                @endif
                            </div>

                    @if ($canManage($article))
                        <div class="manage">
                            <a href="{{ route('articles.edit', $article) }}">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="danger" type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif

                                </div>
                            </article>
                            @endforeach
                        </div>
                    @endif

                @if ($isPaginator && $articles->hasPages())
                    @php
                        $current = $articles->currentPage();
                        $last = $articles->lastPage();
                        $window = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)->values();
                        $previous = null;
                    @endphp

                    <nav class="pager" aria-label="Navigasi halaman">
                        @if ($articles->onFirstPage())
                            <span class="pager-btn is-disabled" aria-disabled="true"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</span>
                        @else
                            <a class="pager-btn" href="{{ $articles->previousPageUrl() }}" rel="prev"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</a>
                        @endif

                        <ul class="pager-pages">
                            @foreach ($window as $page)
                                @if ($previous !== null && $page - $previous > 1)
                                    <li class="pager-gap" aria-hidden="true">&hellip;</li>
                                @endif

                                <li>
                                    @if ($page === $current)
                                        <span class="pager-num is-current" aria-current="page">{{ $page }}</span>
                                    @else
                                        <a class="pager-num" href="{{ $articles->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                                    @endif
                                </li>

                                @php $previous = $page; @endphp
                            @endforeach
                        </ul>

                        @if ($articles->hasMorePages())
                            <a class="pager-btn" href="{{ $articles->nextPageUrl() }}" rel="next">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></a>
                        @else
                            <span class="pager-btn is-disabled" aria-disabled="true">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></span>
                        @endif

                        <span class="pager-status">Halaman {{ $current }} dari {{ $last }}</span>
                    </nav>
                @endif
                @else
                    <div class="empty">
                        <strong>{{ $searchTerm !== '' ? 'Berita tidak ditemukan' : 'Belum ada berita' }}</strong>

                        <p>
                            @if ($searchTerm !== '')
                                Tidak ada berita yang cocok dengan &ldquo;{{ $searchTerm }}&rdquo;. Coba gunakan kata kunci lain.
                            @else
                                Berita akan tampil di halaman ini setelah dipublikasikan.
                            @endif
                        </p>

                        <div class="empty-actions">
                            @if ($searchTerm !== '')
                                <a class="btn" href="{{ route('articles.index') }}">Lihat semua berita</a>
                            @endif
                            <a class="btn btn--ghost" href="/">Kembali ke Beranda</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
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
                    <li><a href="{{ route('articles.index') }}">Semua Berita</a></li>
                    @foreach ($categories as $cat)
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
    var header = document.getElementById('site-header');

    if (header) {
        var onScroll = function () {
            header.classList.toggle('is-scrolled', window.scrollY > 8);
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    var navBar = document.querySelector('.site-header .bar');
    var sWrap = document.getElementById('search-wrap');
    var sToggle = document.getElementById('search-toggle');
    var sForm = document.getElementById('nav-search');
    var sInput = document.getElementById('nav-q');

    if (navBar && sWrap && sToggle && sForm && sInput) {
        var mq = window.matchMedia('(max-width: 1023px)');

        var sizeSearch = function () {
            var wr = sWrap.getBoundingClientRect();
            var limit;

            if (mq.matches) {
                var br = navBar.getBoundingClientRect();
                limit = wr.left - br.left - parseFloat(getComputedStyle(navBar).paddingLeft) - 8;
            } else {
                var brand = navBar.querySelector('.brand');
                limit = wr.left - brand.getBoundingClientRect().right - 24;
            }

            sWrap.style.setProperty('--sw', Math.max(160, Math.min(limit, mq.matches ? 480 : 340)) + 'px');
        };

        var isOpen = function () {
            return navBar.classList.contains('is-searching');
        };

        var openSearch = function () {
            sizeSearch();
            navBar.classList.add('is-searching');
            sToggle.setAttribute('aria-expanded', 'true');
            sToggle.setAttribute('aria-label', 'Tutup pencarian');
            requestAnimationFrame(function () { sInput.focus({ preventScroll: true }); });
        };

        var closeSearch = function (returnFocus) {
            navBar.classList.remove('is-searching');
            sToggle.setAttribute('aria-expanded', 'false');
            sToggle.setAttribute('aria-label', 'Cari berita');
            if (returnFocus) sToggle.focus();
        };

        sToggle.addEventListener('click', function () {
            if (isOpen()) { closeSearch(true); } else { openSearch(); }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen()) closeSearch(true);
        });

        document.addEventListener('click', function (e) {
            if (isOpen() && !sWrap.contains(e.target)) closeSearch(false);
        });

        window.addEventListener('resize', function () {
            if (isOpen()) sizeSearch();
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