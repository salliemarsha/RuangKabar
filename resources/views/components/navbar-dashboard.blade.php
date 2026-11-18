
@php
    $hdUser = auth()->user();

    $hdInitial = $hdUser
        ? mb_strtoupper(mb_substr($hdUser->name ?? '', 0, 1))
        : '';

    $hdPhotoUrl = ($hdUser && $hdUser->profile_photo)
        ? asset('storage/' . $hdUser->profile_photo)
        : null;

    $hdRole = $hdUser
        ? ([
            'admin' => 'Admin',
            'penulis' => 'Penulis',
            'pengguna' => 'Pengguna',
        ][$hdUser->role] ?? ucfirst($hdUser->role))
        : '';

    $hdPanel = $hdUser
        ? ([
            'admin' => 'Panel Admin',
            'penulis' => 'Panel Penulis',
        ][$hdUser->role] ?? 'Area Pengguna')
        : '';

    $hdHome = $hdUser
        ? match ($hdUser->role) {
            'admin' => '/admin/dashboard',
            'penulis' => '/penulis/dashboard',
            default => '/beranda',
        }
        : '/';

    $hdNotifications = $hdUser
        ? $hdUser->notifications()->latest()->take(5)->get()
        : collect();

    $hdUnreadCount = $hdUser
        ? $hdUser->unreadNotifications()->count()
        : 0;
@endphp

<style>
    #dash-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;
    }

    .hd-notification {
        position: relative;
        z-index: 1001;
    }

    .hd-notification__toggle {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        padding: 0;
        color: var(--ivory);
        background: rgba(250, 248, 243, .08);
        border: 1px solid rgba(250, 248, 243, .2);
        border-radius: 12px;
        cursor: pointer;
        pointer-events: auto;
        transition: background .2s ease, border-color .2s ease;
    }

    .hd-notification__toggle:hover,
    .hd-notification.is-open .hd-notification__toggle {
        color: var(--ivory);
        background: rgba(250, 248, 243, .16);
        border-color: rgba(250, 248, 243, .4);
    }

    .hd-notification__toggle svg {
        width: 21px;
        height: 21px;
        pointer-events: none;
    }

    .hd-notification__badge {
        position: absolute;
        top: -5px;
        right: -5px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 19px;
        height: 19px;
        padding: 0 5px;
        color: #fff;
        background: #c94b45;
        border: 2px solid var(--emerald);
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        pointer-events: none;
    }

    .hd-notification__dropdown {
        position: absolute;
        top: calc(100% + 13px);
        right: 0;
        z-index: 10001;
        width: min(360px, calc(100vw - 32px));
        overflow: hidden;
        color: var(--text);
        background: var(--ivory);
        border: 1px solid rgba(24, 60, 54, .12);
        border-radius: 16px;
        box-shadow: 0 16px 45px rgba(0, 0, 0, .18);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(8px);
        transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
    }

    .hd-notification.is-open .hd-notification__dropdown {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0);
    }

    .hd-notification__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 17px;
        border-bottom: 1px solid rgba(24, 60, 54, .1);
    }

    .hd-notification__title {
        margin: 0;
        color: var(--emerald);
        font-size: 14px;
        font-weight: 750;
    }

    .hd-notification__list {
        max-height: 350px;
        overflow-y: auto;
        pointer-events: auto;
    }

    .hd-notification__row {
        display: flex;
        align-items: stretch;
        border-bottom: 1px solid rgba(24, 60, 54, .07);
    }

    .hd-notification__read-form {
        flex: 1;
        min-width: 0;
        margin: 0;
    }

    .hd-notification__item {
        display: flex;
        flex-direction: column;
        gap: 6px;
        width: 100%;
        padding: 14px 17px;
        color: inherit;
        background: transparent;
        border: 0;
        text-align: left;
        cursor: pointer;
        pointer-events: auto;
        transition: background .2s ease;
    }

    .hd-notification__item:hover {
        background: rgba(24, 60, 54, .05);
    }

    .hd-notification__item.is-unread {
        background: rgba(95, 174, 109, .09);
    }

    .hd-notification__message {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        font-size: 12px;
        line-height: 1.55;
    }

    .hd-notification__dot {
        flex: 0 0 7px;
        width: 7px;
        height: 7px;
        margin-top: 5px;
        background: transparent;
        border-radius: 50%;
    }

    .hd-notification__item.is-unread .hd-notification__dot {
        background: #5fae6d;
    }

    .hd-notification__meta {
        padding-left: 16px;
        color: #89918b;
        font-size: 10px;
    }

    .hd-notification__delete-form {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0 12px 0 0;
        pointer-events: auto;
    }

    .hd-notification__delete {
        position: relative;
        z-index: 2;
        padding: 8px 4px;
        color: #a3392c;
        background: none;
        border: 0;
        font-family: inherit;
        font-size: 11px;
        font-weight: 650;
        cursor: pointer;
        pointer-events: auto;
    }

    .hd-notification__delete:hover {
        text-decoration: underline;
    }

    .hd-notification__footer {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 17px;
        background: rgba(24, 60, 54, .025);
        border-top: 1px solid rgba(24, 60, 54, .1);
        pointer-events: auto;
    }

    .hd-notification__footer form {
        display: flex;
        margin: 0;
        pointer-events: auto;
    }

    .hd-notification__action {
        position: relative;
        z-index: 2;
        padding: 8px 2px;
        background: none;
        border: 0;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        pointer-events: auto;
    }

    .hd-notification__action--read {
        color: var(--emerald);
    }

    .hd-notification__action--delete {
        color: #a3392c;
    }

    .hd-notification__action:hover {
        text-decoration: underline;
    }

    .hd-notification__empty {
        padding: 30px 18px;
        color: #89918b;
        font-size: 12px;
        text-align: center;
    }

    .hd-notification__empty svg {
        display: block;
        width: 27px;
        height: 27px;
        margin: 0 auto 10px;
        opacity: .55;
    }

    @media (max-width: 520px) {
        .hd-notification__dropdown {
            position: fixed;
            top: calc(var(--hd-h) + 3px);
            right: 12px;
        }

        .hd-notification__toggle {
            width: 38px;
            height: 38px;
        }

        .hd-notification__footer {
            padding: 13px;
        }

        .hd-notification__action {
            font-size: 10px;
        }
    }
</style>

<header class="dash-header" id="dash-header">
    <div class="hd-left">
        <button class="hd-toggle" id="sb-toggle" type="button" aria-controls="sidebar" aria-expanded="true" aria-label="Ciutkan sidebar">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <path d="M3 6h14M3 10h14M3 14h14"/>
            </svg>
        </button>

        <a class="hd-brand" href="{{ $hdHome }}" aria-label="RuangKabar, ke dashboard">
            <span class="hd-logo">
                <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="" width="46" height="46">
            </span>

            <span class="hd-brand__text">
                <span class="hd-brand__name">Ruang<span>Kabar</span></span>
                <span class="hd-brand__sub">{{ $hdPanel }}</span>
            </span>
        </a>
    </div>

    @if ($hdUser)
        <div class="hd-right">
            <div class="hd-notification" id="hd-notification">
                <button
                    class="hd-notification__toggle"
                    id="hd-notification-toggle"
                    type="button"
                    aria-label="Notifikasi"
                    aria-expanded="false"
                    aria-controls="hd-notification-dropdown"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>

                    @if ($hdUnreadCount > 0)
                        <span class="hd-notification__badge">
                            {{ $hdUnreadCount > 99 ? '99+' : $hdUnreadCount }}
                        </span>
                    @endif
                </button>

                <div class="hd-notification__dropdown" id="hd-notification-dropdown">
                    <div class="hd-notification__head">
                        <h3 class="hd-notification__title">Notifikasi</h3>
                    </div>

                    <div class="hd-notification__list">
                        @forelse ($hdNotifications as $notification)
                            <div class="hd-notification__row">
                                <form
                                    class="hd-notification__read-form"
                                    action="{{ route('notifications.read', $notification->id) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        class="hd-notification__item {{ $notification->unread() ? 'is-unread' : '' }}"
                                        type="submit"
                                    >
                                        <span class="hd-notification__message">
                                            <span class="hd-notification__dot"></span>

                                            <span>
                                                {{ $notification->data['message'] ?? 'Ada notifikasi baru.' }}

                                                @if (!empty($notification->data['article_title']))
                                                    <strong>{{ $notification->data['article_title'] }}</strong>
                                                @endif
                                            </span>
                                        </span>

                                        <span class="hd-notification__meta">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </button>
                                </form>

                                <form
                                    class="hd-notification__delete-form"
                                    action="{{ route('notifications.destroy', $notification->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus notifikasi ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="hd-notification__delete" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="hd-notification__empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                                    <path d="M10 21h4"/>
                                </svg>

                                Belum ada notifikasi.
                            </div>
                        @endforelse
                    </div>

                    @if ($hdNotifications->isNotEmpty())
                        <div class="hd-notification__footer">
                            <form action="{{ route('notifications.read-all') }}" method="POST">
                                @csrf

                                <button class="hd-notification__action hd-notification__action--read" type="submit">
                                    Tandai semua dibaca
                                </button>
                            </form>

                            <form
                                action="{{ route('notifications.destroy-all') }}"
                                method="POST"
                                onsubmit="return confirm('Hapus seluruh riwayat notifikasi?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="hd-notification__action hd-notification__action--delete" type="submit">
                                    Hapus semua
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <a class="hd-user" href="{{ route('account.settings') }}" aria-label="Pengaturan akun {{ $hdUser->name }}">
                <span class="hd-avatar" aria-hidden="true">
                    @if ($hdPhotoUrl)
                        <img src="{{ $hdPhotoUrl }}" alt="">
                    @else
                        {{ $hdInitial }}
                    @endif
                </span>

                <span class="hd-user__text">
                    <span class="hd-user__name">{{ $hdUser->name }}</span>
                    <span class="hd-user__role">{{ $hdRole }}</span>
                </span>
            </a>

            <form class="hd-form" action="/logout" method="POST">
                @csrf

                <button class="hd-logout" type="submit" aria-label="Logout">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9 4H5v16h4M16 8l4 4-4 4M20 12H9"/>
                    </svg>

                    <span class="hd-logout__text">Logout</span>
                </button>
            </form>
        </div>
    @endif
</header>

<script>
    (function () {
        function initNotificationDropdown() {
            const wrapper = document.getElementById('hd-notification');
            const toggle = document.getElementById('hd-notification-toggle');

            if (!wrapper || !toggle || wrapper.dataset.initialized === 'true') {
                return;
            }

            wrapper.dataset.initialized = 'true';

            toggle.addEventListener('click', function (event) {
                event.stopPropagation();

                const isOpen = wrapper.classList.toggle('is-open');

                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            document.addEventListener('click', function (event) {
                if (!wrapper.contains(event.target)) {
                    wrapper.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    wrapper.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initNotificationDropdown);
        } else {
            initNotificationDropdown();
        }
    })();
</script>
