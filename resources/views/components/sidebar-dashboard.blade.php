@php
    $sbRole = auth()->user()->role;

    $sbIcons = [
        'dashboard' => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'article' => '<path d="M6 3h9l4 4v14H6z"/><path d="M15 3v4h4M9 12h7M9 16h7"/>',
        'category' => '<path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>',
        'tag' => '<path d="M3 12V4h8l10 10-8 8z"/><circle cx="7.5" cy="8.5" r="1.2"/>',
        'comment' => '<path d="M4 5h16v11H9l-5 4z"/>',
        'report' => '<path d="M5 20V12M12 20V5M19 20v-9"/>',
        'users' => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 5.2a3 3 0 010 5.6M18 14.4c1.8.7 3 2.5 3 5.6"/>',
        'write' => '<path d="M4 20l4-1 11-11-3-3L5 16z"/><path d="M14 7l3 3"/>',
        'user' => '<circle cx="12" cy="8" r="3.5"/><path d="M5 20c0-3.9 3.1-7 7-7s7 3.1 7 7"/>',
        'home' => '<path d="M4 11l8-7 8 7v9h-5v-6H9v6H4z"/>',
    ];

    $sbGroups = match ($sbRole) {
        'admin' => [
            ['label' => 'Utama', 'items' => [
                ['label' => 'Dashboard', 'url' => '/admin/dashboard', 'icon' => 'dashboard', 'active' => request()->is('admin/dashboard')],
            ]],
            ['label' => 'Konten', 'items' => [
                ['label' => 'Artikel', 'url' => route('articles.index'), 'icon' => 'article', 'active' => request()->is('articles*')],
                ['label' => 'Kategori', 'url' => route('categories.index'), 'icon' => 'category', 'active' => request()->is('categories*')],
                ['label' => 'Tag', 'url' => route('tags.index'), 'icon' => 'tag', 'active' => request()->is('tags*')],
            ]],
            ['label' => 'Pengelolaan', 'items' => [
                ['label' => 'Komentar', 'url' => route('comments.index'), 'icon' => 'comment', 'active' => request()->is('comments*')],
                ['label' => 'Laporan', 'url' => route('reports.articles'), 'icon' => 'report', 'active' => request()->is('reports/*')],
                ['label' => 'Pengguna', 'url' => route('admin.users.index'), 'icon' => 'users', 'active' => request()->is('admin/users*')],
            ]],
        ],
        'penulis' => [
            ['label' => 'Utama', 'items' => [
                ['label' => 'Dashboard', 'url' => '/penulis/dashboard', 'icon' => 'dashboard', 'active' => request()->is('penulis/dashboard')],
            ]],
            ['label' => 'Konten', 'items' => [
                ['label' => 'Daftar Artikel', 'url' => route('articles.index'), 'icon' => 'article', 'active' => request()->is('articles') || (request()->is('articles/*') && ! request()->is('articles/create'))],
                ['label' => 'Tulis Artikel', 'url' => route('articles.create'), 'icon' => 'write', 'active' => request()->is('articles/create')],
            ]],
        ],
        default => [
            ['label' => 'Utama', 'items' => [
                ['label' => 'Akun Saya', 'url' => '/beranda', 'icon' => 'user', 'active' => request()->is('beranda')],
            ]],
        ],
    };
@endphp

<aside class="sidebar" id="sidebar" aria-label="Navigasi dashboard">
    <div class="sb-top">
        <span class="sb-top__title">Menu</span>

        <button class="sb-close" id="sb-close" type="button" aria-label="Tutup menu">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
        </button>
    </div>

    <nav class="sb-nav" aria-label="Menu {{ $sbRole }}">
        @foreach ($sbGroups as $group)
            <p class="sb-group-label">{{ $group['label'] }}</p>

            <ul class="sb-list">
                @foreach ($group['items'] as $item)
                    <li>
                        <a class="sb-link {{ $item['active'] ? 'is-active' : '' }}" href="{{ $item['url'] }}" data-title="{{ $item['label'] }}" @if ($item['active']) aria-current="page" @endif>
                            <span class="sb-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $sbIcons[$item['icon']] !!}</svg></span>
                            <span class="sb-text">{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </nav>

    <div class="sb-foot">
        <a class="sb-link" href="/" data-title="Lihat beranda">
            <span class="sb-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $sbIcons['home'] !!}</svg></span>
            <span class="sb-text">Lihat beranda</span>
        </a>
    </div>
</aside>