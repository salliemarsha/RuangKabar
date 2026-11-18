
@extends('layouts.dashboard')

@section('title', 'Dashboard Pengguna')

@push('styles')
<style>
.btn--light { color: var(--ivory); background: rgba(250, 248, 243, 0.1); border-color: rgba(250, 248, 243, 0.28); }
.btn--light:hover { color: var(--emerald); background: var(--ivory); border-color: var(--ivory); }

.uw-hero { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
.uw-hero-text { min-width: 0; max-width: 640px; }
.uw-greet { margin: 0 0 6px; font-family: var(--body); font-size: 16px; color: var(--gold); }
.uw-date { flex: none; min-width: 148px; padding: 18px 22px; text-align: center; background: rgba(250, 248, 243, 0.08); border: 1px solid rgba(185, 154, 100, 0.45); border-radius: 22px; }
.uw-date-day { display: block; font-family: var(--serif); font-size: 52px; font-weight: 600; line-height: 1; color: var(--gold); }
.uw-date-month { display: block; margin-top: 8px; font-family: var(--sans); font-size: 14px; font-weight: 700; color: var(--ivory); }
.uw-date-week { display: block; margin-top: 2px; font-family: var(--body); font-size: 12.5px; color: var(--on-dark); }

.uw-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 6px 20px; margin-bottom: 16px; }
.uw-h { margin: 0; font-family: var(--serif); font-size: 22px; font-weight: 600; color: var(--emerald); }
.uw-section { margin-top: 28px; }
.uw-link { display: inline-flex; align-items: center; gap: 6px; font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--forest); text-decoration: none; white-space: nowrap; }
.uw-link svg { width: 14px; height: 14px; transition: transform var(--t-ui) var(--ease); }
.uw-link:hover { color: var(--emerald); }
.uw-link:hover svg { transform: translateX(3px); }

.uw-stats { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
.uw-stat { display: flex; flex-direction: column; min-width: 0; padding: 22px 24px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out; }
.uw-stat-top { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
.uw-stat-label { font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--text-soft); }
.uw-stat-icon { display: flex; flex: none; align-items: center; justify-content: center; width: 42px; height: 42px; color: var(--forest); background: rgba(55, 107, 92, 0.12); border-radius: 14px; }
.uw-stat-icon svg { width: 21px; height: 21px; }
.uw-stat-value { font-family: var(--serif); font-size: 42px; font-weight: 600; line-height: 1; color: var(--emerald); }
.uw-stat-note { margin-top: 12px; font-family: var(--body); font-size: 13px; line-height: 1.55; color: var(--text-soft); }
.uw-stat--lead { background: var(--emerald); border-color: var(--emerald); }
.uw-stat--lead .uw-stat-label, .uw-stat--lead .uw-stat-note { color: var(--on-dark); }
.uw-stat--lead .uw-stat-value { color: var(--ivory); }
.uw-stat--lead .uw-stat-icon { color: var(--emerald); background: var(--gold); }

@media (hover: hover) {
    .uw-stat:hover { transform: translateY(-3px); box-shadow: 0 18px 30px -22px rgba(24, 60, 54, 0.5); }
}

.uw-activity { display: block; }
.uw-panel { min-width: 0; padding: 24px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }

.uw-comments { margin: 0; padding: 0; list-style: none; }
.uw-comment { display: grid; grid-template-columns: auto minmax(0, 1fr); gap: 14px; padding: 16px 0; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.uw-comment:first-child { padding-top: 0; }
.uw-comment:last-child { padding-bottom: 0; border-bottom: 0; }
.uw-comment-mark { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; color: var(--emerald); background: rgba(185, 154, 100, 0.2); border-radius: 13px; }
.uw-comment-mark svg { width: 19px; height: 19px; }
.uw-comment-body { min-width: 0; }
.uw-comment-top { display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 6px 12px; }
.uw-comment-article { display: inline-block; min-width: 0; font-family: var(--sans); font-size: 14.5px; font-weight: 700; line-height: 1.4; color: var(--emerald); text-decoration: none; overflow-wrap: anywhere; }
a.uw-comment-article:hover { color: var(--forest); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.uw-comment-text { margin: 6px 0 8px; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); overflow-wrap: anywhere; }
.uw-comment-date { font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }

.uw-badge { display: inline-flex; flex: none; align-items: center; gap: 7px; padding: 4px 11px; font-family: var(--sans); font-size: 11.5px; font-weight: 700; white-space: nowrap; border-radius: 999px; }
.uw-badge::before { content: ""; width: 6px; height: 6px; background: currentColor; border-radius: 50%; }
.uw-badge--ok { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.uw-badge--wait { color: #7A6130; background: rgba(185, 154, 100, 0.24); }
.uw-badge--no { color: var(--danger); background: var(--danger-soft); }
.uw-badge--neutral { color: var(--text-soft); background: rgba(104, 115, 110, 0.14); }

.uw-chips { display: flex; flex-wrap: wrap; gap: 8px; margin: 0 0 18px; padding: 0; list-style: none; }
.uw-chips a { display: inline-flex; align-items: center; height: 36px; padding: 0 16px; font-family: var(--sans); font-size: 12.5px; font-weight: 700; color: var(--emerald); text-decoration: none; background: var(--white); border: 1px solid var(--rule); border-radius: 999px; transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.uw-chips a:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }

.uw-news { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
.uw-item { position: relative; display: grid; grid-template-columns: 132px minmax(0, 1fr); gap: 16px; align-items: center; min-width: 0; padding: 12px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 20px; transition: transform var(--t-ui) var(--ease), box-shadow var(--t-ui) ease-out; }
.uw-thumb { display: block; overflow: hidden; aspect-ratio: 1 / 1; background: var(--emerald); border-radius: 14px; }
.uw-thumb img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform 600ms var(--ease); }
.uw-ph { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; overflow: hidden; background: var(--emerald); }
.uw-ph img { display: block; width: 55px !important; height: 55px !important; max-width: none; max-height: none; object-fit: contain !important; object-position: center; flex: 0 0 auto; }

.uw-item-body { display: flex; flex-direction: column; min-width: 0; padding-right: 6px; }
.uw-cat { position: relative; z-index: 2; align-self: flex-start; margin-bottom: 6px; font-family: var(--sans); font-size: 12.5px; font-weight: 700; color: var(--forest); text-decoration: none; }
.uw-cat:hover { color: var(--emerald); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.uw-title { display: -webkit-box; margin: 0 0 8px; overflow: hidden; -webkit-line-clamp: 3; -webkit-box-orient: vertical; font-family: var(--sans); font-size: 15.5px; font-weight: 700; line-height: 1.35; letter-spacing: -0.01em; overflow-wrap: anywhere; }
.uw-title a { color: var(--emerald); text-decoration: none; transition: color var(--t-fast) ease-out; }
.uw-title a::after { content: ""; position: absolute; inset: 0; z-index: 1; }
.uw-item-meta { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 4px 12px; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.uw-read { display: inline-flex; align-items: center; gap: 5px; font-family: var(--sans); font-weight: 700; color: var(--forest); }
.uw-read svg { width: 14px; height: 14px; transition: transform var(--t-ui) var(--ease); }

@media (hover: hover) {
    .uw-item:hover { transform: translateY(-3px); box-shadow: 0 16px 30px -22px rgba(24, 60, 54, 0.45); }
    .uw-item:hover .uw-thumb img { transform: scale(1.04); }
    .uw-item:hover .uw-title a { color: var(--forest); }
    .uw-item:hover .uw-read svg { transform: translateX(3px); }
}

.uw-empty { padding: 40px 22px; text-align: center; background: var(--ivory); border: 1px dashed rgba(24, 60, 54, 0.25); border-radius: 18px; }
.uw-empty strong { display: block; margin-bottom: 6px; font-family: var(--serif); font-size: 20px; font-weight: 600; color: var(--emerald); }
.uw-empty p { max-width: 400px; margin: 0 auto; font-family: var(--body); font-size: 14px; line-height: 1.65; color: var(--text-soft); }
.uw-empty .btn { margin-top: 18px; }

.uw-application { margin-top: 28px; padding: 24px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.uw-application h2 { margin: 0 0 8px; font-family: var(--serif); font-size: 22px; font-weight: 600; color: var(--emerald); }
.uw-application-desc { margin: 0 0 18px; font-size: 14px; line-height: 1.7; color: var(--text-soft); }
.uw-application textarea { display: block; width: 100%; min-height: 125px; padding: 14px; resize: vertical; color: var(--text); background: var(--ivory); border: 1px solid var(--rule); border-radius: 12px; font: inherit; font-size: 14px; line-height: 1.6; }
.uw-application textarea:focus { outline: 2px solid var(--gold); outline-offset: 2px; }
.uw-application label { display: block; margin-bottom: 9px; font-size: 13px; font-weight: 700; color: var(--emerald); }
.uw-application .btn { margin-top: 14px; }
.uw-application-status { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; }
.uw-application-note { margin: 12px 0 0; padding: 13px 15px; color: var(--text-soft); background: var(--ivory); border-radius: 11px; font-size: 13px; line-height: 1.6; }

@media (max-width: 1023px) {
    .uw-date { display: none; }
}

@media (max-width: 819px) {
    .uw-news { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 719px) {
    .uw-stats { gap: 12px; }
    .uw-stat { padding: 18px 16px; }
    .uw-stat-top { margin-bottom: 12px; }
    .uw-stat-value { font-size: 34px; }
    .uw-panel { padding: 20px 16px; border-radius: 20px; }
    .uw-item { grid-template-columns: 96px minmax(0, 1fr); gap: 12px; padding: 10px; }
    .uw-application { padding: 20px 16px; border-radius: 20px; }
}

@media (max-width: 479px) {
    .uw-stats { grid-template-columns: minmax(0, 1fr); }
    .uw-stat-top { margin-bottom: 10px; }
}
</style>
@endpush

@section('content')

@php
    $user = auth()->user();
    $str = \Illuminate\Support\Str::class;
    $hour = (int) now()->format('G');
    $greeting = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));

    $hasCommentDate = \Illuminate\Support\Facades\Schema::hasColumn('comments', 'created_at');

    $totalComments = $user->comments()->count();

    $recentComments = $hasCommentDate
        ? $user->comments()->where('created_at', '>=', now()->subDays(30))->count()
        : null;

    $commentedArticles = $user->comments()->distinct()->count('article_id');

    $myComments = $user->comments()
        ->with('article')
        ->orderByDesc('id')
        ->take(5)
        ->get();

    $totalReplies = \App\Models\Comment::whereIn(
        'parent_id',
        $user->comments()
            ->whereNull('parent_id')
            ->where('status', 'approved')
            ->select('id')
    )
        ->where('status', 'approved')
        ->count();

    $categories = \App\Models\Category::where('is_active', true)
        ->orderBy('name')
        ->get();

    $readingHistories = ($readingHistories ?? collect())->take(4);

    $tone = function ($status) {
        $key = strtolower((string) $status);

        if (in_array($key, ['approved', 'published', 'disetujui', 'tampil', 'visible'], true)) {
            return 'ok';
        }

        if (in_array($key, ['pending', 'menunggu', 'review'], true)) {
            return 'wait';
        }

        if (in_array($key, ['rejected', 'ditolak', 'hidden', 'disembunyikan'], true)) {
            return 'no';
        }

        return 'neutral';
    };

    $toneLabel = ['ok' => 'Tampil', 'wait' => 'Menunggu moderasi', 'no' => 'Ditolak'];
    $newsList = $articles->slice(0, 4)->values();
@endphp

<section class="hero" aria-labelledby="page-title">
    <div class="hero-inner uw-hero">
        <div class="uw-hero-text">
            <span class="hero-label">DASHBOARD PENGGUNA</span>
            <p class="uw-greet">{{ $greeting }},</p>
            <h1 class="hero-title" id="page-title">{{ $user->name }}</h1>
            <p class="hero-lead">Temukan berita dan informasi terbaru dari berbagai kategori di RuangKabar, lalu bagikan pendapat Anda lewat komentar.</p>
            <div class="hero-actions">
                <a class="btn btn--gold" href="{{ route('articles.index') }}">Jelajahi Berita <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
                <a class="btn btn--light" href="/">Kembali ke Beranda</a>
            </div>
        </div>

        <div class="uw-date" aria-label="Tanggal hari ini">
            <span class="uw-date-day">{{ now()->locale('id')->translatedFormat('d') }}</span>
            <span class="uw-date-month">{{ now()->locale('id')->translatedFormat('F Y') }}</span>
            <span class="uw-date-week">{{ now()->locale('id')->translatedFormat('l') }}</span>
        </div>
    </div>
</section>

<section class="uw-application" aria-labelledby="author-application-title">
    <h2 id="author-application-title">Bergabung sebagai Penulis</h2>

    <p class="uw-application-desc">
        Punya informasi, wawasan, atau ide menarik untuk dibagikan?
        Ajukan diri menjadi penulis RuangKabar dan berkontribusi menyajikan
        informasi kepada pembaca.
    </p>

    @if (session('success'))
        <p class="uw-application-note">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="uw-application-note">{{ session('error') }}</p>
    @endif

    @if ($latestAuthorApplication && $latestAuthorApplication->status === 'pending')
        <div class="uw-application-status">
            <span class="uw-badge uw-badge--wait">Menunggu Persetujuan</span>
        </div>

        <p class="uw-application-note">
            Pengajuan Anda sedang ditinjau oleh admin. Anda akan mendapatkan
            informasi setelah admin menyelesaikan proses peninjauan.
        </p>

    @elseif ($latestAuthorApplication && $latestAuthorApplication->status === 'rejected')
        <div class="uw-application-status">
            <span class="uw-badge uw-badge--no">Pengajuan Ditolak</span>
        </div>

        @if ($latestAuthorApplication->admin_note)
            <p class="uw-application-note">
                <strong>Catatan admin:</strong>
                {{ $latestAuthorApplication->admin_note }}
            </p>
        @endif

        <p class="uw-application-desc" style="margin-top: 14px;">
            Anda masih dapat mengajukan kembali permohonan menjadi penulis.
        </p>

        <form method="POST" action="{{ route('author-applications.store') }}">
            @csrf

            <label for="author-reason">Alasan ingin menjadi penulis</label>
            <textarea
                id="author-reason"
                name="reason"
                minlength="20"
                maxlength="2000"
                required
                placeholder="Ceritakan alasan dan kontribusi yang ingin Anda berikan kepada RuangKabar..."
            >{{ old('reason') }}</textarea>

            @error('reason')
                <p class="uw-application-note">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn--gold">Ajukan Kembali</button>
        </form>

    @else
        <form method="POST" action="{{ route('author-applications.store') }}">
            @csrf

            <label for="author-reason">Alasan ingin menjadi penulis</label>
            <textarea
                id="author-reason"
                name="reason"
                minlength="20"
                maxlength="2000"
                required
                placeholder="Ceritakan alasan dan kontribusi yang ingin Anda berikan kepada RuangKabar..."
            >{{ old('reason') }}</textarea>

            @error('reason')
                <p class="uw-application-note">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn--gold">Kirim Pengajuan</button>
        </form>
    @endif
</section>

<section aria-labelledby="summary-title">
    <div class="uw-head">
        <h2 class="uw-h" id="summary-title">Ringkasan Aktivitas</h2>
    </div>

    <div class="uw-stats">
        <article class="uw-stat uw-stat--lead">
            <div class="uw-stat-top">
                <span class="uw-stat-label">Komentar Saya</span>
                <span class="uw-stat-icon" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>
            </div>
            <span class="uw-stat-value">{{ number_format($totalComments, 0, ',', '.') }}</span>
            <span class="uw-stat-note">
                Komentar yang pernah Anda tulis
                @if ($recentComments !== null)
                    &middot; {{ number_format($recentComments, 0, ',', '.') }} dalam 30 hari terakhir
                @endif
                &middot; {{ number_format($commentedArticles, 0, ',', '.') }} artikel
            </span>
        </article>

        <article class="uw-stat">
            <div class="uw-stat-top">
                <span class="uw-stat-label">Balasan Diterima</span>
                <span class="uw-stat-icon" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 5L3 9.5 8 14"/><path d="M3 9.5h8a6 6 0 016 6V16"/></svg></span>
            </div>
            <span class="uw-stat-value">{{ number_format($totalReplies, 0, ',', '.') }}</span>
            <span class="uw-stat-note">Balasan yang sudah tampil pada komentar Anda</span>
        </article>
    </div>
</section>

<section class="uw-section" aria-labelledby="activity-title">
    <div class="uw-head">
        <h2 class="uw-h" id="activity-title">Aktivitas Komentar</h2>
        <p class="uw-sub">Lima komentar terakhir Anda</p>
    </div>

    <div class="uw-activity">
        <div class="uw-panel">
            @if ($myComments->isNotEmpty())
                <ul class="uw-comments">
                    @foreach ($myComments as $comment)
                        <li class="uw-comment">
                            <span class="uw-comment-mark" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h14v10H9l-4 3v-3H3z"/></svg></span>

                            <div class="uw-comment-body">
                                <div class="uw-comment-top">
                                    @if ($comment->article)
                                        <a class="uw-comment-article" href="{{ route('articles.show', $comment->article) }}">{{ $comment->article->title }}</a>
                                    @else
                                        <span class="uw-comment-article">Artikel tidak tersedia</span>
                                    @endif

                                    @if ($comment->status)
                                        @php $t = $tone($comment->status); @endphp
                                        <span class="uw-badge uw-badge--{{ $t }}">{{ $toneLabel[$t] ?? $str::ucfirst($comment->status) }}</span>
                                    @endif
                                </div>

                                <p class="uw-comment-text">{{ $str::limit(strip_tags($comment->comment), 140) }}</p>

                                @if ($comment->created_at)
                                    <time class="uw-comment-date" datetime="{{ $comment->created_at->toDateString() }}">{{ $comment->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="uw-empty">
                    <strong>Belum ada aktivitas komentar</strong>
                    <p>Baca berita yang menarik, lalu tulis komentar pertama Anda. Riwayatnya akan tampil di sini.</p>
                    <a class="btn" href="{{ route('articles.index') }}">Jelajahi Berita</a>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="uw-section" aria-labelledby="history-title">
    <div class="uw-head">
        <h2 class="uw-h" id="history-title">Riwayat Bacaan</h2>
    </div>

    @if ($readingHistories->isNotEmpty())
        <div class="uw-news">
            @foreach ($readingHistories as $history)
                @php
                    $readArticle = $history->article;
                    $readAt = $history->last_read_at
                        ? \Illuminate\Support\Carbon::parse($history->last_read_at)
                        : null;
                @endphp

                @if ($readArticle)
                    <article class="uw-item">
                        <a class="uw-thumb" href="{{ route('articles.show', $readArticle) }}" tabindex="-1" aria-hidden="true">
                            @if ($readArticle->image)
                                <img src="{{ asset('storage/' . $readArticle->image) }}" alt="" loading="lazy">
                            @else
                                <div class="uw-ph">
                                    <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                                </div>
                            @endif
                        </a>

                        <div class="uw-item-body">
                            @if ($readArticle->category)
                                <a class="uw-cat" href="{{ route('kategori.show', $readArticle->category) }}">{{ $readArticle->category->name }}</a>
                            @endif

                            <h3 class="uw-title"><a href="{{ route('articles.show', $readArticle) }}">{{ $readArticle->title }}</a></h3>

                            <div class="uw-item-meta">
                                @if ($readAt)
                                    <time datetime="{{ $readAt->toDateString() }}">Dibaca {{ $readAt->locale('id')->translatedFormat('d F Y') }}</time>
                                @endif
                                <span class="uw-read" aria-hidden="true">Baca lagi <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                            </div>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
    @else
        <div class="uw-empty">
            <strong>Belum ada riwayat bacaan</strong>
            <p>Berita yang Anda buka akan tersimpan di sini agar mudah ditemukan kembali.</p>
            <a class="btn" href="{{ route('articles.index') }}">Jelajahi Berita</a>
        </div>
    @endif
</section>

<section class="uw-section" aria-labelledby="news-title">
    <div class="uw-head">
        <h2 class="uw-h" id="news-title">Berita Terbaru</h2>
        <a class="uw-link" href="{{ route('articles.index') }}">Lihat semua berita <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg></a>
    </div>

    @if ($categories->isNotEmpty())
        <ul class="uw-chips" aria-label="Jelajahi kategori">
            @foreach ($categories as $cat)
                <li><a href="{{ route('kategori.show', $cat) }}">{{ $cat->name }}</a></li>
            @endforeach
        </ul>
    @endif

    @if ($newsList->isNotEmpty())
        <div class="uw-news">
            @foreach ($newsList as $article)
                <article class="uw-item">
                    <a class="uw-thumb" href="{{ route('articles.show', $article) }}" tabindex="-1" aria-hidden="true">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="" loading="lazy">
                        @else
                            <div class="uw-ph">
                                <img src="{{ asset('images/logo-ruangkabar.png') }}" alt="RuangKabar">
                            </div>
                        @endif
                    </a>

                    <div class="uw-item-body">
                        @if ($article->category)
                            <a class="uw-cat" href="{{ route('kategori.show', $article->category) }}">{{ $article->category->name }}</a>
                        @endif

                        <h3 class="uw-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>

                        <div class="uw-item-meta">
                            @if ($article->created_at)
                                <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                            @endif
                            <span class="uw-read" aria-hidden="true">Baca <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg></span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="uw-empty">
            <strong>Belum ada berita yang dipublikasikan.</strong>
            <p>Berita terbaru akan tampil di sini setelah dipublikasikan oleh redaksi.</p>
            <a class="btn" href="{{ route('articles.index') }}">Lihat Daftar Berita</a>
        </div>
    @endif
</section>
@endsection
