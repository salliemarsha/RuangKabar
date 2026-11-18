@php
    $footerNavCategories = \App\Models\Category::orderBy('name')->get();
@endphp

<footer class="pub-footer">
    <div class="wrap pub-footer__grid">
        <div class="pub-footer__brand">
            <a class="rk-brand" href="{{ url('/') }}" aria-label="RuangKabar, ke beranda">
                <svg class="rk-brand__mark" aria-hidden="true" focusable="false"><use href="#rk-mark"/></svg>
                <span class="rk-brand__name">Ruang<span>Kabar</span></span>
            </a>
            <p class="pub-footer__about">Portal berita dan informasi terkini.</p>
        </div>

        <div>
            <h2 class="pub-footer__title">Jelajahi</h2>
            <ul class="pub-footer__links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ route('articles.index') }}">Semua Berita</a></li>
            </ul>
        </div>

        @if ($footerNavCategories->isNotEmpty())
            <div>
                <h2 class="pub-footer__title">Kategori</h2>
                <ul class="pub-footer__links">
                    @foreach ($footerNavCategories as $footerCat)
                        <li><a href="{{ route('kategori.show', $footerCat) }}">{{ $footerCat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <h2 class="pub-footer__title">Akun</h2>
            <ul class="pub-footer__links">
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
        <div class="pub-footer__bottom">
            &copy; {{ date('Y') }} RuangKabar. All rights reserved.
        </div>
    </div>
</footer>
