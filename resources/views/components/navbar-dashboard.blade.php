@php
    $hdUser = auth()->user();
    $hdInitial = mb_strtoupper(mb_substr($hdUser->name, 0, 1));
    $hdRole = ['admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pengguna'][$hdUser->role] ?? ucfirst($hdUser->role);
    $hdPanel = ['admin' => 'Panel Admin', 'penulis' => 'Panel Penulis'][$hdUser->role] ?? 'Area Pengguna';
    $hdHome = match ($hdUser->role) {
        'admin' => '/admin/dashboard',
        'penulis' => '/penulis/dashboard',
        default => '/beranda',
    };
@endphp

<header class="dash-header" id="dash-header">
    <div class="hd-left">
        <button class="hd-toggle" id="sb-toggle" type="button" aria-controls="sidebar" aria-expanded="true" aria-label="Ciutkan sidebar">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 6h14M3 10h14M3 14h14"/></svg>
        </button>

        <a class="hd-brand" href="{{ $hdHome }}" aria-label="RuangKabar, ke dashboard">
            <span class="hd-logo"><img src="{{ asset('images/logo-ruangkabar.png') }}" alt="" width="46" height="46"></span>
            <span class="hd-brand__text">
                <span class="hd-brand__name">Ruang<span>Kabar</span></span>
                <span class="hd-brand__sub">{{ $hdPanel }}</span>
            </span>
        </a>
    </div>

    <div class="hd-right">
        <a class="hd-user" href="{{ route('account.settings') }}" aria-label="Pengaturan akun {{ $hdUser->name }}">
            <span class="hd-avatar" aria-hidden="true">{{ $hdInitial }}</span>
            <span class="hd-user__text">
                <span class="hd-user__name">{{ $hdUser->name }}</span>
                <span class="hd-user__role">{{ $hdRole }}</span>
            </span>
        </a>

        <form class="hd-form" action="/logout" method="POST">
            @csrf
            <button class="hd-logout" type="submit" aria-label="Logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4H5v16h4M16 8l4 4-4 4M20 12H9"/></svg>
                <span class="hd-logout__text">Logout</span>
            </button>
        </form>
    </div>
</header>