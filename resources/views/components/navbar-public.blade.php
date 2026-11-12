@php
    $navUser = auth()->user();
    $navRole = $navUser ? $navUser->role : null;
    $navDashUrl = match ($navRole) {
        'admin' => '/admin/dashboard',
        'penulis' => '/penulis/dashboard',
        default => '/beranda',
    };
    $navDashLabel = in_array($navRole, ['admin', 'penulis'], true) ? 'Dashboard' : 'Akun Saya';
    $navHomeActive = request()->is('/');
    $navNewsActive = request()->routeIs('articles.*') || request()->routeIs('kategori.*');
@endphp

<style>
    .rk-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        flex: none;
        text-decoration: none;
        color: #FAF8F3;
    }

    .rk-brand__mark {
        display: block;
        width: 44px;
        height: 44px;
        flex: none;
    }

    .rk-brand__name {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        font-size: 23px;
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1;
        color: #FAF8F3;
    }

    .rk-brand__name span {
        color: #B99A64;
    }

    .rk-nav {
        --rk-emerald: #183C36;
        --rk-forest: #376B5C;
        --rk-gold: #B99A64;
        --rk-ivory: #FAF8F3;
        --rk-on-dark: rgba(250, 248, 243, 0.8);
        --rk-line: rgba(250, 248, 243, 0.14);
        position: sticky;
        top: 0;
        z-index: 50;
        padding: 12px 0 0;
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        pointer-events: none;
    }

    .rk-nav *,
    .rk-nav *::before,
    .rk-nav *::after {
        box-sizing: border-box;
    }

    .rk-nav__wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .rk-nav__bar {
        position: relative;
        display: flex;
        align-items: center;
        gap: 28px;
        min-height: 72px;
        padding: 0 14px 0 20px;
        background: var(--rk-emerald);
        border: 1px solid rgba(250, 248, 243, 0.1);
        border-radius: 20px;
        box-shadow: 0 10px 28px -16px rgba(24, 60, 54, 0.55);
        pointer-events: auto;
        transition: box-shadow 300ms ease-out;
    }

    .rk-nav.is-scrolled .rk-nav__bar {
        box-shadow: 0 16px 36px -12px rgba(24, 60, 54, 0.65);
    }

    .rk-nav__panel {
        display: contents;
    }

    .rk-nav__menu {
        display: flex;
        flex: 1;
        justify-content: center;
    }

    .rk-nav__list {
        display: flex;
        gap: 6px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .rk-nav__link {
        position: relative;
        display: inline-flex;
        align-items: center;
        height: 42px;
        padding: 0 18px;
        font-size: 14px;
        font-weight: 600;
        color: var(--rk-on-dark);
        text-decoration: none;
        border-radius: 12px;
        transition: color 200ms ease-out, background 200ms ease-out;
    }

    .rk-nav__link::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 5px;
        width: 18px;
        height: 3px;
        background: var(--rk-gold);
        border-radius: 2px;
        transform: translateX(-50%) scaleX(0);
        transition: transform 300ms cubic-bezier(0.22, 1, 0.36, 1);
    }

    .rk-nav__link:hover {
        color: var(--rk-ivory);
        background: rgba(250, 248, 243, 0.08);
    }

    .rk-nav__link.is-current {
        color: var(--rk-ivory);
        background: rgba(250, 248, 243, 0.12);
    }

    .rk-nav__link.is-current::after {
        transform: translateX(-50%) scaleX(1);
    }

    .rk-nav__actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: none;
    }

    .rk-nav__chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        max-width: 190px;
        padding: 5px 14px 5px 5px;
        background: rgba(250, 248, 243, 0.08);
        border: 1px solid var(--rk-line);
        border-radius: 999px;
    }

    .rk-nav__avatar {
        display: flex;
        flex: none;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        font-size: 12px;
        font-weight: 800;
        color: var(--rk-emerald);
        background: var(--rk-gold);
        border-radius: 50%;
    }

    .rk-nav__name {
        overflow: hidden;
        font-size: 13px;
        font-weight: 600;
        color: var(--rk-ivory);
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .rk-nav__sep {
        flex: none;
        width: 1px;
        height: 20px;
        background: var(--rk-line);
    }

    .rk-nav__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 42px;
        padding: 0 20px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
        border-radius: 12px;
        transition: background 200ms ease-out, border-color 200ms ease-out, color 200ms ease-out, transform 120ms ease-out;
    }

    .rk-nav__btn:active {
        transform: scale(0.97);
    }

    .rk-nav__btn--ghost {
        color: var(--rk-ivory);
        background: transparent;
        border: 1px solid rgba(250, 248, 243, 0.32);
    }

    .rk-nav__btn--ghost:hover {
        background: rgba(250, 248, 243, 0.1);
        border-color: rgba(250, 248, 243, 0.55);
    }

    .rk-nav__btn--gold {
        color: var(--rk-emerald);
        background: var(--rk-gold);
        border: 1px solid var(--rk-gold);
    }

    .rk-nav__btn--gold:hover {
        background: #CBAF7C;
        border-color: #CBAF7C;
    }

    .rk-nav__btn--text {
        padding: 0 10px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(250, 248, 243, 0.6);
        background: none;
        border: 0;
    }

    .rk-nav__btn--text:hover {
        color: var(--rk-ivory);
    }

    .rk-nav__form {
        display: flex;
        margin: 0;
    }

    .rk-nav__toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        margin-left: auto;
        padding: 0;
        color: var(--rk-ivory);
        background: rgba(250, 248, 243, 0.08);
        border: 1px solid var(--rk-line);
        border-radius: 12px;
        cursor: pointer;
        transition: background 200ms ease-out;
    }

    .rk-nav__toggle:hover {
        background: rgba(250, 248, 243, 0.16);
    }

    .rk-nav__toggle svg {
        width: 20px;
        height: 20px;
    }

    .rk-nav__toggle .rk-icon-close {
        display: none;
    }

    .rk-nav__toggle[aria-expanded="true"] .rk-icon-open {
        display: none;
    }

    .rk-nav__toggle[aria-expanded="true"] .rk-icon-close {
        display: block;
    }

    .rk-nav a:focus-visible,
    .rk-nav button:focus-visible,
    .rk-brand:focus-visible {
        outline: 2px solid var(--rk-gold, #B99A64);
        outline-offset: 3px;
    }

    @media (max-width: 1023px) {
        .rk-nav__wrap {
            padding: 0 24px;
        }

        .rk-nav__bar {
            gap: 16px;
        }

        .rk-nav__link {
            padding: 0 14px;
        }

        .rk-nav__chip {
            display: none;
        }
    }

    @media (max-width: 859px) {
        .rk-nav__bar {
            min-height: 68px;
            padding: 0 11px 0 16px;
        }

        .rk-nav__toggle {
            display: inline-flex;
        }

        .rk-nav__panel {
            display: flex;
            flex-direction: column;
            gap: 14px;
            flex-basis: 100%;
            padding: 8px 0 16px;
            order: 3;
        }

        .rk-nav.rk-js .rk-nav__bar {
            flex-wrap: nowrap;
        }

        .rk-nav.rk-js .rk-nav__panel {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            display: none;
            padding: 14px;
            background: var(--rk-emerald);
            border: 1px solid rgba(250, 248, 243, 0.1);
            border-radius: 20px;
            box-shadow: 0 24px 40px -16px rgba(24, 60, 54, 0.6);
        }

        .rk-nav.rk-js .rk-nav__panel.is-open {
            display: flex;
        }

        .rk-nav__bar {
            flex-wrap: wrap;
        }

        .rk-nav__menu {
            justify-content: stretch;
        }

        .rk-nav__list {
            flex-direction: column;
            width: 100%;
            gap: 4px;
        }

        .rk-nav__link {
            height: 48px;
            padding: 0 16px;
            font-size: 15px;
        }

        .rk-nav__link::after {
            left: 16px;
            bottom: 10px;
            transform: scaleX(0);
            transform-origin: left;
        }

        .rk-nav__link.is-current::after {
            transform: scaleX(1);
        }

        .rk-nav__actions {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid var(--rk-line);
        }

        .rk-nav__chip {
            display: inline-flex;
            max-width: none;
            padding: 8px 16px 8px 8px;
        }

        .rk-nav__sep {
            display: none;
        }

        .rk-nav__btn {
            width: 100%;
            height: 48px;
        }

        .rk-nav__form {
            width: 100%;
        }

        .rk-nav__btn--text {
            color: rgba(250, 248, 243, 0.7);
            border: 1px solid var(--rk-line);
        }
    }

    @media (max-width: 719px) {
        .rk-nav__wrap {
            padding: 0 16px;
        }

        .rk-brand__mark {
            width: 38px;
            height: 38px;
        }

        .rk-brand__name {
            font-size: 21px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .rk-nav *,
        .rk-nav *::before,
        .rk-nav *::after {
            transition: none !important;
        }
    }
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
    <symbol id="rk-mark" viewBox="350 345 575 570">
        <path fill="#FAF8F3" d="M468 356H697C810 356 886 430 886 530C886 620 830 680 768 700L918 905H775L625 712V640H660C725 640 762 595 762 540C762 485 725 443 660 443H538Z"/>
        <path fill="#5FA48C" d="M468 406L546 503H468Z"/>
        <path fill="#FAF8F3" d="M360 535H570L593 565H395V850C395 885 420 905 440 906C395 910 360 880 360 850Z"/>
        <rect x="441" y="611" width="139" height="101" rx="3" fill="#B99A64"/>
        <rect x="441" y="751" width="139" height="24" rx="3" fill="#5FA48C"/>
        <rect x="441" y="808" width="139" height="24" rx="3" fill="#FAF8F3"/>
        <rect x="441" y="851" width="139" height="24" rx="3" fill="#FAF8F3"/>
    </symbol>
</svg>

<header class="rk-nav" id="rk-nav">
    <div class="rk-nav__wrap">
        <div class="rk-nav__bar">
            <a class="rk-brand" href="/" aria-label="RuangKabar, ke beranda">
                <svg class="rk-brand__mark" aria-hidden="true" focusable="false"><use href="#rk-mark"/></svg>
                <span class="rk-brand__name">Ruang<span>Kabar</span></span>
            </a>

            <div class="rk-nav__panel" id="rk-nav-panel">
                <nav class="rk-nav__menu" aria-label="Menu utama">
                    <ul class="rk-nav__list">
                        <li><a class="rk-nav__link {{ $navHomeActive ? 'is-current' : '' }}" href="/" @if ($navHomeActive) aria-current="page" @endif>Beranda</a></li>
                        <li><a class="rk-nav__link {{ $navNewsActive ? 'is-current' : '' }}" href="{{ route('articles.index') }}" @if ($navNewsActive) aria-current="page" @endif>Berita</a></li>
                    </ul>
                </nav>

                <div class="rk-nav__actions">
                    @auth
                        <div class="rk-nav__chip">
                            <span class="rk-nav__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($navUser->name, 0, 1)) }}</span>
                            <span class="rk-nav__name">{{ $navUser->name }}</span>
                        </div>

                        <span class="rk-nav__sep" aria-hidden="true"></span>

                        <a class="rk-nav__btn rk-nav__btn--ghost" href="{{ $navDashUrl }}">{{ $navDashLabel }}</a>

                        <form class="rk-nav__form" action="/logout" method="POST">
                            @csrf
                            <button class="rk-nav__btn rk-nav__btn--text" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="rk-nav__btn rk-nav__btn--ghost" href="{{ route('login') }}">Login</a>
                        <a class="rk-nav__btn rk-nav__btn--gold" href="{{ route('register') }}">Daftar</a>
                    @endauth
                </div>
            </div>

            <button class="rk-nav__toggle" id="rk-nav-toggle" type="button" aria-expanded="false" aria-controls="rk-nav-panel" aria-label="Buka menu">
                <svg class="rk-icon-open" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 6h14M3 10h14M3 14h14"/></svg>
                <svg class="rk-icon-close" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
            </button>
        </div>
    </div>
</header>

<script>
    (function () {
        var nav = document.getElementById('rk-nav');
        var toggle = document.getElementById('rk-nav-toggle');
        var panel = document.getElementById('rk-nav-panel');
        if (!nav || !toggle || !panel) return;

        nav.classList.add('rk-js');

        function setOpen(open) {
            panel.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        }

        toggle.addEventListener('click', function () {
            setOpen(!panel.classList.contains('is-open'));
        });

        panel.addEventListener('click', function (e) {
            if (e.target.closest('a')) setOpen(false);
        });

        document.addEventListener('click', function (e) {
            if (panel.classList.contains('is-open') && !nav.contains(e.target)) setOpen(false);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && panel.classList.contains('is-open')) {
                setOpen(false);
                toggle.focus();
            }
        });

        window.matchMedia('(min-width: 860px)').addEventListener('change', function (e) {
            if (e.matches) setOpen(false);
        });

        var onScroll = function () {
            nav.classList.toggle('is-scrolled', window.scrollY > 8);
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>